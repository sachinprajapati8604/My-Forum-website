<?php include 'starter.html'; ?>
<?php
include 'dbconnect.php'; 

include 'header.php'; ?>

<?php 
$id=$_GET['threadid'];
$sql="SELECT * FROM `thread` WHERE thread_id=$id";
                $result=mysqli_query($conn,$sql);
                while($row=mysqli_fetch_assoc($result)){
                $title=$row['thread_title'];
                $desc=$row['thread_desc'];    

                $thread_user_id=$row['thread_user_id'];
                //query for name of the posted by
           
                                        $sql2="SELECT user_email FROM `users` WHERE user_id='$thread_user_id'";
                                        $result2=mysqli_query($conn,$sql2);
                                        $row2=mysqli_fetch_assoc($result2);
                                        $posted_by=$row2['user_email'];


                }
?>


<?php 
$showalert=false;
$method=$_SERVER['REQUEST_METHOD'];
if($method=='POST'){
    //insert into comment into db

    $comment=$_POST['comment'];
    $comment=str_replace("<","&lt;","$comment");
    $comment=str_replace(">","&gt;","$comment");

    $sno=$_POST['sno'];
 
   
    $sql="INSERT INTO `comments`( `comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ('$comment','$id','$sno',current_timestamp())";
                $result=mysqli_query($conn,$sql);
                $showalert=true;
                if($showalert){
                    echo '<div class="alert alert-success alert-dismissible fade show " role="alert">
                    <strong>Success! </strong>Your comment has been added succesfully.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
                }
               

}
?>


<div class="container my-2">
    <div class="jumbotron ">
        <h1 class="display-4"> <?php echo $title; ?> </h1>
        <p class="lead"> <?php echo $desc; ?></p>
        <hr class="my-4">
        <p>This is peer to peer forum for sharing knowledge with eacch other. No Spam / Advertising.
            Do not post copyright-infringing material. ...
            Do not post “offensive” posts, links or images. ...
            Do not cross post questions. ...

            Remain respectful of other members at all times. </p>
        <p class="p-1">Posted By- <strong class="p-1"><?php echo $posted_by ?></strong>
            <p>
    </div>
</div>

<?php 
if(isset ($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
echo'
<div class="container " style="min-height:200px;">
    <h1 class="font-italic ">Post a Comment</h1>

    <form action="'. $_SERVER['REQUEST_URI'] .'" method="post">

        <div class="form-group">
            <label for="exampleFormControlTextarea1">Type your comment</label>
            <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
            <input type="hidden" name="sno" value="'.$_SESSION["sno"].'">
            </div>

        <button type="submit" class="btn btn-primary">Post comment</button>
    </form>

</div>
';
}
else{
echo ' <div class="container">
<h1 class="font-italic py-2">Post a Comment</h1>
<div class="alert alert-warning" role="alert">
You are not logged in ,Please login to able post a comments.    
</div>
</div>';
    
}
?>

<div class="container my-2">
    <h1 class="font-italic ">Discussion</h1>
    <?php  
                    $noresult=true;
                    $id=$_GET['threadid'];
                    $sql="SELECT * FROM `comments` WHERE thread_id=$id";
                                    $result=mysqli_query($conn,$sql);
                                    while($row=mysqli_fetch_assoc($result)){
                                    $noresult=false;
                                    $id=$row['comment_id'];
                                    $content=$row['comment_content'];
                                    $comment_time=$row['comment_time'];
                                                                           
                                        $thred_user_id=$row['comment_by'];
                                        $sql2="SELECT user_email FROM `users` WHERE user_id='$thred_user_id'";
                                        $result2=mysqli_query($conn,$sql2);
                                        $row2=mysqli_fetch_assoc($result2);

                                    echo '  <div class="media my-2 border">
                                    <img src="image/user.jpg" width="80px" class="mr-3" alt="...">
                                    <div class="media-body">
                                    <p class="font-weight-bold my-0">'.$row2['user_email'].' at '.$comment_time.'</p>
                                        '.$content.'
                                     
                                    </div>
                                </div>';

                                    }
                                    if($noresult){
                                        echo '<div class="jumbotron jumbotron-fluid ">
                                        <div class="container">
                                          <h1 class="display-4">No Result for this question</h1>
                                          <p class="lead ">Be the first person to give answer this question.To give answer this question you have to login first.</p>
                                        </div>
                                      </div>';
                                    }
                    ?>
</div>

<?php include 'footer.php'; ?>