    <div class="row justify-content-center">
        <div class="card col-sm-7 mt-5 shadow mx-3 mb-2">
            <div class="card-body">
                <h3 class="card-title text-center">
                    Register Form
                </h3>
                <?php echo form_open('users/staffRegister', array(
                  'onSubmit' => 'return validate()'
                )); ?>

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input required type="text" name="name" id="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="mobileNo">Contact No</label>
                        <input required type="text" maxlength="10" minlength="10" name="mobileNo" id="mobileNo" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email">Mail ID</label>
                        <input required type="email" name="email" id="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="categoryId">Select Category</label>
                        <select class="form-control" name="categoryId" id="categoryId">
                          <option value="select">Select..</option>
                            <?php foreach ($categories as $category) {?>
                              <option value="<?= $category->id?>"><?= $category->name?></option>
                            <?php }?>
                        </select> 
                    </div>
                    <a href="<?= base_url() ?>" class="btn btn-secondary">Cancel</a>
                    <button type="reset" class="btn btn-info">Reset</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
          </div>
      </div>
    </div>
    <script type="text/javascript">
      function validate() {
        if(document.getElementById("categoryId").value=="select")
        {
        alert ( "Please select category!");
        return false;
        }
        return true;
    }
    </script>