  <main id="main" class="main">

    <div class="pagetitle">
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item"><a href="<?=base_url('admin/Admin#')?>">Admin</a></li>
          <li class="breadcrumb-item active">My Profile</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">
        <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Your Basic Details</h5>
                <div class="d-inline showalert">
                  <?php 
                    $error = $this->session->flashdata('error');
                        if($error) { ?>
                    <div class="alert alert-danger">
                        <?php echo $this->session->flashdata('error'); ?>
                    </div>
                    <?php } ?>
                    <?php $success = $this->session->flashdata('success');
                        if($success) {
                    ?>
                    <div class="alert alert-success alert-dismissable">
                        <?php echo $this->session->flashdata('success'); ?>
                    </div>
                    <?php } ?>
                </div>

                <div class="col-4 p-2 m-1">
                  <table class="table table-bordered rounded">
                    <tbody>
                      <tr><th class="p-2 w-30">Name</th><td><?=$record['name']?></td></tr>
                      <tr><th class="p-2 w-30">Email</th><td><?=$record['email']?></td></tr>
                      <tr><th class="p-2 w-30">Phone</th><td><?=$record['phone']?></td></tr>
                      <tr><th class="p-2 w-30">Username</th><td><?=$record['username']?></td></tr>
                      <tr><th class="p-2 w-30">Role</th><td><?=$record['user_type']?></td></tr>
                    </tbody>
                  </table>
                </div>
              </div>

              <div class="card-body">
                <div class="bg-white rounded mt-2">
                    <h5 class="card-title">Change Password</h5>
                    <div class="row m-1">
                      <div class="col-md-4">
                        <form class="form-control" id="update-password" method="POST" action="<?=base_url('admin/Myprofile/changepassword')?>">
                            <div class="col-6">
                                <div class="input-field mb-2">
                                    <label for="cp">Current Password</label>
                                    <input type="password" class="form-control" autocomplete="off" id="cp" name="current_password" value="" required>
                                </div>
                                <div class="input-field mb-2">
                                    <label>New Password</label>
                                    <div class="meta-checkbox mt-1">
                                        <input type="password" class="form-control" autocomplete="off" name="new_password" value="" required>
                                    </div>
                                </div>
                                <div class="input-field mb-2">
                                    <label>Retype Password</label>
                                    <div class="meta-checkbox mt-1">
                                        <input type="password" class="form-control" autocomplete="off" name="retype_password" value="" required>
                                    </div>
                                </div>
                                <div class="input-field mt-4 mb-2">
                                    <button type="button" class="update-password btn btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
                      </div>
                    </div>
                </div>
              </div>

            </div>
          
        </div>

      </div>
    </section>

  </main><!-- End #main -->

  