var base_url = $('#base').val();

$(document).ready(function() {

    table = $('#usersTable').DataTable({ 
        "responsive": true,
 
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": base_url+"users/getUsers",
            "type": "POST",
        },
 
        "columnDefs": [
        { 
            "targets": [ 0 ], 
            "orderable": false,
        },
        { 
            "targets": [ 4 ],
            "orderable": false,
        }

        ],

 
    });
  $.validator.addMethod("valueNotEquals", function(value, element, arg){
    return arg !== value;
  }, "Value must not equal arg.");

        addUser = $("#addUser").validate({
          rules: {
            username: "required",
            password: "required",
            accessType: { valueNotEquals: "select" },
          },
          messages: {
            accessType: {
              valueNotEquals: "Please select access type"
            }
          },
          submitHandler: function(form) {
            $("<input>").attr("type", "hidden").attr('value', token).attr('name', 'csrf_test_name').appendTo("#addUser"); 
            $.ajax({
                url: form.action,
                type: form.method,
                data: $(form).serialize(),
                success: function(response) {
                  response = JSON.parse( response );
                	table.ajax.reload();
                  document.getElementById("addUser").reset();
                	$('#addUser_modal').modal('toggle');
                  token = response.token;
                    alert(response.error);
                },
                statusCode: {
                  404: function() {
                    $('#addUser_modal').modal('toggle');
                    alert('There was a problem with the server.  Try again soon!');
                  },
                  500: function() {
                    $('#addUser_modal').modal('toggle');
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

function deleteUser(data) {
  confirmDialog("Do You Want To Delete ?", (ans) => {
    if (ans) {
      $.ajax({
        url: base_url+'users/deleteUser',
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
// function open_edit(a) {
// 	$("#edit_event")[0].reset();
// 	$("#id").val(a);
// 	var request = $.ajax({
//           url: base_url+'events/get_event',
//           type: "POST",
//           data: {id : a},
//           dataType:"JSON",
//           success: function(response) {
//             response = JSON.stringify( response );
//             var json = $.parseJSON(response);
//             document.getElementById("subject").value = json[0].subject;
//             document.getElementById("body").value = json[0].body;
//             document.getElementById("date").value = json[0].date;
//             document.getElementById("start_time").value = json[0].start_time;
//             document.getElementById("end_time").value = json[0].end_time;
//             document.getElementById("amount").value = json[0].amount;
//             document.getElementById("organizer").value = json[0].organizer;
//             document.getElementById("amount_type").value = json[0].amount_type;
//             document.getElementById("contact_no").value = json[0].contact_no;
//             document.getElementById("contact_mail").value = json[0].contact_mail;
//             // var res = ( json[0].gender  === "male"?'1':'2');
//             // document.getElementById("editgender").selectedIndex = getindexofGender(json[0].gender);
//             // document.getElementById("editblood_group").selectedIndex = getindexofBlood__group(json[0].blood_group);
//             // $('#EditPatientModal').modal('toggle');
//         }
//         });


//         request.fail(function(jqXHR, textStatus) {
//           alert( "Request failed: " + textStatus );
//         });
// 	$('#editevent_modal').modal('toggle');
// }
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



