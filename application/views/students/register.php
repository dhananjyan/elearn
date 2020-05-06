   
  <div class="container">
    <div class="row justify-content-center">
        <div class="card col-sm-7 mt-5 shadow mx-3 mb-2">
            <div class="card-body">
                <h3 class="card-title text-center">
                    Register Form
                </h3>
                <div class="py-4 error"><?=$error?></div>
                <?php echo form_open('students/register', array('id' => 'studentRegister' )); ?>

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="dateOfBirth">Date Of Birth</label>
                        <input type="date" name="dateOfBirth" id="dateOfBirth" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select class="form-control" name="gender" id="gender">
                          <option value="select" >Choose Option</option>
                          <option value="Female" >Female</option>
                          <option value="Male" >Male</option>
                          <option value="Others" >Others</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="rollNo">Roll No</label>
                        <input type="text" name="rollNo" id="rollNo" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="yearOfPassing">Year Of Passing</label>
                        <input maxlength="4" type="number" name="yearOfPassing" id="yearOfPassing" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="contactNo">Contact No</label>
                        <input type="text"maxlength="10" name="contactNo" id="contactNo" class="form-control">
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
                    <div class="form-group">
                        <label for="mailId">Mail ID</label>
                        <input type="email" name="mailId" id="mailId" class="form-control">
                    </div>
                    <a href="<?= base_url() ?>" class="btn btn-secondary">Cancel</a>
                    <button type="reset" class="btn btn-info">Reset</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
          </div>
      </div>
    </div>
  </div>
