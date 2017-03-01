$(document).ready(function(){
    $('.all li.main_navbar').click(function(){
        $(this).addClass('active').siblings().removeClass('active');
        });
});

$(document).ready(function(){
    $('.navbar-right li.main_navbar>a').click(function(){
        $(this).addClass('active').siblings().removeClass('active');
        });
});

//////////////////
$(function(){

$('carousel').carousel({

interval:2000,
pause:false,
wrap:false,
keyboard:false
});

});
/////////////////

 $(document).ready(function () {
                $("#flip").click(function () {
                    $("#panel").slideToggle("slow");
                });
            });





