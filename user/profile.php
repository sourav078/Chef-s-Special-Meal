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

  $sql = "SELECT * FROM user WHERE id='$user_id'";
  
  $orders = fetch_all_data_usingPDO($pdo,"select * from orders where user_id = '".$user_id."' order by id desc");
  $blogs = fetch_all_data_usingPDO($pdo,"select * from blog where user_id = '".$user_id."'");
  
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

        <?php 
            if(isset($_GET['msg']))
            {
        ?>

        <div id="ORDERNOTIFICATION" class="alert alert-success alert-dismissible fade show" role="alert" style="text-align:center;">
            <strong>Order Successfully</strong>
            
        </div>

        <?php
            }
        ?>

  <p style="text-align: center;">Orders of <?php echo $user['name'] ?></p>
  <br>
  <table class="table table-responsive table-hover table-bordered">
    <thead>
      <tr>
        <th scope="col">Menu</th>
        <th scope="col">Seller</th>
        <th scope="col">Total Price</th>
        <th scope="col">Date</th>
        <th scope="col">Status</th>
      </tr>
    </thead>
    <tbody>
        <?php
          foreach($orders as $data)
        {
        ?>
        <tr>
            <td><?php $post = fetch_all_data_usingDB($db,"select * from post where post_id = '".$data['post_id']."'"); echo $post['title']; ?></td>
            <td><?php $seller = fetch_all_data_usingDB($db,"select * from user where id = '".$data['seller_id']."'"); echo $seller['name']; ?></td>
            <td>৳ <?php echo $data['total_price']; ?></td>
            <td><?= date("d M, Y", strtotime($data['created_at'])) ?></td>
            <td><?php if($data['status'] == 0 ){echo 'Pending';} else { echo 'Delivered'; }  ?></td>
        </tr>

        <?php 
        }
        ?>
    </tbody>
  </table>
  <br>
  <br>
  <br>
  <p style="text-align: center;">Blogs of <?php echo $user['name'] ?></p>
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
                <a href="action.php?blog_delete_id=<?= $data['blog_id'] ?>" class="btn btn-danger">Delete</a>    
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
  
   

  <script>

  setTimeout(() => {
    const box = document.getElementById('ORDERNOTIFICATION');
      box.style.display = 'none';
    }, 10000);
    
  </script>
</body>

</html>