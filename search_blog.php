
<?php require '_header.php' ?>
<?php require '_navbar2.php' ?>


<?php 

require 'custom_function.php';  
if(isset($_GET['title'])){

    $title  = $_GET['title'];
    $posts = fetch_all_data_usingPDO($pdo,"select * from blog where title like '".$title."' and status = 1 ORDER BY blog_id DESC");
}
else{
header("Location: index.php");
}

?>

<section>
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-6">
                <h1>Blog Posts : <?= $title ?></h1>
            </div>
            <div class="col-md-6">
                <div style="margin-left:60%;">
                    <a href="blog_add.php" class="btn btn-success" style="min-width: 150px;"><i class="fa fa-plus-circle" aria-hidden="true"></i> &nbsp;Add Blog</a>

                </div>
            </div>
        </div>


        <div class="row">
            <?php 

                foreach($posts as $key =>$data)
                {
            ?>
                     <?php  
                        $user = fetch_all_data_usingDB($db,"select * from user where id = '".$data['user_id']."'");                                        
                     ?>
                    <div class="col-md-4 mt-5">
                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top" src="<?= $data['image'] ?>" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title text-center"><?= $data['title'] ?></h5>
                                <p class="card-text"><?php echo substr($data['details'],0,200); ?></p>
                            </div>
                            <ul class="list-group list-group-flush">
                               
                                <li class="list-group-item">User: <?= $user['name'] ?></li>
                                <li class="list-group-item">Posted at: <?= date("d M, Y", strtotime($data['created_at'])) ?></li>

                                
                            </ul>
                            <div class="card-body">
                                <a href="blog_view.php?blog_id=<?= $data['blog_id'] ?>" class="card-link btn btn-primary btn-block">View</a>
                               
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
