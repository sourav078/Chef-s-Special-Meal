<?php require 'session_check.php' ?>
<?php require '_header.php' ?>
<?php require '_navbar2.php' ?>


<?php 

    require 'custom_function.php';

    if(isset($_GET['blog_id'])){

       
        //updateing the view count
        $sql = "UPDATE `blog` SET view = view + 1 WHERE blog_id='".$_GET['blog_id']."'";
        $db->query($sql);

        $post = fetch_all_data_usingDB($db,"select * from blog where blog_id = '".$_GET['blog_id']."'");

        $user = fetch_all_data_usingDB($db,"select * from user where id = '".$post['user_id']."'");   

        //checking if the user liked this post or not
        $user_id = $_SESSION['user_id'];
        $blog_id = $_GET['blog_id'];
        $sql = "Select count(*) from blog_likes where blog_id='$blog_id' and user_id='$user_id';";
		$result = mysqli_query($db,$sql);
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC); 

        $Likechecked = $row['count(*)'];


        //fectching all the comments for this post
        $comments = fetch_all_data_usingPDO($pdo,"select * from blog_comment where blog_id = '".$_GET['blog_id']."'");


    }
    else{
        header("Location: index.php");
    }
    
    
?>


<section>
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <h3><?= $post['title'] ?></h3>
            </div>

            <div class="col-md-6">
                <img src="../<?= $post['image'] ?>" style="max-width:500px;max-height:400px;" alt="">
            </div>

            <div class="col-md-6">
                <div class="row">
                        <div class="col-md-6">
                            <h5 class="">Blog Info:</h5>
                        </div>
                        <div class="col-md-">
                           
                        </div>
                       
                    
                    </div>
                    <div class="row">
                        <div class="col-12">
                            Name: <?= $user['name'] ?> 
                        </div>

                        <div class="col-12">
                            Email: <?= $user['email'] ?>  
                        </div>

                        <div class="col-12">
                            Views: <?= $post['view'] ?>
                        </div>

                        <div class="col-12">
                            Likes: <?= $post['liked'] ?>
                        </div>
                        
                    </div>
                </div>

            
            <div class="col-md-12 mt-4 mb-4">
                        Details: <br> <?= $post['details'] ?>  
            </div>  
                            
            <div class="col-md-12 mt-5">
                            <?php
                                if($Likechecked >= 1 )
                                {
                            ?>
                                    <a class="btn btn-warning"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>&nbsp; Liked</a>

                            <?php
                                }
                                else{
                            ?>
                                    <a href="action.php?like_post_id=<?= $post['blog_id'] ?>" class="btn btn-primary"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>&nbsp;Like</a>
                            <?php 
                                }
                            ?>

                            
                            <button type="button" class="btn btn-success" onclick="getURL()">
                                <i class="fa fa-share" aria-hidden="true"></i> Share
                                </button>
            </div>
           
        </div>
    </div>
</section>


<section>
    <div class="container">
        <div class="row">
           <div class="col-md-12">
                        <h4>Comment Section</h4>
           </div>   
                                
            <?php 

                foreach($comments as $key => $data)
                {
            ?>

            <div class="col-md-12">
                        <div class="row mt-3 mb-2">
                            <div class="col-md-12">
                                <h5><?= $data['name'] ?> </h5>
                            </div>
                            <div class="col-md-12">
                                <?= $data['comment'] ?>
                            </div>
                        </div>
            </div>
            <?php
                }
            ?>

              <div class="col-md-12 mt-3">
                 <form action="action.php" method="post">
                     <input type="hidden" name="blog_id" value="<?= $blog_id ?>">
                     <input type="hidden" name="user_id" value="<?= $user_id ?>">

                      <div class="form-group">
                            <label for="comment">Comment:</label>
                            <textarea class="form-control" rows="5" id="comment" name="comment"></textarea>
                      </div>
                  
                      <button type="submit" name="btn_blog_comment" class="btn btn-primary">Submit</button>
                      <a href="blog_list.php" class="btn btn-dark">Back</a>
                 </form>
                </div>
           
         
        </div>


        
    </div>
</section>
<script>
    function getURL() {
        navigator.clipboard.writeText(window.location.href);
        alert("URL has been Copied to Clipboard");

    }
</script>



 <?php require '_footer.php' ?>
