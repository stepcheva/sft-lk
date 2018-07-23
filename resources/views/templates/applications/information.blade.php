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