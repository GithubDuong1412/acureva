(function ($) {

    function fixContactFormLayout() {
        const contactCols = document.querySelectorAll(
            '.dk-contact-form .contact-form-row .contact-column-6'
        );

        if (contactCols.length > 0) {
            const lastContactCol = contactCols[contactCols.length - 1];
            if (contactCols.length % 2 !== 0) {
                lastContactCol.classList.remove('contact-column-6', 'col-md-6');
                lastContactCol.classList.add('contact-column-12', 'col-md-12');
            }
        }
    }

    function initAllProductsStyle1Slider() {
        $('.all-products.style-1 .js-all-products-slider').each(function () {
            const $wrapper = $(this);

            if (window.innerWidth < 768) {
                if (! $wrapper.hasClass('slick-initialized')) {
                    $wrapper.slick({
                        slidesToShow: 2,
                        arrows: false,
                        dots: true,
                        infinite: false,
                    });
                }
            } else {
                if ($wrapper.hasClass('slick-initialized')) {
                    $wrapper.slick('unslick');
                }
            }
        });
    }

    $(document).ready(function () {
        fixContactFormLayout();
        initAllProductsStyle1Slider();
    });

    $(window).on('resize', initAllProductsStyle1Slider);

})(jQuery);
