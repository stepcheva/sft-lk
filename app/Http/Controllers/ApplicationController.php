<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Applicator;
use App\Models\Lunit;
use App\Models\OrderApplication;
use App\Models\ProductApplication;
use App\Models\ConsigneerDelivery;
use App\Models\CooperationProductrange;
use App\Models\Productrange;
use Illuminate\Database\Eloquent\Collection;
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
            case 'canceled':
                $applications = $applicator->getApplications($request->param);
                break;
            default:
                $applications = $applicator->applications;
                break;
        }
        $user = $applicator->user;
        $active = $request->param;

        return view('templates.applications.index', compact('user', 'applicator', 'applications', 'active'));
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

        return view('templates.applications.create', [
                'applicator' => $applicator,
                'date_month' => $date_month,
                'date_year' => $date_year,
                'user' => $applicator->user
            ]);
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

        $products = $this->getProducts($application);

        return view('templates.applications.step2', compact('application', 'products'));
    }

    public function getProducts(Application $application)
    {
        $products = [
            "name" => "Товар",
            "selected" =>  -1,
            "brand" => [
                '0' => [
                    "placeholder" => "Марка",
                    "name" => 'M (SFT Medium)',
                    "selected" => -1,
                    "grammage" => [
                        '0' => [
                            "placeholder" => "Граммаж",
                            "name" => '100',
                            "selected" => -1,
                            "format" => [
                                '0' => [
                                    "placeholder" => "Формат",
                                    "name" => '2100',
                                    "id" => '63',
                                    "min_lot" => '30',
                                    "deliveries" => [
                                        '0' => [
                                            "name" => 'Авто',
                                            "delivery_id" => '1',
                                            "price" => '33250',
                                        ],
                                        '1' => [
                                            "name" => 'ЖД',
                                            "delivery_id" => '2',
                                            "price" => '33670',
                                        ]
                                    ]
                                ],
                                '1' => [
                                    "placeholder" => "Формат",
                                    "name" => '2200',
                                    "id" => '64',
                                    "min_lot" => '30',
                                    "deliveries" => [
                                        '0' => [
                                            "name" => 'Авто',
                                            "delivery_id" => '1',
                                            "price" => '33250',
                                        ],
                                        '1' => [
                                            "name" => 'ЖД',
                                            "delivery_id" => '2',
                                            "price" => '33670',
                                        ]
                                    ]
                                ]
                            ]
                        ],
                        '1' => [
                            "placeholder" => "Граммаж",
                            "name" => '110',
                            "selected" => -1,
                            "format" => [
                                '0' => [
                                    "placeholder" => "Формат",
                                    "name" => '2100',
                                    "id" => '65',
                                    "min_lot" => '30',
                                    "deliveries" => [
                                        '0' => [
                                            "name" => 'Авто',
                                            "delivery_id" => '1',
                                            "price" => '33250',
                                        ],
                                        '1' => [
                                            "name" => 'ЖД',
                                            "delivery_id" => '2',
                                            "price" => '33670',
                                        ]
                                    ]
                                ],
                                '1' => [
                                    "placeholder" => "Формат",
                                    "name" => '2200',
                                    "id" => '66',
                                    "min_lot" => '30',
                                    "deliveries" => [
                                        '0' => [
                                            "name" => 'Авто',
                                            "delivery_id" => '1',
                                            "price" => '33250',
                                        ],
                                        '1' => [
                                            "name" => 'ЖД',
                                            "delivery_id" => '2',
                                            "price" => '33670',
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ]
                ],
                '1' => [
                    "placeholder" => "Марка",
                    "name" => 'L (SFT Large)',
                    "selected" => -1,
                    "grammage" => [
                        '0' => [
                            "placeholder" => "Граммаж",
                            "name" => '100',
                            "selected" => -1,
                            "format" => [
                                '0' => [
                                    "placeholder" => "Формат",
                                    "name" => '2100',
                                    "id" => '67',
                                    "min_lot" => '30',
                                    "deliveries" => [
                                        '0' => [
                                            "name" => 'Авто',
                                            "delivery_id" => '1',
                                            "price" => '33250',
                                        ],
                                        '1' => [
                                            "name" => 'ЖД',
                                            "delivery_id" => '2',
                                            "price" => '33670',
                                        ]
                                    ]
                                ],
                                '1' => [
                                    "placeholder" => "Формат",
                                    "name" => '2200',
                                    "id" => '63',
                                    "min_lot" => '30',
                                    "deliveries" => [
                                        '0' => [
                                            "name" => 'Авто',
                                            "delivery_id" => '1',
                                            "price" => '33250',
                                        ],
                                        '1' => [
                                            "name" => 'ЖД',
                                            "delivery_id" => '2',
                                            "price" => '33670',
                                        ]
                                    ]
                                ]
                            ]
                        ],
                        '1' => [
                            "placeholder" => "Граммаж",
                            "name" => '110',
                            "selected" => -1,
                            "format" => [
                                '0' => [
                                    "placeholder" => "Формат",
                                    "name" => '2100',
                                    "id" => '68',
                                    "min_lot" => '30',
                                    "deliveries" => [
                                        '0' => [
                                            "name" => 'Авто',
                                            "delivery_id" => '1',
                                            "price" => '33250',
                                        ],
                                        '1' => [
                                            "name" => 'ЖД',
                                            "delivery_id" => '2',
                                            "price" => '33670',
                                        ]
                                    ]
                                ],
                                '1' => [
                                    "placeholder" => "Формат",
                                    "name" => '2100',
                                    "id" => '69',
                                    "min_lot" => '30',
                                    "deliveries" => [
                                        '0' => [
                                            "name" => 'Авто',
                                            "delivery_id" => '1',
                                            "price" => '33250',
                                        ],
                                        '1' => [
                                            "name" => 'ЖД',
                                            "delivery_id" => '2',
                                            "price" => '33670',
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];
        return response()->json([
            'products' => $products,
        ]);

    /*
        $consigneer_id = $application->consigneer_id;
        $products_id = CooperationProductrange::where('cooperation_id',
            Applicator::find($application->applicator_id)->cooperation->id)->pluck('productrange_id');
        $productranges = Productrange::find($products_id);

        //products tree generating
        $products =  $productranges->groupBy('brand')->map(function ($key, $item) {
            $name = $item;
            return compact('name');
        })->values();

        $grammage = $productranges->groupBy('brand')->map(function ($item) {
            return $item->groupBy('grammage')->map(function ($key, $i) {
                $name = $i;
                $placeholder = 'Граммаж';
                return compact('name', 'placeholder');
            })->values();
        })->values();

        $format = $productranges->groupBy('brand')->map(function ($item) {
            return $item->groupBy('grammage')->map(function ($i) {
                return $i->groupBy('format')->map(function ($key, $j)  {
                    $name = $j;
                    $placeholder = 'Формат';
                    return compact('name', 'placeholder');
                })->values();
            })->values();
        })->values();

        $products->toArray();
        $grammage->toArray();
        $format->toArray();
        dd($grammage->toArray());
        */
        /*
        $products = $productranges->groupBy('brand')->map(function ($item) {
            return $item->groupBy('grammage')->map(function ($i) {
                return $i->groupBy('format')->map(function ($j)  {
                    return $j;
                });
            });
        });
        */
   /*
        foreach ($products as $b => $collection) {
            foreach ($collection as $g => $item) {
                foreach ($item as $f => $j) {
                    foreach($j as $productrange) {
                        $consigneer_delivery = $productrange->consigneerDeliveries;
                        foreach ($consigneer_delivery as $key => $value) {
                            $placeholder = "Способ доставки";
                            $name = $value->delivery->name;
                            $delivery_id = $value->delivery->id;
                            $price = $value->price;
                            $deliveries[] = compact('placeholder', 'name', 'delivery_id', 'price');
                        }
                        $placeholder = "Формат";
                        $name = $f;
                        $id = $productrange->id;
                        $min_lot = $productrange->min_lot;
                        $format[] = compact('placeholder', 'name', 'id', 'min_lot', 'deliveries');
                    }
                }
                $placeholder = "Граммаж";
                $name = $g;
                $selected = -1;
                $grammage[] = compact('placeholder', 'name', 'selected', 'format');
            }
            $placeholder = "Марка";
            $name = $b;
            $selected = -1;
            $brand[] = compact('placeholder', 'name', 'selected', 'grammage');
        }
        $name = "Товар";
        $selected = -1;
        $result[] = compact( 'name', 'selected', 'brand');

        dd($products);



        /*
        $products = [
            "name" => "Товар",
            "selected" =>  -1,
            "brand" => [
                '0' => [
                    "placeholder" => "Марка",
                    "name" => '',
                    "selected" => -1,
                    "grammage" => [
                        '0' => [
                            "placeholder" => "Граммаж",
                            "name" => '',
                            "selected" => -1,
                            "format" => [
                                '0' => [
                                    "placeholder" => "Формат",
                                    "name" => '',
                                    "id" => '',
                                    "min_lot" => '',
                                    "deliveries" => [
                                        '0' => [
                                            "placeholder" => "Способ доставки",
                                            "name" => '',
                                            "delivery_id" => '',
                                            "price" => '',
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ]
    */

  }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Applicator $applicator, Application $application, Request $request)
    {
        $product_applications = $application->order_applications;
        $user = $applicator->user;
        if ($application->lunits) {
            $active = (isset($request->active)) ? $request->active : '1';
            $lunits = $application->getLunits($active);
            $data = compact('applicator', 'application', 'product_applications', 'lunits', 'active', 'user');
        } else {
            $data = compact('applicator', 'application', 'product_applications', 'user');
        }

        //dd(compact('applicator', 'application', 'product_applications', 'lunits', 'active', 'user'));

        return view('templates.applications.show', $data);
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
                return redirect()->route('applications.index',
                    ['applicator' => $application->applicator->id, 'user' => $application->applicator->id]);
            } else {
                session()->flash('success', 'Уведомление отправлено на email.');
            }
        }
        return redirect()->route('applications.index', [
            'applicator' => $application->applicator->id,
            'user' => $application->applicator->id,
            'active' => $new_application->status
        ]);
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
            return redirect()->back()->with(['applicator' => $applicator_id]);
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
        dd($request);
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
                    $product['volume_1'], $product['volume_2'], $product['volume_3'],
                    $product['consigneer_delivery_id']);
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

        if (null !== ($request->query('comment'))) {
            $application->contactquery()->create([
                'application_id' => $application->id,
                'theme' => "Комментарий к заявке $application->number",
                'querytext' => $request->comment,
            ]);
        }

        foreach ($products as $key => $product) {
            $order = $application->order_applications()->create([
                'application_id' => $application->id,
                'productrange_id' => $product['productrange_id'],
                'volume_1' => (array_key_exists('volume_1', $product) ? $product['volume_1'] : null),
                'volume_2' => (array_key_exists('volume_2', $product) ? $product['volume_2'] : null),
                'volume_3' => (array_key_exists('volume_3', $product) ? $product['volume_3'] : null),
                'consigneer_delivery_id' => $product['consigneer_delivery_id'],
                'price' => $product['price'],
            ]);
            //разбиваем товары в заявке на юниты
            //$units = $order->createUnits();
            //$this->createFromUnits($units);
        }
        //dd($application->lunits->map(function ($item) {
        //   return $item->units;
        //}));

        //меняем статус с noncomplete на new
        $application->setStatus('new');

        $send = $application->sendNotification();

        if (!$send) {
            session()->flash('alert', 'Ошибка отправки писем.');
        }


        return redirect()->route('applications.index', [
            'applicator' => $application->applicator->id,
            'user' => $application->applicator->id,
            'active' => $application->status
        ]);
    }

    public function createFromUnits($units)
    {
        $consigneer_id = $units[0]->application->consigneer->id;
        $application_id = $units[0]->application->id;
        $delivery_id = $units[0]->order_application->consigneer_delivery->delivery_id;
        $volume = array_sum(array_map(function ($item) {
            return $item->volume;
        }, $units));
        $price = array_sum(array_map(function ($item) {
            return $item->price;
        }, $units));

        //dd(compact('number','volume', 'consigneer_id','status','plan_data','shipment_data', 'delivery_data' , 'price' , 'application_id'));

        $lunit = Lunit::create([
            'number' => rand(100, 200),
            'consigneer_id' => $consigneer_id,
            'status' => 0,
            'volume' => $volume,
            'plan_data' => date('Y-m-d'),
            'shipment_data' => date('Y-m-d'),
            'delivery_data' => date('Y-m-d'),
            'price' => $price,
            'application_id' => $application_id,
            'delivery_id' => $delivery_id,
        ]);

        foreach ($units as $unit) {
            $unit->lunit_id = $lunit->id;
            $unit->save();
        }

        return $lunit->units;
    }

    public function getCalendar(Application $application)
    {
        $shipments = [];
        $lunits = $application->lunits;
        foreach ($lunits as $lunit) {
            $key = Carbon::createFromFormat('Y-m-d', $lunit->plan_data)->day;
            $shipments["$key"][] = $lunit;
        }
        $endOfMonth = $application->setCalendarDate()->endOfMonth()->day;
        return view('templates.applications.calendar', compact('application', 'shipments', 'endOfMonth'));
    }

}
