  <main id="main" class="main">

    <div class="pagetitle">
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?=base_url('admin')?>">Home</a></li>
          <li class="breadcrumb-item active">Reports</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <div class="col-lg-12">

            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Reports</h5>
                <div class="w-80">
                  <form method="GET" class="row" action="">
                  <div class="col-md-3">
                    <label class="p-1 m-1 fw-bold d-inline px-2 me-2">Booking Status:</label>
                      <select class="w-50 d-inline form-select" name="status">
                        <option <?=((isset($status) && $status == "")?"selected":"")?> value="">--All--</option>
                        <option <?=((isset($status) && $status == 0)?"selected":"")?> value="0">Pre Booked</option>
                        <option <?=((isset($status) && $status == 1)?"selected":"")?> value="1">Rented</option>
                        <option <?=((isset($status) && $status == 2)?"selected":"")?> value="2">Closed</option>
                        <option <?=((isset($status) && $status == 3)?"selected":"")?> value="3">Cancelled</option></select>
                  </div>
                  <div class="col-md-5">
                      <label class="p-1 m-1 fw-bold d-inline px-2 me-2">Date Range:</label>
                      <input class="w-70 d-inline form-control" type="text" name="daterange" value="<?=((isset($daterange) && $daterange != "")?$daterange:"")?>" />
                  </div>
                  <div class="col-md-2">
                    <button type="submit" class="btn btn-sm btn-primary">Search</button>
                  </div>
                  </form>
                </div>
                <div class="d-inline showalert">
                  <?php $error = $this->session->flashdata('error');
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
                
                
              </div>
            </div>
          
        </div>
      </div>
    </section>
  </main><!-- End #main -->
  
<script type="text/javascript">

$(function() 
{
    $('input[name="daterange"]').daterangepicker({
      "timePicker": true,
      "locale": {
          "cancelLabel": 'Clear',
          "format": "YYYY-MM-DD HH:mm:ss",
          "startDate": "2025-01-01",
      },
      "opens": 'right'
    }, function(start, end, label) {
      console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
    });

    $('input[name="daterange"]').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });

});

$("document").ready(function(){

  $(".datatable-search").hide();
  <?php if(isset($daterange) && $daterange == ""){?>
    $('input[name="daterange"]').val('')
  <?php } ?>

});

</script>