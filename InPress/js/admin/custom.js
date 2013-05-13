
/**
 * Custom admin script
 * @version 1.0
 */
jQuery(document).ready(function($) {

    //window resize events
    $(window).resize(function() {
        //get the window size
        var wsize = $(window).width();
        if (wsize > 980) {
            $('.shortcuts.hided').removeClass('hided').attr("style", "");
            $('.sidenav.hided').removeClass('hided').attr("style", "");
        }
    });


    // bootstrap scroll
    $('body').attr({"data-spy": "scroll", "data-target": ".bs-docs-sidebar"});
    // $('.bs-docs-sidebar').scrollspy();

    $('.onoff').parent('div').toggleButtons();
    $('.numeric_input').numeric({decimal: false, negative: false}, function() {
        alert("Positive integers only");
        this.value = "";
        this.focus();
    });

//ScrollTo('div.theme-options-page a[href^="#"]');

// help button
    $('.tooltip-info').popover({
        trigger: 'hover'
    });



    $('.bs-docs-sidenav li a').click(function() {
        $('body').scrollTo($(this).attr('href'), 800, {
            axis: 'y',
            offset: -28
        });

        return false;
    });
    //$('.bs-docs-sidenav li a').scrollTo();

    // radio image select
    $('input.radioImageSelect').radioImageSelect();

    // Gui

    $('.slider-range-min .slider')
        .removeClass('ui-corner-all ui-widget-content')
        .wrap('<span class="ui-slider-wrap"></span>')
        .find('.ui-slider-handle')
        .removeClass('ui-corner-all ui-state-default');




    // set remove icon functionn
    function show_thumbnail() {

    }

    // clear input content


    // set upload icon fuction




});