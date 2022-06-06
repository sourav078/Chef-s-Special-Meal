
<?php require 'd_header.php' ?>

<!-- ########## START: LEFT PANEL ########## -->
<?php require 'd_leftpanel.php' ?>
<!-- ########## END: LEFT PANEL ########## -->

<!-- ########## START: HEAD PANEL ########## -->
<?php require 'd_headpanel.php' ?>
<!-- ########## END: HEAD PANEL ########## -->

<?php 
  require 'custom_function.php';
  $users = fetch_all_data_usingDB_count($db, "SELECT count(*) FROM user where user_type = 'USER'");
  $sellers = fetch_all_data_usingDB_count($db, "SELECT count(*) FROM user where user_type = 'SELLER'");
  $food_post = fetch_all_data_usingDB_count($db, "SELECT count(*) FROM post where status = 1 or status = 0");

  $blog_post = fetch_all_data_usingDB_count($db, "SELECT count(*) FROM blog where status = 1 or status = 0");

?>
    

  <!-- ########## START: MAIN PANEL ########## -->
  <div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="index.php">Home Food</a>
      <span class="breadcrumb-item active">Dashboard</span>
    </nav>

    <div class="sl-pagebody"><!-- MAIN CONTENT -->
      
    <div class="row row-sm">
          <div class="col-sm-6 col-xl-3">
            <div class="card pd-20 bg-primary">
              <div class="d-flex justify-content-between align-items-center mg-b-10">
                <h3 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">Total Users</h3>
                
              </div><!-- card-header -->
              <div class="d-flex align-items-center justify-content-between">
               
                <h3 class="mg-b-0 tx-white tx-lato tx-bold"><?=  $users ?></h3>
              </div><!-- card-body -->
              <div class="d-flex align-items-center justify-content-between mg-t-15 bd-t bd-white-2 pd-t-10">
                
                
              </div><!-- -->
            </div><!-- card -->
          </div><!-- col-3 -->
         
          <div class="col-sm-6 col-xl-3">
            <div class="card pd-20 bg-success">
              <div class="d-flex justify-content-between align-items-center mg-b-10">
                <h3 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">Total Sellers</h3>
                
              </div><!-- card-header -->
              <div class="d-flex align-items-center justify-content-between">
               
                <h3 class="mg-b-0 tx-white tx-lato tx-bold"><?= $sellers ?></h3>
              </div><!-- card-body -->
              <div class="d-flex align-items-center justify-content-between mg-t-15 bd-t bd-white-2 pd-t-10">              
                
              </div><!-- -->
            </div><!-- card -->
          </div><!-- col-3 -->


          <div class="col-sm-6 col-xl-3">
            <div class="card pd-20 bg-purple">
              <div class="d-flex justify-content-between align-items-center mg-b-10">
                <h3 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">Total Food Post</h3>
                
              </div><!-- card-header -->
              <div class="d-flex align-items-center justify-content-between">
               
                <h3 class="mg-b-0 tx-white tx-lato tx-bold"><?= $food_post ?></h3>
              </div><!-- card-body -->
              <div class="d-flex align-items-center justify-content-between mg-t-15 bd-t bd-white-2 pd-t-10">              
                
              </div><!-- -->
            </div><!-- card -->
          </div><!-- col-3 -->

          <div class="col-sm-6 col-xl-3">
            <div class="card pd-20 bg-orange">
              <div class="d-flex justify-content-between align-items-center mg-b-10">
                <h3 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">Total Blog Post</h3>
                
              </div><!-- card-header -->
              <div class="d-flex align-items-center justify-content-between">
               
                <h3 class="mg-b-0 tx-white tx-lato tx-bold"><?= $blog_post ?></h3>
              </div><!-- card-body -->
              <div class="d-flex align-items-center justify-content-between mg-t-15 bd-t bd-white-2 pd-t-10">              
                
              </div><!-- -->
            </div><!-- card -->
          </div><!-- col-3 -->
         
    </div><!-- row -->
    </div><!-- sl-pagebody --><!-- END MAIN CONTENT -->


  <?php require 'd_footer.php' ?>
  </div><!-- sl-mainpanel -->
  <!-- ########## END: MAIN PANEL ########## -->

  <?php require 'd_javascript.php' ?>
  </body>
</html>
