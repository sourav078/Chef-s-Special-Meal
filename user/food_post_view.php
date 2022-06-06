<?php require 'session_check.php' ?>
<?php require '_header.php' ?>
<?php require '_navbar.php' ?>


<?php 
    error_reporting(E_ERROR | E_PARSE);
    require 'custom_function.php';

    if(isset($_GET['post_id'])){

          //updateing the view count
          $sql = "UPDATE `post` SET view = view + 1 WHERE post_id='".$_GET['post_id']."'";
          $db->query($sql);

        $post = fetch_all_data_usingDB($db,"select * from post where post_id = '".$_GET['post_id']."'");

        $seller = fetch_all_data_usingDB($db,"select * from user where id = '".$post['seller_id']."'");   


          //checking if the user liked this post or not
          $user_id = $_SESSION['user_id'];
          $post_id = $_GET['post_id'];
          $sql = "Select count(*) from post_likes where post_id='$post_id' and user_id='$user_id';";
          $result = mysqli_query($db,$sql);
          $row = mysqli_fetch_array($result, MYSQLI_ASSOC); 
  
          $Likechecked = $row['count(*)'];


           //fectching all the reviews and rating for this post
            $reviews = fetch_all_data_usingPDO($pdo,"select * from post_review where post_id = '".$_GET['post_id']."'");

            //getting the total rating
            $total_rating = 0;
            $key = 0;
            foreach($reviews as $data){
                $key++;
                $total_rating += intval( $data['rating'] );
                
            }
            $average_rating = $total_rating/$key;
            
           
            
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
                        <div class="col-md-4">
                            <h5 class="">Post Info:</h5>
                        </div>
                        
                        <div class="col-md-8">
                        <a href="place_order.php?post_id=<?= $post_id ?>" class="btn btn-dark">Order</a>

                        <?php
                                if($Likechecked >= 1 )
                                {
                            ?>
                                    <a class="btn btn-warning"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>&nbsp; Liked</a>

                            <?php
                                }
                                else{
                            ?>
                                    <a href="action.php?like_foodpost_id=<?= $post['post_id'] ?>" class="btn btn-primary"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>&nbsp;Like</a>
                            <?php 
                                }
                            ?>

                                <button type="button" class="btn btn-success" onclick="getURL()">
                                <i class="fa fa-share" aria-hidden="true"></i> Share
                                </button>

                        </div>
                       
                    
                    </div>

                    <div class="row">
                        <div class="col-12">
                            Name: <?= $seller['name'] ?> 
                        </div>

                        <div class="col-12">
                            Phone: <?= $seller['phone'] ?>  
                        </div>

                        <div class="col-12">
                            Location: <?= $seller['location'] ?>  
                        </div>
                        <div class="col-12">
                            Address: <?= $seller['address'] ?>  
                        </div>
                        <div class="col-12">
                            Views: <?= $post['view'] ?>  
                        </div>
                        <div class="col-12">
                            Liked: <?= $post['liked'] ?>  
                        </div>

                      
                        
                    </div>
                </div>
            </div>

            
            <div class="col-md-12 mt-4 mb-4">
                        Details: <br> <?= $post['details'] ?>  
            </div>

            

        </div>
    </div>
</section>


<section>
    <div class="container">
        <div class="row">
           <div class="col-md-12">
                        <h4>Review Section</h4>
           </div>   
                                
            <?php 

                foreach($reviews as $key => $data)
                {
            ?>

            <div class="col-md-12">
                        <div class="row mt-3 mb-2">
                            <div class="col-md-12">
                                <h5><?= $data['name'] ?> </h5>

                                <p>Rating: 
                                        <?php 

                                            for($i=1 ; $i<= $data['rating'] ;$i++)
                                            {
                                ?>
                                        <i class="fa fa-star" aria-hidden="true" style="color:green;"></i>
                                <?php 
                                            }
                                        
                                        ?>
                                </p>
                            </div>
                            <div class="col-md-12">
                                Review: <?= $data['review'] ?>
                            </div>
                        </div>
            </div>
            <?php
                }
            ?>

              <div class="col-md-12 mt-5">
                 <form action="action.php" method="post">
                     <input type="hidden" name="post_id" value="<?= $post_id ?>">
                     <input type="hidden" name="user_id" value="<?= $user_id ?>">
                      <div class="form-group">
                            <label for="comment">Rate this Post:</label>
                            <input type="radio" value="1" name="rating" required> 1 &nbsp;&nbsp;
                            <input type="radio" value="2" name="rating" required> 2 &nbsp;&nbsp;
                            <input type="radio" value="3" name="rating" required> 3 &nbsp;&nbsp;
                            <input type="radio" value="4" name="rating" required> 4 &nbsp;&nbsp;
                            <input type="radio" value="5" name="rating" required> 5 &nbsp;&nbsp;
                      </div>
                      <div class="form-group">
                            <label for="comment">Review:</label>
                            <textarea class="form-control" rows="5" id="comment" name="review" required></textarea>
                      </div>
                  
                      <button type="submit" name="btn_post_review" class="btn btn-primary">Submit</button>
                      <a href="index.php" class="btn btn-dark">Back</a>
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
