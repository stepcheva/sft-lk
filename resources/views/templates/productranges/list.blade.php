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
            <!--ConsineerComponent -->
            <consigneer-component :applicator="{{ $applicator->id }}"></consigneer-component>
            <!--EndComponent-->
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('js/app.js') }}"></script>
@endpush