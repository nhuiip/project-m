define(["jquery","function","bootstrap","validate"], function($,fun) {
  var methods = {}

  methods.validate = function(e){

    // Form content page detail update EN
    if($("#formPagedetailEN").length){
      $("#formPagedetailEN").validate({
        rules: {
            Text_namePageEN: {
                required: true
            }
        },
        messages: {
            Text_namePageEN: {
                required: "please enter page name."
            }
        },submitHandler: function(form) {
          fun.dataSubmit(form);
          return false;
        }
      });
    }

    // Form content page detail update TH
    if($("#formPagedetailTH").length){
      $("#formPagedetailTH").validate({
        rules: {
            Text_namePageTH: {
                required: true
            }
        },
        messages: {
            Text_namePageTH: {
                required: "please enter page name."
            }
        },submitHandler: function(form) {
          var Id = $('#Id').val();
          if(Id != ""){
            fun.dataSubmit(form);
          }else{
            fun.dataSubmitdir(form);
          }
          return false;
        }
      });
    }

    // Form sub content page detail update TH
    if($("#formSubdetailTH").length){
      $("#formSubdetailTH").validate({
        rules: {
            Text_namePageTH: {
                required: true
            }
        },
        messages: {
            Text_namePageTH: {
                required: "please enter page name."
            }
        },submitHandler: function(form) {
          var Id = $('#Id').val();
          if(Id != ""){
            fun.dataSubmit(form);
          }else{
            fun.dataSubmitdir(form);
          }
          return false;
        }
      });
    }

    // Form sub content page detail update EN
    if($("#formSubdetailEN").length){
      $("#formSubdetailEN").validate({
        rules: {
            Text_namePageEN: {
                required: true
            }
        },
        messages: {
            Text_namePageEN: {
                required: "please enter page name."
            }
        },submitHandler: function(form) {
          var Id = $('#Id').val();
          if(Id != ""){
            fun.dataSubmit(form);
          }else{
            fun.dataSubmitdir(form);
          }
          return false;
        }
      });
    }

    // Form upload file manager
    if($("#formFileManager").length){
      $("#formFileManager").validate({
        rules: {
            File_images: {
                required: true
            }
        },
        messages: {
            File_images: {
                required: "please select file for upload."
            }
        },submitHandler: function(form) {
          fun.dataSubmitdir(form);
          return false;
        }
      });
    }

    // Form administrators
    if($("#formAdministrators").length){
      $("#formAdministrators").validate({
        rules: {
            Text_fullName: {
                required: true
            },
            Select_Positon: {
                required: true
            },
            Text_Email: {
                required: true,
                email: true,
                remote: {
                    url: $( "#Text_Email" ).attr('data-url'),
                    type: "post",
                    data: {
                        Text_Email: function() {
                            return $( "#Text_Email" ).val();
                        }
                    }
                }
            },
            Text_passWord: {
                required: true,
                required: true,
                minlength: 6
            },
            Text_confirmPassword: {
                required: true,
                minlength: 6,
                equalTo: "#Text_passWord"
            }
        },
        messages: {
            Text_fullName: {
                required: "please enter fullname."
            },
            Select_Positon: {
                required: "please enter positon."
            },
            Text_Email: {
                required: "please enter email.",
                email: "Please enter a valid email.",
                remote: "This email is already activated !"
            },
            Text_passWord: {
                required: "please enter password.",
                minlength: "Please specify at least 6 characters."
            },
            Text_confirmPassword: {
                required: "please enter confirm password.",
                minlength: "Please specify at least 6 characters.",
                equalTo: "Please specify the same password as the password."
            },
        },submitHandler: function(form) {
          fun.dataSubmitdir(form);
          return false;
        }
      });
    }

    /*############# News #############*/
    // Form create en
    if($("#formNewsEN_Create").length){
      $("#formNewsEN_Create").validate({
        rules: {
            Text_titleEN: {
                required: true
            }
        },
        messages: {
            Text_titleEN: {
                required: "please enter title."
            }
        },submitHandler: function(form) {
          fun.dataSubmitdir(form);
          return false;
        }
      });
    }
    // Form update en
    if($("#formNewsEN_Update").length){
      $("#formNewsEN_Update").validate({
        rules: {
            Text_titleEN: {
                required: true
            }
        },
        messages: {
            Text_titleEN: {
                required: "please enter title."
            }
        },submitHandler: function(form) {
          fun.dataSubmit(form);
          return false;
        }
      });
    }

    // Form create th
    if($("#formNewsTH_Create").length){
      $("#formNewsTH_Create").validate({
        rules: {
            Text_titleTH: {
                required: true
            }
        },
        messages: {
            Text_titleTH: {
                required: "please enter title."
            }
        },submitHandler: function(form) {
          fun.dataSubmitdir(form);
          return false;
        }
      });
    }

    // Form update th
    if($("#formNewsTH_Update").length){
      $("#formNewsTH_Update").validate({
        rules: {
            Text_titleTH: {
                required: true
            }
        },
        messages: {
            Text_titleTH: {
                required: "please enter title."
            }
        },submitHandler: function(form) {
          fun.dataSubmit(form);
          return false;
        }
      });
    }

    /*############# End News #############*/

    /*############# Back #############*/
    // Form create en
    if($("#formBankEN_Create").length){
        $("#formBankEN_Create").validate({
          rules: {
              textbank_name_eng: {
                  required: true
              }
          },
          messages: {
              textbank_name_eng: {
                  required: "กรุณากรอกชือธนาคาร."
              }
          },submitHandler: function(form) {
            fun.dataSubmitdir(form);
            return false;
          }
        });
      }
      // Form update en
      if($("#formBankEN_Update").length){
        $("#formBankEN_Update").validate({
          rules: {
              textbank_name_eng: {
                  required: true
              }
          },
          messages: {
              textbank_name_eng: {
                  required: "กรุณากรอกชือธนาคาร."
              }
          },submitHandler: function(form) {
            fun.dataSubmit(form);
            return false;
          }
        });
      }
  
      // Form create th
      if($("#formBankTH_Create").length){
        $("#formBankTH_Create").validate({
          rules: {
              textbank_name: {
                  required: true
              }
          },
          messages: {
              textbank_name: {
                  required: "กรุณากรอกชือธนาคาร."
              }
          },submitHandler: function(form) {
            fun.dataSubmitdir(form);
            return false;
          }
        });
      }
  
      // Form update th
      if($("#formBankTH_Update").length){
        $("#formBankTH_Update").validate({
          rules: {
              textbank_name: {
                  required: true
              }
          },
          messages: {
              textbank_name: {
                  required: "กรุณากรอกชือธนาคาร."
              }
          },submitHandler: function(form) {
            fun.dataSubmit(form);
            return false;
          }
        });
      }
  
      /*############# End Back #############*/
  

    // Form images en
    if($("#formImages").length){
      $("#formImages").validate({
        rules: {
            Text_title: {
                required: true
            },
            File_images: {
                required: true
            }
        },
        messages: {
            Text_title: {
                required: "please enter title."
            },
            File_images: {
                required: "please selete image for upload."
            }
        },submitHandler: function(form) {
          fun.dataSubmitdir(form);
          return false;
        }
      });
    }

    // Form content page detail update EN
    if($("#formSettings").length){
      $("#formSettings").validate({
        rules: {
            Text_Keywords: {
                required: true
            },
            Text_Description: {
                required: true
            },
            Text_Emailhr: {
                required: true,
                email: true
            },
            Text_Emailcontact: {
                required: true,
                email: true
            },
            Num_Perpagenews: {
                required: true
            },
            Num_Perpagegallery: {
                required: true
            },
            Num_Perpageknowledge: {
                required: true
            }
        },
        messages: {
            Text_Keywords: {
                required: "please enter keywords."
            },
            Text_Description: {
                required: "please enter description."
            },
            Text_Emailhr: {
                required: "please enter email hr.",
                email: "Please enter a valid email."
            },
            Text_Emailcontact: {
                required: "please enter email contact.",
                email: "Please enter a valid email."
            },
            Num_Perpagenews: {
                required: "please enter news per page."
            },
            Num_Perpagegallery: {
                required: "please enter activity per page."
            },
            Num_Perpageknowledge: {
                required: "please enter knowledge per page."
            }
        },submitHandler: function(form) {
          fun.dataSubmit(form);
          return false;
        }
      });
    }

    // Form slider create
    if($("#formSlider_Create").length){
      $("#formSlider_Create").validate({
        rules: {
            File_name: {
                required: true
            },
            Text_msgEN: {
                required: true
            },
            Text_msgTH: {
                required: true
            }
        },
        messages: {
            File_name: {
                required: "select file for upload."
            },
            Text_msgEN: {
                required: "please enter msg (en)."
            },
            Text_msgEN: {
                required: "please enter msg (th)."
            }
        },submitHandler: function(form) {
          fun.dataSubmitdir(form);
          return false;
        }
      });
    }

    // Form slider update
    if($("#formSlider_Update").length){
      $("#formSlider_Update").validate({
        rules: {
            Text_msgEN: {
                required: true
            },
            Text_msgTH: {
                required: true
            }
        },
        messages: {
            Text_msgEN: {
                required: "please enter msg (en)."
            },
            Text_msgEN: {
                required: "please enter msg (th)."
            }
        },submitHandler: function(form) {
          fun.dataSubmitdir(form);
          return false;
        }
      });
    }

  }

  if($("#formFaqTH").length){
    $("#formFaqTH").validate({
      rules: {
          Text_titleTH: {
              required: true
          }
      },
      messages: {
          Text_titleTH: {
              required: "please enter title."
          }
      },submitHandler: function(form) {
        var Id = $('#Id').val();
        if(Id != ""){
          fun.dataSubmit(form);
        }else{
          fun.dataSubmitdir(form);
        }
        return false;
      }
    });
  }

  return methods;
});
