
  $(document).ready(function(){ 

  $.validator.addMethod("valueNotEquals", function(value, element, arg){
    return arg !== value;
  }, "This field is required");


  var studentRegister = $("#studentRegister").validate({
    rules: {
      name: { required: true },
      dateOfBirth: { required: true, date: true },
      yearOfPassing: { required: true, digits: true, minlength: 4 },
      rollNo: { required: true, digits: true },
      gender: { valueNotEquals: "select" },
      categoryId: { valueNotEquals: "select" },
      contactNo: { 
        required: true, 
        digits: true, 
        minlength: 10 
      },
          mailId: { required: true, email: true },
          password: {
            required: true,
            minlength: 8
          }
    },
      messages: {
        contactNo: {
          minlength: "Enter Valid Contact No."
        },
        yearOfPassing: {
          minlength: "Enter Valid Year"
        }
       },
      submitHandler: function(form) {
        form.submit();
      },   
    });

    $(".reset").click(function() {
      validator.resetForm();
    });



 });