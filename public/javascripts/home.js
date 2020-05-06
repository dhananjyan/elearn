
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
                '<div class="card col-sm-3  mx-3 mt-4"><div class="card-body"><h5 class="card-title pb-2 row"><div class="float-left col-10">'+element.name+'</div><div class="dropdown no-arrow float-right col-2"><a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i></a><div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink"><div class="dropdown-header">Actions:</div><a class="dropdown-item" href="#" onclick="return deleteCourse('+element.id+')">Delete</a></div></div></h5><div class="card-text">'+element.description+'</div></div></div>'
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