
var base_url = $('#base').val();
var courseId = $('#courseId').val();

function getComments(id){
	$('#commentModal').modal('toggle');
	$('#shar').val(id);
  $.ajax({
        url: base_url+'Staffs/getComments',
        type: "POST",
        data: {'csrf_test_name': token, 'id': id },
        success: function(data) {
          response = JSON.parse( data );
          token = response.token;
          $.each(response.shared, function(index,element) {
            $('.comment').append(
                '<div class="col-12 mt-3"><b>'+element.username+':</b> '+element.comment+'</div>'
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

function getSharedPost() {  
  $.ajax({
        url: base_url+'Staffs/getSharedPost',
        type: "POST",
        data: {'csrf_test_name': token, 'id': courseId },
        success: function(data) {
          response = JSON.parse( data );
          token = response.token;
          $.each(response.shared, function(index,element) {
            $('.share').append(
                '<div class="card col-12 mt-4"><div class="card-body"><div class="card-text"><b>New post: '+element.title+'</b>('+element.createdAt+')</div><hr><div class="card-text pt-4"><a href="#" onclick="return getComments('+element.id+')"> class comments</a></div></div></div>'
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

$(document).ready(function() { 

getSharedPost();


    postComment = $("#postComment").validate({
          submitHandler: function(form) {
            $("<input>").attr("type", "hidden").attr('value', token).attr('name', 'csrf_test_name').appendTo("#postComment"); 
            $.ajax({
                url: form.action,
                type: form.method,
                data: $(form).serialize(),
                success: function(response) {
                  response = JSON.parse( response );
                  document.getElementById("postComment").reset();
                  $('#postComment').modal('toggle');
                  token = response.token;
                  $('.comment').empty();
                  getComments();
                    alert(response.error);
                },
                statusCode: {
                  404: function() {
                    $('#postComment').modal('toggle');
                    alert('There was a problem with the server.  Try again soon!');
                  },
                  500: function() {
                    $('#postComment').modal('toggle');
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




    postShare = $("#postShare").validate({
          rules: {
            share: "required",
            title: "required"
          },
          submitHandler: function(form) {
            $("<input>").attr("type", "hidden").attr('value', token).attr('name', 'csrf_test_name').appendTo("#postShare"); 
            $.ajax({
                url: form.action,
                type: form.method,
                data: $(form).serialize(),
                success: function(response) {
                  response = JSON.parse( response );
                  document.getElementById("postShare").reset();
                  $('#addCourseModal').modal('toggle');
                  token = response.token;
                  $('.share').empty();
                  getSharedPost();
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
        });

