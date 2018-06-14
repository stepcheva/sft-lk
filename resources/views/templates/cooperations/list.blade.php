<div class="pf-payment">
    <div class="a-title">
        <div class="a-title__h3">{{ $title }}</div>
    </div>
    <div class="pf-pay-tile">
        <div class="pf-pay-tile__col">
            <div class="info-title info-title_mb10 pf-pay-tile__info-title">Условия оплаты</div>
            <p class="pf-text">30 дней отсрочка</p>
        </div>
        <div class="pf-pay-tile__col">
            <div class="info-title info-title_mb10 pf-pay-tile__info-title">Текущая ДЗ</div>
            <p class="pf-text">30 000 <span class="rouble">q</span></p>
        </div>
        <div class="pf-pay-tile__col">
            <div class="info-title info-title_mb10 pf-pay-tile__info-title">Товарный лимит</div>
            <p class="pf-text">{{ $cooperation->min_volume }}<span class="rouble">q</span></p>
            <span class="pf-alert">Ваш товарный лимит был превышен!</span>
        </div>
        <div class="pf-pay-tile__col">
            <div class="info-title info-title_mb10 pf-pay-tile__info-title">Просроченная ДЗ</div>
            <p class="pf-text">10 000 <span class="rouble">q</span></p>
            <span class="pf-alert">Просрочено на 3 дня</span>
        </div>
    </div>
</div>