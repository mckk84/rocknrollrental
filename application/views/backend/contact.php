  <main id="main" class="main">

    <div class="pagetitle">
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item"><a href="<?=base_url('admin/Admin#')?>">Admin</a></li>
          <li class="breadcrumb-item active">Contact</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <div class="col-lg-12">

            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Contact</h5>
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
                      <th scope="col">Name</th>
                      <th scope="col">Email</th>
                      <th scope="col">Phone</th>
                      <th scope="col">Subject</th>
                      <th scope="col">Message</th>
                      <th scope="col">Added On</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($records as $index => $row) {?>
                    <tr>
                      <th scope="row"><?=$row['id']?></th>
                      <td><?=$row['name']?></td>
                      <td><?=$row['email']?></td>
                      <td><?=$row['phone']?></td>
                      <td><?=$row['subject']?></td>
                      <td><?=$row['message']?></td>
                      <td><?=date("d-m-Y h:m A", strtotime($row['created_date']))?></td>
                      <td><div class="d-flex justify-content-start">
                        <a title="View Record" href="javascript:void(0)" record-data="<?=$row['id']?>" class="view-contact-record text-warning float-right mx-2"><i class="bi bi-eye-fill"></i></a>
                        <?php if( isset($user['user_type']) && $user['user_type'] == 'Admin' ){?>
                        <a title="Delete Record" href="javascript:void(0)" record-data="<?=$row['id']?>" class="delete-record text-danger float-right mx-2"><i class="bi bi-trash-fill"></i></a>
                      <?php } ?>
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

  <div class="modal fade" id="view-contact" tabindex="-1" data-bs-backdrop="false">
    <div class="modal-dialog">
      <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Contact</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="viewcontact" class="modal-body">
              <div class="row mb-2">
                <div class="col-md-3">
                  <label for="validationDefault01" class="form-label mt-2">Name</label>
                </div>
                <div class="col-md-9">
                  <span class="d-block border bg-light p-2 rounded" id="name"></span>
                </div>
              </div>
              <div class="row mb-2">
                <div class="col-md-3">
                  <label for="validationDefault02" class="form-label mt-2">Email</label>
                </div>
                <div class="col-md-9">
                  <span class="d-block border bg-light p-2 rounded" id="email"></span>
                </div>
              </div>
              <div class="row mb-2">
                <div class="col-md-3">
                  <label for="validationDefault03" class="form-label mt-2">Phone</label>
                </div>
                <div class="col-md-9">
                  <span class="d-block border bg-light p-2 rounded" id="phone"></span>
                </div>
              </div>
              <div class="row mb-2">
                <div class="col-md-3">
                  <label for="validationDefault04" class="form-label mt-2">Subject</label>
                </div>
                <div class="col-md-9">
                  <span class="d-block border bg-light p-2 rounded" id="subject"></span>
                </div>
              </div>
              <div class="row mb-2">
                <div class="col-md-6">
                  <label for="validationDefault04" class="form-label mt-2">Message</label>
                </div>
                <div class="col-md-12">
                  <span class="d-block border bg-light p-2 rounded" style="min-height: 100px;overflow: auto;" id="message"></span>
                </div>
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </form>
      </div>
    </div>
  </div><!-- End Disabled Backdrop Modal-->

  