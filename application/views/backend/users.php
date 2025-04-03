  <main id="main" class="main">

    <div class="pagetitle">
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?=base_url('admin')?>">Home</a></li>
          <li class="breadcrumb-item"><a href="<?=base_url('admin/Admin#')?>">Admin</a></li>
          <li class="breadcrumb-item active">Users</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <div class="col-lg-12">

            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Users <button type="button" id="add_user" class="btn btn-sm btn-primary float-right">Add <i class="bi bi-plus-circle ms-1"></i></button></h5>
                <div class="d-inline showalert">
                  <?php if( count($records) == 0 ) { ?>
                  <div class="alert alert-danger m-2">No Records found.</div>
                  <?php } else { 

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
                <table class="table datatable table-hover table-sm">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Username</th>
                      <th scope="col">Name</th>
                      <th scope="col">Email</th>
                      <th scope="col">Phone</th>
                      <th scope="col">Type</th>
                      <th scope="col">Added On</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($records as $index => $row) {?>
                    <tr>
                      <th scope="row"><?=$row['userId']?></th>
                      <td><?=$row['username']?></td>
                      <td><?=$row['name']?></td>
                      <td><?=$row['email']?></td>
                      <td><?=$row['phone']?></td>
                      <td><?=$row['user_type']?></td>
                      <td><?=date("d-m-Y h:m A", strtotime($row['created_date']))?></td>
                      <td><div class="d-flex justify-content-center">
                        <a title="Edit Record" href="javascript:void(0)" record-data="<?=$row['userId']?>" class="edit-user-record text-warning float-right mx-2"><i class="bi bi-pencil-fill"></i></a>
                        <a title="Delete Record" href="javascript:void(0)" record-data="<?=$row['userId']?>" class="delete-record text-danger float-right mx-2"><i class="bi bi-trash-fill"></i></a>
                      </div></td>
                    </tr>
                     <?php } ?>
                  </tbody>
                </table>                
                <?php } ?>
              </div>
            </div>
          
        </div>

      </div>
    </section>

  </main><!-- End #main -->

  <div class="modal fade" id="add-user" tabindex="-1" data-bs-backdrop="false">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="adduser" action="<?=base_url('admin/Users/save_record')?>" method="POST">
            <input type="hidden" name="record_id" value="">
            <div class="modal-header">
              <h5 class="modal-title">Add User</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-6">
                      <label for="validationDefault01" class="form-label">Name</label>
                      <input type="text" class="form-control" name="name" id="validationDefault01" value="" required>
                    </div>
                    <div class="col-md-6">
                      <label for="validationDefault02" class="form-label">Email</label>
                      <input type="text" class="form-control" name="email" id="validationDefault02" value="" required>
                    </div>
                  </div>
                </div>
                <div class="col-md-12 mt-4">
                  <div class="row">
                    <div class="col-md-6">
                      <label for="validationDefault03" class="form-label">Phone</label>
                      <input type="number" maxlength="10" class="form-control" name="phone" id="validationDefault03" value="" required>
                    </div>
                    <div class="col-md-6">
                      <label for="validationDefault07" class="form-label">User Type</label>
                      <select name="user_type" class="form-select">
                        <option value="" selected>-Select-</option>
                        <option value="Admin">Admin</option>
                        <option value="Staff">Staff</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-md-12 mt-4">
                  <div class="row">
                    <div class="col-md-6">
                      <label for="validationDefault04" class="form-label">Username</label>
                      <input type="text" class="form-control" name="username" id="validationDefault04" value="" required>
                    </div>
                    <div class="col-md-6">
                      <label for="validationDefault05" class="form-label">Password</label>
                      <input type="password" class="form-control" name="password" id="validationDefault05" value="" required>
                    </div>
                  </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="submituser" type="button">Submit</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </form>
      </div>
    </div>
  </div><!-- End Disabled Backdrop Modal-->

  