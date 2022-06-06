<?php require 'session_check.php' ?>
<?php require 'custom_function.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>My Account</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
  
  <style>
    table,
    td,
    th,
    p {
      font-family: 'IBM Plex Mono', monospace;
      text-align: center;
    }
  </style>
</head>

<body>
  <?php
  
  $user_id = $_SESSION['user_id'];
  $user = fetch_all_data_usingDB($db,"select * from user where id = '".$user_id."'");
    $seller = $user;
  $sql = "SELECT * FROM user WHERE id='$user_id'";
  
  $orders = fetch_all_data_usingPDO($pdo,"select * from orders where seller_id = '".$user_id."'");
  $blogs = fetch_all_data_usingPDO($pdo,"select * from blog where user_id = '".$user_id."'");
  $posts = fetch_all_data_usingPDO($pdo,"select * from post where status = 1 or status = 0 and seller_id = '".$user_id."'");
  
  ?>

  <nav>
    <a href="index.php" style="text-decoration: none; font-family: 'Righteous', cursive;">
      <h1 style="text-align: center;">Chef's Special Meal</h1>
    </a>
  </nav>

  <p style="text-align: center;">Welcome <?php echo $user['name'] ?></p>
  <table class="table table-responsive table-hover table-bordered">
    <thead>
      <tr>
        <th scope="col">Name</th>
        <th scope="col">Phone</th>
        <th scope="col">Email</th>
        <th scope="col">Address</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if ($result = $db->query($sql)) {
        while ($row = $result->fetch_assoc()) {
          printf("<tr>");
          printf("<td>%s</td>
                    <td>%s</td>
                    <td>%s</td>
                    <td>%s</td>", $row['name'], $row['phone'], $row['email'], $row['address']);
          printf("</tr>");
        }
      }
      ?>
    </tbody>
  </table>
  <br>
  <p style="text-align: center;">Orders List of <?php echo $user['name'] ?></p>
  <br>
  <table class="table table-responsive table-hover table-bordered">
    <thead>
      <tr>
        <th scope="col">Menu</th>
        <th scope="col">User</th>
        <th scope="col">Phone</th>
        <th scope="col">Qty</th>
        <th scope="col">Total</th>
        <th scope="col">Address</th>
        <th scope="col">To Deliver</th>
        <th scope="col">Ordered</th>
        <th scope="col">Status</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
        <?php
          foreach($orders as $data)
        {
        ?>
        <tr>
            <td><?php $post = fetch_all_data_usingDB($db,"select * from post where post_id = '".$data['post_id']."'"); echo $post['title']; ?></td>
            <td><?php $user = fetch_all_data_usingDB($db,"select * from user where id = '".$data['user_id']."'"); echo $user['name']; ?></td>
            <td><?php echo $user['phone']; ?></td>
            <td><?php echo $data['quantity']; ?></td>
            <td>৳<?php echo $data['total_price']; ?></td>
            <td><?php echo $data['address']; ?></td>
            <td><?php 
                    $datetime = explode("-//-",  $data['date_time']);
                    $DATE = $datetime[0];
                    $TIME = $datetime[1];

                    echo date("h:ia", strtotime($TIME)) .' | '.date("d M,Y", strtotime($DATE));
                ?>
            </td>
            <td><?= date("h:ia - d M, Y", strtotime($data['created_at'])) ?></td>

            <td><?php if($data['status'] == 0 ){echo 'Pending';} elseif($data['status']==-1){echo 'Canceled';} else { echo 'Delivered'; }  ?></td>
            <td>
                  <?php 

                        if($data['status'] == 0 ){
                  ?>

                        <a href="action.php?Confirmorder_id=<?php echo $data['id']; ?>" class="btn btn-warning btn-sm">Confirm</a>
                        <a href="action.php?Cancelorder_id=<?php echo $data['id']; ?>" class="btn btn-danger btn-sm">Cancel</a>
                          
                  <?php 
                        }
                        else if($data['status'] == -1 ) {    
                  ?>
                          <a class="btn btn-danger btn-sm">Canceled</a>

                  <?php 
                        }
                        else{
                  ?>
                          <a class="btn btn-success btn-sm">Confirmed</a>

                  <?php 
                        }

                  ?>
            </td>
            
        </tr>

        <?php 
        }
        ?>
    </tbody>
  </table>


  <br>
  <br>
  <br>
  <p style="text-align: center;">Food Post of <?php echo $seller['name'] ?></p>
  <br>

  <table class="table table-responsive table-hover table-bordered">
    <thead>
      <tr>
        <th scope="col">Sl</th>
        <th scope="col">Title</th>
        <th scope="col">Price</th>
        <th scope="col">Views</th>
        <th scope="col">Likes</th>
        <th scope="col">Status</th>

        <th scope="col">Date</th>

        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>

    <?php
          foreach($posts as $key => $data)
        {
        ?>
        <tr>
            <td><?= $key+1 ?></td>
            <td><?= $data['title'] ?></td>
            <td>৳<?= $data['price'] ?></td>
            <td><?= $data['view'] ?></td>
            <td><?= $data['liked'] ?></td>
            <td><?php if($data['status']==1){echo "Approved";}else{echo"Not Approved Yet";} ?></td>
            <td><?= date("d M, Y", strtotime($data['created_at'])) ?></td>
            <td>
                <a href="action.php?post_delete_id=<?= $data['post_id'] ?>" class="btn btn-danger btn-sm">Delete</a>    
            </td>
        </tr>

        <?php 
        }
        ?>
    </tbody>
  </table>









  <br>
  <br>
  <br>
  <p style="text-align: center;">Blogs of <?php echo $seller['name'] ?></p>
  <br>

  <table class="table table-responsive table-hover table-bordered">
    <thead>
      <tr>
        <th scope="col">Sl</th>
        <th scope="col">Title</th>
        <th scope="col">Views</th>
        <th scope="col">Likes</th>
        <th scope="col">Date</th>
        
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>

    <?php
          foreach($blogs as $key => $data)
        {
        ?>
        <tr>
            <td><?= $key+1 ?></td>
            <td><?= $data['title'] ?></td>
            <td><?= $data['view'] ?></td>
            <td><?= $data['liked'] ?></td>
            <td><?= date("d M, Y", strtotime($data['created_at'])) ?></td>
            <td>
                <a href="action.php?blog_delete_id=<?= $data['blog_id'] ?>" class="btn btn-danger">Remove</a>    
            </td>
        </tr>

        <?php 
        }
        ?>
    </tbody>
  </table>
   
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span style="color: black">Copyright &copy; Chef's Special Meal 2022</span>
                        </div>
                    </div>
                </footer>
  <br>
  
   
</body>

</html>