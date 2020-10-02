<?php include 'starter.html'; ?>
<?php 
include 'dbconnect.php'; 
include 'header.php'; ?>

<?php 
$id=$_GET['catid'];
$sql="SELECT * FROM `category` WHERE category_id=$id";
                $result=mysqli_query($conn,$sql);
                while($row=mysqli_fetch_assoc($result)){
                $catname=$row['category_name'];
                $catdesc=$row['category_description'];    

                }
?>

<?php 
$showalert=false;
$method=$_SERVER['REQUEST_METHOD'];
if($method=='POST'){
    //insert into thread into db

    $th_title=$_POST['title'];
    $th_desc=$_POST['desc'];

  //this is for saving xss attack.
    $th_title=str_replace("<","&lt;","$th_title");
    $th_title=str_replace(">","&gt;","$th_title");

    $th_desc=str_replace("<","&lt;","$th_desc");
    $th_desc=str_replace(">","&gt;","$th_desc");

    $sno=$_POST['sno'];
    $sql="INSERT INTO `thread`( `thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ('$th_title','$th_desc','$id','$sno',current_timestamp())";
                $result=mysqli_query($conn,$sql);
                $showalert=true;
                if($showalert){
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success! </strong>Your problem has been added succesfully,please wait for community respond.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
                }
               

}
?>


<div class="container my-2">
    <div class="jumbotron ">
        <h1 class="display-4">Welcome to <?php echo $catname; ?> Forums</h1>
        <p class="lead"> <?php echo $catdesc; ?></p>
        <hr class="my-4">
        <p>This is peer to peer forum for sharing knowledge with eacch other. No Spam / Advertising.
            Do not post copyright-infringing material. ...
            Do not post “offensive” posts, links or images. ...
            Do not cross post questions. ...

            Remain respectful of other members at all times. </p>
        <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
    </div>

  
</div>

  <!-- Starting discussion form-->

  <?php 

  if(isset ($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
echo '
<div class="container">
    <h1 class="font-italic py-2"> Start a Discusssion</h1>
    <form action=" '. $_SERVER['REQUEST_URI'].'" method="post">
        <div class="form-group">
            <label for="exampleInputEmail1">Enter problem title </label>
            <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
            <small id="emailHelp" class="form-text text-muted">keep the problem title as short as possible.</small>
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Describe Your problem</label>
            <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
           
        </div> <input type="hidden" name="sno" value="'.$_SESSION["sno"].'">
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>


</div>';
  }
  else{
echo '
    <div class="container">
    <h1 class="font-italic py-2"> Start a Discusssion</h1>
    <div class="alert alert-warning" role="alert">
    to start a discussion please login first.
  </div>
    </div>
';
  }
  ?>

<div class="container">
    <h1 class="font-italic py-2 "> Browse Questions</h1>
    <?php  
$id=$_GET['catid'];
$noresult=true;
$sql="SELECT * FROM `thread` WHERE thread_cat_id=$id";
                $result=mysqli_query($conn,$sql);
                while($row=mysqli_fetch_assoc($result)){
                    $noresult=false;
                $id=$row['thread_id'];
                $title=$row['thread_title'];
                $desc=$row['thread_desc'];
                $comment_time=$row['timestamp'];

                    $thred_user_id=$row['thread_user_id'];
                    $sql2="SELECT user_email FROM `users` WHERE user_id='$thred_user_id'";
                    $result2=mysqli_query($conn,$sql2);
                    $row2=mysqli_fetch_assoc($result2);

                echo '  <div class="media my-2 border ">
                <img src="image/user.jpg" width="80px" class="mr-3" alt="...">
                <div class="media-body">
                <p class="font-weight-normal my-0">Asked By - '.$row2['user_email'].'  at '.$comment_time.'</p>
                    <h5 class="mt-0"><a class="text-dark"  href="thread.php?threadid='.$id.' ">'.$title.' </a>  </h5>
                    '.$desc.'
                </div>
            </div>' ;

                }
               // echo var_dump($noresult);
                if($noresult){
                    echo '<div class="jumbotron jumbotron-fluid ">
                    <div class="container">
                      <h1 class="display-4">No Result for this category</h1>
                      <p class="lead ">Be the first person to ask questions.</p>
                    </div>
                  </div>';
                }
?>




</div>


<?php include 'footer.php'; ?>