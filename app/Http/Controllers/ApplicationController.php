<?php

namespace App\Http\Controllers;

use App\Mail\Mail\SendMail;
use App\Models\Application;
use App\Models\Applicator;
use App\Models\OrderApplication;
use App\Models\ProductApplication;
use App\Models\Productrange;
use App\Models\Provider;
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
    public function index()
    {
       // список заявок пользователя
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Applicator $applicator)
    {
        $date_year = [
            Carbon::now()->format('Y'), Carbon::now()->addYear()->format('Y')
        ];

        $date_month = [];

        for($i = 1; count($date_month) < 12; $i++) {
            $date_month[] = Carbon::now()->addMonth($i)->format('F');
        }

        return view('templates.applications.create', ['applicator' => $applicator, 'date_month' => $date_month, 'date_year' => $date_year]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Applicator $applicator, Request $request)
    {
        $date = "$request->year $request->month";
        $date = Carbon::createFromFormat('Y F', $date)->lastOfMonth();

        $application = Application::create([
            'consigneer_id' => $request->consigneer_id,
            'applicator_id' => $request->applicator->id,
            'status' => 'new',
            'number' => '01/'. random_int(100, 200) . '-' .random_int(100, 200) ,
            'provider_id' => $request->provider_id,
            'period' => $date->format('Y-m-d'),
            ]);

        $productranges = Productrange::where('provider_id', $request->provider_id)->paginate(15);

        return view('templates.applications.productrange', compact('productranges','application'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function createProductVolume(Application $application, Request $request)
    {
        $productranges = Productrange::find(array_keys($request->productranges));
        $consigneer_deliveries = $application->consigneer->consigneerDeliveries;

        return view('templates.applications.volume', compact('productranges','application', 'consigneer_deliveries'));
    }

    public function confirmApplication(Application $application, Request $request)
    {
        $products = $request->productranges;

        foreach ($products as $product) {
            $min_lot = Productrange::find($product['productrange_id'])->min_lot;
            $validator = Validator::make($request->all(), [
                'volume_1' => 'integer|min:' . $min_lot,
                'volume_2' => 'integer|min:' . $min_lot,
                'volume_3' => 'integer|min:' . $min_lot,
                ], [
                    'integer' => 'Введите целое число',
                    'min' => 'Не менее '. $min_lot . 'т',
                ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            } else {
                $product_application = new ProductApplication(
                    $application->id,
                    $product['productrange_id'],
                    $product['volume_1'],
                    $product['volume_2'],
                    $product['volume_3'],
                    $product['consigneer_delivery_id']);
                $product_application->setPrice();
                $price[]= $product_application->price;
                $volume[] = $product_application->getVolume();
                $product_applications[] = $product_application;
            }
        }
        //$product_applications = collect($product_applications);

        return view('templates.applications.confirm', compact('application', 'product_applications', 'price', 'volume'));
    }

    public function createOrder(Application $application, Request $request)
    {
        $products = $request->query('product_applications');
        $price = $request->query('price');
        $comment = $request->comment;

        foreach ($products as $key => $product) {
            $product_application = OrderApplication::create([
                'application_id' => $product['application_id'],
                'productrange_id' => $product['productrange_id'],
                'volume_1' => (array_key_exists('volume_1', $product) ? $product['volume_1'] : null),
                'volume_2' =>(array_key_exists('volume_2', $product) ? $product['volume_2'] : null),
                'volume_3' =>(array_key_exists('volume_3', $product) ? $product['volume_3'] : null),
                'consigneer_delivery_id' => $product['consigneer_delivery_id'],
                'price' => $product['price'],
            ]);

            $volume[] = $product_application->getVolume();
            $product_applications[] = $product_application;
        }

        $subject = "Уведомление о создании заказа";
        $email = $application->applicator->user->email;

        $name = $application->applicator->user->firstName . " " . $application->applicator->user->lastName;
        $data = ['application' => $application, 'product_applications' => $product_applications,'volume' => $volume, 'price' => $price, 'comment' => $comment];
        $view = "templates.mail.applications";
        $send = Mail::send(['html' => $view], $data, function($message) use ($subject, $name, $email) {
            $message->to($email, $name);
            $message->cc('file.storages.ex@gmail.com');
            $message->from('file.storages.ex@gmail.com', 'SFT Group');
            $message->subject($subject);
        });
        if(!$send) {
            session()->flash('alert', 'Ошибка отправки писем.');
        }

        return redirect()->route('applicators.show', $applicator = $application->applicator->id);
    }
}
