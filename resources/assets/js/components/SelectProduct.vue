<template>
    <div class="">
        <form action="" class="form">
            <div id="step0" class="step" v-if="step >= 0 && step < 2">
                <div class="a-title a-title_mb">
                    <div class="a-title__h3">Информация по заявке</div>
                </div>
                <div class="anew-form-wrapper">
                    <fieldset class="form__fieldset">
                        <div class="info-title">Период отгрузки</div>
                        <div class="flex date">
                            <div class="date__month">
                                <drop-down v-bind:list="infoOnApplication.shipmentPeriod.month.list"
                                            v-bind:placeholder="'Месяц'"
                                            v-bind:default-selected="infoOnApplication.shipmentPeriod.month.selected"
                                            v-bind:disabled="false"
                                            v-on:change="infoOnApplication.shipmentPeriod.month.selected = $event">
                                </drop-down>
                            </div>
                            <div class="date__year">
                                <drop-down v-bind:list="infoOnApplication.shipmentPeriod.year.list"
                                            v-bind:placeholder="'Год'"
                                            v-bind:default-selected="infoOnApplication.shipmentPeriod.year.selected"
                                            v-bind:disabled="infoOnApplication.shipmentPeriod.month.selected<0"
                                            v-on:change="infoOnApplication.shipmentPeriod.year.selected = $event">
                                </drop-down>

                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="form__fieldset form__fieldset_mb">
                        <div class="info-title">Получатель</div>
                        <drop-down v-bind:list="infoOnApplication.recipient.list"
                                    v-bind:placeholder="'Получатель'"
                                    v-bind:default-selected="infoOnApplication.recipient.selected"
                                    v-bind:disabled="infoOnApplication.shipmentPeriod.year.selected<0"
                                    v-on:change="infoOnApplication.recipient.selected = $event">
                        </drop-down>


                    </fieldset>
                    <fieldset class="form__fieldset">
                        <div class="info-title">Поставщик</div>
                        <drop-down v-bind:list="infoOnApplication.provider.list"
                                    v-bind:placeholder="'Поставщик'"
                                    v-bind:default-selected="infoOnApplication.provider.selected"
                                    v-bind:disabled="infoOnApplication.recipient.selected<0"
                                    v-on:change="infoOnApplication.provider.selected = $event">
                        </drop-down>

                    </fieldset>
                    <fieldset class="form__fieldset">
                        <div class="info-title">Способ доставки</div>
                        <drop-down v-bind:list="infoOnApplication.deliveryMethod.list"
                                    v-bind:placeholder="'Способ доставки'"
                                    v-bind:default-selected="infoOnApplication.deliveryMethod.selected"
                                    v-bind:disabled="infoOnApplication.provider.selected<0"
                                    v-on:change="infoOnApplication.deliveryMethod.selected = $event">
                        </drop-down>

                    </fieldset>
                    <div class="anew-next">
                        <a href="" class="btn btn_next" @click.prevent="nextStep(1)"
                           :class="{ disabled : (infoOnApplication.deliveryMethod.selected<0) }">Далее</a>
                    </div>
                </div>
            </div>
            <transition v-on:after-enter="scrollStep"
                        v-on:before-leave="scrollStep">
                <div id="step1" class="step" v-if="step >= 1 && step < 2">
                    <div class="a-title a-title_mb">
                        <div class="a-title__h3">Выбор продукции</div>
                    </div>
                    <div class="products ">
                        <div class="products__row">
                            <div class="products__td products__td-number"></div>
                            <div class="products__td products__td-product">
                                <div class="info-title products__info-title">Товары</div>
                            </div>
                            <div class="products__td products__td-decade">
                                <div class="info-title products__info-title">Декада</div>
                            </div>
                            <div class="products__td products__td-volume">
                                <div class="info-title products__info-title">Объём</div>
                            </div>
                            <div class="products__td products__info-title"">
                                <div class="info-title products__info-title">Объём 1 декада</div>
                            </div>
                            <div class="products__td products__info-title"">
                                <div class="info-title products__info-title">Объём 2 декада</div>
                            </div>
                            <div class="products__td products__info-title"">
                                <div class="info-title products__info-title">Объём 3 декада</div>
                            </div>


                <drop-down v-bind:list="infoOnApplication.deliveryMethod.list"
                           v-bind:placeholder="'Способ доставки'"
                           v-bind:default-selected="infoOnApplication.deliveryMethod.selected"
                           v-bind:disabled="infoOnApplication.provider.selected<0"
                           v-on:change="infoOnApplication.deliveryMethod.selected = $event">
                </drop-down>

                            <div class="products__td products__td-price">
                                <div class="info-title products__info-title">Цена</div>
                            </div>
                            <div class="products__td products__td-remove"></div>
                        </div>
                        <div class="products__row "
                             v-for="(item, index) in productList">
                            <div class="products__td">
                                <span class="products__number">{{index+1}}.{{item.index}}</span>
                            </div>
                            <div class="products__td">
                                <drop-down v-bind:list="products.list"
                                            v-bind:placeholder="'Товар'"
                                            v-bind:default-selected="item.product"
                                            v-bind:disabled="false"
                                            v-on:change="changeProduct(index, $event)">
                                </drop-down>
                            </div>
                            <div class="products__td">
                                <drop-down
                                        v-bind:list="products.list[item.product] ? products.list[item.product].data.decade.list : false"
                                        v-bind:placeholder="products.list[item.product] ? products.list[item.product].data.decade.name : 'Декада'"
                                        v-bind:default-selected="item.decade"
                                        v-bind:disabled="products.list[item.product] ? false : true"
                                        v-on:change="item.decade = $event">
                                </drop-down>

                            </div>
                            <div class="products__td">
                                <input type="number" class="form__input form__input_large"
                                       min="1"
                                       :class="{ disabled : item.volume === false }"
                                       v-model="item.volume">
                            </div>
                            <div class="products__td">
                                <drop-down
                                        v-bind:list="products.list[item.product] ? products.list[item.product].data.diameter.list : false"
                                        v-bind:placeholder="products.list[item.product] ? products.list[item.product].data.diameter.name : 'Диаметр'"
                                        v-bind:default-selected="item.diameter"
                                        v-bind:disabled="products.list[item.product] ? false : true "
                                        v-on:change="item.diameter = $event">
                                </drop-down>
                            </div>
                            <div class="products__td">
                                <div type="text" class="form__input form__input_large form__input_bold">
                                    {{calcPrice(index)}}
                                </div>
                            </div>
                            <div class="products__td">
                                <i class="icon icon-trash "
                                   v-on:click.prevent="delProduct(index)"></i>
                            </div>
                        </div>
                    </div>
                    <div class="products-add">
                        <a class="add-btn" href=""
                           v-on:click.prevent="addProduct">Добавить товар</a>
                    </div>
                    <div class="anew-toolbar">
                        <a href="" class="btn btn_inversed"
                           v-on:click.prevent="prevStep()">Отменить</a>
                        <a href="" class="btn"
                           v-on:click.prevent="nextStep(2)">Сохранить</a>
                    </div>
                </div>
            </transition>
            <div id="step2" class="step" v-if="step === 2">
                <div class="a-information">
                    <div class="a-title">
                        <div class="a-title__h3">Информация по заявке</div>
                    </div>
                    <div class="flex info-flex">
                        <div class="flex__col info-flex__col">
                            <div class="info-title-small">Период отгрузки</div>
                            <span class="info-line">{{infoOnApplication.shipmentPeriod.month.list[infoOnApplication.shipmentPeriod.month.selected].name}} {{infoOnApplication.shipmentPeriod.year.list[infoOnApplication.shipmentPeriod.year.selected].name}}</span>
                        </div>
                        <div class="flex__col info-flex__col">
                            <div class="info-title-small">Способ доставки</div>
                            <span class="info-line">{{infoOnApplication.deliveryMethod.list[infoOnApplication.deliveryMethod.selected].name}}</span>
                        </div>
                        <div class="flex__col info-flex__col">
                            <div class="info-title-small">Грузополучатель</div>
                            <span class="info-line">{{infoOnApplication.recipient.list[infoOnApplication.recipient.selected].name}}</span>
                        </div>
                        <div class="flex__col info-flex__col">
                            <div class="info-title-small">Поставщик</div>
                            <span class="info-line">{{infoOnApplication.provider.list[infoOnApplication.provider.selected].name}}</span>
                        </div>
                    </div>
                </div>
                <div class="a-goods">
                    <div class="a-title">
                        <div class="a-title__h3">Товары в заявке</div>
                    </div>
                    <table class="table a-table">
                        <thead>
                        <tr>
                            <th class="table__th" rowspan="2">№</th>
                            <th class="table__th a-table__th-name" rowspan="2">Наименование товара</th>
                            <th class="table__th" colspan="3">Кол-во и срок отгрузки</th>
                            <th class="table__th a-table__th-total" rowspan="2">Итого</th>
                            <th class="table__th a-table__th-price" rowspan="2">Цена</th>
                        </tr>
                        <tr>
                            <th class="table__th a-table__th-number">01-10</th>
                            <th class="table__th a-table__th-number">11-20</th>
                            <th class="table__th a-table__th-number">21-31</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(item, index) in productList">
                            <template v-if="item.product>-1">
                                <td class="table__td">{{index+1}}</td>
                                <td class="table__td">{{products.list[item.product].name}}</td>
                                <td class="table__td">{{item.decade === 0 ? item.volume : '-'}}</td>
                                <td class="table__td">{{item.decade === 1 ? item.volume : '-'}}</td>
                                <td class="table__td">{{item.decade === 2 ? item.volume : '-'}}</td>
                                <td class="table__td">{{item.volume}}</td>
                                <td class="table__td">{{item.price}}</td>
                            </template>
                        </tr>
                        <tr>
                            <td colspan="7" class="table__td table__td_summary table__td_left">
                                <div class="table__summary">
                                    <span class="table__summary-title">Итого:</span> {{totalVolume}} т
                                </div>
                                <div class="table__summary">
                                    <span class="table__summary-title">Итоговая сумма:</span> {{totalPrice}} <span
                                        class="rouble">q</span>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="sh-toolbar">
                    <a href="" class="btn btn_inversed" v-on:click.prevent="prevStep()">Редактировать</a>
                    <a href="" class="btn" v-on:click.prevent="sendForm">Отправить</a>
                </div>
            </div>
        </form>
    </div>
