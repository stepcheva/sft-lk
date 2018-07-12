<div class="a-shipping">

    <div class="a-title">
        <div class="a-title__h3">Отгрузки по заявке</div>
    </div>
    <div class="default-tabs">

        <ul class="tabs_controls">
            <li class="tabs_controls_item {{ (isset($active) && $active == '1') ? 'active': ''}}">
                <a class="tabs_controls_link"
                   href="{{ route('applications.show',  ['application' => $application, 'applicator' => $applicator, 'active' => '1']) }}">1-ая
                    декада</a>
            </li>
            <li class="tabs_controls_item {{ (isset($active) && $active == '2') ? 'active': ''}}">
                <a class="tabs_controls_link"
                   href="{{ route('applications.show',  ['application' => $application, 'applicator' => $applicator, 'active' => '2']) }}">2-ая
                    декада</a>
            </li>
            <li class="tabs_controls_item {{ (isset($active) && $active == '3') ? 'active': ''}}">
                <a class="tabs_controls_link"
                   href="{{ route('applications.show',  ['application' => $application, 'applicator' => $applicator, 'active' => '3']) }}">3-я
                    декада</a>
            </li>
        </ul>

        <ul class="tabs_list">
            @foreach($lunits as $lunit)
                <li class="tabs_item active">
                    <div class="default-acardion">
                        <div class="accordeon__list sh-accordion">
                            <div class="accordeon__item active">
                                <a class="accordeon__trigger js-accordeon_trigger" href="#">
                                    <span class="shipment">Отгрузка №{{ $lunit->number }}</span>
                                    <span class="shipment-status">Статус:
                                        <span class="status status_available">
                                            @if(App::isLocale('ru'))
                                                @lang("shipments.status." . $lunit->status())
                                            @endif
                                         </span>
                                    </span>
                                </a>
                                <div class="accordeon__inner" style="display: block;">
                                    <div class="accordeon__inner-item">
                                        <div class="sh-information">
                                            <div class="sh-title">
                                                <div class="sh-title__h4">Информация по заявке</div>
                                            </div>
                                            <div class="flex sh-info-flex">
                                                <div class="flex__col sh-info-flex__col">
                                                    <div class="info-title-small">Вид доставки</div>
                                                    <span class="info-line">{{ $lunit->delivery->name }}</span>
                                                </div>
                                                <div class="flex__col sh-info-flex__col">
                                                    <div class="info-title-small">Стоимость доставки</div>
                                                    <span class="info-line">{{ $lunit->getTotalPrice() }}<span
                                                                class="rouble">q</span></span>
                                                </div>
                                                <div class="flex__col sh-info-flex__col">
                                                    <div class="info-title-small">Плановая дата производства</div>
                                                    <span class="info-line">{{ $lunit->plan_data }} </span>
                                                </div>
                                                <div class="flex__col sh-info-flex__col">
                                                    <div class="info-title-small">Плановая дата отгрузки</div>
                                                    <span class="info-line">{{ $lunit->shipment_data }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="sh-goods">
                                            <div class="sh-title">
                                                <div class="sh-title__h4">Товары в отгрузке</div>
                                            </div>
                                            <div class="table-wrapper">
                                                <table class="table sh-table">
                                                    <thead>
                                                    <tr>
                                                        <th class="table__th sh-table__th">Марка</th>
                                                        <th class="table__th sh-table__th">Граммаж</th>
                                                        <th class="table__th sh-table__th">Формат</th>
                                                        <th class="table__th sh-table__th">Тоннаж</th>
                                                        <th class="table__th sh-table__th">Диаметр рулона</th>
                                                        <th class="table__th sh-table__th">Цена</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach ($lunit->units as $unit)
                                                        <tr>
                                                            <td class="table__td">{{ $unit->productrange->brand }}</td>
                                                            <td class="table__td">{{ $unit->productrange->grammage }}</td>
                                                            <td class="table__td">{{ $unit->productrange->format }}</td>
                                                            <td class="table__td">{{ $unit->volume }}</td>
                                                            <td class="table__td">{{ $lunit->consigneer->roll_diameter }}</td>
                                                            <td class="table__td sh-table__td-cost">{{ $unit->price }}</td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="sh-documents">
                                            <div class="sh-title">
                                                <div class="sh-title__h4">Документы</div>
                                            </div>
                                            <div class="flex documents">
                                                @if($lunit->files)
                                                    @foreach($lunit->files as $file)
                                                        <div class="document document_flex">
                                                            <span class="document__title">Документ-рейс</span>
                                                            {{ $file->name }}
                                                            <div class="document__links">
                                                                <a href="{{ $file->path }}" class="document__link">Скачать</a>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                                <fileupload-component :lunit="{{ $lunit->id }}"></fileupload-component>
                                            </div>
                                        </div>

                                        <div class="sh-drivers">
                                            <div class="sh-title">
                                                <div class="sh-title__h4">Информация о перевозчиках</div>
                                            </div>
                                            <div class="flex drivers-flex">
                                                @if($lunit->showAddDeliveryField())
                                                    @include('templates.transports.create', ['lunit' => $lunit])
                                                    <div class="drivers-flex__col drivers-flex__col_bordered">
                                                        <div class="add-driver">
                                                            <a href="#addTransport" class="js-modal add-driver__link">
                                                                <i class="icon icon-driver add-driver__icon"></i>
                                                                <span class="add-driver__text">Добавить ТС</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                @elseif($lunit->showEditDeliveryField())
                                                    @include('templates.transports.edit', ['transport' => $lunit->showEditDeliveryField()])
                                                    <div class="drivers-flex__col">
                                                            <span class="info-line driver-line">
                                                            <span class="info-line__color driver-line__title">
                                                                Средство:</span> {{ $lunit->showEditDeliveryField()->info }}</span>
                                                        <!--
                                                        <span class="info-line driver-line"><span class="info-line__color driver-line__title">Водитель:</span> Константинопольский К.</span>
                                                        <span class="info-line driver-line"><span class="info-line__color driver-line__title">Номер ТС:</span> Р563АЗ</span>
                                                        -->

                                                        <span class="info-line edit-line">
                                                                <a href="#editTransport" class="edit-btn js-modal">Изменить</a></span>

                                                    </div>
                                                @else
                                                    @foreach( $lunit->transportunits as $transport)
                                                        <div class="drivers-flex__col">
                                                        <span class="info-line driver-line">
                                                        <span class="info-line__color driver-line__title">
                                                            Средство:</span> {{ $transport->info }}</span>
                                                            <!--
                                                            <span class="info-line driver-line"><span class="info-line__color driver-line__title">Водитель:</span> Константинопольский К.</span>
                                                            <span class="info-line driver-line"><span class="info-line__color driver-line__title">Номер ТС:</span> Р563АЗ</span>
                                                            -->
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>

                                        <div class="sh-toolbar">
                                            <a href="{{ route('applications.calendar', ['application' => $application]) }}" class="btn btn_inversed btn_small btn_full">Перейти в
                                                календарь</a>
                                            <a href="#shipmentDetailPopup" class="btn btn_small btn_full js-modal">Отменить
                                                / Изменить</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>

@push('script')
    <script src="{{ asset('js/app.js') }}"></script>
@endpush

