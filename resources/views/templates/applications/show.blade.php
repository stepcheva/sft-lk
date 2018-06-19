@extends('layouts.master')

@section('title', "Детальная страница заявки")

@section('content')

    @include('flashes')

    <div class="a-header flex">
        <div class="a-header__col">
            <h1 class="a-header__title">Заявка {{ $application->number }}</h1>
            <a href="{{ route('applications.duplicate', ['application' => $application]) }}" class="a-header__icon icon icon-copy"></a>
            <div class="a-date">От {{$application->created_at->format('Y-m-d')}}</div>
        </div>
        <div class="a-header__col">
			<span class="a-status a-status_approved">
                @if(App::isLocale('ru'))
                    @lang("applications.status.$application->status")
                @endif
			</span>
        </div>
    </div>
    <div class="a-body">
        <div class="a-information">
            <div class="a-title">
                <div class="a-title__h3">Информация по заявке</div>
            </div>
            <div class="flex info-flex">
                <div class="flex__col info-flex__col">
                    <div class="info-title-small">Период отгрузки</div>
                    <span class="info-line">{{ $application->period }}</span>
                </div>
                <div class="flex__col info-flex__col">
                    <div class="info-title-small">Диаметр рулона</div>
                    <span class="info-line">{{ $application->consigneer->roll_diameter }}</span>
                </div>
                <div class="flex__col info-flex__col">
                    <div class="info-title-small">Диаметр гильз</div>
                    <span class="info-line">{{ $application->consigneer->core_diameter }}</span>
                </div>
            </div>
        </div>
        <div class="a-goods">
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
                                <span class="table__summary-title">Остаток от мин. объема:</span>
                                {{ $applicator->getMonthlyVolumeRemainder($application->period) }} т
                            </div>
                        </td>
                    </tr>
                    @else
                        <h2>Нет товаров в заявке</h2>
                    @endif
                    </tbody>
                </table>
            </div>
            @isset($application->contactquery)
            <div class="a-comment comment">
                <span class="comment__title">Комментарий:</span>
                <div class="comment__text">
                    {{ $application->contactquery }}
                </div>
            </div>
            @endisset
        </div>
    </div>
@endsection


