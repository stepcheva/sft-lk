@push('hidden')
<div class="hidden">
    <div id="shipmentPopup{{ $shipment->id }}" class="popup">
        <h3 class="popup__title">Информация по отгрузке №{{ $shipment->number }}</h3>
        <div class="flex popup__flex popup__flex_spaced">
            <div class="flex__col popup__flex-col popup__flex-col_space">
                <div class="info-title">Даты</div>
                <span class="info-line"><span class="info-line__color">Плановая отгрузка:</span>{{ $shipment->plain_data }}</span>
                <span class="info-line"><span class="info-line__color">Фактическая отгрузка:</span>{{ $shipment->shipment_data }}</span>
                <span class="info-line"><span class="info-line__color">Дата доставки: </span>{{ $shipment->delivery_data }}</span>
            </div>
            <div class="flex__col popup__flex-col popup__flex-col_fixed">
                <div class="info-title">Перевозчик</div>
                @foreach($shipment->transportunits as $transport)
                <span class="info-line">{{ $transport->info }}</span>
                <!--<span class="info-line-small">Петров П.П. <br>Е547МР77</span>-->
                @endforeach
            </div>
        </div>
        <div class="info-title">Данные о грузе</div>
        <table class="table-small popup-table">
            <thead>
            <tr>
                <th class="table-small__th popup-table__th">Марка</th>
                <th class="table-small__th popup-table__th">Граммаж</th>
                <th class="table-small__th popup-table__th">Формат</th>
                <th class="table-small__th popup-table__th">Тоннаж</th>
            </tr>
            </thead>
            <tbody>
            @foreach($shipment->units as $product)
                <tr>
                    <td class="table__td a-table__td">{{ $product->productrange->brand }}</td>
                    <td class="table__td a-table__td">{{ $product->productrange->grammage }}</td>
                    <td class="table__td a-table__td">{{ $product->productrange->format }}</td>
                    <td class="table__td a-table__td">{{ $product->volume }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="popup__toolbar">
            <a href="" class="btn btn_small btn_inversed js-close-modal">Закрыть</a>
            <a href="{{ route('applications.show',  ['application' => $shipment->application, 'applicator' => $shipment->application->applicator]) }}" class="btn btn_small">Перейти к заявке</a>
        </div>
    </div>
</div>
@endpush