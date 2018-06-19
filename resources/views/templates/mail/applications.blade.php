<h3>Заявка № {{ $application->number }}</h3>
<h5>от {{$application->created_at->format('d-m-Y')}}</h5>
<h5>
    Заказчик: {{$application->applicator->user->lastName }}
    {{ $application->applicator->user->firstName }}
    {{ $application->applicator->user->middleName }} <br>
    Период отгрузки: {{ $application->period }} <br>
    Грузополучатель: {{ $application->consigneer->name }} <br>
    Поставщик: {{ $application->provider->name }} <br>
</h5>

<div>
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

            @isset($application->contactquery)
                <p> Комментарий к заказу: {{ $application->contactquery->querytext }} </p>
            @endisset
            </tbody>
        </table>
        <div>
            <h5>Итого (тн): {{ $application->getApplicationVolume() }}</h5>
            <h5>Сумма (руб): {{ $application->getApplicationPrice() }}</h5>
        </div>
    </div>
</div>
<hr />
<p>P.S. Письмо сгененировано автоматически. Не отвечайте на это письмо.</p>