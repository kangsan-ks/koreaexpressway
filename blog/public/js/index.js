
$(document).ready(function(){
    $(window).scroll(function(){
        var scTop = $(document).scrollTop();
        scroll_event(scTop);
    });
    function scroll_event(scTop){
        if(scTop > 0){
            if($(document).width() > 1400){
                $('#header').addClass('on');
                $('#header .logo img').attr('src', '/img/logo.png');
            }
        }else{
            $('#header').removeClass('on');
            $('#header .logo img').attr('src', '/img/logo_on.png');
        }
    }
});