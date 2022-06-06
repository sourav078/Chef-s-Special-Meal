<nav class="navbar navbar-expand-lg navbar-dark bg-dark justify-content-between">
  <div class="container">
    <a class="navbar-brand" href="index.php">Chef's Special Meal</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse container" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
        
        <li class="nav-item">
            <a class="nav-link" href="blog_list.php">Blogs</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="index.php">Food Post</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" target="_blank" href="profile.php">My Account</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
        </li>

        <li style="margin-left:200px;">
          <form class="form-inline" action="action.php" method="post">
            <input class="form-control mr-sm-2" type="search" name="title" placeholder="Search Blog Post" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="btn_search_blog">Search</button>
          </form>
        </li>
       
        </ul>
        
    </div>
  </div>
</nav>