</template>
<script>
    export default {
        data () {
            return {
                title: 'Новая заявка',
                step: '0',
                infoOnApplication: {
                    shipmentPeriod: {
                        month: {
                            name: 'Месяц',
                            list: [
                                {name: 'Январь', val: 'month-01'},
                                {name: 'Февраль', val: 'month-02'},
                                {name: 'Март', val: 'month-03'},
                                {name: 'Апрель', val: 'month-04'},
                                {name: 'Май', val: 'month-05'},
                                {name: 'Июнь', val: 'month-06'},
                                {name: 'Июль', val: 'month-07'},
                                {name: 'Август', val: 'month-08'},
                                {name: 'Сентябрь', val: 'month-09'},
                                {name: 'Октябрь', val: 'month-10'},
                                {name: 'Ноябрь', val: 'month-11'},
                                {name: 'Декабрь', val: 'month-12'}
                            ],
                            selected: -1
                        },
                        year: {
                            name: 'Год',
                            list: [
                                {name: '2018', val: 'year-2018'},
                                {name: '2019', val: 'year-2019'}
                            ],
                            selected: -1
                        }
                    },
                    recipient: {
                        name: 'Получатель',
                        list: [
                            {name: 'АО "Фамадар Картона Лимитед"', val: 'АО "Фамадар Картона Лимитед"'}
                        ],
                        selected: -1
                    },
                    provider: {
                        name: 'Поставщик',
                        list: [
                            {name: 'АО «Каменская БКФ»', val: 'АО «Каменская БКФ»'}
                        ],
                        selected: -1
                    },
                    deliveryMethod: {
                        name: 'Способ доставки',
                        list: [
                            {name: 'Автомобильная', val: 'delivery-type-01'},
                            {name: 'Железнодорожная', val: 'delivery-type-02'},
                            {name: 'Самовывоз', val: 'delivery-type-03'}
                        ],
                        selected: -1
                    }
                },
                products: {
                    name: 'Товар',
                    selected: -1,
                    list: [
                        {
                            name: 'M 100 (1700мм)',
                            val: '01',
                            data: {
                                decade: {
                                    name: 'Декада',
                                    selected: -1,
                                    list: [
                                        {name: '1-ая декада', val: 'product-decade_01'},
                                        {name: '2-ая декада', val: 'product-decade_02'},
                                        {name: '3-ая декада', val: 'product-decade_03'}
                                    ]
                                },
                                volume: {
                                    name: 'Объём',
                                    val: '1500'
                                },
                                diameter: {
                                    name: 'Диаметр рулона',
                                    selected: -1,
                                    list: [
                                        {name: '1 330 мм', val: 'product-diameter_01'}
                                    ]
                                },
                                price: {
                                    withDelivery: 32424,
                                    withoutDelivery: 30854
                                }
                            }
                        },
                        {
                            name: 'M 100 (2000мм)',
                            val: '01',
                            data: {
                                decade: {
                                    name: 'Декада',
                                    selected: -1,
                                    list: [
                                        {name: '1-ая декада', val: 'product-decade_01'},
                                        {name: '2-ая декада', val: 'product-decade_02'},
                                        {name: '3-ая декада', val: 'product-decade_03'}
                                    ]
                                },
                                volume: {
                                    name: 'Объём',
                                    val: '1500'
                                },
                                diameter: {
                                    name: 'Диаметр рулона',
                                    selected: -1,
                                    list: [
                                        {name: '1 330 мм', val: 'product-diameter_01'}
                                    ]
                                },
                                price: {
                                    withDelivery: 32424,
                                    withoutDelivery: 30854
                                }
                            }
                        },
                        {
                            name: 'M 100 (2100мм)',
                            val: '01',
                            data: {
                                decade: {
                                    name: 'Декада',
                                    selected: -1,
                                    list: [
                                        {name: '1-ая декада', val: 'product-decade_01'},
                                        {name: '2-ая декада', val: 'product-decade_02'},
                                        {name: '3-ая декада', val: 'product-decade_03'}
                                    ]
                                },
                                volume: {
                                    name: 'Объём',
                                    val: '1500'
                                },
                                diameter: {
                                    name: 'Диаметр рулона',
                                    selected: -1,
                                    list: [
                                        {name: '1 330 мм', val: 'product-diameter_01'}
                                    ]
                                },
                                price: {
                                    withDelivery: 32424,
                                    withoutDelivery: 30854
                                }
                            }
                        },
                        {
                            name: 'M 100 (2200мм)',
                            val: '01',
                            data: {
                                decade: {
                                    name: 'Декада',
                                    selected: -1,
                                    list: [
                                        {name: '1-ая декада', val: 'product-decade_01'},
                                        {name: '2-ая декада', val: 'product-decade_02'},
                                        {name: '3-ая декада', val: 'product-decade_03'}
                                    ]
                                },
                                volume: {
                                    name: 'Объём',
                                    val: '1500'
                                },
                                diameter: {
                                    name: 'Диаметр рулона',
                                    selected: -1,
                                    list: [
                                        {name: '1 330 мм', val: 'product-diameter_01'}
                                    ]
                                },
                                price: {
                                    withDelivery: 32424,
                                    withoutDelivery: 30854
                                }
                            }
                        },
                        {
                            name: 'M 100 (2500мм)',
                            val: '01',
                            data: {
                                decade: {
                                    name: 'Декада',
                                    selected: -1,
                                    list: [
                                        {name: '1-ая декада', val: 'product-decade_01'},
                                        {name: '2-ая декада', val: 'product-decade_02'},
                                        {name: '3-ая декада', val: 'product-decade_03'}
                                    ]
                                },
                                volume: {
                                    name: 'Объём',
                                    val: '1500'
                                },
                                diameter: {
                                    name: 'Диаметр рулона',
                                    selected: -1,
                                    list: [
                                        {name: '1 330 мм', val: 'product-diameter_01'}
                                    ]
                                },
                                price: {
                                    withDelivery: 32424,
                                    withoutDelivery: 30854
                                }
                            }
                        },
                        {
                            name: 'M 110 (1700мм)',
                            val: '01',
                            data: {
                                decade: {
                                    name: 'Декада',
                                    selected: -1,
                                    list: [
                                        {name: '1-ая декада', val: 'product-decade_01'},
                                        {name: '2-ая декада', val: 'product-decade_02'},
                                        {name: '3-ая декада', val: 'product-decade_03'}
                                    ]
                                },
                                volume: {
                                    name: 'Объём',
                                    val: '1500'
                                },
                                diameter: {
                                    name: 'Диаметр рулона',
                                    selected: -1,
                                    list: [
                                        {name: '1 330 мм', val: 'product-diameter_01'}
                                    ]
                                },
                                price: {
                                    withDelivery: 32424,
                                    withoutDelivery: 30854
                                }
                            }
                        },
                        {
                            name: 'M 110 (2000мм)',
                            val: '01',
                            data: {
                                decade: {
                                    name: 'Декада',
                                    selected: -1,
                                    list: [
                                        {name: '1-ая декада', val: 'product-decade_01'},
                                        {name: '2-ая декада', val: 'product-decade_02'},
                                        {name: '3-ая декада', val: 'product-decade_03'}
                                    ]
                                },
                                volume: {
                                    name: 'Объём',
                                    val: '1500'
                                },
                                diameter: {
                                    name: 'Диаметр рулона',
                                    selected: -1,
                                    list: [
                                        {name: '1 330 мм', val: 'product-diameter_01'}
                                    ]
                                },
                                price: {
                                    withDelivery: 32424,
                                    withoutDelivery: 30854
                                }
                            }
                        },
                        {
                            name: 'M 110 (2100мм)',
                            val: '01',
                            data: {
                                decade: {
                                    name: 'Декада',
                                    selected: -1,
                                    list: [
                                        {name: '1-ая декада', val: 'product-decade_01'},
                                        {name: '2-ая декада', val: 'product-decade_02'},
                                        {name: '3-ая декада', val: 'product-decade_03'}
                                    ]
                                },
                                volume: {
                                    name: 'Объём',
                                    val: '1500'
                                },
                                diameter: {
                                    name: 'Диаметр рулона',
                                    selected: -1,
                                    list: [
                                        {name: '1 330 мм', val: 'product-diameter_01'}
                                    ]
                                },
                                price: {
                                    withDelivery: 32424,
                                    withoutDelivery: 30854
                                }
                            }
                        },
                        {
                            name: 'M 110 (2200мм)',
                            val: '01',
                            data: {
                                decade: {
                                    name: 'Декада',
                                    selected: -1,
                                    list: [
                                        {name: '1-ая декада', val: 'product-decade_01'},
                                        {name: '2-ая декада', val: 'product-decade_02'},
                                        {name: '3-ая декада', val: 'product-decade_03'}
                                    ]
                                },
                                volume: {
                                    name: 'Объём',
                                    val: '1500'
                                },
                                diameter: {
                                    name: 'Диаметр рулона',
                                    selected: -1,
                                    list: [
                                        {name: '1 330 мм', val: 'product-diameter_01'}
                                    ]
                                },
                                price: {
                                    withDelivery: 32424,
                                    withoutDelivery: 30854
                                }
                            }
                        },
                        {
                            name: 'M 110 (2500мм)',
                            val: '01',
                            data: {
                                decade: {
                                    name: 'Декада',
                                    selected: -1,
                                    list: [
                                        {name: '1-ая декада', val: 'product-decade_01'},
                                        {name: '2-ая декада', val: 'product-decade_02'},
                                        {name: '3-ая декада', val: 'product-decade_03'}
                                    ]
                                },
                                volume: {
                                    name: 'Объём',
                                    val: '1500'
                                },
                                diameter: {
                                    name: 'Диаметр рулона',
                                    selected: -1,
                                    list: [
                                        {name: '1 330 мм', val: 'product-diameter_01'}
                                    ]
                                },
                                price: {
                                    withDelivery: 32424,
                                    withoutDelivery: 30854
                                }
                            }
                        },
                        {
                            name: 'M 120 (1700мм)',
                            val: '01',
                            data: {
                                decade: {
                                    name: 'Декада',
                                    selected: -1,
                                    list: [
                                        {name: '1-ая декада', val: 'product-decade_01'},
                                        {name: '2-ая декада', val: 'product-decade_02'},
                                        {name: '3-ая декада', val: 'product-decade_03'}
                                    ]
                                },
                                volume: {
                                    name: 'Объём',
                                    val: '1500'
                                },
                                diameter: {
                                    name: 'Диаметр рулона',
                                    selected: -1,
                                    list: [
                                        {name: '1 330 мм', val: 'product-diameter_01'}
                                    ]
                                },
                                price: {
                                    withDelivery: 32224,
                                    withoutDelivery: 30654
                                }
                            }
                        },
                        {
                            name: 'M 120 (2000мм)',
                            val: '01',
                            data: {
                                decade: {
                                    name: 'Декада',
                                    selected: -1,
                                    list: [
                                        {name: '1-ая декада', val: 'product-decade_01'},
                                        {name: '2-ая декада', val: 'product-decade_02'},
                                        {name: '3-ая декада', val: 'product-decade_03'}
                                    ]
                                },
                                volume: {
                                    name: 'Объём',
                                    val: '1500'
                                },
                                diameter: {
                                    name: 'Диаметр рулона',
                                    selected: -1,
                                    list: [
                                        {name: '1 330 мм', val: 'product-diameter_01'}
                                    ]
                                },
                                price: {
                                    withDelivery: 32224,
                                    withoutDelivery: 30654
                                }
                            }
                        },
                        {
                            name: 'M 120 (2100мм)',
                            val: '01',
                            data: {
                                decade: {
                                    name: 'Декада',
                                    selected: -1,
                                    list: [
                                        {name: '1-ая декада', val: 'product-decade_01'},
                                        {name: '2-ая декада', val: 'product-decade_02'},
                                        {name: '3-ая декада', val: 'product-decade_03'}
                                    ]
                                },
                                volume: {
                                    name: 'Объём',
                                    val: '1500'
                                },
                                diameter: {
                                    name: 'Диаметр рулона',
                                    selected: -1,
                                    list: [
                                        {name: '1 330 мм', val: 'product-diameter_01'}
                                    ]
                                },
                                price: {
                                    withDelivery: 32224,
                                    withoutDelivery: 30654
                                }
                            }
                        },
                        {
                            name: 'M 120 (2200мм)',
                            val: '01',
                            data: {
                                decade: {
                                    name: 'Декада',
                                    selected: -1,
                                    list: [
                                        {name: '1-ая декада', val: 'product-decade_01'},
                                        {name: '2-ая декада', val: 'product-decade_02'},
                                        {name: '3-ая декада', val: 'product-decade_03'}
                                    ]
                                },
                                volume: {
                                    name: 'Объём',
                                    val: '1500'
                                },
                                diameter: {
                                    name: 'Диаметр рулона',
                                    selected: -1,
                                    list: [
                                        {name: '1 330 мм', val: 'product-diameter_01'}
                                    ]
                                },
                                price: {
                                    withDelivery: 32224,
                                    withoutDelivery: 30654
                                }
                            }
                        },
                        {
                            name: 'M 120 (2500мм)',
                            val: '01',
                            data: {
                                decade: {
                                    name: 'Декада',
                                    selected: -1,
                                    list: [
                                        {name: '1-ая декада', val: 'product-decade_01'},
                                        {name: '2-ая декада', val: 'product-decade_02'},
                                        {name: '3-ая декада', val: 'product-decade_03'}
                                    ]
                                },
                                volume: {
                                    name: 'Объём',
                                    val: '1500'
                                },
                                diameter: {
                                    name: 'Диаметр рулона',
                                    selected: -1,
                                    list: [
                                        {name: '1 330 мм', val: 'product-diameter_01'}
                                    ]
                                },
                                price: {
                                    withDelivery: 32224,
                                    withoutDelivery: 30654
                                }
                            }
                        },
                        {
                            name: 'M 135 (1700мм)',
                            val: '01',
                            data: {
                                decade: {
                                    name: 'Декада',
                                    selected: -1,
                                    list: [
                                        {name: '1-ая декада', val: 'product-decade_01'},
                                        {name: '2-ая декада', val: 'product-decade_02'},
                                        {name: '3-ая декада', val: 'product-decade_03'}
                                    ]
                                },
                                volume: {
                                    name: 'Объём',
                                    val: '1500'
                                },
                                diameter: {
                                    name: 'Диаметр рулона',
                                    selected: -1,
                                    list: [
                                        {name: '1 330 мм', val: 'product-diameter_01'}
                                    ]
                                },
                                price: {
                                    withDelivery: 32024,
                                    withoutDelivery: 30454
                                }
                            }
                        },
                        {
                            name: 'M 135 (2000мм)',
                            val: '01',
                            data: {
                                decade: {
                                    name: 'Декада',
                                    selected: -1,
                                    list: [
                                        {name: '1-ая декада', val: 'product-decade_01'},
                                        {name: '2-ая декада', val: 'product-decade_02'},
                                        {name: '3-ая декада', val: 'product-decade_03'}
                                    ]
                                },
                                volume: {
                                    name: 'Объём',
                                    val: '1500'
                                },
                                diameter: {
                                    name: 'Диаметр рулона',
                                    selected: -1,
                                    list: [
                                        {name: '1 330 мм', val: 'product-diameter_01'}
                                    ]
                                },
                                price: {
                                    withDelivery: 32024,
                                    withoutDelivery: 30454
                                }
                            }
                        },
                        {
                            name: 'M 135 (2100мм)',
                            val: '01',
                            data: {
                                decade: {
                                    name: 'Декада',
                                    selected: -1,
                                    list: [
                                        {name: '1-ая декада', val: 'product-decade_01'},
                                        {name: '2-ая декада', val: 'product-decade_02'},
                                        {name: '3-ая декада', val: 'product-decade_03'}
                                    ]
                                },
                                volume: {
                                    name: 'Объём',
                                    val: '1500'
                                },
                                diameter: {
                                    name: 'Диаметр рулона',
                                    selected: -1,
                                    list: [
                                        {name: '1 330 мм', val: 'product-diameter_01'}
                                    ]
                                },
                                price: {
                                    withDelivery: 32024,
                                    withoutDelivery: 30454
                                }
                            }
                        },
                        {
                            name: 'M 135 (2200мм)',
                            val: '01',
                            data: {
                                decade: {
                                    name: 'Декада',
                                    selected: -1,
                                    list: [
                                        {name: '1-ая декада', val: 'product-decade_01'},
                                        {name: '2-ая декада', val: 'product-decade_02'},
                                        {name: '3-ая декада', val: 'product-decade_03'}
                                    ]
                                },
                                volume: {
                                    name: 'Объём',
                                    val: '1500'
                                },
                                diameter: {
                                    name: 'Диаметр рулона',
                                    selected: -1,
                                    list: [
                                        {name: '1 330 мм', val: 'product-diameter_01'}
                                    ]
                                },
                                price: {
                                    withDelivery: 32024,
                                    withoutDelivery: 30454
                                }
                            }
                        },
                        {
                            name: 'M 135 (2500мм)',
                            val: '01',
                            data: {
                                decade: {
                                    name: 'Декада',
                                    selected: -1,
                                    list: [
                                        {name: '1-ая декада', val: 'product-decade_01'},
                                        {name: '2-ая декада', val: 'product-decade_02'},
                                        {name: '3-ая декада', val: 'product-decade_03'}
                                    ]
                                },
                                volume: {
                                    name: 'Объём',
                                    val: '1500'
                                },
                                diameter: {
                                    name: 'Диаметр рулона',
                                    selected: -1,
                                    list: [
                                        {name: '1 330 мм', val: 'product-diameter_01'}
                                    ]
                                },
                                price: {
                                    withDelivery: 32024,
                                    withoutDelivery: 30454
                                }
                            }
                        },
                        {
                            name: 'M 150 (1700мм)',
                            val: '01',
                            data: {
                                decade: {
                                    name: 'Декада',
                                    selected: -1,
                                    list: [
                                        {name: '1-ая декада', val: 'product-decade_01'},
                                        {name: '2-ая декада', val: 'product-decade_02'},
                                        {name: '3-ая декада', val: 'product-decade_03'}
                                    ]
                                },
                                volume: {
                                    name: 'Объём',
                                    val: '1500'
                                },
                                diameter: {
                                    name: 'Диаметр рулона',
                                    selected: -1,
                                    list: [
                                        {name: '1 330 мм', val: 'product-diameter_01'}
                                    ]
                                },
                                price: {
                                    withDelivery: 31824,
                                    withoutDelivery: 30254
                                }
                            }
                        },
                        {
                            name: 'M 150 (2000мм)',
                            val: '01',
                            data: {
                                decade: {
                                    name: 'Декада',
                                    selected: -1,
                                    list: [
                                        {name: '1-ая декада', val: 'product-decade_01'},
                                        {name: '2-ая декада', val: 'product-decade_02'},
                                        {name: '3-ая декада', val: 'product-decade_03'}
                                    ]
                                },
                                volume: {
                                    name: 'Объём',
                                    val: '1500'
                                },
                                diameter: {
                                    name: 'Диаметр рулона',
                                    selected: -1,
                                    list: [
                                        {name: '1 330 мм', val: 'product-diameter_01'}
                                    ]
                                },
                                price: {
                                    withDelivery: 31824,
                                    withoutDelivery: 30254
                                }
                            }
                        },
                        {
                            name: 'M 150 (2100мм)',
                            val: '01',
                            data: {
                                decade: {
                                    name: 'Декада',
                                    selected: -1,
                                    list: [
                                        {name: '1-ая декада', val: 'product-decade_01'},
                                        {name: '2-ая декада', val: 'product-decade_02'},
                                        {name: '3-ая декада', val: 'product-decade_03'}
                                    ]
                                },
                                volume: {
                                    name: 'Объём',
                                    val: '1500'
                                },
                                diameter: {
                                    name: 'Диаметр рулона',
                                    selected: -1,
                                    list: [
                                        {name: '1 330 мм', val: 'product-diameter_01'}
                                    ]
                                },
                                price: {
                                    withDelivery: 31824,
                                    withoutDelivery: 30254
                                }
                            }
                        },
                        {
                            name: 'M 150 (2200мм)',
                            val: '01',
                            data: {
                                decade: {
                                    name: 'Декада',
                                    selected: -1,
                                    list: [
                                        {name: '1-ая декада', val: 'product-decade_01'},
                                        {name: '2-ая декада', val: 'product-decade_02'},
                                        {name: '3-ая декада', val: 'product-decade_03'}
                                    ]
                                },
                                volume: {
                                    name: 'Объём',
                                    val: '1500'
                                },
                                diameter: {
                                    name: 'Диаметр рулона',
                                    selected: -1,
                                    list: [
                                        {name: '1 330 мм', val: 'product-diameter_01'}
                                    ]
                                },
                                price: {
                                    withDelivery: 31824,
                                    withoutDelivery: 30254
                                }
                            }
                        },
                        {
                            name: 'M 150 (2500мм)',
                            val: '01',
                            data: {
                                decade: {
                                    name: 'Декада',
                                    selected: -1,
                                    list: [
                                        {name: '1-ая декада', val: 'product-decade_01'},
                                        {name: '2-ая декада', val: 'product-decade_02'},
                                        {name: '3-ая декада', val: 'product-decade_03'}
                                    ]
                                },
                                volume: {
                                    name: 'Объём',
                                    val: '1500'
                                },
                                diameter: {
                                    name: 'Диаметр рулона',
                                    selected: -1,
                                    list: [
                                        {name: '1 330 мм', val: 'product-diameter_01'}
                                    ]
                                },
                                price: {
                                    withDelivery: 31824,
                                    withoutDelivery: 30254
                                }
                            }
                        },
                        {
                            name: 'M3 100 (1700мм)',
                            val: '01',
                            data: {
                                decade: {
                                    name: 'Декада',
                                    selected: -1,
                                    list: [
                                        {name: '1-ая декада', val: 'product-decade_01'},
                                        {name: '2-ая декада', val: 'product-decade_02'},
                                        {name: '3-ая декада', val: 'product-decade_03'}
                                    ]
                                },
                                volume: {
                                    name: 'Объём',
                                    val: '1500'
                                },
                                diameter: {
                                    name: 'Диаметр рулона',
                                    selected: -1,
                                    list: [
                                        {name: '1 330 мм', val: 'product-diameter_01'}
                                    ]
                                },
                                price: {
                                    withDelivery: 25750,
                                    withoutDelivery: 24180
                                }
                            }
                        },
                        {
                            name: 'M3 100 (2000мм)',
                            val: '01',
                            data: {
                                decade: {
                                    name: 'Декада',
                                    selected: -1,
                                    list: [
                                        {name: '1-ая декада', val: 'product-decade_01'},
                                        {name: '2-ая декада', val: 'product-decade_02'},
                                        {name: '3-ая декада', val: 'product-decade_03'}
                                    ]
                                },
                                volume: {
                                    name: 'Объём',
                                    val: '1500'
                                },
                                diameter: {
                                    name: 'Диаметр рулона',
                                    selected: -1,
                                    list: [
                                        {name: '1 330 мм', val: 'product-diameter_01'}
                                    ]
                                },
                                price: {
                                    withDelivery: 25750,
                                    withoutDelivery: 24180
                                }
                            }
                        },
                        {
                            name: 'M3 100 (2100мм)',
                            val: '01',
                            data: {
                                decade: {
                                    name: 'Декада',
                                    selected: -1,
                                    list: [
                                        {name: '1-ая декада', val: 'product-decade_01'},
                                        {name: '2-ая декада', val: 'product-decade_02'},
                                        {name: '3-ая декада', val: 'product-decade_03'}
                                    ]
                                },
                                volume: {
                                    name: 'Объём',
                                    val: '1500'
                                },
                                diameter: {
                                    name: 'Диаметр рулона',
                                    selected: -1,
                                    list: [
                                        {name: '1 330 мм', val: 'product-diameter_01'}
                                    ]
                                },
                                price: {
                                    withDelivery: 25750,
                                    withoutDelivery: 24180
                                }
                            }
                        },
                        {
                            name: 'M3 100 (2200мм)',
                            val: '01',
                            data: {
                                decade: {
                                    name: 'Декада',
                                    selected: -1,
                                    list: [
                                        {name: '1-ая декада', val: 'product-decade_01'},
                                        {name: '2-ая декада', val: 'product-decade_02'},
                                        {name: '3-ая декада', val: 'product-decade_03'}
                                    ]
                                },
                                volume: {
                                    name: 'Объём',
                                    val: '1500'
                                },
                                diameter: {
                                    name: 'Диаметр рулона',
                                    selected: -1,
                                    list: [
                                        {name: '1 330 мм', val: 'product-diameter_01'}
                                    ]
                                },
                                price: {
                                    withDelivery: 25750,
                                    withoutDelivery: 24180
                                }
                            }
                        },
                        {
                            name: 'M3 100 (2500мм)',
                            val: '01',
                            data: {
                                decade: {
                                    name: 'Декада',
                                    selected: -1,
                                    list: [
                                        {name: '1-ая декада', val: 'product-decade_01'},
                                        {name: '2-ая декада', val: 'product-decade_02'},
                                        {name: '3-ая декада', val: 'product-decade_03'}
                                    ]
                                },
                                volume: {
                                    name: 'Объём',
                                    val: '1500'
                                },
                                diameter: {
                                    name: 'Диаметр рулона',
                                    selected: -1,
                                    list: [
                                        {name: '1 330 мм', val: 'product-diameter_01'}
                                    ]
                                },
                                price: {
                                    withDelivery: 25750,
                                    withoutDelivery: 24180
                                }
                            }
                        },
                        {
                            name: 'M3 110 (1700мм)',
                            val: '01',
                            data: {
                                decade: {
                                    name: 'Декада',
                                    selected: -1,
                                    list: [
                                        {name: '1-ая декада', val: 'product-decade_01'},
                                        {name: '2-ая декада', val: 'product-decade_02'},
                                        {name: '3-ая декада', val: 'product-decade_03'}
                                    ]
                                },
                                volume: {
                                    name: 'Объём',
                                    val: '1500'
                                },
                                diameter: {
                                    name: 'Диаметр рулона',
                                    selected: -1,
                                    list: [
                                        {name: '1 330 мм', val: 'product-diameter_01'}
                                    ]
                                },
                                price: {
                                    withDelivery: 25750,
                                    withoutDelivery: 24180
                                }
                            }
                        },
                        {
                            name: 'M3 110 (2000мм)',
                            val: '01',
                            data: {
                                decade: {
                                    name: 'Декада',
                                    selected: -1,
                                    list: [
                                        {name: '1-ая декада', val: 'product-decade_01'},
                                        {name: '2-ая декада', val: 'product-decade_02'},
                                        {name: '3-ая декада', val: 'product-decade_03'}
                                    ]
                                },
                                volume: {
                                    name: 'Объём',
                                    val: '1500'
                                },
                                diameter: {
                                    name: 'Диаметр рулона',
                                    selected: -1,
                                    list: [
                                        {name: '1 330 мм', val: 'product-diameter_01'}
                                    ]
                                },
                                price: {
                                    withDelivery: 25750,
                                    withoutDelivery: 24180
                                }
                            }
                        },
                        {
                            name: 'M3 110 (2100мм)',
                            val: '01',
                            data: {
                                decade: {
                                    name: 'Декада',
                                    selected: -1,
                                    list: [
                                        {name: '1-ая декада', val: 'product-decade_01'},
                                        {name: '2-ая декада', val: 'product-decade_02'},
                                        {name: '3-ая декада', val: 'product-decade_03'}
                                    ]
                                },
                                volume: {
                                    name: 'Объём',
                                    val: '1500'
                                },
                                diameter: {
                                    name: 'Диаметр рулона',
                                    selected: -1,
                                    list: [
                                        {name: '1 330 мм', val: 'product-diameter_01'}
                                    ]
                                },
                                price: {
                                    withDelivery: 25750,
                                    withoutDelivery: 24180
                                }
                            }
                        },
                        {
                            name: 'M3 110 (2200мм)',
                            val: '01',
                            data: {
                                decade: {
                                    name: 'Декада',
                                    selected: -1,
                                    list: [
                                        {name: '1-ая декада', val: 'product-decade_01'},
                                        {name: '2-ая декада', val: 'product-decade_02'},
                                        {name: '3-ая декада', val: 'product-decade_03'}
                                    ]
                                },
                                volume: {
                                    name: 'Объём',
                                    val: '1500'
                                },
                                diameter: {
                                    name: 'Диаметр рулона',
                                    selected: -1,
                                    list: [
                                        {name: '1 330 мм', val: 'product-diameter_01'}
                                    ]
                                },
                                price: {
                                    withDelivery: 25750,
                                    withoutDelivery: 24180
                                }
                            }
                        },
                        {
                            name: 'M3 110 (2500мм)',
                            val: '01',
                            data: {
                                decade: {
                                    name: 'Декада',
                                    selected: -1,
                                    list: [
                                        {name: '1-ая декада', val: 'product-decade_01'},
                                        {name: '2-ая декада', val: 'product-decade_02'},
                                        {name: '3-ая декада', val: 'product-decade_03'}
                                    ]
                                },
                                volume: {
                                    name: 'Объём',
                                    val: '1500'
                                },
                                diameter: {
                                    name: 'Диаметр рулона',
                                    selected: -1,
                                    list: [
                                        {name: '1 330 мм', val: 'product-diameter_01'}
                                    ]
                                },
                                price: {
                                    withDelivery: 25750,
                                    withoutDelivery: 24180
                                }
                            }
                        },
                        {
                            name: 'L2 110 (1700мм)',
                            val: '01',
                            data: {
                                decade: {
                                    name: 'Декада',
                                    selected: -1,
                                    list: [
                                        {name: '1-ая декада', val: 'product-decade_01'},
                                        {name: '2-ая декада', val: 'product-decade_02'},
                                        {name: '3-ая декада', val: 'product-decade_03'}
                                    ]
                                },
                                volume: {
                                    name: 'Объём',
                                    val: '1500'
                                },
                                diameter: {
                                    name: 'Диаметр рулона',
                                    selected: -1,
                                    list: [
                                        {name: '1 330 мм', val: 'product-diameter_01'}
                                    ]
                                },
                                price: {
                                    withDelivery: 32824,
                                    withoutDelivery: 31254
                                }
                            }
                        },
                        {
                            name: 'L2 110 (2000мм)',
                            val: '01',
                            data: {
                                decade: {
                                    name: 'Декада',
                                    selected: -1,
                                    list: [
                                        {name: '1-ая декада', val: 'product-decade_01'},
                                        {name: '2-ая декада', val: 'product-decade_02'},
                                        {name: '3-ая декада', val: 'product-decade_03'}
                                    ]
                                },
                                volume: {
                                    name: 'Объём',
                                    val: '1500'
                                },
                                diameter: {
                                    name: 'Диаметр рулона',
                                    selected: -1,
                                    list: [
                                        {name: '1 330 мм', val: 'product-diameter_01'}
                                    ]
                                },
                                price: {
                                    withDelivery: 32824,
                                    withoutDelivery: 31254
                                }
                            }
                        },
                        {
                            name: 'L2 110 (2100мм)',
                            val: '01',
                            data: {
                                decade: {
                                    name: 'Декада',
                                    selected: -1,
                                    list: [
                                        {name: '1-ая декада', val: 'product-decade_01'},
                                        {name: '2-ая декада', val: 'product-decade_02'},
                                        {name: '3-ая декада', val: 'product-decade_03'}
                                    ]
                                },
                                volume: {
                                    name: 'Объём',
                                    val: '1500'
                                },
                                diameter: {
                                    name: 'Диаметр рулона',
                                    selected: -1,
                                    list: [
                                        {name: '1 330 мм', val: 'product-diameter_01'}
                                    ]
                                },
                                price: {
                                    withDelivery: 32824,
                                    withoutDelivery: 31254
                                }
                            }
                        },
                        {
                            name: 'L2 110 (2200мм)',
                            val: '01',
                            data: {
                                decade: {
                                    name: 'Декада',
                                    selected: -1,
                                    list: [
                                        {name: '1-ая декада', val: 'product-decade_01'},
                                        {name: '2-ая декада', val: 'product-decade_02'},
                                        {name: '3-ая декада', val: 'product-decade_03'}
                                    ]
                                },
                                volume: {
                                    name: 'Объём',
                                    val: '1500'
                                },
                                diameter: {
                                    name: 'Диаметр рулона',
                                    selected: -1,
                                    list: [
                                        {name: '1 330 мм', val: 'product-diameter_01'}
                                    ]
                                },
                                price: {
                                    withDelivery: 32824,
                                    withoutDelivery: 31254
                                }
                            }
                        },
                        {
                            name: 'L2 110 (2500мм)',
                            val: '01',
                            data: {
                                decade: {
                                    name: 'Декада',
                                    selected: -1,
                                    list: [
                                        {name: '1-ая декада', val: 'product-decade_01'},
                                        {name: '2-ая декада', val: 'product-decade_02'},
                                        {name: '3-ая декада', val: 'product-decade_03'}
                                    ]
                                },
                                volume: {
                                    name: 'Объём',
                                    val: '1500'
                                },
                                diameter: {
                                    name: 'Диаметр рулона',
                                    selected: -1,
                                    list: [
                                        {name: '1 330 мм', val: 'product-diameter_01'}
                                    ]
                                },
                                price: {
                                    withDelivery: 32824,
                                    withoutDelivery: 31254
                                }
                            }
                        },
                        {
                            name: 'L2 120 (1700мм)',
                            val: '01',
                            data: {
                                decade: {
                                    name: 'Декада',
                                    selected: -1,
                                    list: [
                                        {name: '1-ая декада', val: 'product-decade_01'},
                                        {name: '2-ая декада', val: 'product-decade_02'},
                                        {name: '3-ая декада', val: 'product-decade_03'}
                                    ]
                                },
                                volume: {
                                    name: 'Объём',
                                    val: '1500'
                                },
                                diameter: {
                                    name: 'Диаметр рулона',
                                    selected: -1,
                                    list: [
                                        {name: '1 330 мм', val: 'product-diameter_01'}
                                    ]
                                },
                                price: {
                                    withDelivery: 32624,
                                    withoutDelivery: 31054
                                }
                            }
                        },
                        {
                            name: 'L2 120 (2000мм)',
                            val: '01',
                            data: {
                                decade: {
                                    name: 'Декада',
                                    selected: -1,
                                    list: [
                                        {name: '1-ая декада', val: 'product-decade_01'},
                                        {name: '2-ая декада', val: 'product-decade_02'},
                                        {name: '3-ая декада', val: 'product-decade_03'}
                                    ]
                                },
                                volume: {
                                    name: 'Объём',
                                    val: '1500'
                                },
                                diameter: {
                                    name: 'Диаметр рулона',
                                    selected: -1,
                                    list: [
                                        {name: '1 330 мм', val: 'product-diameter_01'}
                                    ]
                                },
                                price: {
                                    withDelivery: 32624,
                                    withoutDelivery: 31054
                                }
                            }
                        },
                        {
                            name: 'L2 120 (2100мм)',
                            val: '01',
                            data: {
                                decade: {
                                    name: 'Декада',
                                    selected: -1,
                                    list: [
                                        {name: '1-ая декада', val: 'product-decade_01'},
                                        {name: '2-ая декада', val: 'product-decade_02'},
                                        {name: '3-ая декада', val: 'product-decade_03'}
                                    ]
                                },
                                volume: {
                                    name: 'Объём',
                                    val: '1500'
                                },
                                diameter: {
                                    name: 'Диаметр рулона',
                                    selected: -1,
                                    list: [
                                        {name: '1 330 мм', val: 'product-diameter_01'}
                                    ]
                                },
                                price: {
                                    withDelivery: 32624,
                                    withoutDelivery: 31054
                                }
                            }
                        },
                        {
                            name: 'L2 120 (2200мм)',
                            val: '01',
                            data: {
                                decade: {
                                    name: 'Декада',
                                    selected: -1,
                                    list: [
                                        {name: '1-ая декада', val: 'product-decade_01'},
                                        {name: '2-ая декада', val: 'product-decade_02'},
                                        {name: '3-ая декада', val: 'product-decade_03'}
                                    ]
                                },
                                volume: {
                                    name: 'Объём',
                                    val: '1500'
                                },
                                diameter: {
                                    name: 'Диаметр рулона',
                                    selected: -1,
                                    list: [
                                        {name: '1 330 мм', val: 'product-diameter_01'}
                                    ]
                                },
                                price: {
                                    withDelivery: 32624,
                                    withoutDelivery: 31054
                                }
                            }
                        },
                        {
                            name: 'L2 120 (2500мм)',
                            val: '01',
                            data: {
                                decade: {
                                    name: 'Декада',
                                    selected: -1,
                                    list: [
                                        {name: '1-ая декада', val: 'product-decade_01'},
                                        {name: '2-ая декада', val: 'product-decade_02'},
                                        {name: '3-ая декада', val: 'product-decade_03'}
                                    ]
                                },
                                volume: {
                                    name: 'Объём',
                                    val: '1500'
                                },
                                diameter: {
                                    name: 'Диаметр рулона',
                                    selected: -1,
                                    list: [
                                        {name: '1 330 мм', val: 'product-diameter_01'}
                                    ]
                                },
                                price: {
                                    withDelivery: 32624,
                                    withoutDelivery: 31054
                                }
                            }
                        },
                        {
                            name: 'L2 135 (1700мм)',
                            val: '01',
                            data: {
                                decade: {
                                    name: 'Декада',
                                    selected: -1,
                                    list: [
                                        {name: '1-ая декада', val: 'product-decade_01'},
                                        {name: '2-ая декада', val: 'product-decade_02'},
                                        {name: '3-ая декада', val: 'product-decade_03'}
                                    ]
                                },
                                volume: {
                                    name: 'Объём',
                                    val: '1500'
                                },
                                diameter: {
                                    name: 'Диаметр рулона',
                                    selected: -1,
                                    list: [
                                        {name: '1 330 мм', val: 'product-diameter_01'}
                                    ]
                                },
                                price: {
                                    withDelivery: 32424,
                                    withoutDelivery: 30854
                                }
                            }
                        },
                        {
                            name: 'L2 135 (2000мм)',
                            val: '01',
                            data: {
                                decade: {
                                    name: 'Декада',
                                    selected: -1,
                                    list: [
                                        {name: '1-ая декада', val: 'product-decade_01'},
                                        {name: '2-ая декада', val: 'product-decade_02'},
                                        {name: '3-ая декада', val: 'product-decade_03'}
                                    ]
                                },
                                volume: {
                                    name: 'Объём',
                                    val: '1500'
                                },
                                diameter: {
                                    name: 'Диаметр рулона',
                                    selected: -1,
                                    list: [
                                        {name: '1 330 мм', val: 'product-diameter_01'}
                                    ]
                                },
                                price: {
                                    withDelivery: 32424,
                                    withoutDelivery: 30854
                                }
                            }
                        },
                        {
                            name: 'L2 135 (2100мм)',
                            val: '01',
                            data: {
                                decade: {
                                    name: 'Декада',
                                    selected: -1,
                                    list: [
                                        {name: '1-ая декада', val: 'product-decade_01'},
                                        {name: '2-ая декада', val: 'product-decade_02'},
                                        {name: '3-ая декада', val: 'product-decade_03'}
                                    ]
                                },
                                volume: {
                                    name: 'Объём',
                                    val: '1500'
                                },
                                diameter: {
                                    name: 'Диаметр рулона',
                                    selected: -1,
                                    list: [
                                        {name: '1 330 мм', val: 'product-diameter_01'}
                                    ]
                                },
                                price: {
                                    withDelivery: 32424,
                                    withoutDelivery: 30854
                                }
                            }
                        },
                        {
                            name: 'L2 135 (2200мм)',
                            val: '01',
                            data: {
                                decade: {
                                    name: 'Декада',
                                    selected: -1,
                                    list: [
                                        {name: '1-ая декада', val: 'product-decade_01'},
                                        {name: '2-ая декада', val: 'product-decade_02'},
                                        {name: '3-ая декада', val: 'product-decade_03'}
                                    ]
                                },
                                volume: {
                                    name: 'Объём',
                                    val: '1500'
                                },
                                diameter: {
                                    name: 'Диаметр рулона',
                                    selected: -1,
                                    list: [
                                        {name: '1 330 мм', val: 'product-diameter_01'}
                                    ]
                                },
                                price: {
                                    withDelivery: 32424,
                                    withoutDelivery: 30854
                                }
                            }
                        },
                        {
                            name: 'L2 135 (2500мм)',
                            val: '01',
                            data: {
                                decade: {
                                    name: 'Декада',
                                    selected: -1,
                                    list: [
                                        {name: '1-ая декада', val: 'product-decade_01'},
                                        {name: '2-ая декада', val: 'product-decade_02'},
                                        {name: '3-ая декада', val: 'product-decade_03'}
                                    ]
                                },
                                volume: {
                                    name: 'Объём',
                                    val: '1500'
                                },
                                diameter: {
                                    name: 'Диаметр рулона',
                                    selected: -1,
                                    list: [
                                        {name: '1 330 мм', val: 'product-diameter_01'}
                                    ]
                                },
                                price: {
                                    withDelivery: 32424,
                                    withoutDelivery: 30854
                                }
                            }
                        },
                        {
                            name: 'L2 150 (1700мм)',
                            val: '01',
                            data: {
                                decade: {
                                    name: 'Декада',
                                    selected: -1,
                                    list: [
                                        {name: '1-ая декада', val: 'product-decade_01'},
                                        {name: '2-ая декада', val: 'product-decade_02'},
                                        {name: '3-ая декада', val: 'product-decade_03'}
                                    ]
                                },
                                volume: {
                                    name: 'Объём',
                                    val: '1500'
                                },
                                diameter: {
                                    name: 'Диаметр рулона',
                                    selected: -1,
                                    list: [
                                        {name: '1 330 мм', val: 'product-diameter_01'}
                                    ]
                                },
                                price: {
                                    withDelivery: 32224,
                                    withoutDelivery: 30654
                                }
                            }
                        },
                        {
                            name: 'L2 150 (2000мм)',
                            val: '01',
                            data: {
                                decade: {
                                    name: 'Декада',
                                    selected: -1,
                                    list: [
                                        {name: '1-ая декада', val: 'product-decade_01'},
                                        {name: '2-ая декада', val: 'product-decade_02'},
                                        {name: '3-ая декада', val: 'product-decade_03'}
                                    ]
                                },
                                volume: {
                                    name: 'Объём',
                                    val: '1500'
                                },
                                diameter: {
                                    name: 'Диаметр рулона',
                                    selected: -1,
                                    list: [
                                        {name: '1 330 мм', val: 'product-diameter_01'}
                                    ]
                                },
                                price: {
                                    withDelivery: 32224,
                                    withoutDelivery: 30654
                                }
                            }
                        },
                        {
                            name: 'L2 150 (2100мм)',
                            val: '01',
                            data: {
                                decade: {
                                    name: 'Декада',
                                    selected: -1,
                                    list: [
                                        {name: '1-ая декада', val: 'product-decade_01'},
                                        {name: '2-ая декада', val: 'product-decade_02'},
                                        {name: '3-ая декада', val: 'product-decade_03'}
                                    ]
                                },
                                volume: {
                                    name: 'Объём',
                                    val: '1500'
                                },
                                diameter: {
                                    name: 'Диаметр рулона',
                                    selected: -1,
                                    list: [
                                        {name: '1 330 мм', val: 'product-diameter_01'}
                                    ]
                                },
                                price: {
                                    withDelivery: 32224,
                                    withoutDelivery: 30654
                                }
                            }
                        },
                        {
                            name: 'L2 150 (2200мм)',
                            val: '01',
                            data: {
                                decade: {
                                    name: 'Декада',
                                    selected: -1,
                                    list: [
                                        {name: '1-ая декада', val: 'product-decade_01'},
                                        {name: '2-ая декада', val: 'product-decade_02'},
                                        {name: '3-ая декада', val: 'product-decade_03'}
                                    ]
                                },
                                volume: {
                                    name: 'Объём',
                                    val: '1500'
                                },
                                diameter: {
                                    name: 'Диаметр рулона',
                                    selected: -1,
                                    list: [
                                        {name: '1 330 мм', val: 'product-diameter_01'}
                                    ]
                                },
                                price: {
                                    withDelivery: 32224,
                                    withoutDelivery: 30654
                                }
                            }
                        },
                        {
                            name: 'L2 150 (2500мм)',
                            val: '01',
                            data: {
                                decade: {
                                    name: 'Декада',
                                    selected: -1,
                                    list: [
                                        {name: '1-ая декада', val: 'product-decade_01'},
                                        {name: '2-ая декада', val: 'product-decade_02'},
                                        {name: '3-ая декада', val: 'product-decade_03'}
                                    ]
                                },
                                volume: {
                                    name: 'Объём',
                                    val: '1500'
                                },
                                diameter: {
                                    name: 'Диаметр рулона',
                                    selected: -1,
                                    list: [
                                        {name: '1 330 мм', val: 'product-diameter_01'}
                                    ]
                                },
                                price: {
                                    withDelivery: 32224,
                                    withoutDelivery: 30654
                                }
                            }
                        },
                        {
                            name: 'L2 175 (1700мм)',
                            val: '01',
                            data: {
                                decade: {
                                    name: 'Декада',
                                    selected: -1,
                                    list: [
                                        {name: '1-ая декада', val: 'product-decade_01'},
                                        {name: '2-ая декада', val: 'product-decade_02'},
                                        {name: '3-ая декада', val: 'product-decade_03'}
                                    ]
                                },
                                volume: {
                                    name: 'Объём',
                                    val: '1500'
                                },
                                diameter: {
                                    name: 'Диаметр рулона',
                                    selected: -1,
                                    list: [
                                        {name: '1 330 мм', val: 'product-diameter_01'}
                                    ]
                                },
                                price: {
                                    withDelivery: 32224,
                                    withoutDelivery: 30654
                                }
                            }
                        },
                        {
                            name: 'L2 175 (2000мм)',
                            val: '01',
                            data: {
                                decade: {
                                    name: 'Декада',
                                    selected: -1,
                                    list: [
                                        {name: '1-ая декада', val: 'product-decade_01'},
                                        {name: '2-ая декада', val: 'product-decade_02'},
                                        {name: '3-ая декада', val: 'product-decade_03'}
                                    ]
                                },
                                volume: {
                                    name: 'Объём',
                                    val: '1500'
                                },
                                diameter: {
                                    name: 'Диаметр рулона',
                                    selected: -1,
                                    list: [
                                        {name: '1 330 мм', val: 'product-diameter_01'}
                                    ]
                                },
                                price: {
                                    withDelivery: 32224,
                                    withoutDelivery: 30654
                                }
                            }
                        },
                        {
                            name: 'L2 175 (2100мм)',
                            val: '01',
                            data: {
                                decade: {
                                    name: 'Декада',
                                    selected: -1,
                                    list: [
                                        {name: '1-ая декада', val: 'product-decade_01'},
                                        {name: '2-ая декада', val: 'product-decade_02'},
                                        {name: '3-ая декада', val: 'product-decade_03'}
                                    ]
                                },
                                volume: {
                                    name: 'Объём',
                                    val: '1500'
                                },
                                diameter: {
                                    name: 'Диаметр рулона',
                                    selected: -1,
                                    list: [
                                        {name: '1 330 мм', val: 'product-diameter_01'}
                                    ]
                                },
                                price: {
                                    withDelivery: 32224,
                                    withoutDelivery: 30654
                                }
                            }
                        },
                        {
                            name: 'L2 175 (2200мм)',
                            val: '01',
                            data: {
                                decade: {
                                    name: 'Декада',
                                    selected: -1,
                                    list: [
                                        {name: '1-ая декада', val: 'product-decade_01'},
                                        {name: '2-ая декада', val: 'product-decade_02'},
                                        {name: '3-ая декада', val: 'product-decade_03'}
                                    ]
                                },
                                volume: {
                                    name: 'Объём',
                                    val: '1500'
                                },
                                diameter: {
                                    name: 'Диаметр рулона',
                                    selected: -1,
                                    list: [
                                        {name: '1 330 мм', val: 'product-diameter_01'}
                                    ]
                                },
                                price: {
                                    withDelivery: 32224,
                                    withoutDelivery: 30654
                                }
                            }
                        },
                        {
                            name: 'L2 175 (2500мм)',
                            val: '01',
                            data: {
                                decade: {
                                    name: 'Декада',
                                    selected: -1,
                                    list: [
                                        {name: '1-ая декада', val: 'product-decade_01'},
                                        {name: '2-ая декада', val: 'product-decade_02'},
                                        {name: '3-ая декада', val: 'product-decade_03'}
                                    ]
                                },
                                volume: {
                                    name: 'Объём',
                                    val: '1500'
                                },
                                diameter: {
                                    name: 'Диаметр рулона',
                                    selected: -1,
                                    list: [
                                        {name: '1 330 мм', val: 'product-diameter_01'}
                                    ]
                                },
                                price: {
                                    withDelivery: 32224,
                                    withoutDelivery: 30654
                                }
                            }
                        }
                    ]
                },
                productList: [
                    {product: 0, decade: 0, volume: 1, diameter: 0, price: 0}
                ]
            }
        },
        computed: {
            totalPrice: function () {
                var total = 0;
                for (var i = 0; this.productList.length > i; i++) {
                    total = total + Number(this.productList[i].price);
                }
                return total;
            },
            totalVolume: function () {
                var volume = 0;
                for (var i = 0; this.productList.length > i; i++) {
                    volume = volume + Number(this.productList[i].volume);
                }
                return volume;
            }
        },
        watch: {},
        methods: {
            nextStep: function (i) {
                this.step = i;
            },
            prevStep: function (n) {
                n = n || 1;
                this.step = this.step - n;
            },
            changeProduct: function (indexProductList, indexProduct) {
                this.productList[indexProductList].product = indexProduct;
                this.productList[indexProductList].decade = 0;
                this.productList[indexProductList].volume = 1;
                this.productList[indexProductList].diameter = 0;
                this.productList[indexProductList].price = 0;
            },
            addProduct: function (e) {
                this.productList.push({product: -1, decade: -1, volume: 1, diameter: -1, price: 0});
            },
            delProduct: function (index) {
                this.productList.splice(index, 1);
            },
            calcPrice: function (index) {
                var price = 0;
                if (!this.products.list[this.productList[index].product]) {
                    return price;
                }
                switch (this.infoOnApplication.deliveryMethod.selected) {
                    case 0 :
                        price = this.products.list[this.productList[index].product].data.price.withDelivery;
                        break;
                    case 1 :
                        price = this.products.list[this.productList[index].product].data.price.withDelivery;
                        break;
                    case 2 :
                        price = this.products.list[this.productList[index].product].data.price.withoutDelivery;
                        break;
                }
                this.productList[index].price = price * this.productList[index].volume;
                return this.productList[index].price;
            },
            scrollStep: function (el) {
                scrollBy({top: document.querySelector('#step' + this.step).offsetTop, behavior: 'smooth'});
// scrollTo(document.body, document.querySelector('#step' + this.step).offsetTop, 300);
            },
            sendForm: function () {
                var xhr = new XMLHttpRequest();
                var _productList = [];

                for (var i = 0; this.productList.length > i; i++) {
                    if (this.productList[i].product > -1) {
                        _productList[i] = {
                            name: this.products.list[this.productList[i].product].name,
                            decade: this.products.list[this.productList[i].product].data.decade.list[this.productList[i].decade].name,
                            volume: this.productList[i].volume,
                            diameter: this.products.list[this.productList[i].product].data.diameter.list[this.productList[i].diameter].name,
                            price: this.productList[i].price
                        }
                    }
                }

                var json = JSON.stringify({
                    month: this.infoOnApplication.shipmentPeriod.month.list[this.infoOnApplication.shipmentPeriod.month.selected].name,
                    year: this.infoOnApplication.shipmentPeriod.year.list[this.infoOnApplication.shipmentPeriod.year.selected].name,
                    recipient: this.infoOnApplication.recipient.list[this.infoOnApplication.recipient.selected].name,
                    provider: this.infoOnApplication.provider.list[this.infoOnApplication.provider.selected].name,
                    deliveryMethod: this.infoOnApplication.deliveryMethod.list[this.infoOnApplication.deliveryMethod.selected].name,
                    productList: _productList

                });

                xhr.open("POST", './sendMail.php/', true);
                xhr.setRequestHeader('Content-type', 'application/json; charset=utf-8');

                console.log(xhr);
                xhr.onreadystatechange = function (ev) {
                    console.log(ev);
                    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                        console.log('confirm!');

                        var template = '\t<div id="appSuccess" class="popup popup_wide cntr">\n' +
                            '\t\t<h3 class="popup__title-cnt">Ваша заявка успешно отправлена</h3>\n' +
                            '\t\t<p class="popup__line">В ближайшее время с вами свяжется наш менеджер для уточнения информации!</p>\n' +
                            '\t\t<div class="popup__toolbar">\n' +
                            '\t\t\t<a href="./nomenclature.php" class="btn btn_wide">Ок</a>\n' +
                            '\t\t</div>\n' +
                            '\t</div>\n';

                        $.fancybox.open({
                            src: template,
                            type: 'inline',
                            animationEffect: 'fade',
                            baseClass: 'application-modal',
                            toolbar: false,
                            smallBtn: false,
                            touch: false,
                            closeClickOutside: false,
                            modal: true,
                            helpers: {
                                overlay: {
                                    closeClick: false
                                }
                            }
                        });
                    } else {
                        console.error(ev);
                    }
                };
                xhr.send(json);
            }
        }
    }
</script>

<style>
    .form__select-large input {
        color: #26231f;
        width: 100%;
    }

    .disabled {
        opacity: .5;
        pointer-events: none;
    }
</style>
