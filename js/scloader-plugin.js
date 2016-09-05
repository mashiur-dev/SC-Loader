//define $ as jQuery.noConflict()
var $ = jQuery.noConflict();

//document ready function
jQuery(document).ready(function () {
    
});

//preloader
jQuery(window).load(function () {
    $('#scloader_main').fadeOut('slow',function(){$(this).remove();});
});