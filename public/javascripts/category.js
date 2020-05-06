
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
var base_url = $('#base').val();

$(document).ready(function() {

    table = $('#categoryTable').DataTable({ 
        "responsive": true,
 
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": base_url+"category/getCategories",
            "type": "POST",
        },
 
        "columnDefs": [
        { 
            "targets": [ 0 ], 
            "orderable": false,
        },
        { 
            "targets": [ 3 ],
            "orderable": false,
        }

        ],

 
    });

        addCategory = $("#addCategory").validate({
          rules: {
            name: "required",
          },
          submitHandler: function(form) {
            $("<input>").attr("type", "hidden").attr('value', token).attr('name', 'csrf_test_name').appendTo("#addCategory"); 
            $.ajax({
                url: form.action,
                type: form.method,
                data: $(form).serialize(),
                success: function(response) {
                  response = JSON.parse( response );
                  table.ajax.reload();
                  document.getElementById("addCategory").reset();
                  $('#addCategoryModal').modal('toggle');
                  token = response.token;
                    alert(response.error);
                },
                statusCode: {
                  404: function() {
                    $('#addCategoryModal').modal('toggle');
                    alert('There was a problem with the server.  Try again soon!');
                  },
                  500: function() {
                    $('#addCategoryModal').modal('toggle');
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



