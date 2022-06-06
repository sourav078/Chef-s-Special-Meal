<?php

	require '../db_config.php';
	require 'custom_function.php';
	session_start();


	//removing a food post 
	if(isset($_GET['post_delete_id'])){
		$post_id = $_GET['post_delete_id'];
		$sql = "UPDATE post SET status = 2 WHERE post_id = '$post_id'";
		$result = $db->query($sql);
		if($result){
			header("Location: profile.php");
		}
	}

	//confirming an order
	if(isset($_GET['Confirmorder_id']))
	{
		$order_id = $_GET['Confirmorder_id'];
		$sql = "UPDATE orders SET status = 1 WHERE id = '$order_id'";
		$db->query($sql);
		header('location: profile.php');
		
	}

	//cancel an order
	if(isset($_GET['Cancelorder_id']))
	{
		$order_id = $_GET['Cancelorder_id'];
		$sql = "UPDATE orders SET status = -1 WHERE id = '$order_id'";
		$db->query($sql);
		header('location: profile.php');
		
	}


	//add a new post
	if(isset($_POST['btn_postadd']))
	{

		$user_id = $_SESSION['user_id'];

		$title= $_POST['title'];
		$price= $_POST['price'];
		$details= $_POST['details'];

		if(!empty($_FILES['image']['name']))
			{	
				$product_image="";
				if(!empty($_FILES['image']['name']))
				{
					$file_name = $_FILES['image']['name'];
					$file_type = $_FILES['image']['type'];
					$file_size = $_FILES['image']['size'];
					$file_tem_Loc = $_FILES['image']['tmp_name'];

					$product_image = "images/post/".$file_name;

					$target_dir="../images/post/";
					//checking for proper image formate
					$target_file = $target_dir . basename($_FILES["image"]["name"]);
					$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

					if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
						  $uploadOk = 0;
						  header("Location: post_add.php");
						  die();
					}

					move_uploaded_file($file_tem_Loc, $target_file);
				}

			}

		
		$sql = "INSERT INTO post (title, price, details,image, seller_id) VALUES ('$title','$price','$details','$product_image','$user_id')";
		if ($db->query($sql) === TRUE) {
			echo "New record created successfully";
		  } else {
			echo "Error: " . $sql . "<br>" . $db->error;
			die();
		  } 

		header("Location: food_add.php?msg=on");
		

	}

	//confirming or placing an order
	if(isset($_POST['btn_confirmOrder']))
	{
		$post_id = $_POST['post_id'];
		$user_id = $_POST['user_id'];
		$seller_id = $_POST['seller_id'];
		$unit_price = $_POST['unit_price'];
		$quantity = $_POST['quantity'];
		$total_price = $_POST['total_price'];
		$date = $_POST['date'];
		$time = $_POST['time'];
		$address = $_POST['address'];

		$date_time = $date . '-//-' . $time;

		$sql = "INSERT INTO `orders`(`post_id`, `user_id`, `seller_id`,`unit_price`,`quantity`,`total_price`, `date_time`, `address`) VALUES ('$post_id','$user_id','$seller_id','$unit_price','$quantity','$total_price','$date_time','$address')";
		if ($db->query($sql) === TRUE) {
			echo "New record created successfully";
		  } else {
			echo "Error: " . $sql . "<br>" . $db->error;
			die();
		  } 

		header("Location: place_order.php?post_id=$post_id&msg=on");

		

	}


	//adding review in the post 
	if(isset($_POST['btn_post_review']))
	{
		$post_id = $_POST['post_id'];
		$user_id = $_POST['user_id'];
		$review = $_POST['review'];
		$rating = $_POST['rating'];

		$user = fetch_all_data_usingDB($db,"select * from user where id = '".$user_id."'");
		$name = $user['name'];
		$email = $user['email'];
		$sql = "INSERT INTO `post_review`(`post_id`, `user_id`, `review`,`name`,`email`,`rating`) VALUES ('$post_id','$user_id','$review','$name','$email','$rating')";
		if ($db->query($sql) === TRUE) {
			echo "New record created successfully";
		  } else {
			echo "Error: " . $sql . "<br>" . $db->error;
			die();
		  } 

		header("Location: food_post_view.php?post_id=$post_id");
	}


	//counter for dood post likes 
	if(isset($_GET['like_foodpost_id']))
	{
		$post_id = $_GET['like_foodpost_id'];
		$sql = "UPDATE `post` SET liked = liked + 1 WHERE post_id='".$_GET['like_foodpost_id']."'";
		$db->query($sql);



		$user_id = $_SESSION['user_id'];
		$sql2 = "INSERT INTO post_likes (post_id , user_id) VALUES ('$post_id','$user_id')";
		if ($db->query($sql2) === TRUE) {
			echo "New record created successfully";
		  } else {
			echo "Error: " . $sql2 . "<br>" . $db->error;
			die();
		  } 


		header('Location: food_post_view.php?post_id='.$post_id.'&liked=inserted');
	}

	//adding comment for a blog post
	if(isset($_POST['btn_blog_comment']))
	{
		$blog_id = $_POST['blog_id'];
		$user_id = $_POST['user_id'];
		$comment = $_POST['comment'];

		$user = fetch_all_data_usingDB($db,"select * from user where id = '".$user_id."'");
		$name = $user['name'];
		$email = $user['email'];
		$sql = "INSERT INTO `blog_comment`(`blog_id`, `user_id`, `comment`,`name`,`email`) VALUES ('$blog_id','$user_id','$comment','$name','$email')";
		if ($db->query($sql) === TRUE) {
			echo "New record created successfully";
		  } else {
			echo "Error: " . $sql . "<br>" . $db->error;
			die();
		  } 

		header("Location: blog_view.php?blog_id=$blog_id");
	}

	//counter for likes blog_post
	if(isset($_GET['like_post_id'])){
		$post_id = $_GET['like_post_id'];
		$sql = "UPDATE `blog` SET liked = liked + 1 WHERE blog_id='".$_GET['like_post_id']."'";
		$db->query($sql);



		$user_id = $_SESSION['user_id'];
		$sql2 = "INSERT INTO blog_likes (blog_id , user_id) VALUES ('$post_id','$user_id')";
		if ($db->query($sql2) === TRUE) {
			echo "New record created successfully";
		  } else {
			echo "Error: " . $sql2 . "<br>" . $db->error;
			die();
		  } 


		header('Location: blog_view.php?blog_id='.$post_id.'&liked=inserted');
	}



	//add a new blog
	if(isset($_POST['btn_blogadd']))
	{
		$user_id = $_SESSION['user_id'];

		$title= $_POST['title'];		
		$details= $_POST['details'];

		
		if(!empty($_FILES['image']['name']))
			{	
				$product_image="";
				if(!empty($_FILES['image']['name']))
				{
					$file_name = $_FILES['image']['name'];
					$file_type = $_FILES['image']['type'];
					$file_size = $_FILES['image']['size'];
					$file_tem_Loc = $_FILES['image']['tmp_name'];

					$product_image = "images/blog/".$file_name;

					$target_dir="../images/blog/";
					//checking for proper image formate
					$target_file = $target_dir . basename($_FILES["image"]["name"]);
					$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

					if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
						  $uploadOk = 0;
						  header("Location: blog_add.php");
						  die();
					}

					move_uploaded_file($file_tem_Loc, $target_file);
				}

			}

		
		$sql = "INSERT INTO blog (title, details, image, user_id) VALUES ('$title','$details','$product_image','$user_id')";
		if ($db->query($sql) === TRUE) {
			echo "New record created successfully";
		  } else {
			echo "Error: " . $sql . "<br>" . $db->error;
			die();
		  }

		header("Location: blog_add.php?msg=on");


	}


	//deleting blogs 
	if(isset($_GET['blog_delete_id']))
	{
		$id = $_GET['blog_delete_id'];

		$sql = "delete from blog where blog_id='$id';";
		$db->query($sql);
		header("Location: profile.php?delete=on");		
		
	}


	//searching food post 
	if(isset($_POST['btn_search_food']))
	{
		$title = $_POST['title'];	
		
		header("Location: search_food.php?title=$title");
	}


	//searching blog post 
	if(isset($_POST['btn_search_blog']))
	{
		$title = $_POST['title'];	
		
		header("Location: search_blog.php?title=$title");
	}


	
?>