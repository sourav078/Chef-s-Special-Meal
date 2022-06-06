<?php require 'd_header.php' ?>

<!-- ########## START: LEFT PANEL ########## -->
<?php require 'd_leftpanel.php' ?>
<!-- ########## END: LEFT PANEL ########## -->

<!-- ########## START: HEAD PANEL ########## -->
<?php require 'd_headpanel.php' ?>
<!-- ########## END: HEAD PANEL ########## -->

<?php 
  
    require 'custom_function.php';
   
    $order_list = fetch_all_data_usingPDO($pdo,"select * from orders ORDER BY id DESC");

?> 

  <!-- ########## START: MAIN PANEL ########## -->
  <div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="index.php">Chef's Special Meal</a>
      <span class="breadcrumb-item active">Order List</span>
    </nav>

    <div class="sl-pagebody"><!-- MAIN CONTENT -->
    

      <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">Order Details</h6>
          
         
          <div class="table-wrapper">
            <table id="myTable" class="table display responsive nowrap">
              <thead>
                <tr>
                  <th >SL</th>
                  <th >User</th>
                  <th >Seller</th>
                  <th >Item</th>                               
                  <th >Price</th>                               
                  <th >Qty</th>                               
                  <th >Total</th>                               
                  <th >Deliver To</th>                               
                  <th >Created At</th>
                  <th >Status</th>

                 

                  
                </tr>
              </thead>
              <tbody>
                
                <?php

                    foreach ($order_list as $key => $data) {

                      $post = fetch_all_data_usingDB($db,"select * from post where post_id = '".$data['post_id']."'");
                      $user = fetch_all_data_usingDB($db,"select * from user where id = '".$data['user_id']."'"); 
                      $seller = fetch_all_data_usingDB($db,"select * from user where id = '".$data['seller_id']."'"); 

                ?>  
                    <tr>
                        <td><?= $key+1 ?></td>
                        <td><?php  echo $user['name']; ?></td>
                        <td><?php echo $seller['name'];  ?></td>
                        <td><?php echo $post['title']; ?></td>
                        <td>৳ <?php echo $data['unit_price']; ?></td>
                        <td><?php echo $data['quantity']; ?></td>
                        <td>৳ <?php echo $data['total_price']; ?></td>
                        <td><?php echo $data['address']; ?></td>
                        <td><?php  echo date("h:ia - d M, y", strtotime($data['created_at'])); ?></td>
                        <td><?php if($data['status'] == 1){echo "Delivered";}elseif($data['status'] == -1){echo 'Canceled';}else{echo"Pending";} ?></td>
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
