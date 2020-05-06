
	<div class="container">
    <div class="row justify-content-center my-5">
        <div class="card col-sm-5 mt-5 shadow mx-3 mb-2">
            <div class="card-body">
                <h3 class="card-title text-center my-4 mb-5">
                    Students Login
                </h3>
                <div class="text-danger"><?php if($error) echo $error?></div>
                <?php echo form_open(base_url().'students/login'); ?>
                    <div class="form-group">
                        <label for="username">Username(Roll no.)</label>
                        <input type="text" value="<?php if($username) echo $username?>" name="username" id="username" class="form-control" placeholder="eg: 172503113">
                    </div>
                    <div class="form-group">
                        <label for="password">Password(Date of birth)</label>
                        <input type="date" name="password" id="password" class="form-control">
                    </div>
                    <div class="text-right mt-5">
                        <a href="<?= base_url() ?>" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-success">Login</button>
                    </div>
                </form>
            </div>
          </div>
      </div>
  </div>