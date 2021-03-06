    <h3>Заявка № {{ $application->number }}</h3>
    <h5>от {{$application->created_at->format('Y-m-d')}}</h5>
    <h5>
        Заказчик: {{$application->applicator->user->lastName }}
        {{  $application->applicator->user->firstName }}
        {{  $application->applicator->user->middleName }}</h5>
    <h5>Статус: новая </h5>
    <h5>Минимальный объем на
        месяц: {{ $application->applicator->cooperation->monthly_min_volume }}т</h5>
    <div>
        <div>
            <h3>Товары в заявке</h3>
            <table id="application" class="table table-striped" border="1">
                <thead>
                <tr>
                    <th>Период отгрузки<br>{{ $application->period }}</th>
                    <th>Грузополучатель<br>{{ $application->consigneer->name }}</th>
                    <th>Поставщик<br>{{ $application->provider->name }}</th>
                </tr>
                </thead>
            </table>
        </div>
        <div>
            <table id="application_products" class="table table-bordered table-striped" border="1">
                <thead>
                <tr>
                    <th class="text-center">Марка</th>
                    <th class="text-center">Граммаж</th>
                    <th class="text-center">Формат</th>
                    <th class="text-center">Объем 1 декада</th>
                    <th class="text-center">Объем 2 декада</th>
                    <th class="text-center">Объем 3 декада</th>
                    <th class="text-center">Доставка</th>
                </tr>
                </thead>
                <tbody>
                @if (isset($product_applications))
                    @foreach($product_applications as $product)
                        <tr>
                            <td> {{ $product->productrange->brand }} </td>
                            <td> {{ $product->productrange->grammage }} </td>
                            <td> {{ $product->productrange->format }} </td>
                            <td> {{ $product->volume_1 }} </td>
                            <td> {{ $product->volume_2 }} </td>
                            <td> {{ $product->volume_3 }} </td>
                            <td> {{ $product->consigneer_delivery->delivery->name }}</td>
                        </tr>

                    @endforeach
                @else
                    <h2>Ошибка создания заявки</h2>
                @endif

                @isset($comment)
                    <p> {{$comment}} </p>
                @endisset
                </tbody>
            </table>
            <div>
                <p>Итого (тн): {{ array_sum($volume) }}</p>
                <p>Сумма (руб): {{ array_sum($price) }}</p>
            </div>
        </div>
    </div>