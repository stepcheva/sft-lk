<div class="a-title">
    <div class="a-title__h3">Товары в заявке</div>
</div>
<div class="table-wrapper">
    <table class="table a-table">
        <thead>
        <tr>
            <th class="table__th">Марка</th>
            <th class="table__th">Граммаж</th>
            <th class="table__th">Формат</th>
            <th class="table__th">Объем 1 декада</th>
            <th class="table__th">Объем 2 декада</th>
            <th class="table__th">Объем 3 декада</th>
            <th class="table__th">Вид доставки</th>
            <th class="table__th">Сумма без НДС</th>
        </tr>
        </thead>
        <tbody>
        @if (isset($product_applications))
            @foreach($product_applications as $product)
                <tr>
                    <td class="table__td a-table__td">{{ $product->productrange->brand }}</td>
                    <td class="table__td a-table__td">{{ $product->productrange->grammage }}</td>
                    <td class="table__td a-table__td">{{ $product->productrange->format }}</td>
                    <td class="table__td a-table__td">{{ $product->volume_1 }}</td>
                    <td class="table__td a-table__td">{{ $product->volume_2 }}</td>
                    <td class="table__td a-table__td">{{ $product->volume_3 }}</td>
                    <td class="table__td a-table__td">{{ $product->consigneer_delivery->delivery->name }}</td>
                    <td class="table__td a-table__td a-table__td-line">{{ $product->price }}<span class="rouble">q</span></td>
                </tr>
            @endforeach
            <tr>
                <td colspan="8" class="table__td table__td_summary table__td_left">
                    <div class="table__summary">
                        <span class="table__summary-title">Итого:</span> {{ $application->getApplicationVolume() }} т
                    </div>
                    <div class="table__summary">
                        <span class="table__summary-title">Итоговая сумма:</span> {{ $application->getApplicationPrice() }}
                        <span class="rouble">q</span>
                    </div>
                    <div class="table__summary">
                        @if($applicator->getMonthlyVolumeRemainder($application->period) >= 0)
                            <span class="table__summary-title">Остаток от мин. объема:</span>
                        @else
                            <span class="table__summary-title">Общий объем заказов (за месяц):</span>
                        @endif
                        {{ abs($applicator->getMonthlyVolumeRemainder($application->period)) }} т
                    </div>
                </td>
            </tr>
        @else
            <h2>Нет товаров в заявке</h2>
        @endif
        </tbody>
    </table>
</div>