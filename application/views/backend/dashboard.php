  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard

        <span id="last_updated" class="d-inline small text-danger float-right p-1"></span>
      </h1>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">
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
        <!-- Left side columns -->
        <div class="col-lg-12 p-0">
          <div class="row">

            <!-- Pickup Card -->
            <div class="col-xl-3 col-md-3">
              <div class="card info-card pickup-card">
                <div id="today_bookings" class="card-body">
                  <h5 class="card-title">Pickups <span>| Today</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-box-arrow-up-right"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?=$today_pickups?></h6>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End Pickup Card -->

            <!-- Pickup Card -->
            <div class="col-xl-3 col-md-3">
              <div class="card info-card dropoff-card">
                <div id="today_bookings" class="card-body">
                  <h5 class="card-title">Dropoffs <span>| Today</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-box-arrow-in-down-left"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?=$today_dropoffs?></h6>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End Pickup Card -->

            <!-- Sales Card -->
            <div class="col-xl-3 col-md-3">
              <div class="card info-card sales-card">
                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>
                    <li><a class="dropdown-item" onclick="showdiv('sales-card','#today_bookings')" href="javascript:void(0)">Today</a></li>
                    <li><a class="dropdown-item" onclick="showdiv('sales-card','#week_bookings')" href="javascript:void(0)">This Week</a></li>
                    <li><a class="dropdown-item" onclick="showdiv('sales-card','#month_bookings')" href="javascript:void(0)">This Month</a></li>
                  </ul>
                </div>

                <div id="today_bookings" class="card-body">
                  <h5 class="card-title">Bookings <span>| Today</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-journal-check"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?=$today_bookings?></h6>
                    </div>
                  </div>
                </div>

                <div style="display: none;" id="week_bookings" class="card-body">
                  <h5 class="card-title">Bookings <span>| Week</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-journal-check"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?=$week_bookings?></h6>
                    </div>
                  </div>
                </div>

                <div style="display: none;" id="month_bookings" class="card-body">
                  <h5 class="card-title">Bookings <span>| Month</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-journal-check"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?=$month_bookings?></h6>
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            <!-- Customers Card -->
            <div class="col-xl-3 col-md-3">

              <div class="card info-card customers-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" onclick="showdiv('customers-card', '#today_customers')" href="javascript:void(0)">Today</a></li>
                    <li><a class="dropdown-item" onclick="showdiv('customers-card', '#week_customers')" href="javascript:void(0)">This Week</a></li>
                    <li><a class="dropdown-item" onclick="showdiv('customers-card', '#month_customers')" href="javascript:void(0)">This Month</a></li>
                  </ul>
                </div>

                <div id="today_customers" class="card-body">
                  <h5 class="card-title">Customers <span>| Today</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?=$today_customers?></h6>
                    </div>
                  </div>
                </div>

                <div style="display: none;" id="week_customers" class="card-body">
                  <h5 class="card-title">Customers <span>| This Week</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?=$week_customers?></h6>
                    </div>
                  </div>
                </div>

                <div style="display: none;" id="month_customers" class="card-body">
                  <h5 class="card-title">Customers <span>| This Month</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?=$month_customers?></h6>
                    </div>
                  </div>
                </div>

              </div>

            </div><!-- End Customers Card -->

            <!-- Recent Sales -->
            <div class="col-6">
              <div class="card recent-sales overflow-auto">
                <div class="card-body">
                  <h5 class="card-title px-2 mb-0">Pre Booked</h5>
                  <table class="table table-bordered  text-center small">
                    <thead>
                      <tr>
                        <th class="bg-success-light" scope="col">#</th>
                        <th class="bg-success-light" scope="col">Bikes</th>
                        <th class="bg-success-light" scope="col">Customer</th>
                        <th class="bg-success-light" scope="col">From</th>
                        <th class="bg-success-light" scope="col">To</th>
                        <th class="bg-success-light" scope="col">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach($records as $index => $row) {

                        $early_pickup = $row['early_pickup'];
                        $bikes_ordered = "";
                        $bk = explode(",", $row['bikes_types']);
                        $bk_qty = explode(",", $row['bikes_qty']);
                        $bikes_ordered = array();
                        $bikes_order = "";

                        foreach($bk as $index => $bky)
                        {
                          if( isset( $bikes_ordered[ $biketypes[$bky] ] ) )
                          {
                            $bikes_ordered[ $biketypes[$bky] ] = $bikes_ordered[ $biketypes[$bky] ] + $bk_qty[$index];
                          }
                          else
                          {
                            $bikes_ordered[ $biketypes[$bky] ] = $bk_qty[$index];
                          }
                        }

                        foreach($bikes_ordered as $name => $qty)
                        {
                          $bikes_order .= ( $bikes_order == "" ) ? $name."(<b>".$qty."</b>)" : "<br/>".$name."(<b>".$qty."</b>)";
                        }

                        if( isset($row['free_helmet']) && $row['free_helmet'] > 0 )
                        {
                          $bikes_order .= "<br/>Free Helmet(<b>".$row['free_helmet']."</b>)";
                        }
                        if( isset($row['helmet_quantity']) && $row['helmet_quantity'] > 0 )
                        {
                          $bikes_order .= "<br/>Helmet(<b>".$row['helmet_quantity']."</b>)";
                        }
                        ?>
                      <tr>
                        <td><a title="View Record" href="<?=base_url('admin/Bookings/view?bid='.$row['id'])?>" ><?=$row['id']?></a></td>
                        <td><?=$bikes_order?></td>
                        <td><?=$row['name']?><br/><?=$row['phone']?></td>
                        <td><?=date("d-m-Y", strtotime($row['pickup_date']))?><br/><?=$row['pickup_time']?></td>
                        <td><?=date("d-m-Y", strtotime($row['dropoff_date']))?><br/><?=$row['dropoff_time']?></td>
                        <td><?php if( $row['status'] == 0) { ?>
                          <span class="d-block mx-auto mb-1 py-2 badge bg-warning">Pre Booked</span>
                          <?php if($user['user_type'] == "Admin"){?>
                          <a title="Edit Order" href="javascript:void(0)" record-data="<?=$row['id']?>" class="superedit-booking-record py-1 px-2 text-warning"><i class="bi bi-pencil-square me-1"></i></a>
                          <?php } else { ?>
                          <a title="Edit Order" href="javascript:void(0)" record-data="<?=$row['id']?>" class="edit-booking-record py-1 px-2 text-warning"><i class="bi bi-pencil-square me-1"></i></a>
                          <?php } ?>
                          <?php if($user['user_type'] == "Admin"){?>
                            <a title="Cancel Order" href="javascript:void(0)" record-data="<?=$row['id']?>" class="cancel-booking-record py-1 px-2 text-danger"><i class="bi bi-x-square me-1"></i></a>
                          <?php } ?>
                        <?php } else if($row['status'] == 1) { ?>
                          <span class="d-block mx-auto mb-1 py-2 badge bg-success">Rented</span>
                          <?php if($user['user_type'] == "Admin"){?>
                          <a title="Edit Order" href="javascript:void(0)" record-data="<?=$row['id']?>" class="superedit-booking-record py-1 px-2 text-warning"><i class="bi bi-pencil-square me-1"></i></a>
                          <?php } else { ?>
                          <a title="Edit Order" href="javascript:void(0)" record-data="<?=$row['id']?>" class="edit-booking-record py-1 px-2 text-warning"><i class="bi bi-pencil-square me-1"></i></a>
                          <?php } ?>
                        <?php } else { ?>
                          <span class="d-block mx-auto mb-1 py-2 badge bg-info">Closed</span>
                        <?php } ?>
                        </td>
                      </tr>
                       <?php } ?>
                    </tbody>
                  </table>  
                </div>

              </div>
            </div><!-- End Recent Sales -->

            <!-- Recent Sales -->
            <div class="col-6">
              <div class="card recent-sales overflow-auto">
                <div class="card-body">
                  <h5 class="card-title px-2 mb-0">Returns Today</h5>
                  <table class="table table-bordered text-center small">
                    <thead>
                      <tr>
                        <th class="bg-warning-light" scope="col">#</th>
                        <th class="bg-warning-light" scope="col">Bikes</th>
                        <th class="bg-warning-light" scope="col">Customer</th>
                        <th class="bg-warning-light" scope="col">From</th>
                        <th class="bg-warning-light" scope="col">To</th>
                        <th class="bg-warning-light" scope="col">Late By</th>
                        <th class="bg-warning-light" scope="col">Action</th>   
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach($returns as $index => $row) {

                        $early_pickup = $row['early_pickup'];
                        $bikes_ordered = "";
                        $bk = explode(",", $row['bikes_types']);
                        $bk_qty = explode(",", $row['bikes_qty']);
                        $bikes_ordered = array();
                        $bikes_order = "";

                        foreach($bk as $index => $bky)
                        {
                          if( isset( $bikes_ordered[ $biketypes[$bky] ] ) )
                          {
                            $bikes_ordered[ $biketypes[$bky] ] = $bikes_ordered[ $biketypes[$bky] ] + $bk_qty[$index];
                          }
                          else
                          {
                            $bikes_ordered[ $biketypes[$bky] ] = $bk_qty[$index];
                          }
                        }

                        foreach($bikes_ordered as $name => $qty)
                        {
                          $bikes_order .= ( $bikes_order == "" ) ? $name."(<b>".$qty."</b>)" : "<br/>".$name."(<b>".$qty."</b>)";
                        }

                        if( isset($row['helmet_quantity']) && $row['helmet_quantity'] > 0 )
                        {
                          $bikes_order .= "<br/>Helmet(<b>".$row['helmet_quantity']."</b>)";
                        }
                        $d1= new DateTime(date("Y-m-d h:i A")); // first date
                        $d2= new DateTime($row['dropoff_date']." ".$row['dropoff_time']); // second date
                        $interval= $d1->diff($d2); 
                        $row['late_by'] = $interval->days." Days, ".$interval->h." Hours"; 
                        ?>
                      <tr>
                        <td><a title="View Record" href="<?=base_url('admin/Bookings/view?bid='.$row['id'])?>" class="mx-2"><?=$row['id']?></a></td>
                        <td><?=$bikes_order?></td>
                        <td><?=$row['name']?><br/><?=$row['phone']?></td>
                        <td><?=date("d-m-Y", strtotime($row['pickup_date']))?><br/><?=$row['pickup_time']?></td>
                        <td><?=date("d-m-Y", strtotime($row['dropoff_date']))?><br/><?=$row['dropoff_time']?></td>
                        <td><?=$row['late_by']?></td>
                        <td>
                          <a title="Send Reminder in Whatsapp" class="btn btn-sm text-success" target="_blank" href="<?=base_url('admin/Bookings/whatsapp_reminder?bid='.$row['id'])?>"><i class="bi bi-whatsapp"></i></a>
                          <?php if($user['user_type'] == "Admin"){?>
                          <a title="Edit Order" href="javascript:void(0)" record-data="<?=$row['id']?>" class="superedit-booking-record text-warning py-1 px-2"><i class="bi bi-pencil-square me-1"></i></a>
                          <?php } else { ?>
                          <a title="Edit Order" href="javascript:void(0)" record-data="<?=$row['id']?>" class="edit-booking-record py-1 px-2 text-warning"><i class="bi bi-pencil-square me-1"></i></a>
                          <?php } ?>
                        </td>
                      </tr>
                       <?php } ?>
                    </tbody>
                  </table>  
                </div>

              </div>
            </div><!-- End Recent Sales -->

          </div>
        </div><!-- End Left side columns -->
        <!-- Left side columns -->
        <div class="col-lg-12 p-0">
          <div class="row">

            <!-- Recent Sales -->
            <div class="col-6">
              <div class="card recent-sales overflow-auto">
                <div class="card-body">
                  <h5 class="card-title px-2 mb-0">Late Pickups</h5>
                  <table class="table table-bordered text-center small">
                    <thead>
                      <tr>
                        <th class="bg-danger-light" scope="col">#</th>
                        <th class="bg-danger-light" scope="col">Bikes</th>
                        <th class="bg-danger-light" scope="col">Customer</th>
                        <th class="bg-danger-light" scope="col">From</th>
                        <th class="bg-danger-light" scope="col">To</th>  
                        <th class="bg-danger-light" scope="col">Late By</th>  
                        <th class="bg-danger-light" scope="col">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach($late_pickups as $index => $row) {

                        $early_pickup = $row['early_pickup'];
                        $bikes_ordered = "";
                        $bk = explode(",", $row['bikes_types']);
                        $bk_qty = explode(",", $row['bikes_qty']);
                        $bikes_ordered = array();
                        $bikes_order = "";

                        foreach($bk as $index => $bky)
                        {
                          if( isset( $bikes_ordered[ $biketypes[$bky] ] ) )
                          {
                            $bikes_ordered[ $biketypes[$bky] ] = $bikes_ordered[ $biketypes[$bky] ] + $bk_qty[$index];
                          }
                          else
                          {
                            $bikes_ordered[ $biketypes[$bky] ] = $bk_qty[$index];
                          }
                        }

                        foreach($bikes_ordered as $name => $qty)
                        {
                          $bikes_order .= ( $bikes_order == "" ) ? $name."(<b>".$qty."</b>)" : "<br/>".$name."(<b>".$qty."</b>)";
                        }

                        if( isset($row['free_helmet']) && $row['free_helmet'] > 0 )
                        {
                          $bikes_order .= "<br/>Free Helmet(<b>".$row['free_helmet']."</b>)";
                        }
                        if( isset($row['helmet_quantity']) && $row['helmet_quantity'] > 0 )
                        {
                          $bikes_order .= "<br/>Helmet(<b>".$row['helmet_quantity']."</b>)";
                        }

                        $d1= new DateTime(date("Y-m-d h:i A")); // first date
                        $d2= new DateTime($row['pickup_date']." ".$row['pickup_time']); // second date
                        $interval= $d1->diff($d2); 
                        $row['late_by'] = $interval->days." Days, ".$interval->h." Hours"; 

                        ?>
                      <tr>
                        <td><a title="View Record" href="<?=base_url('admin/Bookings/view?bid='.$row['id'])?>" ><?=$row['id']?></a></td>
                        <td><?=$bikes_order?></td>
                        <td><?=$row['name']?><br/><?=$row['phone']?></td>
                        <td><?=date("d-m-Y", strtotime($row['pickup_date']))?><br/><?=$row['pickup_time']?></td>
                        <td><?=date("d-m-Y", strtotime($row['dropoff_date']))?><br/><?=$row['dropoff_time']?></td>
                        <td><?=$row['late_by']?></td>
                        <td><?php if( $row['status'] == 0) { ?>
                          <span class="d-block mx-auto mb-1 py-2 badge bg-warning">Pre Booked</span>
                          <?php if($user['user_type'] == "Admin"){?>
                          <a title="Edit Order" href="javascript:void(0)" record-data="<?=$row['id']?>" class="superedit-booking-record text-warning py-1 px-2"><i class="bi bi-pencil-square me-1"></i></a>
                          <?php } else { ?>
                          <a title="Edit Order" href="javascript:void(0)" record-data="<?=$row['id']?>" class="edit-booking-record text-warning py-1 px"><i class="bi bi-pencil-square me-1"></i></a>
                          <?php } ?>
                          <?php if($user['user_type'] == "Admin"){?>
                            <a title="Cancel Order" href="javascript:void(0)" record-data="<?=$row['id']?>" class="cancel-booking-record text-danger py-1 px-2"><i class="bi bi-x-square me-1"></i></a>
                          <?php } ?>
                        <?php } else if($row['status'] == 1) { ?>
                          <span class="d-block mx-auto bg-success">Rented</span>
                          <?php if($user['user_type'] == "Admin"){?>
                          <a title="Edit Order" href="javascript:void(0)" record-data="<?=$row['id']?>" class="superedit-booking-record text-warning py-1 px-2"><i class="bi bi-pencil-square me-1"></i></a>
                          <?php } else { ?>
                          <a title="Edit Order" href="javascript:void(0)" record-data="<?=$row['id']?>" class="edit-booking-record text-warning py-1 px"><i class="bi bi-pencil-square me-1"></i></a>
                          <?php } ?>
                        <?php } else { ?>
                          <span class="d-block mx-auto mb-1 py-2 badge bg-info">Closed</span>
                        <?php } ?>
                        </td>
                      </tr>
                       <?php } ?>
                    </tbody>
                  </table>  
                </div>

              </div>
            </div><!-- End Recent Sales -->

            <!-- Recent Sales -->
            <div class="col-6">
              
            </div><!-- End Recent Sales -->

          </div>
        </div><!-- End Left side columns -->

      </div>
    </section>

  </main><!-- End #main -->
  <script type="text/javascript">

    function diff_hours(dt2, dt1) 
    {
      var diff =(dt2.getTime() - dt1.getTime()) / 1000;
      var hrs = diff / (60 * 60);
      var min = diff / (60 * 60 * 60);
      var sec = diff / (60 * 60 * 60 * 60);
      if( min > 0 )
      {
        if( Math.abs(Math.round(hrs)) > 0 ){
          return Math.abs(Math.round(hrs))+" hrs,"+Math.abs(Math.round(min))+" mins ago";
        }else{
          return Math.abs(Math.round(min))+" mins ago";
        }
      }
      else
      {
        return "";
      }
    }

    function formatDate(date) {
      var year = date.getFullYear().toString();
      var month = (date.getMonth() + 101).toString().substring(1);
      var day = (date.getDate() + 100).toString().substring(1);
      var hrs = date.getHours();
      var min = date.getMinutes();
      var sec = date.getSeconds();
      return year + "-" + month + "-" + day + " "+hrs+":"+min+":"+sec;
    }


    function showdiv(eleparent, ele)
    {
        $("."+eleparent+" .card-body").each(function(){
          $(this).hide();
        });
        $(ele).show();
    }

    function showdifftime()
    {
      var last_updated = '<?=$last_update?>';
      console.log(last_updated);
      
      var now = formatDate(new Date());
      console.log(now);

      var diff = diff_hours(new Date(last_updated), new Date(now));
      $('#last_updated').html(diff);
    }

    $(document).ready(function(){

      setInterval(function(){
        showdifftime();
      }, 5000)
      
    });

  </script>

  