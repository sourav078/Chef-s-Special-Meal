<?php 
	
 	require 'db_config.php';

 	if(isset($_POST['btn-register_user']))
 	{
 		$name = $_POST['name'];
 		$email = $_POST['email'];
 		$user_type = $_POST['user_type'];
 		$phone = $_POST['phone'];
 		
 		$location = $_POST['location'];

 		$address = $_POST['address'];
 		$password = md5($_POST['password']);

 		$sql = "INSERT INTO user (name, email, phone, user_type, location, address ,password) VALUES ('$name','$email','$phone','$user_type','$location','$address','$password')";

		if ($db->query($sql) === TRUE) {
		  header('Location: login.php?msg=inserted');
		 
		} else {
		  echo "Error: " . $sql . "<br>" . $db->error;
		}


 	}


	//user login
	if(isset($_POST['btn-login_user']))
	{
		$email = $_POST['email'];
		$password = md5($_POST['password']);

		$sql = "Select count(*),id,name,user_type from user where email='$email' and password='$password';";
		$result = mysqli_query($db,$sql);
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		


		if($row['count(*)']=="1")
		{
			$user_type = $row['user_type'];
			session_start();
			if($user_type == "USER")
			{
				$_SESSION['user']="VERIFIED";
				$_SESSION['user_id']=$row['id'];
				$_SESSION['user_name']=$row['name'];
				header("Location: user/index.php");
				die();

			}
			else if($user_type == "SELLER")
			{
				$_SESSION['seller']="VERIFIED";
				$_SESSION['user_id']=$row['id'];
				$_SESSION['user_name']=$row['name'];
				header("Location: seller/index.php");
				die();
			}
			else if($user_type == "ADMIN")
			{
				$_SESSION['admin']="VERIFIED";
				$_SESSION['user_id']=$row['id'];
				$_SESSION['user_name']=$row['name'];
				header("Location: admin/index.php");
				die();
			}
			else{
				die('Error');
			}
			
			
			
		}
		else
		{
			header("Location: login.php?emsg=error");
		}


	}

	//counter for likes blog
	if(isset($_GET['like_blog_id']))
	{
		$blog_id = $_GET['like_blog_id'];
		$sql = "UPDATE `blog` SET liked = liked + 1 WHERE blog_id='".$_GET['like_blog_id']."'";
		$db->query($sql);
		header('Location: blog_view.php?blog_id='.$blog_id.'&liked=inserted');
	}


	//counter for likes post

	if(isset($_GET['like_post_id'])){
		$post_id = $_GET['like_post_id'];
		$sql = "UPDATE `post` SET liked = liked + 1 WHERE post_id='".$_GET['like_post_id']."'";
		$db->query($sql);
		header('Location: post_view.php?post_id='.$post_id.'&liked=inserted');
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


	 function fetch_all_data_usingDB($db,$sql){
			
			$result = mysqli_query($db,$sql);
		    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		    mysqli_free_result($result);
		    return $row;
		}

?>