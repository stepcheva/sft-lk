/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 47);
/******/ })
/************************************************************************/
/******/ ({

/***/ 47:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(48);


/***/ }),

/***/ 48:
/***/ (function(module, exports) {

var isMobile;
if ($(window).width() <= 640) {
    isMobile = true;
} else {
    isMobile = false;
}
var moduleApp = {
    'init': function init() {
        this.appStatus();
        this.initCalendar();
        this.modal();
        this.tabs();
        this.accordeon();
        this.selectize();
        this.attachmentBtn();
        this.stepChanger();
        this.productMechanics();
        this.contentToggler();
        this.commentToggler();
        if (isMobile) {
            this.mobileMenu();
            this.mobileSubmenu();
            this.mobileCalendar();
        }
    },
    'appStatus': function appStatus() {
        if ($('.js-progress').length) {
            var progress = $('.js-progress');
            progress.each(function () {
                var $el = $(this),
                    percent = $el.data('status');
                $el.css('width', percent + '%');
            });
        }
    },
    'initCalendar': function initCalendar() {
        var cControlPrev = $('.js-calendar-control-prev'),
            cControlNext = $('.js-calendar-control-next'),
            calendar = $('.js-calendar'),
            cShow = $('.js-calendar-show'),
            cHide = $('.js-calendar-hide');
        var cControls = new Swiper('.js-calendar-controls', {
            roundLengths: true,
            navigation: {
                nextEl: cControlNext,
                prevEl: cControlPrev
            },
            on: {
                slideChangeTransitionStart: function slideChangeTransitionStart() {
                    cBody.slideTo(cControls.realIndex);
                }
            }
        });
        var cBody = new Swiper('.js-calendar-body', {
            roundLengths: true,
            allowTouchMove: false,
            simulateTouch: false
        });
        cShow.on('click', function () {
            var $el = $(this),
                app = $('.js-app-item'),
                parent = $el.closest(app),
                topPos = parent.offset().top;
            console.log($el.data('id'));

            calendar.addClass('shown');
            if (isMobile) {
                calendar.css('top', topPos);
                $('html, body').animate({ scrollTop: calendar.offset().top }, 800);
            } else {
                if ($(window).offset().top > 100) {
                    calendar.css('top', '0');
                }
                if ($(window).offset().top < 100) {
                    calendar.css('top', '100px');
                }
            }
        });
        cHide.on('click', function () {
            calendar.removeClass('shown');
        });
        if (!isMobile) {
            $(window).scroll(function (e) {
                if ($(this).scrollTop() > 100) {
                    calendar.css('top', '0');
                }
                if ($(this).scrollTop() < 100) {
                    calendar.css('top', '100px');
                }
            });
        }
    },
    'modal': function modal() {
        var modalClose = $('.js-close-modal');
        if ($('.js-modal').length) {
            $('.js-modal').fancybox({
                animationEffect: 'fade',
                baseClass: 'application-modal',
                toolbar: false,
                smallBtn: false,
                touch: false,
                closeClickOutside: false,
                helpers: {
                    overlay: {
                        closeClick: false
                    }
                }
            });
            modalClose.on('click', function (e) {
                e.preventDefault();
                $.fancybox.close();
            });
        }
    },
    tabs: function tabs() {
        $('.js-tab-link ').on('click', function (e) {
            e.preventDefault();
            var item = $(this).closest('.tabs_controls_item'),
                contentItem = $('.tabs_item'),
                itemNomber = item.index();
            contentItem.eq(itemNomber).add(item).addClass('active').siblings().removeClass('active');
        });
    },
    'accordeon': function accordeon() {
        $('.js-accordeon_trigger').on('click', function (e) {
            e.preventDefault();
            var $this = $(this),
                item = $this.closest('.accordeon__item'),
                list = $this.closest('.accordeon__list'),
                items = list.find('.accordeon__item'),
                content = item.find('.accordeon__inner'),
                otherContent = list.find('.accordeon__inner'),
                duration = 300;
            if (!item.hasClass('active')) {
                items.removeClass('active');
                item.addClass('active');
                otherContent.stop(true, true).slideUp(duration);
                content.stop(true, true).slideDown(duration);
            } else {
                content.stop(true, true).slideUp(duration);
                item.removeClass('active');
            }
        });
    },
    selectize: function selectize() {
        $('.js-default-select').selectize({});
    },
    attachmentBtn: function attachmentBtn() {
        var attachmentBtn = $('.js-attach-file');
        attachmentBtn.on('change', function () {
            var $el = $(this),
                attachmentTxt = $el.closest('.js-attach-parent').find('.js-filename'),
                attachmentVal = $el[0].files[0].name;
            attachmentTxt.text(attachmentVal);
        });
    },
    stepChanger: function stepChanger() {
        var step = $('.js-step'),
            nextBtn = $('.js-next-btn');
        nextBtn.on('click', function (e) {
            var $el = $(this);
            e.preventDefault();
            $el.closest(step).find(nextBtn).hide();
            $el.closest(step).next(step).addClass('active').removeClass('disabled');
            if (step.hasClass('disabled')) {
                $('.js-step.disabled').slideUp(500);
            } else {
                $('.js-step.active').slideDown(500);
            }
        });
    },
    productMechanics: function productMechanics() {
        var removeBtn = $('.js-remove-product'),
            product = $('.js-product'),
            productList = $('.js-product-list');
        removeBtn.on('click', function (e) {
            e.preventDefault();
            var $el = $(this);
            $el.closest(product).remove();
            if (productList.find(product).length === 0) {
                productList.after('<div class="products-notify cntr">Список продуктов пуст</div>');
            }
        });
    },
    contentToggler: function contentToggler() {
        var toggler = $('.js-toggler'),
            togglerBtn = $('.js-toggler-btn'),
            togglerTxt = $('.js-toggler-text');
        togglerInner = $('.js-toggler-inner');
        togglerBtn.on('click', function () {
            var $el = $(this),
                parent = $el.closest(toggler),
                text = $el.closest(toggler).find(togglerTxt),
                inner = text.find(togglerInner),
                innerH = inner.height();
            parent.toggleClass('activated');
            if (parent.hasClass('activated')) {
                text.css('height', innerH);
            } else {
                text.css('height', '');
            }
        });
    },
    mobileMenu: function mobileMenu() {
        var btn = $('.js-mobile-btn'),
            menu = $('.js-mobile-menu');
        btn.on('click', function () {
            btn.toggleClass('active');
            if (btn.hasClass('active')) {
                menu.addClass('toggled');
            } else {
                menu.removeClass('toggled');
            }
        });
    },
    mobileSubmenu: function mobileSubmenu() {
        var link = $('.js-nav-toggle'),
            menu = $('.js-nav');
        link.on('click', function (e) {
            e.preventDefault();
            var $el = $(this);
            $el.toggleClass('active');
            if ($el.hasClass('active')) {
                $el.next(menu).addClass('shown');
            } else {
                $el.next(menu).removeClass('shown');
            }
        });
    },
    mobileCalendar: function mobileCalendar() {
        var cTile = $('.js-calendar-item'),
            cBtn = $('.js-shipments-toggle'),
            cInner = $('.js-shipments-inner');
        cBtn.on('click', function () {
            var $el = $(this),
                parent = $el.closest(cTile),
                innerBlock = $el.closest(cInner),
                pWidth = parent.outerWidth();
            parent.toggleClass('active');
            if (parent.hasClass('active')) {
                innerBlock.css('width', pWidth * 2);
                parent.siblings(cTile).removeClass('active');
                parent.siblings(cTile).find(cInner).css('width', 0);
            } else {
                innerBlock.css('width', 0);
            }
        });
    },
    commentToggler: function commentToggler() {
        var btn = $('.js-add-comment'),
            comment = $('.js-comment');
        btn.on('click', function (e) {
            e.preventDefault();
            comment.toggleClass('shown');
            if (comment.hasClass('shown')) {
                comment.slideDown(500);
            } else {
                comment.slideUp(500);
            }
        });
    }
};
$(document).ready(function () {
    moduleApp.init();
});

/***/ })

/******/ });