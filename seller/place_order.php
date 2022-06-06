<?php require 'session_check.php' ?>
<?php require '_header.php' ?>
<?php require '_navbar.php' ?>


<?php 

    require 'custom_function.php';

    if(isset($_GET['post_id'])){

        $post = fetch_all_data_usingDB($db,"select * from post where post_id = '".$_GET['post_id']."'");

        $seller = fetch_all_data_usingDB($db,"select * from user where id = '".$post['seller_id']."'");   

        $unit = $post['price'];
        $seller_id = $post['seller_id'];
          $user_id = $_SESSION['user_id'];
          $post_id = $_GET['post_id'];
         
    }
    else{
        header("Location: index.php");
    }
    
    
?>

<section style="padding-bottom:50px;">
    <div class="container mt-5 mb-5">
        
    <?php 
            if(isset($_GET['msg']))
            {
        ?>

        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Order Placed Successfully!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <?php
            }
        ?>


       <div class="row">

            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Food Details</h4>
                        <p class="card-title-desc">
                            <?= $post['title'] ?>
                        </p>
                        <img src="../<?= $post['image'] ?>" style="max-width: 500px;" alt="" class="img-fluid">
                        <p class="card-text">Price ৳<?= $post['price'] ?></p>
                        <p class="card-text">Location: <?= $seller['location'] ?></p>
                        <p class="card-text">Address: <?= $seller['address'] ?></p>
                        <p class="card-text">phone: <?= $seller['phone'] ?></p>
                        <p class="card-text"><?= $post['details'] ?></p>

                        
                    </div>
                </div>
            </div>


            <div class="col-md-6">
                <form action="action.php" method="post" enctype="multipart/form-data">

                        <input type="hidden" name="total_price" id="total_price" value="">
                        <input type="hidden" name="unit_price" value="<?= $unit ?>">
                        <input type="hidden" name="seller_id" value="<?= $seller_id ?>">
                        <input type="hidden" name="user_id" value="<?= $user_id ?>">
                        <input type="hidden" name="post_id" value="<?= $post_id ?>">

                    <div class="form-layout">
                        <div class="row mg-b-25">
                        <div class="col-lg-6">
                            <div class="form-group">
                            <label class="form-control-label">Quantity:</label>
                                <input id="qty" class="form-control" type="number" name="quantity" value="1" min="1" placeholder="Enter quantity" required>
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-6" >
                            <div class="form-group">
                            <label class="form-control-label">Total Price:</label>
                            <input id="TOTALPRICE" class="form-control" type="number"  required>
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-6" >
                            <div class="form-group">
                            <label class="form-control-label">Date:</label>
                            <input class="form-control" type="date" name="date" required>
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-6" >
                            <div class="form-group">
                            <label class="form-control-label">Time:</label>
                            <input class="form-control" type="time" name="time" required>
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-12" >
                            <div class="form-group">
                            <label class="form-control-label">Address:</label>
                            <textarea name="address" class="form-control" id="" cols="100" rows="3" required></textarea>
                            
                            </div>
                        </div><!-- col-4 -->
                        
                        
                        <div class="form-layout-footer col-lg-12">
                            <a class="btn btn-warning"  id="orderButton" onclick="ConfirmOrder(<?= $post['price'] ?> , '#confirmedBUTTOn')">Place Order</a>
                            <button class="btn btn-info mg-r-5" type="submit" name="btn_confirmOrder" >Confirm Order</button>
                            <a href="food_post_view.php?post_id=<?= $post_id ?>" class="btn btn-dark mg-r-5">Back</a>
                        </div><!-- form-layout-footer -->
                    </div><!-- form-layout -->
                </form>
            </div>

           
       </div>
    </div>
</section>


<footer class="bg-dark" style="position: bottom;left: 0;bottom: 0;width: 100%;color: white;text-align: center;padding-bottom:5px;margin-top:100px;">
		<div class="text-center mt-2">
			<p>Copyright © 2022 Chef's Special Meal</p>
		</div>
</footer>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script>
    function ConfirmOrder(price,data){
        var qty = $('#qty').val();
        console.log(qty);
        console.log(price);

        var total = price * qty;
        console.log(total);

        var showtotal = $('#TOTALPRICE').val(total);
        var total_price = $('#total_price').val(total);
    }
</script>
</body>
</html>