  <main id="main" class="main">

    <div class="pagetitle">
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item"><a href="<?=base_url('admin/Admin#')?>">Admin</a></li>
          <li class="breadcrumb-item active">Settings</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <div class="col-lg-12">

            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Settings</h5>
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
                <form method="POST" action="<?=base_url('admin/Settings/update')?>">
                  <table class="w-50 table table-sm">
                    <thead>
                      <tr>
                        <th scope="col">Parameter Name</th>
                        <th scope="col">Value</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $row = $records[0];
                        $last_updated = date("Y-m-d");
                        foreach($row as $column => $value) {
                        if( $column == "updated_date" )
                        {
                          $last_updated = $value;
                        }
                        elseif($column == 'id'){
                          $record_id = $value;
                        }
                        else{
                          $column1 = explode("_", $column);
                          $column = implode(" ", $column1);
                       ?> 
                        <tr>
                        <td><?=strtoupper($column)?></td>
                        <td><input type="text" class="form-control" name="<?=$column?>" value="<?=$value?>" /></td>
                        </tr>
                       <?php } } ?>
                    </tbody>
                  </table>
                  <input type="hidden" name="id" value="<?=$record_id?>">   
                  <button type="submit" class="btn btn-primary">Update</button>     
                  <?php } ?>
                </form>
              </div>
            </div>
          
        </div>

      </div>
    </section>

  </main><!-- End #main -->

  