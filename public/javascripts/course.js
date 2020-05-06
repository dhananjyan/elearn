
function editCategory(a) {
 $("#id").val(a);
  var request = $.ajax({
          url: base_url+'category/getCategory',
          type: "POST",
          data: {id : a, 'csrf_test_name': token },
          success: function(response) {
            response = JSON.parse( response );
            token = response.token;
            document.getElementById("ename").value = response[0].name;
            $('#updateCategoryModel').modal('toggle');
          }
        });


        request.fail(function(jqXHR, textStatus) {
          alert( "Request failed: " + textStatus );
        });
}

function  getsCourses() {        
  $.ajax({
        url: base_url+'course/getCourses',
        type: "POST",
        data: {'csrf_test_name': token },
        dataType: 'json',
        success: function(data) {
          $.each(data, function(index,element) {
            $('#img').append('<div class="col-lg-3 col-md-4 col-4 select"><div class="d-block mb-4 h-100"><img class="img-fluid img-thumbnail" src="'+base_url+'upload/images/'+element.file_name+'" alt="img"><input type="radio" name="select" value="'+element.id+'"><div class="text-truncate">'+element.file_name+'</div></div></div>');
          });
        },
        statusCode: {
           404: function() {
             alert('There was a problem with the server.  Try again soon!');
           }
        }
      }); }
var base_url = $('#base').val();

$(document).ready(function() {   

    getCourses();


        addCourse = $("#addCourse").validate({
          rules: {
            name: "required",
            description: "required",
          },
          submitHandler: function(form) {
            $("<input>").attr("type", "hidden").attr('value', token).attr('name', 'csrf_test_name').appendTo("#addCourse"); 
            $.ajax({
                url: form.action,
                type: form.method,
                data: $(form).serialize(),
                success: function(response) {
                  response = JSON.parse( response );
                  document.getElementById("addCourse").reset();
                  $('#addCourseModal').modal('toggle');
                  token = response.token;
                    alert(response.error);
                },
                statusCode: {
                  404: function() {
                    $('#addCourseModal').modal('toggle');
                    alert('There was a problem with the server.  Try again soon!');
                  },
                  500: function() {
                    $('#addCourseModal').modal('toggle');
                    alert('Error in Creating User');
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


        updateCategory = $("#updateCategory").validate({
          rules: {
            ename: "required",
          },
          submitHandler: function(form) {
            $("<input>").attr("type", "hidden").attr('value', token).attr('name', 'csrf_test_name').appendTo("#updateCategory"); 
            $.ajax({
                url: form.action,
                type: form.method,
                data: $(form).serialize(),
                success: function(response) {
                  response = JSON.parse( response );
                  table.ajax.reload();
                  document.getElementById("updateCategory").reset();
                  $('#updateCategoryModel').modal('toggle');
                  token = response.token;
                    alert(response.error);
                },
                statusCode: {
                  404: function() {
                    $('#updateCategoryModel').modal('toggle');
                    alert('There was a problem with the server.  Try again soon!');
                  },
                  500: function() {
                    $('#updateCategoryModel').modal('toggle');
                    alert('Error in updating category');
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

function deleteCategory(data) {
  confirmDialog("Do You Want To Delete ?", (ans) => {
    if (ans) {
      $.ajax({
        url: base_url+'category/deleteCategory',
        type:'post',
        data:{ id : data, 'csrf_test_name': token },
        dataType: "html",
        success: function(response){
                  response = JSON.parse( response );
                  table.ajax.reload();
                  token = response.token;
                    alert(response.result);
        },
      });
        }
  });
}
    function confirmDialog(message, handler){
        $(`<div class="modal fade" id="myModal" role="dialog"> 
           <div class="modal-dialog"> 
             <!-- Modal content--> 
              <div class="modal-content"> 
                 <div class="modal-body" style="padding:10px;"> 
                   <h4 class="text-center">${message}</h4> 
                   <div class="text-right text-white"> 
                     <a class="btn btn-primary btn-yes">Yes</a> 
                     <a class="btn btn-primary btn-no">No</a> 
                   </div> 
                 </div> 
             </div> 
          </div>
        </div>`).appendTo('body');
       
        //Trigger the modal
        $("#myModal").modal({
           backdrop: 'static',
           keyboard: false
        });
        
         //Pass true to a callback function
         $(".btn-yes").click(function () {
             handler(true);
             $("#myModal").modal("hide");
         });
          
         //Pass false to callback function
         $(".btn-no").click(function () {
             handler(false);
             $("#myModal").modal("hide");
         });

         //Remove the modal once it is closed.
         $("#myModal").on('hidden.bs.modal', function () {
            $("#myModal").remove();
         });
      }



