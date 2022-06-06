
<?php require 'session_check.php' ?>
<?php require '_header.php' ?>
<?php require '_navbar2.php' ?>



<section style="padding-bottom:50px;">
    <div class="container mt-5 mb-5">
        
    <?php 
            if(isset($_GET['msg']))
            {
        ?>

        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Blog Added Successfully</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <?php
            }
        ?>


        <form action="action.php" method="post" enctype="multipart/form-data">
            <div class="form-layout">
                <div class="row mg-b-25">
                <div class="col-lg-6">
                    <div class="form-group">
                    <label class="form-control-label">Title:</label>
                    <input class="form-control" type="text" name="title"  placeholder="Enter title" required>
                    </div>
                </div><!-- col-4 -->


                <div class="col-lg-6">
                    <div class="form-group">
                    <label class="form-control-label">Image: </label>
                    <input class="form-control" type="file" name="image" required >
                    </div>
                </div><!-- col-4 -->


                <div class="col-lg-12">
                    <div class="form-group">
                    <label class="form-control-label">Details: </label>
                    <textarea name="details" id="details" class="form-control" cols="30" rows="10"></textarea>
                    </div>
                </div><!-- col-4 -->
                
                
                <div class="form-layout-footer col-lg-12">
                <button class="btn btn-info mg-r-5" type="submit" name="btn_blogadd" >Submit Form</button>
                <a href="blog_list.php" class="btn btn-dark mg-r-5">Blog List</a>
                </div><!-- form-layout-footer -->
            </div><!-- form-layout -->
          </form>
    </div>
</section>

 <?php require '_footer.php' ?>



