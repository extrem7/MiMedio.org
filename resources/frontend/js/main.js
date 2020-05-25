function menu() {
    $("#search-btn, .search-box .close-btn").click(() => {
        $('.search-box').toggleClass('open-search');
        $('body').toggleClass('open-modal');
    });
    $("#mobile-btn, .menu-container .close-btn").click(() => {
        $('.mobile-btn').toggleClass('open');
        $('body').toggleClass('open-modal');
        $('.menu-container').toggleClass('open-menu');
    });
}

function header() {
    if ($(this).scrollTop() > 71) {
        $('body').addClass('stick');
        $(".header").addClass('sticky-header');
    } else {
        $('body').removeClass('stick');
        $(".header").removeClass('sticky-header');
    }

}

function upButton() {
    let btn = $('.header'),
        tempScrollTop,
        currentScrollTop = 0;
    $(window).scroll(function () {
        currentScrollTop = $(window).scrollTop();
        if (tempScrollTop < currentScrollTop || currentScrollTop < 100) {
            $(btn).removeClass('show-category');
        } else if (tempScrollTop > currentScrollTop && currentScrollTop > 100) {
            $(btn).addClass('show-category');
        }
        tempScrollTop = currentScrollTop;
    });
}

$(() => {

    $(".mob-accordion-btn").click(() => {
        $('.mob-wrapper').slideToggle();
    });

    $('[data-toggle="popover"]').popover()
    menu();
    upButton();
    });

$(window).on('load resize scroll', () => header());

$(window).on('load', () => {
    setTimeout(() => {
        $('.preloader .box').fadeOut(1000);
    }, 1000);
});

$(document).on("shown.bs.dropdown", ".d-inline-flex", function () {
    // calculate the required sizes, spaces
    let $ul = $(this).find(".dropdown-last-comment");
    let $button = $(this).find(".btn-comment");
    let ulOffset = $ul.offset();
    let spaceUp = (ulOffset.top - $button.height() - $ul.height()) - $(window).scrollTop();
    let spaceDown = $(window).scrollTop() + $(window).height() - (ulOffset.top + $ul.height());
    if (spaceDown < 0 && (spaceUp >= 0 || spaceUp > spaceDown))
        $(this).addClass("dropup-custom");
}).on("hidden.bs.dropdown", ".d-inline-flex", function() {
    $(this).removeClass("dropup-custom");
});



