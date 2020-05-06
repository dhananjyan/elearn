<div class="row bg-dark">
	<div class="container">
		<div class="py-3 col-12">
			<h1 class="float-left text-white">Elearn</h1>
			<a href="#" data-toggle="modal" data-target="#joinClassModal" class="btn btn-success float-right"><b>Join Class</b></a>
		</div>
	</div>
</div>



    <!-- The Modal -->
<div class="modal" id="joinClassModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Join Class</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form  name="joinClass" id="joinClass" method="post" action="<?=base_url()?>students/joinClass">
      <!-- Modal body -->
      <div class="modal-body">
        <div class="col">
      <div class="form-group">
        <label for="name">Course code</label>
        <input required type="text" class="form-control" name="code" id="code" placeholder="eg: 57">
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

