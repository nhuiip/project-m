define(["jquery"], function($,fun) {
  var methods = {}

  methods.validate = function(e){
    // Form content page detail update EN
    if($("#formRegis").length){
      $("#formRegis").validate({
        rules: {
          name_title: {
                required: true
            }
        },
        messages: {
          name_title: {
                required: "please enter page name."
            } 
        },submitHandler: function(form) {
          fun.dataSubmit(form);
          return false;
        }
      });
    }
  }

  return methods;
});
