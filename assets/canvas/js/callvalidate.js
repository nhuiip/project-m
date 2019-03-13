//-------------------------------------------------//
// submit form //
//-------------------------------------------------//
dataSubmitdir = function(form) {
  $(form).ajaxSubmit({
    dataType: "json",
    success: function(result) {
      if (result.error === true) {
        toastr.options = {
          closeButton: true,
          progressBar: true,
          positionClass: "toast-top-full-width",
          showMethod: "slideDown",
          timeOut: 1500
        };
        toastr.error(result.msg, result.title);
      } else {
        location.href = result.url;
      }
    }
  });
};

//-------------------------------------------------//
//validate//
//-------------------------------------------------//

$("#formFideData").validate({
  rules: {
    student_id: { required: true }
  },
  submitHandler: function(form) {
    dataSubmitdir(form);
    return false;
  }
});

