jQuery(document).ready(function($) {

/*-----------------------------> MAPS <-----------------------------*/

    $("#maps").gmap3({
    map:{
    options:{
      center: [19.405068, -99.158177],
      scrollwheel: false,
      draggable: false,
      zoom: 15,
      //style
       styles: [{
           "featureType": "water",
           "elementType": "geometry.fill",
           "stylers": [{
               "color": "#929CA4"
           }]
       }, {
           "featureType": "transit",
           "stylers": [{
               "color": "#808080"
           }, {
               "visibility": "off"
           }]
       }, {
           "featureType": "road.highway",
           "elementType": "geometry.stroke",
           "stylers": [{
               "visibility": "on"
           }, {
               "color": "#b3b3b3"
           }]
       }, {
           "featureType": "road.highway",
           "elementType": "geometry.fill",
           "stylers": [{
               "color": "#ffffff"
           }]
       }, {
           "featureType": "road.local",
           "elementType": "geometry.fill",
           "stylers": [{
               "visibility": "on"
           }, {
               "color": "#ffffff"
           }, {
               "weight": 1.8
           }]
       }, {
           "featureType": "road.local",
           "elementType": "geometry.stroke",
           "stylers": [{
               "color": "#d7d7d7"
           }]
       }, {
           "featureType": "poi",
           "elementType": "geometry.fill",
           "stylers": [{
               "visibility": "on"
           }, {
               "color": "#ebebeb"
           }]
       }, {
           "featureType": "administrative",
           "elementType": "geometry",
           "stylers": [{
               "color": "#a7a7a7"
           }]
       }, {
           "featureType": "road.arterial",
           "elementType": "geometry.fill",
           "stylers": [{
               "color": "#ffffff"
           }]
       }, {
           "featureType": "road.arterial",
           "elementType": "geometry.fill",
           "stylers": [{
               "color": "#ffffff"
           }]
       }, {
           "featureType": "landscape",
           "elementType": "geometry.fill",
           "stylers": [{
               "visibility": "on"
           }, {
               "color": "#efefef"
           }]
       }, {
           "featureType": "road",
           "elementType": "labels.text.fill",
           "stylers": [{
               "color": "#696969"
           }]
       }, {
           "featureType": "administrative",
           "elementType": "labels.text.fill",
           "stylers": [{
               "visibility": "on"
           }, {
               "color": "#929CA4"
           }]
       }, {
           "featureType": "poi",
           "elementType": "labels.icon",
           "stylers": [{
               "visibility": "off"
           }]
       }, {
           "featureType": "poi",
           "elementType": "labels",
           "stylers": [{
               "visibility": "off"
           }]
       }, {
           "featureType": "road.arterial",
           "elementType": "geometry.stroke",
           "stylers": [{
               "color": "#d6d6d6"
           }]
       }, {
           "featureType": "road",
           "elementType": "labels.icon",
           "stylers": [{
               "visibility": "off"
           }]
       }, {}, {
           "featureType": "poi",
           "elementType": "geometry.fill",
           "stylers": [{
               "color": "#dadada"
           }]
       }]
       //style
    }
  },
    marker:{
      values:[
        {latLng:[19.405068, -99.158177],data:"https://www.google.com.mx/maps/place/Ures+69,+Roma+Sur,+06760+Ciudad+de+M%C3%A9xico,+CDMX/@19.4050728,-99.1603715,17z/data=!3m1!4b1!4m5!3m4!1s0x85d1ff170d1c19dd:0xb8a0fe3fd28e4288!8m2!3d19.4050678!4d-99.1581775"}
        ],
      /*events:{
          click:function(map, event, context){window.open(context.data)}
          
          }*/   
         events:{click:function(map, event){
                 var map = $(this).gmap3("get");
                map.panTo(event.latLng);
                map.setZoom(map.getZoom()+10);
                }} 
    },

});





});