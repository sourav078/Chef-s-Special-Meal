<?php require 'd_header.php' ?>

<!-- ########## START: LEFT PANEL ########## -->
<?php require 'd_leftpanel.php' ?>
<!-- ########## END: LEFT PANEL ########## -->

<!-- ########## START: HEAD PANEL ########## -->
<?php require 'd_headpanel.php' ?>
<!-- ########## END: HEAD PANEL ########## -->

<?php 
  
    require 'custom_function.php';
   
    $post_list = fetch_all_data_usingPDO($pdo,"select * from post where status = 0 ORDER BY post_id DESC");

?> 

  <!-- ########## START: MAIN PANEL ########## -->
  <div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="index.php">Home Food</a>
      <span class="breadcrumb-item active">Post List</span>
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
          <h6 class="card-body-title">Post Details</h6>
          
         
          <div class="table-wrapper">
            <table id="myTable" class="table display responsive nowrap">
              <thead>
                <tr>
                  <th >SL</th>
                  <th >Title</th>
                  <th >Image</th>
                  <th >Seller</th>
                  <th >Price</th>                  
                  <th >Created At</th>
                  <th >Action</th>
                 

                  
                </tr>
              </thead>
              <tbody>
                
                <?php

                    foreach ($post_list as $key => $data) {
                ?>
                    <tr>
                      <td><?php echo $key+1; ?></td>
                      <td><?php echo $data['title']; ?></td>
                      <td><img src="<?= "../".$data['image'] ?>" style="max-width: 100px;" alt="img"></td>

                     

                      <td>
                        <?php 
                            $seller = fetch_all_data_usingDB($db,"select * from user where id = '".$data['seller_id']."'");

                            echo $seller['name'];
                        ?>
                      </td>
                      <td><?php echo $data['price']; ?></td>
                      <td>
                        <?php
                          $date = date("d M, Y", strtotime($data['created_at']));
                          echo $date;
                        ?>
                      </td>
                     
                    <td>
                        <a href="action.php?post_approve_id=<?= $data['post_id'] ?>" class="btn btn-success btn-small">Approve</a>
                        <a href="action.php?post_delete_id=<?= $data['post_id'] ?>" class="btn btn-danger btn-small">Delete</a>
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
