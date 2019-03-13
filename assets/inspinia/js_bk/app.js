requirejs.config({
    baseUrl: '/assets/inspinia/js/lib',
    paths: {
        jquery: 'jquery-2.1.1',
        bootstrap: 'bootstrap.min',
        metisMenu: 'plugins/metisMenu/jquery.metisMenu',
        slimscroll: 'plugins/slimscroll/jquery.slimscroll.min',
        pace: 'plugins/pace/pace.min',
        codemirror: 'plugins/codemirror/codemirror',
        summernote: 'plugins/summernote/summernote',
        codemirrorjs: 'plugins/codemirror/mode/javascript/javascript',
        jqueryForm: 'plugins/jqueryForm/jquery.form',
        validate: 'plugins/validate/jquery.validate.min',
        toastr: 'plugins/toastr/toastr.min',
        dataTables: 'plugins/dataTables/datatables',
        sweetalert: 'plugins/sweetalert/sweetalert.min',
        clipboard: 'plugins/clipboard/clipboard.min',
        inspinia: '../methods/inspinia.min',
        function: '../methods/app/function',
        callvalidate: '../methods/callvalidate.min',
        callplugins: '../methods/callplugins.min'
    },
    shim: {
      'bootstrap':{
          deps: ['jquery']
      },
      'codemirrorjs':{
          deps: ['codemirror']
      },
      'metisMenu': {
        deps: ['jquery']
      },
      'slimscroll': {
        deps: ['jquery']
      },
      'summernote': {
        deps: ['jquery','bootstrap','codemirror']
      },
      'jqueryForm': {
        deps: ['jquery']
      },
      'clipboard': {
        deps: ['jquery']
      },
      'inspinia': {
        deps: ['jquery','metisMenu','slimscroll']
      },

  	}
});

// Start the main app logic.
requirejs([
  'jquery',
  'bootstrap',
  'codemirrorjs',
  'metisMenu',
  'slimscroll',
  'pace',
  'codemirror',
  'summernote',
  'jqueryForm',
  'validate',
  'clipboard',
  'inspinia'
],
function($) {
  require(['function','callplugins','callvalidate','clipboard'],function(fun,plug,vali,Clipboard){
    new Clipboard('.clipboard');
    plug.summernote();
    plug.dataTables();
    vali.validate();
    if($("#listFile").length){
      var listFile = $("#listFile");
      fun.jsonFilemanager(listFile);
    }
    $('.Btn-delete').click(function(){
      fun.deleteData(this);
    });
    $('.file-box').each(function() {
      fun.animationHover(this, 'pulse');
    });

    $('.file-type').click(function(){
      $( ".file-type" ).removeClass( "active" );
      $(this).addClass("active");
      var type = $(this).attr('data-type');
      listFile.attr("data-type",type);
      fun.jsonFilemanager(listFile);
    });

    $('.file-folder').click(function(){
      $( ".file-folder i" ).removeClass( "fa-folder-open" );
      $("i",this).addClass("fa-folder-open");
      var folder = $(this).attr('data-folder');
      listFile.attr("data-folder",folder);
      fun.jsonFilemanager(listFile);
    });

    $('.file-tag').click(function(){
      $(this).toggleClass("active");
      var tag = $(this).attr('data-tag');
      var tags = listFile.attr('data-tags');
      if(tags != ""){
        var t = tags.split(',');
        var key = $.inArray( tag, t );
        if(key >= 0){
          t = $.grep(t, function(value) {
            return value != tag;
          });
        }else{
          t.push(tag);
        }
        t.toString();
      }else{
        t = tag;
      }

      listFile.attr("data-tags",t);
      fun.jsonFilemanager(listFile);
    });

    $('.btn-reload').click(function(){
      location.reload();
    });

    $('.btn-url').click(function(){
      var Url = $(this).attr('data-url');
      window.open(Url,'_blank');
    });

    $('.btn-eye').click(function() {
      $('.Text_eye').each(function() {
        var v = $(this).val();
        if(v == 1){
          $(this).val(2);
        }else{
          $(this).val(1);
        }
      });
      $("i", this).toggleClass("fa-eye-slash fa-eye");
    });

    $('.btn-check').click(function() {
      $('.Text_check').each(function() {
        var v = $(this).val();
        if(v == 1){
          $(this).val(2);
        }else{
          $(this).val(1);
        }
      });
      $("i", this).toggleClass("fa-check-square fa-check-square-o");
    });

  });
});
