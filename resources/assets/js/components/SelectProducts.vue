<template>
    <div class="">
        <form action="" class="form">
            <transition v-on:after-enter="scrollStep"
                        v-on:before-leave="scrollStep">
                <div>
                    <div class="a-title a-title_mb">
                        <div class="a-title__h3">Выбор продукции</div>
                    </div>
                    <div class="products ">
                        <div class="products__row "
                             v-for="(item, index) in productList">
                            <div class="products__td products__td-number">
                                <span class="products__number">{{index+1}}.{{item.index}}</span>
                            </div>

                            <div class="products__td">
                                <div class="info-title products__info-title">Марка</div>
                                <drop-down
                                    v-bind:list="products.brand"
                                    :placeholder="'Товар'"
                                    v-bind:default-selected="item.brand || -1"
                                    :disabled="false"
                                    @change="changeProduct(index, $event)"
                                ></drop-down>
                            </div>
                            <div class="products__td">
                                <drop-down
                                        v-bind:list="products.brand[item.brand] ? products.brand[item.brand].grammage : false"
                                        :placeholder="'Граммаж'"
                                        v-bind:default-selected="false"
                                        @change="changeGrammage(index, $event)"
                                ></drop-down>

                            </div>
                            <div class="products__td products__td-flex1">
                                <drop-down
                                        v-bind:list="products.brand[item.brand].grammage[item.grammage].format ? products.brand[item.brand].grammage[item.grammage].format: false"
                                        :placeholder="'Формат'"
                                        v-bind:default-selected="false"
                                        @change="changeFormat(index, $event); setProductSettings(index, item)"

                                ></drop-down>
                            </div>

                            <div class="products__td products__td-flex1">
                                <input type="text" class="form__input form__input_large"
                                       :class="{ disabled : item.volume_1 === false }"
                                       v-model="item.volume_1"
                                       v-on:keyup="calcPrice(index, item)"

                                >
                            </div>
                            <div class="products__td products__td-flex1">
                                <input type="text" class="form__input form__input_large"
                                       :class="{ disabled : item.volume_2 === false }"
                                       v-model="item.volume_2"
                                       v-on:keyup="calcPrice(index, item)"

                                >
                            </div>
                            <div class="products__td products__td-flex1">
                                <input type="text" class="form__input form__input_large"
                                       :class="{ disabled : item.volume_3 === false }"
                                       v-model="item.volume_3"
                                       v-on:keyup="calcPrice(index, item)"
                                >
                            </div>

                            <div class="products__td products__td-flex1">
                                <drop-down
                                        v-bind:list="products.brand[item.brand].grammage[item.grammage].format[item.grammage].deliveries ? products.brand[item.brand].grammage[item.grammage].format[item.grammage].deliveries: false"
                                        :placeholder="'Способ доставки'"
                                        @change="item.delivery = $event; calcPrice(index)"
                                ></drop-down>
                            </div>
                            <div class="products__td products__td-flex1">
                                <div class="info-title products__info-title">Цена</div>
                                <input type="text" class="form__input form__input form__input_bold">{{ productList[index].price }}
                            </div>
                            <div class="products__td">
                                <i class="icon icon-trash "
                                   v-on:click.prevent="delProduct(index)"></i>
                            </div>
                        </div>
                    </div>
                    <div class="products-add">
                        <a class="add-btn" href=""
                           v-on:click.prevent="addProduct()">Добавить товар</a>
                    </div>

                    <div class="anew-toolbar">
                        <a href="" class="btn btn_inversed"
                           v-on:click.prevent="prevStep()">Отменить</a>
                        <a href="" class="btn"
                           v-on:click.prevent="nextStep(2)">Сохранить</a>
                    </div>
                </div>
            </transition>

                <div class="sh-toolbar">
                    <a href="" class="btn btn_inversed" v-on:click.prevent="prevStep()">Редактировать</a>
                    <a href="" class="btn" v-on:click.prevent="sendForm">Отправить</a>
                </div>
        </form>
    </div>
