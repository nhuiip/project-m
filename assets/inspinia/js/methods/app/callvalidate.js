define(["jquery", "function", "bootstrap", "validate"], function($, fun) {
  var methods = {};
  jQuery.validator.addMethod(
    "engonly",
    function(value, element) {
      return this.optional(element) || /^[a-z," "]+$/i.test(value);
    },
    ""
  );
  jQuery.validator.addMethod(
    "thaionly",
    function(value, element) {
      return this.optional(element) || /^[u0E01-u0E5B]+$/i.test(value);
    },
    ""
  );
  methods.validate = function(e) {
    // Validate Settings --------------------------------------------------------->
    if ($("#formSettings").length) {
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
        },
        submitHandler: function(form) {
          fun.dataSubmit(form);
          return false;
        }
      });
    }

    // Validate FileManager --------------------------------------------------------->
    if ($("#formFileManager").length) {
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
        },
        submitHandler: function(form) {
          fun.dataSubmitdir(form);
          return false;
        }
      });
    }

    // Validate Administrators --------------------------------------------------------->
    if ($("#formAdministrators").length) {
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
              url: $("#Text_Email").attr("data-url"),
              type: "post",
              data: {
                Text_Email: function() {
                  return $("#Text_Email").val();
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
            required: "กรุณากรอกข้อมูล"
          },
          Select_Positon: {
            required: "กรุณาเลือกตำแหน่งผู้ใช้"
          },
          Text_Email: {
            required: "กรุณากรอก email",
            email: "รูปแบบ email ผิดพลาด",
            remote: "email นี้มีชื่อผู้ใช้อยู่แล้ว"
          },
          Text_passWord: {
            required: "กรุณากรอกรหัสผ่าน.",
            minlength: "รหัสผ่านอย่างน้อย 6 ตัวอักษร."
          },
          Text_confirmPassword: {
            required: "กรุณากรอกรหัสผ่านอีกครั้ง.",
            minlength: "รหัสผ่านอย่างน้อย 6 ตัวอักษร.",
            equalTo: "รหัสผ่านไม่ถูกต้อง"
          }
        },
        submitHandler: function(form) {
          fun.dataSubmitdir(form);
          return false;
        }
      });
    }
    // Validate Pagedetai --------------------------------------------------------->
    // formPagedetailTH
    if ($("#formPagedetailTH").length) {
      $("#formPagedetailTH").validate({
        rules: {
          con_detail_th: {
            required: true
          }
        },
        submitHandler: function(form) {
          fun.dataSubmit(form);
          return false;
        }
      });
    }
    // Validate Intro --------------------------------------------------------->
    // formIntroTH
    if ($("#formIntroTH").length) {
      $("#formIntroTH").validate({
        rules: {
          intro_content: {
            required: true
          }
        },
        submitHandler: function(form) {
          fun.dataSubmit(form);
          return false;
        }
      });
    }
    // Validate Year --------------------------------------------------------->
    // formYear_Create
    if ($("#formYear_Create").length) {
      $("#formYear_Create").validate({
        rules: {
          scyear_title: { required: true}
        },
        messages: {
          scyear_title: { required: "กรุณากรอกข้อมูล." }
        },
        submitHandler: function(form) {
          fun.dataSubmit(form);
          return false;
        }
      });
    }

    if ($("#formYear_Update").length) {
      $("#formYear_Update").validate({
        rules: {
          scyear_title: { required: true}
        },
        messages: {
          scyear_title: { required: "กรุณากรอกข้อมูล." }
        },
        submitHandler: function(form) {
          fun.dataSubmit(form);
          return false;
        }
      });
    }

    // Validate Faculty --------------------------------------------------------->
    // formFaculty_Create
    if ($("#formFaculty_Create").length) {
      $("#formFaculty_Create").validate({
        rules: {
          fac_name: { required: true }
        },
        messages: {
          fac_name: { required: "กรุณากรอกชื่อคณะ." }
        },
        submitHandler: function(form) {
          fun.dataSubmit(form);
          return false;
        }
      });
    }
    // formFaculty_Update
    if ($("#formFaculty_Update").length) {
      $("#formFaculty_Update").validate({
        rules: {
          fac_name: {
            required: true
          }
        },
        messages: {
          fac_name: {
            required: "กรุณากรอกชื่อคณะ."
          }
        },
        submitHandler: function(form) {
          fun.dataSubmit(form);
          return false;
        }
      });
    }

    // Validate Department --------------------------------------------------------->
    // formDepartment_Create
    if ($("#formDepartment_Create").length) {
      $("#formDepartment_Create").validate({
        rules: {
          dept_name: { required: true }
        },
        messages: {
          dept_name: { required: "กรุณากรอกชื่อสาขา." }
        },
        submitHandler: function(form) {
          fun.dataSubmit(form);
          return false;
        }
      });
    }
    // formDepartment_Create
    if ($("#formDepartment_Update").length) {
      $("#formDepartment_Update").validate({
        rules: {
          dept_name: {
            required: true
          }
        },
        messages: {
          dept_name: {
            required: "กรุณากรอกชื่อสาขา."
          }
        },
        submitHandler: function(form) {
          fun.dataSubmit(form);
          return false;
        }
      });
    }

    // Validate Product --------------------------------------------------------->
    // formProduct_Create
    if ($("#formProduct_Create").length) {
      $("#formProduct_Create").validate({
        rules: {
          product_name: { required: true },
          product_price: { required: true }
        },
        messages: {
          product_name: { required: "กรุณากรอกชื่อรายการ." },
          product_price: { required: "กรุณากรอกราคา." }
        },
        submitHandler: function(form) {
          fun.dataSubmit(form);
          return false;
        }
      });
    }
    //formFaculty
    if ($("#formProduct_Update").length) {
      $("#formProduct_Update").validate({
        rules: {
          product_name: {
            required: true
          }
        },
        messages: {
          product_name: {
            required: "กรุณากรอกชื่อรายการ."
          }
        },
        submitHandler: function(form) {
          fun.dataSubmit(form);
          return false;
        }
      });
    }

    // Validate Size --------------------------------------------------------->
    // formSize_Create
    if ($("#formSize_Create").length) {
      $("#formSize_Create").validate({
        rules: {
          size_name: { required: true }
        },
        messages: {
          size_name: { required: "กรุณากรอกชื่อรายการ." }
        },
        submitHandler: function(form) {
          fun.dataSubmit(form);
          return false;
        }
      });
    }
    // formSize_Update
    if ($("#formSize_Update").length) {
      $("#formSize_Update").validate({
        rules: {
          size_name: {
            required: true
          }
        },
        messages: {
          size_name: {
            required: "กรุณากรอกชื่อรายการ."
          }
        },
        submitHandler: function(form) {
          fun.dataSubmit(form);
          return false;
        }
      });
    }

    // Validate Stock --------------------------------------------------------->
    // formStock_Create
    if ($("#formStock_Create").length) {
      $("#formStock_Create").validate({
        rules: {
          status: { required: true },
          size_id1: { required: true },
          size_id2: { required: true },
          amount: { required: true },
          amount1: { required: true },
          amount2: { required: true }
        },
        messages: {
          status: { required: "กรุณาเลือกประเถทเครื่องแบบ." },
          size_id1: { required: "กรุณากรอกจำนวนเครื่องแบบ." },
          size_id2: { required: "กรุณากรอกจำนวนเครื่องแบบ." },
          amount: { required: "กรุณากรอกจำนวนเครื่องแบบ." },
          amount1: { required: "กรุณากรอกจำนวนเครื่องแบบ." },
          amount2: { required: "กรุณากรอกจำนวนเครื่องแบบ." }
        },
        submitHandler: function(form) {
          fun.dataSubmit(form);
          return false;
        }
      });
    }
    // formStock_Update
    if ($("#formStock_Update").length) {
      $("#formStock_Update").validate({
        rules: {
          amount: {
            required: true
          }
        },
        messages: {
          amount: {
            required: "กรุณากรอกจำนวนเครื่องแบบ."
          }
        },
        submitHandler: function(form) {
          fun.dataSubmit(form);
          return false;
        }
      });
    }

    // Validate Package --------------------------------------------------------->
    // formPackage_Create
    if ($("#formPackage_Create").length) {
      $("#formPackage_Create").validate({
        rules: {
          course_status: { required: true },
          sex_id: { required: true }

        },
        messages: {
          course_status: { required: "กรุณาเลือกหลักสูตร." },
          sex_id: { required: "กรุณาเลือกเพศ." }
        },
        submitHandler: function(form) {
          fun.dataSubmit(form);
          return false;
        }
      });
    }
    // formPackage_Update
    if ($("#formPackage_Update").length) {
      $("#formPackage_Update").validate({
        rules: {
          course_status: { required: true },
          sex_id: { required: true }
        },
        messages: {
          course_status: { required: "กรุณาเลือกหลักสูตร." },
          sex_id: { required: "กรุณาเลือกเพศ." }
        },
        submitHandler: function(form) {
          fun.dataSubmit(form);
          return false;
        }
      });
    }
    // Validate Editpieces --------------------------------------------------------->
    // formEditpieces
    if ($("#formEditpieces").length) {
      $("#formEditpieces").validate({
        rules: {
          pieces: { required: true }

        },
        messages: {
          pieces: { required: "กรุณากรอกจำนวนชิ้น." }
        },
        submitHandler: function(form) {
          fun.dataSubmit(form);
          return false;
        }
      });
    }
    // Validate Student --------------------------------------------------------->
    // formStudent_Create
    if ($("#formStudent_Create").length) {
      $("#formStudent_Create").validate({
        rules: {
          student_id: { required: true },
          name_title: { required: true },
          student_fname: { required: true },
          student_lname: { required: true },
          birthdate: { required: true },
          sex_id: { required: true } 

        },
        messages: {
          student_id: { required: "กรุณากรอกรหัสนักศึกษา." },
          name_title: { required: "กรุณาเลือกคำนำหน้า." },
          student_fname: { required: "กรุณากรอกชื่อ." },
          student_lname: { required: "กรุณากรอกนามสกุล." },
          birthdate: { required: "กรุณากรอกวันเกิด." },
          sex_id: { required: "กรุณาเลือกเพศ." }
        },
        submitHandler: function(form) {
          fun.dataSubmit(form);
          return false;
        }
      });
    }
    // formStudent_Update
    if ($("#formStudent_Update").length) {
      $("#formStudent_Update").validate({
        rules: {
          student_id: { required: true },
          name_title: { required: true },
          student_fname: { required: true },
          student_lname: { required: true },
          birthdate: { required: true },
          sex_id: { required: true }
        },
        messages: {
          student_id: { required: "กรุณากรอกรหัสนักศึกษา." },
          name_title: { required: "กรุณาเลือกคำนำหน้า." },
          student_fname: { required: "กรุณากรอกชื่อ." },
          student_lname: { required: "กรุณากรอกนามสกุล." },
          birthdate: { required: "กรุณากรอกวันเกิด." },
          sex_id: { required: "กรุณาเลือกเพศ." }
        },
        submitHandler: function(form) {
          fun.dataSubmit(form);
          return false;
        }
      });
    }

    if ($("#formImport").length) {
      $("#formImport").validate({
        rules: {
          csv_file: { required: true },
        },
        messages: {
          csv_file: { required: "กรุณากรอกเลือกไฟล์." },
        },
        submitHandler: function(form) {
          fun.dataSubmit(form);
          return false;
        }
      });
    }

    if ($("#formMuti").length) {
      $("#formMuti").validate({
        rules: {
          orders_status: { required: true },
        },
        messages: {
          orders_status: { required: "กรุณากรอกข้อมูล." },
        },
        submitHandler: function(form) {
          fun.dataSubmit(form);
          return false;
        }
      });
    }

  };


  return methods;
});
