
var base_url = $('#base').val();
function getCourse() {

  $.ajax({
        url: base_url+'students/getCourse',
        type: "POST",
        data: {'csrf_test_name': token },
        success: function(data) {
          response = JSON.parse( data );
          token = response.token;
          $.each(response.courses, function(index,element) {
            $('.course').append(
                '<div class="col-12 col-sm-3 mt-5"><div class="card"><div class="card-header"><h4>'+element.name+'</h4></div><div class="card-body" style="height: 150px;"><div class="card-text">'+element.description+'</div></div></div></div>'
              )
          });
        },
        statusCode: {
           404: function() {
             alert('There was a problem with the server.  Try again soon!');
           }
        }
      }); 
}

  $(document).ready(function(){ 

  $.validator.addMethod("valueNotEquals", function(value, element, arg){
    return arg !== value;
  }, "This field is required");

  getCourse();


  var joinClass = $("#joinClass").validate({
    rules: {
      code: { required: true },
    },
      submitHandler: function(form) {
            $("<input>").attr("type", "hidden").attr('value', token).attr('name', 'csrf_test_name').appendTo('#joinClass'); 
            $.ajax({
                url: form.action,
                type: form.method,
                data: $(form).serialize(),
                success: function(response) {
                  response = JSON.parse( response );
                  document.getElementById("joinClass").reset();
                  $('#joinClassModal').modal('toggle');
                  token = response.token;
                  $('.course').empty();
                  getCourse();
                    alert(response.error);
                },
                statusCode: {
                  404: function() {
                    $('#joinClassModal').modal('toggle');
                    alert('There was a problem with the server.  Try again soon!');
                  },
                  500: function() {
                    $('#joinClassModal').modal('toggle');
                    alert('Error in joining class');
                  },
                }            
            });
          },    
          highlight: function (element, errorClass, validClass) {
            return false;
          },
          unhighlight: function (element, errorClass, validClass) {
              return false;
          },
    });

 });