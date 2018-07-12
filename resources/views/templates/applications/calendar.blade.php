@extends('layouts.master')

@section('title', "Календарь")

@section('content')
    <h1 class="ai-title">Календарь</h1>
    @php $j = 0; $i = 0  @endphp
    <div class="calendar__header">
        <div class="calendar__title-top">период отгрузки</div>
        <div class="calendar__month"><strong>
                @if(App::isLocale('ru'))
                    @lang("dates.month." . $application->setCalendarDate()->format('F'))
                @endif
                , {{ $application->setCalendarDate()->year }}</strong>
            ({{ $application->getApplicationVolume() }} тонн)
        </div>

        <div class="calendar__head">
            <div class="js-calendar-controls calendar__controls">
                <div class="swiper-wrapper">
                    <div class="swiper-slide calendar__controls-item">
                        Первая декада
                    </div>
                    <div class="swiper-slide calendar__controls-item">
                        Вторая декада
                    </div>
                    <div class="swiper-slide calendar__controls-item">
                        Третья декада
                    </div>
                </div>
                <div class="js-calendar-control-prev icon calendar__control calendar__control_prev"></div>
                <div class="js-calendar-control-next icon calendar__control calendar__control_next"></div>
            </div>
        </div>
    </div>
    <div class="calendar__body">
        <div class="js-calendar-body calendar__body-slider">
            <div class="swiper-wrapper">
                @for($k = 0; $k < 3; $k++)
                    <div class="swiper-slide calendar__body-item">
                        <div class="calendar__tile">
                            @while($i < $endOfMonth)
                                @php $i++ @endphp
                                <div class="calendar__tile-item js-calendar-item">
                                    <div class="calendar__tile-inner js-shipments-inner">
                                        @if(array_key_exists($i, $shipments))
                                            <span class="calendar__date calendar__date_active">{{ $i }}</span>
                                            <i class="icon icon-cross calendar__close js-shipments-toggle"></i>
                                            <div class="calendar__shipments">
                                                @foreach($shipments[$i] as $shipment)
                                                    <div class="calendar__shipment">
                                                        @switch($shipment->delivery_id)
                                                            @case('4')
                                                            <i class="icon calendar__shipment-icon icon-stock"></i>
                                                            <!--<span>На складе</span>-->
                                                            @break

                                                            @case('1')
                                                            <i class="icon calendar__shipment-icon icon-truck"></i>
                                                            <!--<span>Назначен транспорт</span>-->
                                                            @break

                                                            @case('2')
                                                            <i class="icon calendar__shipment-icon icon-truck"></i>
                                                             <!--<span>Отгружен</span>-->
                                                            @break
                                                        @endswitch

                                                        @include('templates.applications.shipment', ['shipment' => $shipment])

                                                        <span class="calendar__shipment-text">Отгрузка <a
                                                                    class="calendar__shipment-link link js-modal"
                                                                    href="#shipmentPopup{{ $shipment->id }}">№{{ ++$j }}</a></span>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <span class="calendar__shipment-label js-shipments-toggle">Отгрузки</span>
                                        @else
                                            <span class="calendar__date">{{ $i }}</span>
                                        @endif
                                    </div>
                                </div>
                                @if($i == 10 || $i == 20) @break @endif
                            @endwhile
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </div>
@endsection


