
<style>
  .cool-link::after {
    content: '';
    display: block;
    width: 0;
    height: 2px;
    background: #000;
    transition: width .3s;
}

.cool-link:hover::after {
    width: 100%;
    transition: width .3s;
}

nav a,.logo {
  font-weight: 500;
  font-size: 20px;

}
 

.card-title a{
  text-decoration: none;
}
</style>
<?php

echo '
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand logo" href="#">iDiscuss</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto mx-auto ">
      <li class="nav-item active">
        <a class="nav-link cool-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
     
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Top Category
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">';

        $sql="SELECT `category_id`, `category_name` FROM `category` Limit 5";
        $result=mysqli_query($conn,$sql);
        while($row=mysqli_fetch_assoc($result)){
            echo '  <a class="dropdown-item cool-link" href="threadlist.php?catid='.$row['category_id'].'">'.$row['category_name'].'</a>';

        }
       echo ' </div>
      </li>
      <li class="nav-item">
      
      <a class="nav-link cool-link" href="about.php">About</a>
    </li>
      <li class="nav-item">
        <a class="nav-link cool-link" href="contact.php"  >Contact</a>
      </li>
    </ul>
  </div>
    <form class="form-inline my-2 my-lg-0 action="search.php" method="GET">
      <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>  
</form>
  </div>
  </div>
</nav>

';
?>

<?php
    session_start();
   if(isset ($_SESSION['loggedin']) && $_SESSION['loggedin']==true){

    echo'
            <div class="alert alert-success" role="alert"><div class="btn-group">
       <p class="text-dark">  Welcome <b>'.$_SESSION['useremail'].'</b>
        <a href="logout.php" class="btn btn-success my-2 my-sm-0" type="submit">Logout</a></p>
        </div>
        </div>';


   }
   else {
   echo'
    <div class="alert alert-success" role="alert"><div class="btn-group">
  Create an account for this website <button class="btn btn-success ml-2" data-toggle="modal" data-target="#signupModal">signup</button>
  <button class="btn btn-success ml-2" data-toggle="modal" data-target="#loginModal" >login</button> 
  </div>
</div>';


   }
   


include 'loginModal.php'; 
include 'signupModal.php';

if(isset($_GET['signupsuccess']) && $_GET['signupsuccess']=="true"){
  echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
  <strong>Success !</strong> You can login now.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}

?>
