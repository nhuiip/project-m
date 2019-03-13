define(["jquery"], function($) {
  var methods = {}

  methods.camera = function(){
    console.log("camera");
    // $('#camera_wrap_1').camera({
    //   thumbnails: false,
    //   height: '35%',
    //   loader: 'pie',
    //   loaderPadding: 1,
    //   loaderStroke: 5,
    //   onLoaded: function() {
    //     $('#camera_wrap_1').find('.camera_next').html('<i class="icon-angle-right"></i>');
    //     $('#camera_wrap_1').find('.camera_prev').html('<i class="icon-angle-left"></i>');
    //   }
    // });
  }

  methods.gMap = function(e){
    console.log("gMap");
    // $('#google-map5').gMap({
    //    latitude: 13.75633,
    //    longitude: 100.50177,
    //    maptype: 'ROADMAP',
    //    zoom: 15,
    //    markers: [
    //     {
    //       latitude: 13.75633,
    //       longitude: 100.50177,
    //       html: "Saengaree"
    //     }
    //    ],
    //    doubleclickzoom: false,
    //    controls: {
    //      panControl: true,
    //      zoomControl: true,
    //      mapTypeControl: false,
    //      scaleControl: false,
    //      streetViewControl: false,
    //      overviewMapControl: false
    //   }
    // });

    methods.datepicker = function(){

      $('.date').datepicker({
          startView: 1,
          todayBtn: "linked",
          keyboardNavigation: false,
          forceParse: false,
          autoclose: true,
          format: "dd-mm-yyyy",
      });
  
    }
  }

  return methods;
});
