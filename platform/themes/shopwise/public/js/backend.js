/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./platform/plugins/language/resources/js/language-public.js":
/*!*******************************************************************!*\
  !*** ./platform/plugins/language/resources/js/language-public.js ***!
  \*******************************************************************/
/***/ (() => {

"use strict";


$(function () {
  $('.language-wrapper .dropdown .dropdown-toggle').off('click').on('click', function (event) {
    event.preventDefault();
    var _self = $(event.currentTarget);
    if (_self.hasClass('active')) {
      _self.closest('.language-wrapper').find('.dropdown .dropdown-menu').hide();
      _self.removeClass('active');
    } else {
      _self.closest('.language-wrapper').find('.dropdown .dropdown-menu').show();
      _self.addClass('active');
    }
  });
  $(document).on('click', function (event) {
    var _self = $(event.currentTarget);
    if (_self.closest('.language-wrapper').length === 0) {
      _self.closest('.language-wrapper').find('.dropdown .dropdown-menu').hide();
      _self.closest('.language-wrapper').find('.dropdown .dropdown-toggle').removeClass('active');
    }
  });
});

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
// This entry needs to be wrapped in an IIFE because it needs to be isolated against other modules in the chunk.
(() => {
/*!*******************************************************!*\
  !*** ./platform/themes/shopwise/assets/js/backend.js ***!
  \*******************************************************/
(function ($) {
  'use strict';

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  window.botbleCookieNewsletter = function () {
    var COOKIE_VALUE = 1;
    var COOKIE_NAME = 'botble_cookie_newsletter';
    var COOKIE_DOMAIN = $('div[data-session-domain]').data('session-domain');
    var COOKIE_MODAL = $('#newsletter-modal');
    var COOKIE_MODAL_TIME = COOKIE_MODAL.data('time');
    function newsletterWithCookies(expirationInDays) {
      setCookie(COOKIE_NAME, COOKIE_VALUE, expirationInDays);
    }
    function cookieExists(name) {
      return document.cookie.split('; ').indexOf(name + '=' + COOKIE_VALUE) !== -1;
    }
    function hideCookieDialog() {
      var modalEl = COOKIE_MODAL[0];
      if (modalEl) {
        var modal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
        modal.hide();
      }
    }
    function setCookie(name, value, expirationInDays) {
      var date = new Date();
      date.setTime(date.getTime() + expirationInDays * 24 * 60 * 60 * 1000);
      document.cookie = name + '=' + value + ';expires=' + date.toUTCString() + ';domain=' + COOKIE_DOMAIN + ';path=/';
    }
    if (!cookieExists(COOKIE_NAME)) {
      setTimeout(function () {
        var modalEl = COOKIE_MODAL[0];
        if (modalEl) {
          var modal = new bootstrap.Modal(modalEl);
          modal.show();
        }
      }, COOKIE_MODAL_TIME);
    }
    COOKIE_MODAL.on('hide.bs.modal', function () {
      if (!cookieExists(COOKIE_NAME) && $('#dont_show_again').is(':checked')) {
        newsletterWithCookies(3);
      } else {
        newsletterWithCookies(1 / 24);
      }
    });
    return {
      newsletterWithCookies: newsletterWithCookies,
      hideCookieDialog: hideCookieDialog
    };
  }();
  var showError = function showError(message) {
    window.showAlert('alert-danger', message);
  };
  var showSuccess = function showSuccess(message) {
    window.showAlert('alert-success', message);
  };
  var handleError = function handleError(data) {
    if (typeof data.errors !== 'undefined' && data.errors.length) {
      handleValidationError(data.errors);
    } else if (typeof data.responseJSON !== 'undefined') {
      if (typeof data.responseJSON.errors !== 'undefined') {
        if (data.status === 422) {
          handleValidationError(data.responseJSON.errors);
        }
      } else if (typeof data.responseJSON.message !== 'undefined') {
        showError(data.responseJSON.message);
      } else {
        $.each(data.responseJSON, function (index, el) {
          $.each(el, function (key, item) {
            showError(item);
          });
        });
      }
    } else {
      showError(data.statusText);
    }
  };
  var handleValidationError = function handleValidationError(errors) {
    var message = '';
    $.each(errors, function (index, item) {
      if (message !== '') {
        message += '<br />';
      }
      message += item;
    });
    showError(message);
  };
  window.showAlert = function (messageType, message) {
    if (messageType && message !== '') {
      if (messageType === 'alert-success') {
        Theme.showSuccess(message);
      } else {
        Theme.showError(message);
      }
    }
  };
  $(document).ready(function () {
    if (jQuery().mCustomScrollbar) {
      $('.ps-custom-scrollbar').mCustomScrollbar({
        theme: 'dark',
        scrollInertia: 0
      });
    }
    $(document).on('click', '.newsletter-form button[type=submit]', function (event) {
      event.preventDefault();
      event.stopPropagation();
      var _self = $(this);
      _self.addClass('button-loading');
      $('.newsletter-success-message').html('').hide();
      $('.newsletter-error-message').html('').hide();
      $.ajax({
        type: 'POST',
        cache: false,
        url: _self.closest('form').prop('action'),
        data: new FormData(_self.closest('form')[0]),
        contentType: false,
        processData: false,
        success: function success(res) {
          _self.removeClass('button-loading');
          if (typeof refreshRecaptcha !== 'undefined') {
            refreshRecaptcha();
          }
          if (!res.error) {
            window.botbleCookieNewsletter.newsletterWithCookies(30);
            _self.closest('form').find('input[type=email]').val('');
            showSuccess(res.message);
            setTimeout(function () {
              _self.closest('.modal-body').find('button[data-bs-dismiss="modal"]').trigger('click');
            }, 2000);
          } else {
            showError(res.message);
          }
        },
        error: function error(res) {
          if (typeof refreshRecaptcha !== 'undefined') {
            refreshRecaptcha();
          }
          _self.removeClass('button-loading');
          Theme.handleError(res);
        }
      });
    });
  });
  $(document).ready(function () {
    $(document).on('change', '.switch-currency', function () {
      $(this).closest('form').submit();
    });
    $(document).on('click', '.js-add-to-wishlist-button', function (event) {
      event.preventDefault();
      var _self = $(this);
      _self.addClass('button-loading');
      $.ajax({
        url: _self.data('url'),
        method: 'POST',
        success: function success(res) {
          if (res.error) {
            _self.removeClass('button-loading');
            showError(res.message);
            return false;
          }
          showSuccess(res.message);
          $('.btn-wishlist span').text(res.data.count);
          _self.removeClass('button-loading').removeClass('js-add-to-wishlist-button').addClass('js-remove-from-wishlist-button active');
        },
        error: function error() {
          _self.removeClass('button-loading');
        }
      });
    });
    $(document).on('click', '.js-remove-from-wishlist-button', function (event) {
      event.preventDefault();
      var _self = $(this);
      _self.addClass('button-loading');
      $.ajax({
        url: _self.data('url'),
        method: 'DELETE',
        success: function success(res) {
          if (res.error) {
            _self.removeClass('button-loading');
            showError(res.message);
            return false;
          }
          showSuccess(res.message);
          $('.btn-wishlist span').text(res.data.count);
          _self.closest('tr').remove();
          _self.removeClass('button-loading').removeClass('js-remove-from-wishlist-button active').addClass('js-add-to-wishlist-button');
        },
        error: function error() {
          _self.removeClass('button-loading');
        }
      });
    });
    $(document).on('click', '.add-to-cart-button', function (event) {
      event.preventDefault();
      var _self = $(this);
      _self.prop('disabled', true).addClass('button-loading');
      $.ajax({
        url: _self.data('url'),
        method: 'POST',
        data: {
          id: _self.data('id')
        },
        dataType: 'json',
        success: function success(res) {
          _self.prop('disabled', false).removeClass('button-loading').addClass('active');
          if (res.error) {
            showError(res.message);
            if (res.data.next_url !== undefined) {
              setTimeout(function () {
                window.location.href = res.data.next_url;
              }, 500);
            }
            return false;
          }
          showSuccess(res.message);
          if (res.data.next_url !== undefined) {
            window.location.href = res.data.next_url;
          } else {
            $.ajax({
              url: window.siteUrl + '/ajax/cart',
              method: 'GET',
              success: function success(response) {
                if (!response.error) {
                  $('.cart_box').html(response.data.html);
                  $('.btn-shopping-cart span').text(response.data.count);
                }
              }
            });
          }
        },
        error: function error() {
          _self.prop('disabled', false).removeClass('button-loading');
        }
      });
    });
    $(document).on('click', '.remove-cart-button', function (event) {
      event.preventDefault();
      $('.confirm-remove-item-cart').data('url', $(this).prop('href'));
      var removeModal = document.getElementById('remove-item-modal');
      if (removeModal) {
        var modal = new bootstrap.Modal(removeModal);
        modal.show();
      }
    });
    $(document).on('click', '.confirm-remove-item-cart', function (event) {
      event.preventDefault();
      var _self = $(this);
      _self.prop('disabled', true).addClass('button-loading');
      $.ajax({
        url: _self.data('url'),
        method: 'GET',
        success: function success(res) {
          _self.prop('disabled', false).removeClass('button-loading');
          if (res.error) {
            return false;
          }
          var modalEl = _self.closest('.modal')[0];
          if (modalEl) {
            var modal = bootstrap.Modal.getInstance(modalEl);
            if (modal) modal.hide();
          }
          if ($('.form--shopping-cart').length) {
            $('.form--shopping-cart').load(window.location.href + ' .form--shopping-cart > *');
          }
          $.ajax({
            url: window.siteUrl + '/ajax/cart',
            method: 'GET',
            success: function success(response) {
              if (!response.error) {
                $('.cart_box').html(response.data.html);
                $('.btn-shopping-cart span').text(response.data.count);
              }
            }
          });
        },
        error: function error() {
          _self.prop('disabled', false).removeClass('button-loading');
        }
      });
    });
    window.onBeforeChangeSwatches = function (data) {
      $('.add-to-cart-form .error-message').hide();
      $('.add-to-cart-form .success-message').hide();
      $('.number-items-available').html('').hide();
      if (data && data.attributes) {
        $('.add-to-cart-form button[type=submit]').prop('disabled', true).addClass('btn-disabled');
      }
    };
    window.onChangeSwatchesSuccess = function (res) {
      $('.add-to-cart-form .error-message').hide();
      $('.add-to-cart-form .success-message').hide();
      if (res) {
        var data = res.data || {};
        console.log(res);
        console.log(data);
        var buttonSubmit = $('.add-to-cart-form button[type=submit]');
        if (res.error) {
          buttonSubmit.prop('disabled', true).addClass('btn-disabled');
          $('.number-items-available').html('<span class="text-danger">' + res.message + '</span>').show();
          $('#hidden-product-id').val('');
        } else {
          var _data$image_with_size;
          $('.add-to-cart-form').find('.error-message').hide();
          $('.product_price .product-sale-price-text').text(data.display_sale_price);
          if (data.sale_price !== data.price) {
            $('.product_price .product-price-text').text(data.display_price).show();
            $('.product_price .on_sale .on_sale_percentage_text').text(data.sale_percentage).show();
            $('.product_price .show').hide();
          } else {
            $('.product_price .product-price-text').text(data.sale_percentage).hide();
            $('.product_price .on_sale .on_sale_percentage_text').text(data.sale_percentage).hide();
            $('.product_price .on_sale').hide();
          }
          if (data.sku) {
            $('.product_description #product-sku span').text(data.sku);
            $('.product_description #product-sku').show();
          } else {
            $('.product_description #product-sku').hide();
          }
          $('#hidden-product-id').val(data.id);
          buttonSubmit.prop('disabled', false).removeClass('btn-disabled');
          if (data.error_message) {
            buttonSubmit.prop('disabled', true).addClass('btn-disabled');
            $('.number-items-available').html('<span class="text-danger">' + data.error_message + '</span>').show();
          } else if (data.success_message) {
            $('.number-items-available').html('<span class="text-success">' + data.success_message + '</span>').show();
          } else {
            $('.number-items-available').html('').hide();
          }
          var $product = $('.bb-product-detail');
          $product.find('.bb-product-attribute-swatch-item').removeClass('disabled');
          $product.find('.bb-product-attribute-swatch-list select option').prop('disabled', false);
          var unavailableAttributeIds = data.unavailable_attribute_ids || [];
          if (unavailableAttributeIds.length) {
            unavailableAttributeIds.map(function (id) {
              var $swatchItem = $product.find(".bb-product-attribute-swatch-item[data-id=\"".concat(id, "\"]"));
              if ($swatchItem.length) {
                $swatchItem.addClass('disabled');
                $swatchItem.find('input').prop('checked', false);
              } else {
                $swatchItem = $product.find(".bb-product-attribute-swatch-list select option[data-id=\"".concat(id, "\"]"));
                if ($swatchItem.length) {
                  $swatchItem.prop('disabled', true);
                }
              }
            });
          }
          var slider = $('#pr_item_gallery');
          var selectedImage = data === null || data === void 0 || (_data$image_with_size = data.image_with_sizes) === null || _data$image_with_size === void 0 || (_data$image_with_size = _data$image_with_size.origin) === null || _data$image_with_size === void 0 ? void 0 : _data$image_with_size[0];
          if (slider.length && selectedImage) {
            var targetSlickIndex = null;
            slider.find(".product_gallery_item[data-image=\"".concat(selectedImage, "\"]")).each(function () {
              var $slide = $(this).closest('.slick-slide');
              if ($slide.length) {
                var slickIndex = $slide.attr('data-slick-index');
                if (slickIndex !== undefined) {
                  targetSlickIndex = parseInt(slickIndex, 10);
                }
              }
            });
            if (targetSlickIndex !== null && slider.hasClass('slick-initialized')) {
              slider.slick('slickGoTo', targetSlickIndex);
            }
            slider.find('.product_gallery_item').removeClass('active');
            slider.find(".product_gallery_item[data-image=\"".concat(selectedImage, "\"]")).first().addClass('active');
            $(window).trigger('resize');
            var image = $('#product_img');
            image.prop('src', selectedImage).data('zoom-image', selectedImage);
            setTimeout(function () {
              if (image.data('elevateZoom')) {
                $.removeData(image, 'elevateZoom');
                $('.zoomContainer:last-child').remove();
              }
              var zoomActive = image.data('zoom-enable');
              if (image.length > 0) {
                image.elevateZoom({
                  cursor: 'crosshair',
                  easing: true,
                  gallery: 'pr_item_gallery',
                  zoomType: 'inner',
                  galleryActiveClass: 'active'
                });
                if (!zoomActive) {
                  image.data('elevateZoom').changeState('disable');
                }
              }
            }, 50);
          }
        }
      }
    };
    $(document).on('click', '.add-to-cart-form button[type=submit]', function (event) {
      event.preventDefault();
      event.stopPropagation();
      var _self = $(this);
      if (!$('#hidden-product-id').val()) {
        _self.prop('disabled', true).addClass('btn-disabled');
        return;
      }
      _self.prop('disabled', true).addClass('btn-disabled').addClass('button-loading');
      var $form = _self.closest('form');
      $form.find('.error-message').hide();
      $form.find('.success-message').hide();
      var data = $form.serializeArray();
      data.push({
        name: 'checkout',
        value: _self.prop('name') === 'checkout' ? 1 : 0
      });
      $.ajax({
        type: 'POST',
        url: $form.prop('action'),
        data: $.param(data),
        success: function success(res) {
          _self.prop('disabled', false).removeClass('btn-disabled').removeClass('button-loading');
          if (res.error) {
            $form.find('.error-message').html(res.message).show();
            if (res.data.next_url !== undefined) {
              window.location.href = res.data.next_url;
            }
            return false;
          }
          $form.find('.success-message').html(res.message).show();
          if (res.data.next_url !== undefined) {
            window.location.href = res.data.next_url;
          } else {
            $.ajax({
              url: window.siteUrl + '/ajax/cart',
              method: 'GET',
              success: function success(response) {
                if (!response.error) {
                  $('.cart_box').html(response.data.html);
                  $('.btn-shopping-cart span').text(response.data.count);
                }
              }
            });
          }
        },
        error: function error(res) {
          _self.prop('disabled', false).removeClass('btn-disabled').removeClass('button-loading');
          Theme.handleError(res, $form);
        }
      });
    });
    var imagesReviewBuffer = [];
    var setImagesFormReview = function setImagesFormReview(input) {
      var dT = new ClipboardEvent('').clipboardData ||
      // Firefox < 62 workaround exploiting https://bugzilla.mozilla.org/show_bug.cgi?id=1422655
      new DataTransfer(); // specs compliant (as of March 2018 only Chrome)
      for (var _i = 0, _imagesReviewBuffer = imagesReviewBuffer; _i < _imagesReviewBuffer.length; _i++) {
        var file = _imagesReviewBuffer[_i];
        dT.items.add(file);
      }
      input.files = dT.files;
      loadPreviewImage(input);
    };
    var loadPreviewImage = function loadPreviewImage(input) {
      var $uploadText = $('.image-upload__text');
      var maxFiles = $(input).data('max-files');
      var filesAmount = input.files.length;
      if (maxFiles) {
        if (filesAmount >= maxFiles) {
          $uploadText.closest('.image-upload__uploader-container').addClass('d-none');
        } else {
          $uploadText.closest('.image-upload__uploader-container').removeClass('d-none');
        }
        $uploadText.text(filesAmount + '/' + maxFiles);
      } else {
        $uploadText.text(filesAmount);
      }
      var viewerList = $('.image-viewer__list');
      var $template = $('#review-image-template').html();
      viewerList.addClass('is-loading');
      viewerList.find('.image-viewer__item').remove();
      if (filesAmount) {
        for (var i = filesAmount - 1; i >= 0; i--) {
          viewerList.prepend($template.replace('__id__', i));
        }
        var _loop = function _loop(j) {
          var reader = new FileReader();
          reader.onload = function (event) {
            viewerList.find('.image-viewer__item[data-id=' + j + ']').find('img').attr('src', event.target.result);
          };
          reader.readAsDataURL(input.files[j]);
        };
        for (var j = filesAmount - 1; j >= 0; j--) {
          _loop(j);
        }
      }
      viewerList.removeClass('is-loading');
    };
    $(document).on('change', '.form-review-product input[type=file]', function (event) {
      event.preventDefault();
      var input = this;
      var $input = $(input);
      var maxSize = $input.data('max-size');
      Object.keys(input.files).map(function (i) {
        if (maxSize && input.files[i].size / 1024 > maxSize) {
          var message = $input.data('max-size-message').replace('__attribute__', input.files[i].name).replace('__max__', maxSize);
          window.showAlert('alert-danger', message);
        } else {
          imagesReviewBuffer.push(input.files[i]);
        }
      });
      var filesAmount = imagesReviewBuffer.length;
      var maxFiles = $input.data('max-files');
      if (maxFiles && filesAmount > maxFiles) {
        imagesReviewBuffer.splice(filesAmount - maxFiles - 1, filesAmount - maxFiles);
      }
      setImagesFormReview(input);
    });
    $(document).on('click', '.form-review-product .image-viewer__icon-remove', function (event) {
      event.preventDefault();
      var $this = $(event.currentTarget);
      var id = $this.closest('.image-viewer__item').data('id');
      imagesReviewBuffer.splice(id, 1);
      var input = $('.form-review-product input[type=file]')[0];
      setImagesFormReview(input);
    });
    if (sessionStorage.reloadReviewsTab) {
      $('.nav-tabs li a[href="#reviews"]').trigger('click');
      sessionStorage.reloadReviewsTab = false;
    }
    $(document).on('click', '.form-review-product button[type=submit]', function (event) {
      var _this = this;
      event.preventDefault();
      event.stopPropagation();
      $(this).prop('disabled', true).addClass('btn-disabled').addClass('button-loading');
      var $form = $(this).closest('form');
      $.ajax({
        type: 'POST',
        cache: false,
        url: $form.prop('action'),
        data: new FormData($form[0]),
        contentType: false,
        processData: false,
        success: function success(res) {
          if (!res.error) {
            $form.find('select').val(0);
            $form.find('textarea').val('');
            showSuccess(res.message);
            setTimeout(function () {
              sessionStorage.reloadReviewsTab = true;
              window.location.reload();
            }, 1500);
          } else {
            showError(res.message);
          }
          $(_this).prop('disabled', false).removeClass('btn-disabled').removeClass('button-loading');
        },
        error: function error(res) {
          $(_this).prop('disabled', false).removeClass('btn-disabled').removeClass('button-loading');
          Theme.handleError(res, $form);
        }
      });
    });
  });
  $('.form-coupon-wrapper .coupon-code').keypress(function (event) {
    if (event.keyCode === 13) {
      $('.apply-coupon-code').trigger('click');
      event.preventDefault();
      event.stopPropagation();
      return false;
    }
  });
  $(document).on('click', '.btn-apply-coupon-code', function (event) {
    event.preventDefault();
    var _self = $(event.currentTarget);
    _self.prop('disabled', true).addClass('btn-disabled').addClass('button-loading');
    $.ajax({
      url: _self.data('url'),
      type: 'POST',
      data: {
        coupon_code: _self.closest('.form-coupon-wrapper').find('.coupon-code').val()
      },
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function success(res) {
        if (!res.error) {
          $('.form--shopping-cart').load(window.location.href + '?applied_coupon=1 .form--shopping-cart > *', function () {
            _self.prop('disabled', false).removeClass('btn-disabled').removeClass('button-loading');
          });
        } else {
          $('.coupon-error-msg .text-danger').text(res.message);
          _self.prop('disabled', false).removeClass('btn-disabled').removeClass('button-loading');
        }
      },
      error: function error(data) {
        if (typeof data.responseJSON !== 'undefined') {
          if (data.responseJSON.errors !== 'undefined') {
            $.each(data.responseJSON.errors, function (index, el) {
              $.each(el, function (key, item) {
                $('.coupon-error-msg .text-danger').text(item);
              });
            });
          } else if (typeof data.responseJSON.message !== 'undefined') {
            $('.coupon-error-msg .text-danger').text(data.responseJSON.message);
          }
        } else {
          $('.coupon-error-msg .text-danger').text(data.status.text);
        }
        _self.prop('disabled', false).removeClass('btn-disabled').removeClass('button-loading');
      }
    });
  });
  $(document).on('click', '.btn-remove-coupon-code', function (event) {
    event.preventDefault();
    var _self = $(event.currentTarget);
    _self.prop('disabled', true).addClass('btn-disabled').addClass('button-loading');
    $.ajax({
      url: _self.data('url'),
      type: 'POST',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function success(res) {
        if (!res.error) {
          $('.form--shopping-cart').load(window.location.href + ' .form--shopping-cart > *', function () {
            _self.prop('disabled', false).removeClass('btn-disabled').removeClass('button-loading');
          });
        } else {
          $('.coupon-error-msg .text-danger').text(res.message);
          _self.prop('disabled', false).removeClass('btn-disabled').removeClass('button-loading');
        }
      },
      error: function error(data) {
        if (typeof data.responseJSON !== 'undefined') {
          if (data.responseJSON.errors !== 'undefined') {
            $.each(data.responseJSON.errors, function (index, el) {
              $.each(el, function (key, item) {
                $('.coupon-error-msg .text-danger').text(item);
              });
            });
          } else if (typeof data.responseJSON.message !== 'undefined') {
            $('.coupon-error-msg .text-danger').text(data.responseJSON.message);
          }
        } else {
          $('.coupon-error-msg .text-danger').text(data.status.text);
        }
        _self.prop('disabled', false).removeClass('btn-disabled').removeClass('button-loading');
      }
    });
  });
  $(document).on('click', '.js-add-to-compare-button', function (event) {
    event.preventDefault();
    var _self = $(this);
    _self.addClass('button-loading');
    $.ajax({
      url: _self.data('url'),
      method: 'POST',
      success: function success(res) {
        if (res.error) {
          _self.removeClass('button-loading');
          showError(res.message);
          return false;
        }
        showSuccess(res.message);
        _self.removeClass('button-loading');
      },
      error: function error(res) {
        _self.removeClass('button-loading');
        showError(res.message);
      }
    });
  });
  $(document).on('click', '.js-remove-from-compare-button', function (event) {
    event.preventDefault();
    var _self = $(this);
    var buttonHtml = _self.html();
    _self.html(buttonHtml + '...');
    $.ajax({
      url: _self.data('url'),
      method: 'DELETE',
      success: function success(res) {
        if (res.error) {
          _self.text(buttonHtml);
          showError(res.message);
          return false;
        }
        $('.compare_box').load(window.location.href + ' .compare_box > *', function () {
          showSuccess(res.message);
          _self.html(buttonHtml);
        });
      },
      error: function error(res) {
        _self.removeClass('button-loading');
        showError(res.message);
      }
    });
  });
  $(document).on('click', '.quantity .plus', function (event) {
    event.preventDefault();
    event.stopPropagation();
    var currentVal = parseInt($(this).prev('.qty').val(), 10);
    $(this).prev('.qty').val(currentVal + 1);
    if ($(this).closest('.form--shopping-cart').length) {
      ajaxUpdateCart($(this));
    }
  });
  $(document).on('click', '.quantity .minus', function (event) {
    event.preventDefault();
    event.stopPropagation();
    var currentVal = parseInt($(this).next('.qty').val(), 10);
    if (currentVal > 0) {
      $(this).next('.qty').val(currentVal - 1);
    }
    if (currentVal >= 0) {
      if ($(this).closest('.form--shopping-cart').length) {
        ajaxUpdateCart($(this));
      }
    }
  });
  $(document).on('change', '.quantity .qty', function (event) {
    event.preventDefault();
    event.stopPropagation();
    var currentVal = parseInt($(this).val(), 10);
    if (currentVal > 0) {
      $(this).val(currentVal);
    }
    if (currentVal >= 0) {
      if ($(this).closest('.form--shopping-cart').length) {
        ajaxUpdateCart($(this).closest('.quantity'));
      }
    }
  });
  function ajaxUpdateCart(_self) {
    _self.closest('.shop_cart_table').addClass('content-loading');
    $.ajax({
      type: 'POST',
      cache: false,
      url: _self.closest('form').prop('action'),
      data: new FormData(_self.closest('form')[0]),
      contentType: false,
      processData: false,
      success: function success(res) {
        if (res.error) {
          _self.closest('.shop_cart_table').removeClass('content-loading');
          window.showAlert('alert-danger', res.message);
          _self.prev('.qty').val(res.data.count);
          return false;
        }
        $('.form--shopping-cart').load(window.location.href + ' .form--shopping-cart > *', function () {
          _self.closest('.shop_cart_table').removeClass('content-loading');
          window.showAlert('alert-success', res.message);
        });
        $.ajax({
          url: window.siteUrl + '/ajax/cart',
          method: 'GET',
          success: function success(response) {
            if (!response.error) {
              $('.cart_box').html(response.data.html);
              $('.btn-shopping-cart span').text(response.data.count);
            }
          }
        });
      },
      error: function error(res) {
        _self.closest('.shop_cart_table').removeClass('content-loading');
        window.showAlert('alert-danger', res.message);
      }
    });
  }
  __webpack_require__(/*! ../../../../../platform/plugins/language/resources/js/language-public */ "./platform/plugins/language/resources/js/language-public.js");
  var quickSearchProducts = function quickSearchProducts() {
    var quickSearch = '.product_search_form';
    var $quickSearch = $('.product_search_form');
    $('body').on('click', function (e) {
      if (!$(e.target).closest(quickSearch).length) {
        $('.panel--search-result').removeClass('active');
      }
    });
    var currentRequest = null;
    $quickSearch.on('keyup', '.input-search-product', function () {
      var $form = $(this).closest('form');
      ajaxSearchProduct($form);
    });
    $quickSearch.on('change', '.product-category-select', function () {
      var $form = $(this).closest('form');
      ajaxSearchProduct($form);
    });
    function ajaxSearchProduct($form) {
      var url = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : null;
      var $panel = $form.find('.panel--search-result');
      var k = $form.find('.input-search-product').val();
      if (!k) {
        $panel.html('').removeClass('active');
        return;
      }
      $quickSearch.find('.input-search-product').val(k); // update all inputs

      var $button = $form.find('button[type=submit]');
      currentRequest = $.ajax({
        type: 'GET',
        url: url || $form.data('ajax-url'),
        dataType: 'json',
        data: url ? [] : $form.serialize(),
        beforeSend: function beforeSend() {
          $button.addClass('loading');
          if (currentRequest != null) {
            currentRequest.abort();
          }
        },
        success: function success(res) {
          if (!res.error) {
            if (url) {
              var $content = $('<div>' + res.data + '</div>');
              $panel.find('.panel__content').append($content.find('.panel__content').contents());
            } else {
              $panel.html(res.data).addClass('active');
            }
          } else {
            $panel.html('').removeClass('active');
          }
        },
        error: function error() {},
        complete: function complete() {
          $button.removeClass('loading');
        }
      });
    }
  };
  quickSearchProducts();
  $(document).on('click', '.product_img', function (event) {
    var $target = $(event.currentTarget).find('.product-link');
    if ($target.length) {
      window.location.href = $target.prop('href');
    }
  });
})(jQuery);
})();

/******/ })()
;