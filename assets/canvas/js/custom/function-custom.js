//submit form
dataSubmitdir = function(form) {
  $(form).ajaxSubmit({
    dataType: "json",
    success: function(result) {
      if (result.error === true) {
        toastr.options = {
          closeButton: true,
          progressBar: true,
          showMethod: "slideDown",
          timeOut: 4000
        };
        toastr.error(result.msg, result.title);
      } else {
        location.href = result.url;
      }
    }
  });
};

//callvalidate formLicense
$("#formLicense").validate({
  rules: {
    student_id: { required: true }
  },
  submitHandler: function(form) {
    dataSubmitdir(form);
    return false;
  }
});
