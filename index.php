
<?php require '_header.php' ?>
<?php require '_navbar.php' ?>


<?php 

require 'custom_function.php';    
$posts = fetch_all_data_usingPDO($pdo,"select * from post where status = 1 ORDER BY post_id DESC");

?>

<section>
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <h1>Food Posts</h1>
            </div>
        </div>


        <div class="row">
            <?php 

                foreach($posts as $key =>$data)
                {
            ?>
                     <?php  
                        $seller = fetch_all_data_usingDB($db,"select * from user where id = '".$data['seller_id']."'");                                        
                     ?>
                    <div class="col-md-4 mt-5">
                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top" src="<?= $data['image'] ?>" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title text-center"><?= $data['title'] ?></h5>
                                <p class="card-text"><?php echo substr($data['details'],0,200); ?></p>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Price: ৳<?= $data['price'] ?></li>
                                <li class="list-group-item">Seller: <?= $seller['name'] ?></li>
                                <li class="list-group-item">Location: <?= $seller['location'] ?></li>
                                
                            </ul>
                            <div class="card-body">
                                <a href="food_post_view.php?post_id=<?= $data['post_id'] ?>" class="card-link btn btn-primary btn-block">View</a>
                               
                            </div>
                        </div>
                    </div>


            <?php 
                }

            ?>
        </div>
    </div>
</section>

 <?php require '_footer.php' ?>
