<div class="d-sm-flex align-items-center justify-content-between mb-4 mx-2 row">
    <h1 class="h3 mb-0 text-gray-800">All Courses&nbsp;&nbsp;</h1>
    <a href="#" data-toggle="modal" data-target="#addCourseModal" class="btn btn-primary btn-icon-split btn-sm float-left">
    	<span class="icon text-white-50">
            <i class="fas fa-plus"></i>
        </span>
        <span class="text">Add Course</span>
    </a>
  </div>
  <hr class="mt-2">
    <div class="row course">

      <div class="card col-sm-3  mx-3 mt-4">
        <div class="card-body">
          <h4 class="card-title">asfkasdfhkjdsfh</h4>
        </div>
      </div>

    </div>


















    <!-- The Modal -->
<div class="modal" id="addCourseModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add Course</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form name="addCourse" id="addCourse" method="post" action="<?=base_url()?>course/addCourse">
      <!-- Modal body -->
      <div class="modal-body">
        <div class="col">
      <div class="form-group">
        <label for="name">Course title</label>
        <input type="text" class="form-control" name="name" id="name" placeholder="Course name">
      </div>
      <div class="form-group">
        <label for="description">Course description</label>
        <textarea class="form-control" name="description" id="description"></textarea>
      </div>
      <input type="hidden" name="categoryId" value="<?=$this->session->userdata('category')?>">
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