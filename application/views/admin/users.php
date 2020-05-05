
  <div class="d-sm-flex align-items-center justify-content-between mb-4 row">
    <h1 class="h3 mb-0 text-gray-800">All Users&nbsp;&nbsp;</h1>
  </div>
  <hr class="mt-2">



          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <a href="#" data-toggle="modal" data-target="#addUser_modal" class="btn btn-primary btn-icon-split btn-sm float-left">
                <span class="icon text-white-50">
                  <i class="fas fa-plus"></i>
                </span>
                <span class="text">Add User</span>
              </a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="usersTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Username</th>
                      <th>accessType</th>
                      <th>createdAt</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>

                  </tbody>
                </table>
              </div>
            </div>
          </div>






    <!-- The Modal -->
<div class="modal" id="addUser_modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add user</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form name="addUser" id="addUser" method="post" action="<?=base_url()?>users/addUser">
      <!-- Modal body -->
      <div class="modal-body">
        <div class="col">
      <div class="form-group">
        <label for="username">Username</label>
        <input required type="text" class="form-control" name="username" id="username" placeholder="username">
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input required type="password" class="form-control" name="password" id="password" placeholder="Password">
      </div>
      <div class="form-group">
        <label for="accessType">Select Access type</label>
        <select class="form-control" name="accessType" id="accessType">
        <option value="select">Select..</option>
        <option value="admin">Admin</option>
        <option value="staff">Staff</option>
        </select> 
      </div>

    </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
      <button type="reset" class="btn btn-primary">Clear</button>
      <button type="submit" id="addUserSubmit" class="btn btn-primary">Submit</button>
      </div>
      
    </form>

    </div>
  </div>
</div>    



<input type="hidden" id="base" value="<?php echo base_url(); ?>">