</template>
<script>
    import VueMultiselect from "../../../../node_modules/vue-multiselect/src/Multiselect.vue";

    export default {
        components: {VueMultiselect},
        props: [
            'applicator',
            'provider_id',
            'consigneer_id'
        ],
        data () {
            return {
                title: 'Новая заявка',
                step: '0',
                /*infoOnApplication: {
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
                },/*
                /*
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
                }, */
                products: {
                    name: 'Товар',
                    selected: -1,
                    brand: [
                        {
                            placeholder: 'Марка',
                            name: 'M (SFT Medium)',
                            selected: -1,
                            grammage: [
                                {
                                    placeholder: 'Граммаж',
                                    name: '100',
                                    selected: -1,
                                    format: [
                                        {
                                            placeholder:'Формат',
                                            name: '2100',
                                            id: 62,
                                            min_lot: 30,
                                            deliveries: [
                                                {
                                                    name: "ЖД",
                                                    price: 33924
                                                }
                                            ]
                                        },
                                        {
                                            placeholder:'Формат',
                                            name: '2200',
                                            id: 68,
                                            min_lot: 30,
                                            deliveries: [
                                                {
                                                    name: "ЖД",
                                                    price: 33924
                                                }
                                            ]
                                        }
                                    ]
                                },
                                {
                                    placeholder: 'Граммаж',
                                    name: '110',
                                    selected: -1,
                                    format: [
                                        {
                                            placeholder:'Формат',
                                            name: '2100',
                                            id: 63,
                                            min_lot: 20,
                                            deliveries: [
                                                {
                                                    name: "ЖД",
                                                    price: 33924
                                                },
                                                {
                                                    name: "АВИА",
                                                    price: 38924
                                                }
                                            ]
                                        }
                                    ]
                                },
                                {
                                    placeholder: 'Граммаж',
                                    name: '120',
                                    selected: -1,
                                    format: [
                                        {
                                            placeholder:'Формат',
                                            name: '2100',
                                            id: 64,
                                            min_lot: 50,
                                            deliveries: [
                                                {
                                                    name: "ЖД",
                                                    price: 33924
                                                },
                                                {
                                                    name: "АВИА",
                                                    price: 38924
                                                }
                                            ]
                                        }
                                    ]
                                }
                            ]
                        },
                        {
                            placeholder: 'Марка',
                            name: 'L (SFT Medium)',
                            selected: -1,
                            grammage: [
                                {
                                    placeholder: 'Граммаж',
                                    name: '100',
                                    selected: -1,
                                    format: [
                                        {
                                            placeholder:'Формат',
                                            name: '2100',
                                            id: 62,
                                            min_lot: 30,
                                            deliveries: [
                                                {
                                                    name: "ЖД",
                                                    price: 33924
                                                }
                                            ]
                                        }
                                    ]
                                },
                                {
                                    placeholder: 'Граммаж',
                                    name: '110',
                                    selected: -1,
                                    format: [
                                        {
                                            placeholder:'Формат',
                                            name: '2100',
                                            id: 63,
                                            min_lot: 20,
                                            deliveries: [
                                                {
                                                    name: "ЖД",
                                                    price: 33924
                                                },
                                                {
                                                    name: "АВИА",
                                                    price: 38924
                                                }
                                            ]
                                        }
                                    ]
                                },
                                {
                                    placeholder: 'Граммаж',
                                    name: '120',
                                    selected: -1,
                                    format: [
                                        {
                                            placeholder:'Формат',
                                            name: '2100',
                                            id: 64,
                                            min_lot: 50,
                                            deliveries: [
                                                {
                                                    name: "ЖД",
                                                    price: 33924
                                                },
                                                {
                                                    name: "АВИА",
                                                    price: 38924
                                                }
                                            ]
                                        }
                                    ]
                                }
                            ]
                        },

                    ]
                },
                productList: [
                    { id: 0, brand: 0, grammage: 0, format: 0, min_lot: 0, volume_1: '', volume_2: '', volume_3: '', delivery: '', price: 0 }
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
                    volume = volume + this.itemVolume(i);
                }
                return volume;
            }
        },
        watch: {},
        methods: {
            nextStep: function (i) {
                if(i === 1) {
                    this.step = i;
                }

            },
            prevStep: function (n) {
                n = n || 1;
                this.step = this.step - n;
            },
            changeProduct: function (indexProductList, indexProduct) {
                this.productList[indexProductList].brand = indexProduct;
                this.productList[indexProductList].grammage = 0;
                this.productList[indexProductList].format = 0;
                this.productList[indexProductList].id = '';
                this.productList[indexProductList].min_lot = 0;
                this.productList[indexProductList].delivery = '';
                this.productList[indexProductList].price = 0;
            },
            changeGrammage: function (indexProductList, indexProduct) {
                this.productList[indexProductList].grammage = indexProduct;
                this.productList[indexProductList].format = 0;
                this.productList[indexProductList].id = '';
                this.productList[indexProductList].min_lot = 0;
                this.productList[indexProductList].delivery = '';
                this.productList[indexProductList].price = 0;
            },
            changeFormat: function (indexProductList, indexProduct) {
                this.productList[indexProductList].format = indexProduct;
                var item = this.productList[indexProductList];
                var product = this.products.brand[item.brand].grammage[item.grammage].format[item.format];
                this.productList[indexProductList].id = product.id;
                this.productList[indexProductList].min_lot = product.min_lot;
            },
            setProductSettings: function (indexProductList, item) {
                var product = this.products.brand[item.brand].grammage[item.grammage].format[item.format];
                conole.log(item);
                this.productList[indexProductList].id = product.id;
                this.productList[indexProductList].min_lot = product.min_lot;
            },
            itemVolume(indexProductList) {
                var itemVolume = 0;
                itemVolume = Number(this.productList[indexProductList].volume_1) + Number(this.productList[indexProductList].volume_2) + Number(this.productList[indexProductList].volume_3);
                return itemVolume;
            },
            calcPrice: function (indexProductList) {
                var price = 0;
                if (this.itemVolume(indexProductList) > 0) {
                    price = this.products.brand[this.productList[indexProductList].brand].grammage[this.productList[indexProductList].grammage].format[this.productList[indexProductList].format].deliveries[this.productList[indexProductList].delivery].price;
                    this.productList[indexProductList].price = this.itemVolume(indexProductList) * price;
                } else this.productList[indexProductList].price = price;
            },
            addProduct: function (e) {
                console.log(e);
                this.productList.push({id: 0, brand: 0, grammage: 0, format: 0, min_lot: 0, volume_1: '', volume_2: '', volume_3: '', delivery: '', price: 0 });
            },
            delProduct: function (index) {
                this.productList.splice(index, 1);
            },
            scrollStep: function (el) {
                scrollBy({top: document.querySelector('#step' + this.step).offsetTop, behavior: 'smooth'});
            },

            sendForm: function () {
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
                console.log(json);

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

