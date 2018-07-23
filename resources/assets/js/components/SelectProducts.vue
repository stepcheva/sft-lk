<template>
    <div class="step1">
        <form action="" class="form">
            <transition v-on:after-enter="scrollStep"
                        v-on:before-leave="scrollStep">
                <div id="step1" class="step">
                    <div class="a-title a-title_mb">
                        <div class="a-title__h3">Выбор продукции</div>
                    </div>
                    <div class="products product-list">
                        <div class="products__row">
                            <div class="products__td products__td-number"></div>
                            <div class="products__td products__td-flex1">
                                <div class="info-title products__info-title">Марка</div>
                            </div>
                            <div class="products__td products__td-flex1">
                                <div class="info-title products__info-title">Граммаж</div>
                            </div>
                            <div class="products__td products__td-flex1">
                                <div class="info-title products__info-title">Формат</div>
                            </div>
                            <div class="products__td products__td-flex1">
                                <div class="info-title products__info-title">Объём 1 декада</div>
                            </div>
                            <div class="products__td products__td-flex1">
                                <div class="info-title products__info-title">Объём 2 декада</div>
                            </div>
                            <div class="products__td products__td-flex1">
                                <div class="info-title products__info-title">Объём 3 декада</div>
                            </div>
                            <div class="products__td products__td-flex1">
                                <div class="info-title products__info-title">Способ доставки</div>
                            </div>
                            <div class="products__td products__td-flex1">
                                <div class="info-title products__info-title">Цена</div>
                            </div>
                        </div>
                        <div class="products__row product"
                             v-for="(item, index) in productList">
                            <div class="products__td products__td-number">
                                <span class="products__number">{{index + 1}}.{{item.index}}</span>
                            </div>
                            <div class="products__td products__td-flex1">
                                <drop-down
                                        v-bind:list="products.brand"
                                        :placeholder="'Товар'"
                                        v-bind:default-selected="item.brand"
                                        :disabled="false"
                                        @change="changeProduct(index, $event)"
                                ></drop-down>
                            </div>
                            <div class="products__td products__td-flex1">
                                <drop-down
                                        v-bind:list="products.brand[item.brand] ? products.brand[item.brand].grammage : false"
                                        :placeholder="'Граммаж'"
                                        v-bind:default-selected="item.grammage"
                                        @change="changeGrammage(index, $event)"
                                ></drop-down>
                            </div>
                            <div class="products__td products__td-flex1">
                                <drop-down
                                        v-bind:list="products.brand[item.brand].grammage[item.grammage].format ? products.brand[item.brand].grammage[item.grammage].format: false"
                                        :placeholder="'Формат'"
                                        v-bind:default-selected="item.format"
                                        @change="changeFormat(index, $event); setProductSettings(index, item)"
                                ></drop-down>
                            </div>
                            <div class="products__td products__td-flex1">
                                <input type="text" class="form__input "
                                       :class="{ disabled : item.volume_1 === false }"
                                       v-model="item.volume_1"
                                       v-on:keyup="calcPrice(index, item)"
                                >
                            </div>
                            <div class="products__td products__td-flex1">
                                <input type="text" class="form__input form__input"
                                       :class="{ disabled : item.volume_2 === false }"
                                       v-model="item.volume_2"
                                       v-on:keyup="calcPrice(index, item)"
                                >
                            </div>
                            <div class="products__td products__td-flex1">
                                <input type="text" class="form__input form__input"
                                       :class="{ disabled : item.volume_3 === false }"
                                       v-model="item.volume_3"
                                       v-on:keyup="calcPrice(index, item)"
                                >
                            </div>
                            <div class="products__td products__td-flex1">
                                <drop-down
                                        v-bind:list="products.brand[item.brand].grammage[item.grammage].format[item.format].deliveries ? products.brand[item.brand].grammage[item.grammage].format[item.format].deliveries: false"
                                        :placeholder="'Способ доставки'"
                                        @change="item.delivery = $event; calcPrice(index)"
                                ></drop-down>
                            </div>
                            <div class="products__td products__td-flex1">
                                <div type="text" class="form__input form__input form__input_bold">
                                    {{ productList[index].price }}
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

            <div id="step2" class="step" v-if="step === 2">
                <div class="a-information">
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
                                    <td class="table__td">{{products[item.brand].name}}</td>
                                    <td class="table__td">{{item.volume_1 === 0 ? item.volume_1 : '-'}}</td>
                                    <td class="table__td">{{item.volume_2 === 1 ? item.volume_2 : '-'}}</td>
                                    <td class="table__td">{{item.volume_3 === 2 ? item.volume_3 : '-'}}</td>
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
                </div>
            </div>

            <div class="sh-toolbar">
                <a href="" class="btn btn_inversed" v-on:click.prevent="prevStep()">Редактировать</a>
                <a href="" class="btn" v-on:click.prevent="sendForm">Отправить</a>
            </div>
        </form>
    </div>
</template>
<script>
    export default {
        props: [
            'application',
            'applicator'
        ],
        data: function () {
            return {
                title: 'Новая заявка',
                step: '1',
                products: [],
                productList: [
                    {
                        id: 0,
                        brand: 0,
                        grammage: 0,
                        format: 0,
                        min_lot: 0,
                        volume_1: '',
                        volume_2: '',
                        volume_3: '',
                        delivery: '',
                        price: 0
                    }
                ]
            }
        },
        mounted() {
            this.getProducts();
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

            getProducts() {
                let route = 'http://localhost/sft-lk/public/user/' + this.applicator + '/get/products/';
                axios.get(route).then((response) => {
                    this.products = response.data.products
                    if (this.products.length > 0) {
                        this.showProducts = true
                        console.log(response.data.products)
                    }
                })
                    .catch(error => {
                        this.showProducts = false
                        console.log(error)
                    });

            },

            nextStep: function (i) {
                if (i === 1) {
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
                this.productList.push({
                    id: 0,
                    brand: 0,
                    grammage: 0,
                    format: 0,
                    min_lot: 0,
                    volume_1: '',
                    volume_2: '',
                    volume_3: '',
                    delivery: '',
                    price: 0
                });
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



