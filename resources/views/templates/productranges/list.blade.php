@extends('layouts.master')

@section('title', "Номенклатура")

@section('content')

    @include('flashes')

    <div class="nm-header cntr">
        <h1 class="nm-title">Номенклатура</h1>
        <p class="nm-subtitle">Данная номенклатура является текущей из справочника по условиям сотрудничества</p>
    </div>
    <div class="nm-body">
        <div class="a-title">
            <div class="a-title__h3">Информация по номенклатуре</div>
        </div>
        <div class="nm-info">
            <div class="flex info-flex">
                <div class="flex__col info-flex__col">
                    <div class="info-title-small">Время отсрочки</div>
                    <span class="info-line">{{ $applicator->cooperation->delayed_payment }}</span>
                </div>
                <div class="flex__col info-flex__col">
                    <div class="info-title-small">Время действия соглашения</div>
                    <span class="info-line">до {{ $applicator->cooperation->contract_period }}</span>
                </div>
                <div class="flex__col info-flex__col">
                    <div class="info-title-small">Объем на месяц</div>
                    <span class="info-line">{{ $applicator->cooperation->monthly_max_volume }} тонн</span>
                </div>
                <div class="flex__col info-flex__col">
                    <div class="info-title-small">Бонус</div>
                    <span class="info-line">{{ $applicator->cooperation->bonus }} %</span>
                </div>
            </div>
        </div>
        <div class="nm-receivers">
            <div class="a-title">
                <div class="a-title__h3">Данные по грузополучателям</div>
            </div>
            <div class="flex receivers">
                <div class="receivers__col receivers__col-left">{{ $applicator->id }}
                    <!--ConsineerComponent -->
                    <consigneer-component :applicator="{{ $applicator->id }}"></consigneer-component>
                    <!--EndComponent-->
                    <div class="info-line-small">Диаметр рулона: <span class="info-line-small__color">1300</span></div>
                    <div class="info-line-small">Диаметр гильзы: <span class="info-line-small__color">100</span></div>
                </div>
                <div class="receivers__col receivers__col-right">
                    @if (isset($productranges))
                    <div class="infoblocks">
                        @foreach($productranges as $product)
                        <div class="infoblock @if($loop->last) infoblock_last @endif flex">
                            <div class="infoblock__col">
                                <div class="info-title infoblock__info-title">Данные о грузе</div>
                                <div class="info-line-small">Марка: <span class="info-line-small__color">{{ $product->brand }}</span></div>
                                <div class="info-line-small">Граммаж: <span class="info-line-small__color">{{ $product->grammage }}</span></div>
                                <div class="info-line-small">Формат: <span class="info-line-small__color">{{ $product->format }}</span></div>
                            </div>
                            <div class="infoblock__col">
                                <div class="info-title infoblock__info-title">Объём продукции</div>
                                <div class="info-line-small">Минимальная партия: <span class="info-line-small__color">{{ $product->min_lot }} т</span></div>
                                <!--<div class="info-line-small">Объём на месяц: <span class="info-line-small__color">50 т</span></div>-->
                            </div>
                            <div class="infoblock__col">
                                <div class="info-title infoblock__info-title">Цена</div>
                                <!--Изменить согласно видам доставки-->
                                <div class="info-line-small">Самовывоз: <span class="info-line-small__color"> 12 100 <span class="rouble">q</span></span></div>
                                <div class="info-line-small">Авто: <span class="info-line-small__color">19 600 <span class="rouble">q</span></span></div>
                                <div class="info-line-small">Ж/Д: <span class="info-line-small__color">15 600 <span class="rouble">q</span></span></div>
                            </div>
                               <!--Убираем примечание
                                <div class="infoblock__col infoblock__col_last">

                                    <div class="receiver-toggler js-toggler">
                                        <div class="info-title infoblock__info-title">Примечание</div>
                                        <div class="receiver-toggler__txt js-toggler-text">
                                            <div class="js-toggler-inner">
                                                Sed ut perspiciatis unde omnis iste natus error sit voluptatem error sit accusantium doloremque error Sed ut perspiciatis unde omnis iste natus error sit voluptatem error sit accusantium doloremque error Sed ut perspiciatis unde omnis iste natus error sit voluptatem error sit accusantium doloremque error
                                            </div>
                                        </div>
                                        <div class="receiver-toggler__btn js-toggler-btn">
                                            <span class="js-show">Показать полностью</span>
                                            <span class="js-hide">Скрыть</span>
                                        </div>
                                    </div>
                                </div>
                                -->
                        </div>
                        @endforeach
                    </div>
                    @else
                        <h2> Нет товаров у текущего поставщика</h2>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('js/app.js') }}"></script>
@endpush