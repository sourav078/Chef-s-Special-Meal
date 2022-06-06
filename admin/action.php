<?php

	require '../db_config.php';
	require 'custom_function.php';
	session_start();



	//removing a food post 
	if(isset($_GET['post_remove_id'])){
		$post_id = $_GET['post_remove_id'];
		$sql = "UPDATE post SET status = 2 WHERE post_id = '$post_id'";
		$result = $db->query($sql);
		if($result){
			header("Location: post_approved.php");
		}
	}

	//aprove a new post
	if(isset($_GET['post_approve_id']))
	{
		$post_id = $_GET['post_approve_id'];
		$query = "UPDATE post SET status = 1 WHERE post_id = $post_id";
		$result = mysqli_query($db, $query);
		if($result)
		{
			header('Location: post_pending.php?update=on');
		}
		else
		{
			echo "Error";
		}
	}

	//delete a post
	if(isset($_GET['post_delete_id']))
	{
		$post_id = $_GET['post_delete_id'];
		$query = "DELETE FROM post WHERE post_id = $post_id";
		$result = mysqli_query($db, $query);
		if($result)
		{
			header('Location: post_pending.php?delete=on');
		}
		else
		{
			echo "Error";
		}
	}




	//aprove a new blog
	if(isset($_GET['blog_approve_id']))
	{
		$blog_id = $_GET['blog_approve_id'];
		$query = "UPDATE blog SET status = 1 WHERE blog_id = $blog_id";
		$result = mysqli_query($db, $query);
		if($result)
		{
			header('Location: blog_pending.php?update=on');
		}
		else
		{
			echo "Error";
		}
	}

	//delete a blog
	if(isset($_GET['blog_delete_id']))
	{
		$blog_id = $_GET['blog_delete_id'];
		$query = "DELETE FROM blog WHERE blog_id = $blog_id";
		$result = mysqli_query($db, $query);
		if($result)
		{
			header('Location: blog_pending.php?delete=on');
		}
		else
		{
			echo "Error";
		}
	}

?>