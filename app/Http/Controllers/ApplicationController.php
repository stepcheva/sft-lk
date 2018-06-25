<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Applicator;
use App\Models\OrderApplication;
use App\Models\ProductApplication;
use App\Models\Productrange;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Mail;

class ApplicationController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Applicator $applicator, Request $request)
    {
        switch ($request->param) {
            case 'current':
                $applications = $applicator->getMonthlyApplications();
                break;
            case 'new':
            case 'done':
            case 'draft':
                $applications = $applicator->getApplications($request->param);
                break;
            default:
                $applications = $applicator->applications;
                break;
        }
        $user = $applicator->user;
        $active = $request->param;

        return view('templates.applications.index', compact('user', 'applicator', 'applications','active'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Applicator $applicator)
    {
        $date_year = [
            Carbon::now()->format('Y'),
            Carbon::now()->addYear()->format('Y')
        ];

        $date_month = [];

        for ($i = 1; count($date_month) < 12; $i++) {
            $date_month[] = Carbon::now()->addMonth($i)->format('F');
        }

        return view('templates.applications.create',
            ['applicator' => $applicator, 'date_month' => $date_month, 'date_year' => $date_year, 'user' => $applicator->user]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Applicator $applicator, Request $request)
    {
        $date = "$request->date_year $request->date_month";
        $date = Carbon::createFromFormat('Y F', $date)->lastOfMonth();

        $application = Application::create([
            'consigneer_id' => $request->consigneer_id,
            'applicator_id' => $request->applicator->id,
            'status' => 'draft',
            'number' => '01/' . random_int(100, 200) . '-' . random_int(100, 200),
            'provider_id' => $request->provider_id,
            'period' => $date->format('Y-m-d'),
        ]);

        $productranges = Productrange::where('provider_id', $request->provider_id)->paginate(15);

        return view('templates.applications.productrange', compact('productranges', 'application'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Applicator $applicator, Application $application)
    {
        $product_applications = $application->order_applications;
        $user = $applicator->user;
        return view('templates.applications.show', compact('applicator', 'application', 'product_applications', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Applicator $applicator, Application $application)
    {
        $order_applications = $application->order_applications;
        return response()->json([
            'application' => $application,
            'order_applications' => $order_applications,
        ]);
        //view('templates.applications.edit', compact('applicator','application', 'order_applications'));
    }
    public function duplicate(Application $application)
    {
        $new_application = Application::create([
            'consigneer_id' => $application->consigneer_id,
            'applicator_id' => $application->applicator->id,
            'status' => 'draft',
            'number' => '01/' . random_int(100, 200) . '-' . random_int(100, 200),
            'provider_id' => $application->provider_id,
            'period' => $application->period,
        ]);

        $products = $application->order_applications;
        if (isset($products)) {
            foreach ($products as $product) {
                $product_application = OrderApplication::create([
                    'application_id' => $new_application->id,
                    'productrange_id' => $product->productrange->id,
                    'volume_1' => $product->volume_1,
                    'volume_2' => $product->volume_2,
                    'volume_3' => $product->volume_3,
                    'consigneer_delivery_id' => $product->consigneer_delivery_id,
                    'price' => $product->price,
                ]);
            }

            $status = 'new';
            $new_application->setStatus($status);
            $send = $new_application->sendNotification();

            if (!$send) {
                session()->flash('alert', 'Ошибка отправки писем.');
                return redirect()->route('applications.index', ['applicator' => $application->applicator->id, 'user' => $application->applicator->id]);
            } else {
                session()->flash('success', 'Уведомление отправлено на email.');
            }
        }
        return redirect()->route('applications.index', ['applicator' => $application->applicator->id, 'user' => $application->applicator->id, 'active' => $new_application->status ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $application = Application::find($id)->update([
            'consigneer_id' => $request->consigneer_id,
            'applicator_id' => $request->applicator->id,
            'status' => $request->status,
            'number' => $request->number,
            'provider_id' => $request->provider_id,
            'period' => $request->period,
        ]);

        $products = $request->order_applications ? $request->order_applications : null;
        if (isset($products)) {
            foreach ($products as $key => $product) {
                $product_application = OrderApplication::find($product->id)->update([
                    'volume_1' => (array_key_exists('volume_1', $product) ? $product['volume_1'] : null),
                    'volume_2' => (array_key_exists('volume_2', $product) ? $product['volume_2'] : null),
                    'volume_3' => (array_key_exists('volume_3', $product) ? $product['volume_3'] : null),
                    //'price' => $product['price'],
                ]);
                $volume = $product_application->getVolume();
                $price = (ConsigneerDelivery::find($product->consigneer_delivery_id)->price) * $volume;
                $product_application->update(['price', $price]);
            }
        }

        return response()->json([
            'application' => $application,
            'order_applications' => $application->order_applications,
        ]);
    }

    public function destroy($applicator_id, $application_id)
    {
        $application = Application::findOrFail($application_id);
        if (isset($application->id)) {
            $application->order_applications()->delete();
            Application::destroy($application->id);
            session()->flash('success', 'Заявка успешно удалена.');
            return redirect()->route('applications.index', ['applicator' => $applicator_id]);
        }
    }

    public function createProductVolume(Application $application, Request $request)
    {
        if (!isset($request->products)) {
            $search = array_keys($request->productranges);
        } else {
            foreach ($request->products as $product) {
                $search[] = $product['productrange_id'];
            }
        }

        $productranges = Productrange::find($search);

        return view('templates.applications.volume', compact('productranges', 'application'));
    }

    public function confirmApplication(Application $application, Request $request)
    {
        $products = $request->productranges;

        foreach ($products as $key => $product) {

            $min_lot = Productrange::find($product['productrange_id'])->min_lot;

            $validator = Validator::make($product, [
                'volume_1' => isset($product['volume_1']) ? 'numeric|integer|min:' . $min_lot : '',
                'volume_2' => isset($product['volume_2']) ? 'numeric|integer|min:' . $min_lot : '',
                'volume_3' => isset($product['volume_3']) ? 'numeric|integer|min:' . $min_lot : '',
            ]);

            if ($validator->messages()->has('volume_1')) {
                $validator_errors[$key]['volume_1'] = 'Не менее ' . $min_lot . 'т';
            }
            if ($validator->messages()->has('volume_2')) {
                $validator_errors[$key]['volume_2'] = 'Не менее ' . $min_lot . 'т';
            }
            if ($validator->messages()->has('volume_3')) {
                $validator_errors[$key]['volume_3'] = 'Не менее ' . $min_lot . 'т';
            }
        }
        if ($validator->fails()) {
            return redirect()->route('applications.product',
                compact('application', 'products', 'validator_errors'))->withInput();
        } else {
            foreach ($products as $product) {
                $product_application = new ProductApplication($application->id, $product['productrange_id'],
                    $product['volume_1'], $product['volume_2'], $product['volume_3'], $product['consigneer_delivery_id']);
                $product_application->setPrice();
                $price[] = $product_application->price;
                $volume[] = $product_application->getVolume();
                $product_applications[] = $product_application;
            }
        }

        //$product_applications = collect($product_applications);
        return view('templates.applications.confirm',
            compact('application', 'product_applications', 'price', 'volume'));
    }

    public function createOrder(Application $application, Request $request)
    {
        $products = $request->query('product_applications');
        $price = $request->query('price');
        $application->contactquery()->create([
            'application_id' => $application->id,
            'theme' => "Комментарий к заявке $application->number",
            'querytext' => $request->comment,
        ]);

        foreach ($products as $key => $product) {
            $application->order_applications()->create([
                'application_id' => $application->id,
                'productrange_id' => $product['productrange_id'],
                'volume_1' => (array_key_exists('volume_1', $product) ? $product['volume_1'] : null),
                'volume_2' => (array_key_exists('volume_2', $product) ? $product['volume_2'] : null),
                'volume_3' => (array_key_exists('volume_3', $product) ? $product['volume_3'] : null),
                'consigneer_delivery_id' => $product['consigneer_delivery_id'],
                'price' => $product['price'],
            ]);
        }

        //меняем статус с noncomplete на new
        $application->setStatus('new');
        $send = $application->sendNotification();

        if (!$send) {
            session()->flash('alert', 'Ошибка отправки писем.');
        }

        return redirect()->route('applications.index', ['applicator' => $application->applicator->id, 'user' => $application->applicator->id, 'active' => $application->status ]);
    }
}
