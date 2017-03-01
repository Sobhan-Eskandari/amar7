$(document).ready(function(){
    $('.admin_side_title').click(function(){
        $(this).addClass('active').siblings().removeClass('active');
        });
});

 $(document).ready(function(){
    $('li.activate_pag').click(function(){
        $(this).addClass('active').siblings().removeClass('active');
        });
});


//////////////////////

function myMap() {
  var mapCanvas = document.getElementById("map");
  var mapOptions = {
    center: new google.maps.LatLng(51.5, -0.2),
    zoom: 10
  }
  var map = new google.maps.Map(mapCanvas, mapOptions);
}