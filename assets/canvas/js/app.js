requirejs.config({
    baseUrl: '/assets/canvas/js/lib',
    paths: {
        jquery: 'jquery',
        plugins: 'plugins',
        function: '../methods/function.min',
        callplugins: '../methods/callplugins.min',
        'functions-canvas': 'functions',
        'jquery-camera': 'jquery.camera'
    },
    shim: {
      'plugins': {
        deps: ['jquery']
      },
      'functions-canvas': {
        deps: ['jquery','plugins']
      },
      'datepicker': {
        deps: ['jquery', 'bootstrap']
      },
      'jquery-camera': {
        deps: ['jquery']
      }
  	}
});

// Start the main app logic.
requirejs([
  'jquery',
  'jquery-camera'
],
function($) {
  require(['plugins','functions-canvas','function', 'callplugins',],function(p,f,fun,plug,){
  
    fun.Testfunction();
  });
});
