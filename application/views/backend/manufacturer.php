  <main id="main" class="main">

    <div class="pagetitle">
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item"><a href="<?=base_url('admin/Bikes')?>">Bikes</a></li>
          <li class="breadcrumb-item active">Manufacturer</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <div class="col-lg-12">

            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Manufacturer <button type="button" data-bs-toggle="modal" data-bs-target="#disablebackdrop" class="btn btn-primary float-right">Add <i class="bi bi-plus-circle ms-1"></i></button></h5>
                <table class="table datatable table-hover table-sm">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Name</th>
                      <th scope="col">Position</th>
                      <th scope="col">Age</th>
                      <th scope="col">Start Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row">1</th>
                      <td>Brandon Jacob</td>
                      <td>Designer</td>
                      <td>28</td>
                      <td>2016-05-25</td>
                    </tr>
                    <tr>
                      <th scope="row">2</th>
                      <td>Bridie Kessler</td>
                      <td>Developer</td>
                      <td>35</td>
                      <td>2014-12-05</td>
                    </tr>
                    <tr>
                      <th scope="row">3</th>
                      <td>Ashleigh Langosh</td>
                      <td>Finance</td>
                      <td>45</td>
                      <td>2011-08-12</td>
                    </tr>
                    <tr>
                      <th scope="row">4</th>
                      <td>Angus Grady</td>
                      <td>HR</td>
                      <td>34</td>
                      <td>2012-06-11</td>
                    </tr>
                    <tr>
                      <th scope="row">5</th>
                      <td>Raheem Lehner</td>
                      <td>Dynamic Division Officer</td>
                      <td>47</td>
                      <td>2011-04-19</td>
                    </tr>
                  </tbody>
                </table>
                <!-- End small tables -->

              </div>
            </div>
          
        </div>

      </div>
    </section>

  </main><!-- End #main -->

  <div class="modal fade" id="disablebackdrop" tabindex="-1" data-bs-backdrop="false">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="add-manufacturer" method="POST">
            <div class="modal-header">
              <h5 class="modal-title">Add Manufacturer</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-md-6">
                  <label for="validationDefault01" class="form-label">Name</label>
                  <input type="text" class="form-control" name="manufacturer_name" id="validationDefault01" value="" required>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="submit">Submit</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </form>
      </div>
    </div>
  </div><!-- End Disabled Backdrop Modal-->

  