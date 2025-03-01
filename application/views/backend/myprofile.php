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

                <div class="col-6">
                  <div class="row mb-2">
                    <div class="col-md-3">
                      <label for="validationDefault01" class="form-label mt-2">Name</label>
                    </div>
                    <div class="col-md-4">
                      <span class="d-block p-2 text-primary border-bottom" id="name"><?=$record['name']?></span>
                    </div>
                  </div>
                  <div class="row mb-2">
                    <div class="col-md-3">
                      <label for="validationDefault02" class="form-label mt-2">Email</label>
                    </div>
                    <div class="col-md-4">
                      <span class="d-block p-2 text-primary border-bottom" id="email"><?=($record['email']=="")?"---":$record['email']?></span>
                    </div>
                  </div>
                  <div class="row mb-2">
                    <div class="col-md-3">
                      <label for="validationDefault03" class="form-label mt-2">Phone</label>
                    </div>
                    <div class="col-md-4">
                      <span class="d-block p-2 text-primary border-bottom" id="phone"><?=($record['phone']=="")?"---":$record['phone']?></span>
                    </div>
                  </div>
                  <div class="row mb-2">
                    <div class="col-md-3">
                      <label for="validationDefault04" class="form-label mt-2">Username</label>
                    </div>
                    <div class="col-md-4">
                      <span class="d-block p-2 text-primary border-bottom" id="subject"><?=$record['username']?></span>
                    </div>
                  </div>
                  <div class="row mb-2">
                    <div class="col-md-3">
                      <label for="validationDefault04" class="form-label mt-2">Role</label>
                    </div>
                    <div class="col-md-4">
                      <span class="d-block p-2 text-primary border-bottom" id="role"><?=$record['user_type']?></span>
                    </div>
                  </div>
                </div>
                
              </div>

              <div class="card-body">
                <div class="bg-white rounded mt-5">
                    <h4 class="h4 m-2">Change Password</h4>
                    <div class="row p-2 m-2">
                        <form class="form-control" id="update-password" method="POST" action="<?=base_url('admin/Myprofile/changepassword')?>">
                            <div class="col-2">
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
    </section>

  </main><!-- End #main -->

  