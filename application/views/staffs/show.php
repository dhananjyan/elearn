<div class="row">
	<div class="col-12 col-sm-10 float-left">
		<h4><?=$result['course']->name;?></h4>
		<p><?=$result['course']->description?></p>
	</div>
	<div class="col-12 col-sm-2 float-right">
		<b>Students joined: <?=$result['students']?></b>
	</div>
</div>
<div class="row mt-4">
	<div class="card col-12 shadow">
		<div class="card-body">
			<div class="card-text text-center text-info">
				<a href="#" data-toggle="modal" data-target="#addCourseModal" >Share something with your class...</a>
			</div>
		</div>
	</div>
</div>


<div class="row mt-4 share">
	<!-- <div class="card col-12 mt-4"><div class="card-body"><div class="card-text"><b>Posted a new material: '+element.title+'</b>('+element.createdAt+')</div><hr><div class="card-text pt-4"><a href="#" onclick="return getComments('+element.id+')">'+element.id+' class comments</a></div></div></div> -->
</div>






    <!-- The Modal -->
<div class="modal" id="addCourseModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Share with your class</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form name="postShare" id="postShare" method="post" action="<?=base_url()?>course/postShare">
      <!-- Modal body -->
      <div class="modal-body">
        <div class="col">
        <div class="form-group">
        	<label for="title">Title</label>
        	<input type="text" name="title" id="title" class="form-control" placeholder="eg: assignment, material or topic">
        </div>
      <div class="form-group">
        <label for="share">Share with your class</label>
        <textarea class="form-control" rows="6" name="share" id="share"></textarea>
      </div>
      <input type="hidden" name="courseId" id="courseId" value="<?=$result['course']->id;?>">
    </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
      <button type="reset" class="btn btn-secondary">Clear</button>
      <button type="submit" id="addUserSubmit" class="btn btn-primary">Post</button>
      </div>
      
    </form>

    </div>
  </div>
</div>   




    <!-- The Modal -->
<div class="modal" id="commentModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h6 class="modal-title">Class Comment</h6>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
      	<div class="row comment">
      		
      	</div>
<hr>
      	<form action="<?=base_url()?>staffs/postComment"  method="post" name="postComment" id="postComment">
      		<div class="form-group row">
      			<input  type="hidden" name="shareId" id="shareId">
      			<input type="hidden" name="username" id="username" value="<?=$this->session->userdata('username')?>">
      			<input required type="text" name="comment" class="form-control col-9">
      <button type="submit" id="addUserSubmit" class="btn btn-primary col-3">Post</button>
      		</div>
      </form>
      </div>


      

    </div>
  </div>
</div>   


<input type="hidden" id="base" value="<?php echo base_url(); ?>">