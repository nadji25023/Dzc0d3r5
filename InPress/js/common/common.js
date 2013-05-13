jQuery(document).ready(function($){ 
    /*var baseURL = $('input#base-url').val();
    var always_show_nav = '';
    var always_show_fix = 0;
    var js_enabled = false;*/
    
    /*$.get(baseURL+"/wp-content/themes/wp-inpress/js/common/js_options.php", function(theXML){
	$('settings',theXML).each(function(i){
	    always_show_nav = $(this).find("always_show_nav").text();
            always_show_fix = $(this).find("always_show_fix").text();
            js_enabled      = $(this).find("js_enabled").text();
	});*/
        
        //var initial_nav_pos = $('.header_bottom_wrap').position().top - always_show_fix;
        
        $('.header_bottom_container').css('height',$('.header_bottom_wrap').height());
        $('[rel=tooltip]').tooltip({
            container: 'body',
            placement: 'bottom'
        });
        //if(js_enabled){
            $("ul.menu").superfish();
            $('.main_navigation').removeClass("noJquery");
            //$('li.main-menu-item').navMenuEffects();
           // $('li.sub-menu-item').navMenuEffects();
       // }
        
       // Cufon.replace('.toCufon');
        
       /* $(window).bind('scroll', function() {
             if ($(window).scrollTop() >= initial_nav_pos) {
                 
                 $('.header_bottom_wrap').addClass(always_show_nav);
             }
             else {
                 $('.header_bottom_wrap').removeClass(always_show_nav);
             }
        });*/

        /*$(".social_links a").tipTip({
            'edgeOffset': -1,
            'defaultPosition' : 'bottom',
            'fadeOut':150,
            'fadeIn':150,
            'delay':0
        });
        */
      
        
   // });
});