
var base_url = $('#base').val();
function deleteCourse(a) {
  var request = $.ajax({
          url: base_url+'course/deleteCourse',
          type: "POST",
          data: {id : a, 'csrf_test_name': token },
          success: function(response) {
            response = JSON.parse( response );
            token = response.token;
            $('.course').empty();
            getCourses();
            alert(response.error);
          }
        });


        request.fail(function(jqXHR, textStatus) {
          alert( "Request failed: " + textStatus );
        });
}

function  getCourses() {        
  $.ajax({
        url: base_url+'course/getCourses',
        type: "POST",
        data: {'csrf_test_name': token },
        success: function(data) {
          response = JSON.parse( data );
          token = response.token;
          $.each(response.courses, function(index,element) {
            $('.course').append(
                // '<div class="card col-sm-3  mx-3 mt-4"><div class="card-body"><h4 class="card-title">'+element.name+'</h4><div class="card-text">'+element.description+'</div></div></div>'
                '<div class="card col-sm-3  mx-3 mt-4"><div class="card-body"><h5 class="card-title pb-2 row"><div class="float-left col-10">'+element.name+'</div><div class="dropdown no-arrow float-right col-2"><a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i></a><div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink"><div class="dropdown-header">Actions:</div><a class="dropdown-item" href="#" onclick="return deleteCourse('+element.id+')">Delete</a></div></div></h5><div class="card-text">'+element.description+'</div></div></div>'
              )
          });
        },
        statusCode: {
           404: function() {
             alert('There was a problem with the server.  Try again soon!');
           }
        }
      }); }



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
                  $('.course').empty();
                  getCourses();
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



