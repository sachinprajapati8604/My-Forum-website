<?php include 'starter.html' ?>
<?php
include 'dbconnect.php'; 

include 'header.php'; ?>

<?php
// Include config file
require_once "dbconnect.php";
 
// Define variables and initialize with empty values
$name = $email = $comments = "";

 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
        
 // Check input errors before inserting in database
 if($name && $email && $comments){
        
  // Prepare an insert statement
  $sql = "INSERT INTO contact (cont_username,cont_email, cont_message) VALUES (?,?, ?)";
   
  if($stmt = mysqli_prepare($conn, $sql)){
      // Bind variables to the prepared statement as parameters
      mysqli_stmt_bind_param($stmt, "sss",$param_name, $para_email, $param_comments);
      
      // Set parameters
      $param_name=$name;
      $param_email = $email;
      $param_comments = $comments; // Creates a password hash
      
      // Attempt to execute the prepared statement
      if(mysqli_stmt_execute($stmt)){
          // Redirect to loginhandle page
          echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
          <strong> Awesome !</strong> Your form has been submitted.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>';
         // header("location: index.php");
      } else{
          echo "Something went wrong. Please try again later.";
      }

      // Close statement
      mysqli_stmt_close($stmt);
  }
}

// Close connection
mysqli_close($conn);
}
?>


<div class="container bg-grey mt-4 " style="min-height: 70vh;">
  <h2 class="text-center">CONTACT</h2>
  <div class="row mt-4">
    <div class="col-sm-5">
      <p>Contact us and we'll get back to you within few hours.</p>
      <p class="font-weight-bold"><span class="glyphicon glyphicon-map-marker"></span> Bundelkhand University</p>
      <p class="font-weight-bold" ><span class="glyphicon glyphicon-envelope"></span> sachinp8604@gmail.com</p>
    </div>
  
    <div class="col-sm-7">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <div class="row">
        <div class="col-sm-6 form-group">
          <input class="form-control" id="name" name="name" placeholder="Name" type="text" required>
        </div>
        <div class="col-sm-6 form-group">
          <input class="form-control" id="email" name="email" placeholder="Email" type="email" required>
        </div>
      </div>
      <textarea class="form-control" id="comments" name="comments" placeholder="Comment" rows="5"></textarea><br>
      <div class="row">
        <div class="col-sm-12 form-group">
          <button class="btn btn-primary pull-right" type="submit">Send</button>
        </div>
      </div>
      </form>
    </div>
   
   
  </div>
</div>



<?php include 'footer.php'; ?>