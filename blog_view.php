
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
                <img src="<?= $post['image'] ?>" style="max-width:500px;max-height:400px;" alt="">
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
                            
            <!-- <div class="col-md-12 mt-5">
                 <a href="login.php" class="btn btn-primary"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>&nbsp;Like</a>

            </div> -->
           
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
                 <form >
                     <input type="hidden" name="blog_id" value="<?= $blog_id ?>">
                     <input type="hidden" name="user_id" value="<?= $user_id ?>">

                      <div class="form-group">
                            <label for="comment">Comment:</label>
                            <textarea class="form-control" rows="5" id="comment" name="comment"></textarea>
                      </div>
                  
                      <a href="login.php" class="btn btn-primary">Submit</a>
                      <a href="blog_list.php" class="btn btn-dark">Back</a>
                 </form>
                </div>
           
         
        </div>


        
    </div>
</section>


 <?php require '_footer.php' ?>
