<main id="main" class="main">

    <div class="pagetitle">
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item"><a href="<?=base_url('admin/Booings#')?>">Booings</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <div class="col-lg-12">

            <div class="card">
              <div class="card-body">
                <h5 class="card-title">New Booking</h5>
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

                <!-- Multi Columns Form -->
                <form class="row g-3" method="POST" action="<?=base_url('admin/Booings/save_record')?>">
                  <div class="col-md-8">
                      <div class="row mb-1">
                          <div class="col-md-3">
                              <label class="text-dark mb-1">Pickup date</label>
                              <input type="date" name="pickup_date" id="pickup_date" value="<?=date("Y-m-d", time())?>" class="form-control text-dark border w-100 rounded-2" placeholder="">
                          </div>
                          <div class="col-md-3">
                              <label class="text-dark mb-1">Time</label>
                              <select id="pickup_time" name="pickup_time" class="form-select">
                                <option value="07:30 AM">07:30 AM</option>
                                <option value="08:00 AM">08:00 AM</option>
                                <option value="08:30 AM">08:30 AM</option>

                                <option value="09:00 AM">09:00 AM</option>
                                <option value="09:30 AM">09:30 AM</option>
                                <option value="10:00 AM">10:00 AM</option>
                                <option value="10:30 AM">10:30 AM</option>
                                <option value="11:00 AM">11:00 AM</option>
                                <option value="11:30 AM">11:30 AM</option>
                                
                                <option value="12:00 AM">12:00 PM</option>
                                <option value="12:30 AM">12:30 PM</option>
                                <option value="01:00 PM">01:00 PM</option>
                                <option value="01:30 PM">01:30 PM</option>
                                <option value="02:00 AM">02:00 PM</option>
                                <option value="02:30 PM">02:30 PM</option>
                                <option value="03:00 PM">03:00 PM</option>
                                <option value="04:00 PM">04:00 PM</option>
                                <option value="04:30 PM">04:30 PM</option>
                                <option value="05:00 PM">05:00 PM</option>
                                <option value="05:30 PM">05:30 PM</option>
                                <option value="06:00 PM">06:00 PM</option>
                                <option value="06:30 PM">06:30 PM</option>
                                <option value="07:00 PM">07:00 PM</option>
                                <option value="07:30 PM">07:30 PM</option>
                                <option value="08:00 PM">08:00 PM</option>
                              </select>
                          </div>
                        <div class="col-md-3">
                            <label class="text-dark mb-1">Dropoff date</label>
                            <input type="date" name="dropoff_date" id="dropoff_date" value="<?=date("Y-m-d", time())?>" class="form-control text-dark border w-100 rounded-2" placeholder="">
                        </div>
                        <div class="col-md-3">
                            <label class="text-dark mb-1">Time</label>
                            <select id="dropoff_time" name="dropoff_time" class="form-select">
                              <option value="07:30 AM">07:30 AM</option>
                                <option value="08:00 AM">08:00 AM</option>
                                <option value="08:30 AM">08:30 AM</option>

                                <option value="09:00 AM">09:00 AM</option>
                                <option value="09:30 AM">09:30 AM</option>
                                <option value="10:00 AM">10:00 AM</option>
                                <option value="10:30 AM">10:30 AM</option>
                                <option value="11:00 AM">11:00 AM</option>
                                <option value="11:30 AM">11:30 AM</option>
                                
                                <option value="12:00 AM">12:00 PM</option>
                                <option value="12:30 AM">12:30 PM</option>
                                <option value="01:00 PM">01:00 PM</option>
                                <option value="01:30 PM">01:30 PM</option>
                                <option value="02:00 AM">02:00 PM</option>
                                <option value="02:30 PM">02:30 PM</option>
                                <option value="03:00 PM">03:00 PM</option>
                                <option value="04:00 PM">04:00 PM</option>
                                <option value="04:30 PM">04:30 PM</option>
                                <option value="05:00 PM">05:00 PM</option>
                                <option value="05:30 PM">05:30 PM</option>
                                <option value="06:00 PM">06:00 PM</option>
                                <option value="06:30 PM">06:30 PM</option>
                                <option value="07:00 PM">07:00 PM</option>
                                <option value="07:30 PM">07:30 PM</option>
                                <option value="08:00 PM">08:00 PM</option>
                            </select>
                        </div>
                      </div>
                      <div class="row mb-1">
                          <div class="col-md-3">
                              <label class="text-dark mb-1">Bike</label>
                              <select id="biketype" name="bie_type_id" class="form-select">
                                <option selected>-Select-</option>
                                <?php foreach($biketypes as $index => $row) {?>
                                <option value="<?=$index?>"><?=$row?></option>
                                <?php } ?>
                              </select>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-md-12 text-end">
                              <button id="search_bike" class="btn btn-primary" type="button">Search Now</button>
                          </div>
                      </div>
                      <div class="row">

                      </div>
                      <div class="text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                      </div>
                  </div>
                </form><!-- End Multi Columns Form -->

                
              </div>
            </div>
          
        </div>

      </div>
    </section>

  </main><!-- End #main -->

  <script type="text/javascript">

    $(document).ready(function(){

      $("#search_bike").click(function(){

        

      });

    });

  </script>