<div class="pf-shipment">
    <div class="a-title">
        <div class="a-title__h3">{{ $title }}</div>
    </div>
    <div class="pf-tile">
        @foreach($consigneers as $consigneer)
        <div class="pf-tile__col pf-tile__col_first">
            <div class="info-title info-title_mb15">{{ $consigneer->name }}</div>
            <div class="pf-address">
                {{ $consigneer->address }}
            </div>
            <div class="flex banking">
                <div class="banking__item">
                    <span class="banking__title">ИНН:</span>
                    {{ $consigneer->INN }}
                </div>
                <div class="banking__item">
                    <span class="banking__title">КПП:</span>
                    {{ $consigneer->KPP }}
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>