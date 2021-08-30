<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Great-Discusssion</title>

    <style>
    .cat-img {
        height: 12rem;
        width: 100%;
        object-fit: contain;
    }
    </style>
</head>

<body>

    <?php
    include 'dbconnect.php';
    include 'header.php'; ?>


    <!-- Crousle -->

    <div id="carouselExampleIndicators" class="carousel slide my-0 p-0" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="image/slide1.jpg" class=" d-block w-100" height="400px" alt="...">
            </div>
            <div class="carousel-item">
                <img src="image/slide2.jpg" class=" d-block w-100" height="400px" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="image/slide3.jpg" class=" d-block w-100" height="400px" class="d-block w-100" alt="...">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>


    <!--card container -->
    <div class="container my-3">
        <h2 class="text-center"> iDiscuss- Browse Categories </h2>

        <div class="row">
            <!--fetching all the categories-->

            <?php
            include 'dbconnect.php';
            // Turn off error reporting
            //  error_reporting(0);

            $sql = "SELECT * FROM `category`";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                // echo $row['category_id'];
                // echo $row['category_name'];
                $id = $row['category_id'];
                $cat = $row['category_name'];
                $desc = $row['category_description'];
                $image_name = $row['cat_image'];
                echo '<div class="col-md-4 my-2 ">
                  <div class="card h-100" style="width: 18rem; margin:auto;">
                      <img src="image/' . $image_name . '" class="card-img-top cat-img" alt="...">
                      <div class="card-body">
                          <h5 class="card-title"> <a  href="threadlist.php?catid=' . $id . '">' . $cat . '</a></h5>
                          <p class="card-text text-justify">' . substr($desc, 0, 100) . '...</p>
                          <a href="threadlist.php?catid=' . $id . '" class="btn btn-primary">View Thread</a>
                      </div>
                  </div>
              </div>';
            }

            ?>




        </div>



    </div>


    <?php include 'footer.php'; ?>




    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>
</body>

</html>