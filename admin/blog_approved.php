<?php require 'd_header.php' ?>

<!-- ########## START: LEFT PANEL ########## -->
<?php require 'd_leftpanel.php' ?>
<!-- ########## END: LEFT PANEL ########## -->

<!-- ########## START: HEAD PANEL ########## -->
<?php require 'd_headpanel.php' ?>
<!-- ########## END: HEAD PANEL ########## -->

<?php 
  
    require 'custom_function.php';
   
    $blog_list = fetch_all_data_usingPDO($pdo,"select * from blog where status = 1 ORDER BY blog_id DESC");

?> 

  <!-- ########## START: MAIN PANEL ########## -->
  <div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="index.php">Home Food</a>
      <span class="breadcrumb-item active">Blog List</span>
    </nav>

    <div class="sl-pagebody"><!-- MAIN CONTENT -->
    <?php

        if(isset($_GET['update']))
        {
        ?>

        <div class="alert alert-success alert-dismissible" style="height: 50px;">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        Post Approved Successfully!
        </div>
        <?php 
        }
        ?>


        <?php

        if(isset($_GET['delete']))
        {
        ?>

        <div class="alert alert-danger alert-dismissible" style="height: 50px;">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        Post Deleted Successfully!
        </div>
        <?php 
        }
        ?>

      <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">Blog Details</h6>
          
         
          <div class="table-wrapper">
            <table id="myTable" class="table display responsive nowrap">
              <thead>
                <tr>
                  <th >SL</th>
                  <th >Title</th>
                  <th >Image</th>
                  <th >User</th>                               
                  <th >Views</th>                               
                  <th >Likes</th>                               
                  <th >Created At</th>

                 

                  
                </tr>
              </thead>
              <tbody>
                
                <?php

                    foreach ($blog_list as $key => $data) {
                ?>
                    <tr>
                      <td><?php echo $key+1; ?></td>
                      <td><?php echo $data['title']; ?></td>
                      <td><img src="<?= "../".$data['image'] ?>" style="max-width: 100px;" alt="img"></td>

                     

                      <td>
                        <?php 
                            $seller = fetch_all_data_usingDB($db,"select * from user where id = '".$data['user_id']."'");

                            echo $seller['name'];
                        ?>
                      </td>
                      <td><?php echo $data['view']; ?></td>
                      <td><?php echo $data['liked']; ?></td>

                      
                      <td>
                        <?php
                          $date = date("d M, Y", strtotime($data['created_at']));
                          echo $date;
                        ?>
                      </td>
                     


                    </tr>
                <?php
                    }

                ?>
               
                
               
              </tbody>
            </table>
          </div><!-- table-wrapper -->
        </div>    

      
    </div><!-- sl-pagebody --><!-- END MAIN CONTENT -->


  <?php require 'd_footer.php' ?>
  </div><!-- sl-mainpanel -->
  <!-- ########## END: MAIN PANEL ########## -->

  <?php require 'd_javascript.php' ?>


   <script>
    $('#myTable').DataTable({
    bLengthChange: true,
    searching: true,
    responsive: true
  });
  </script>
  </body>
</html>
