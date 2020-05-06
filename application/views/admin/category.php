
  <div class="d-sm-flex align-items-center justify-content-between mb-4 row">
    <h1 class="h3 mb-0 text-gray-800">All Categories&nbsp;&nbsp;</h1>
  </div>
  <hr class="mt-2">



          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <a href="#" data-toggle="modal" data-target="#addCategoryModal" class="btn btn-primary btn-icon-split btn-sm float-left">
                <span class="icon text-white-50">
                  <i class="fas fa-plus"></i>
                </span>
                <span class="text">Add Category</span>
              </a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="categoryTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Category Name</th>
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
<div class="modal" id="addCategoryModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add Category</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form name="addCategory" id="addCategory" method="post" action="<?=base_url()?>category/addCategory">
      <!-- Modal body -->
      <div class="modal-body">
        <div class="col">
      <div class="form-group">
        <label for="name">Category</label>
        <input required type="text" class="form-control" name="name" id="name" placeholder="Category name">
      </div>
    </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
      <button type="reset" class="btn btn-secondary">Clear</button>
      <button type="submit" id="addUserSubmit" class="btn btn-primary">Create</button>
      </div>
      
    </form>

    </div>
  </div>
</div>    

    <!-- The Modal -->
<div class="modal" id="updateCategoryModel">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Update Category</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form name="updateCategory" id="updateCategory" method="post" action="<?=base_url()?>category/updateCategory">
      <!-- Modal body -->
      <div class="modal-body">
        <div class="col">
          <input type="hidden" name="id" id="id">
      <div class="form-group">
        <label for="name">Category</label>
        <input required type="text" class="form-control" name="ename" id="ename" placeholder="Category name">
      </div>
    </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
      <button type="reset" class="btn btn-secondary">Clear</button>
      <button type="submit" id="addUserSubmit" class="btn btn-primary">Update</button>
      </div>
      
    </form>

    </div>
  </div>
</div>    



<input type="hidden" id="base" value="<?php echo base_url(); ?>">
