<template>
    <div class="receiver-title">Выберите грузополучателя</div>
          <select class="js-default-select form__select-tiny">{{ applicator }}
                 <option value="receiver-01">ОАО «Константинопольский и ко»</option>
                                       <option value="receiver-02">ОАО «Иванов и ко»</option>
                                       <option value="receiver-03">ОАО «Петров и ко»</option>
                                   </select>
                                   <div class="nm-address">
                                       249000, Ульяновская обл., г.Ульяновск,
                                       ул.Дмитрия Ульянова, д.192
                                   </div>
                                   <div class="flex banking">
                                       <div class="banking__item">
                                           <span class="banking__title">ИНН:</span>
                                           4003014954
                                       </div>
                                       <div class="banking__item">
                                           <span class="banking__title">КПП:</span>
                                           40030001
                                       </div>
                                   </div>
</template>

<script>
    export default {
        props: [
            'applicator'
        ],

        mounted() {
            this.fetch()
        },

        methods:
            fetch() {
                console.log(this.applicator);
            }

    }
</script>
