<template>
    <div>
        <div class="selectize-control form__select-large single ">
        <label class="selectize-input items not-full has-options" :class="{ disabled: disabled }">
            <input @focus="selectFocus($event)"
            @blur="selectBlur($event)"
            v-model="searchSelect"
            :options="list"
            :placeholder="placeholder"
            autocomplete="off"
            type="text">
            </label>
        <div class="selectize-dropdown single form__select-large" style="display: none">
            <div class="selectize-dropdown-content">
                <div v-for="(item, index) in list" v-show="(listShow.indexOf(index)>-1 || listShow.length === 0)"
                     v-bind="{'data-value':item.val}"
                     @click="selectChange(index)" class="option" data-selectable>
                    {{item.name}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    //import Multiselect from 'vue-multiselect'
    export default {
      //  components: { Multiselect },
        data () {
            return {
                searchSelect : '',
                listShow : [],
                selected : this.defaultSelected || -1
            }
        },
        props : {
            list : [Array, Boolean],
            defaultSelected : [Number],
            disabled : [Boolean],
            placeholder : [String]
        },

        created : function (e) {
            this.selected = this.defaultSelected;
            if(this.selected > -1) {
                this.searchSelect = this.list[this.selected].name;
            }
            // console.log(this.defaultSelected);
        },
        mounted() {
            //this.getConsigneers();
        },
        methods : {
            selectFocus : function (e) {
                this.searchSelect = '';
                e.target.parentElement.classList.add('dropdown-active');
                e.target.parentElement.nextElementSibling.style.display = 'block';
            },
            selectBlur : function (e) {
                var linkData = this;
                setTimeout(function () {
                    if(linkData && (typeof linkData.selected) === 'number' && linkData.selected > -1) {
                        linkData.searchSelect = linkData.list[linkData.selected].name;
                    } else {
                        linkData.searchSelect = '';
                    }
                    e.target.parentElement.classList.remove('dropdown-active');
                    e.target.parentElement.nextElementSibling.style.display = 'none';
                }, 300);
            },
            selectChange : function (index) {
                var linkData = this;
                linkData.selected = index;
                linkData.searchSelect = linkData.list[index].name;
                this.$emit('change', index);
            },
            selectSearch : function (list, newQuestion) {
                var indexList = [];
                list.findIndex(function (element, index, array) {
                    if(element.name.toLowerCase().indexOf(newQuestion.toLowerCase()) > -1) {
                        indexList.push(index);
                    }
                });
                return indexList;
            }

        },
        watch : {
            'searchSelect' : function (newQuestion, oldQuestion) {
                this.listShow = this.selectSearch(this.list, newQuestion);
            },
            'list' : function (newQuestion, oldQuestion) {
                this.selected = this.defaultSelected;
            },
            'defaultSelected' : function (n, o) {
                if(this.defaultSelected < this.list.length) {
                    this.selected = this.defaultSelected;
                }
            },
            'selected' : function (newQuestion, oldQuestion) {
                this.searchSelect = this.list[this.selected].name;
            }
        }
    }
</script>



