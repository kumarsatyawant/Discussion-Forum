<?php
    include "literals/header.php";
    include "literals/dbconnect.php";
    $added = false;
?>

<?php
    if($_SERVER["REQUEST_METHOD"] == 'POST'){
        $forum_name = $_POST["forum_name"];
        $forum_desc = $_POST["forum_desc"];

        $sql = "SELECT category_name FROM `categories` WHERE `category_name` = '$forum_name'";
        $output = mysqli_query($conn, $sql);
        $exists = mysqli_num_rows($output);

        if($exists){
            echo '<div class="alert alert-warning alert-dismissible fade show my-0" role="alert">
            <strong>'.$forum_name.' Already exists!</strong> Please create another
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
        else{
            $username = $_SESSION['username'];

            $sql = "SELECT user_id FROM `users` WHERE `username` = '$username'";
            $output = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($output);

            $user_id = $row['user_id'];

            $forum_name = str_replace("<", "&lt;", $forum_name);
            $forum_name = str_replace(">", "&gt;", $forum_name);
        
            $forum_desc = str_replace("<", "&lt;", $forum_desc);
            $forum_desc = str_replace(">", "&gt;", $forum_desc);

            $sql = "INSERT INTO `categories` (`category_name`, `category_desc`, `added_by`, `added`) 
                VALUES ('$forum_name', '$forum_desc', '$user_id', CURRENT_TIMESTAMP())";
            $add = mysqli_query($conn, $sql);
            if($add){
                $added = true;
            }

            if($added){
                echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
                        <strong>Added successfully!</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
            }
        }
    }

?>

<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="css/design.css">
    <title>Welcome to iCoder</title>
</head>

<body style="background-color:#cec5c5;">
    <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
        <ol class="carousel-indicators">
            <li data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active"></li>
            <li data-bs-target="#carouselExampleDark" data-bs-slide-to="1"></li>
            <li data-bs-target="#carouselExampleDark" data-bs-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="10000">
                <img src="img/1.jpg" height="500px" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h1 class="white">Upgrade Your Skills</h1>
                    <p class="white">Comment or Post your queries to start Discussion.</p>
                </div>
            </div>
            <div class="carousel-item" data-bs-interval="2000">
                <img src="img/2.jpg" height="500px" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h1>For Developers</h1>
                    <p>Easiest and fastest way to get your queries answered.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="img/3.jpg" height="500px" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h1 class="white">Our Mission</h1>
                    <p class="white">We encourage productivity, growth and discovery.</p>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleDark" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleDark" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </a>
    </div>

    <div class="container my-2">
        <h3 class="text-center">Browse Forums</h3>
        <div class="row">
            <?php
                $sql = "SELECT * FROM `categories`";
                $output = mysqli_query($conn, $sql);
                while($row=mysqli_fetch_assoc($output)){
                    echo '<div class="col-md-4 py-3">
                    <div class="card" style="width: 18rem;">
                        <img src="img/python.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">'.$row['category_name'].'</h5>
                            <p class="card-text">'.substr($row['category_desc'], 0, 60).'...</p>
                            <a href="queries.php?category_id='.$row['category_id'].'" class="btn btn-warning"><b>See more</b></a>
                        </div>
                    </div>
                </div>';
                }
            ?>
            <!-- <div class="col-md-4 py-3">
                <div class="card" style="width: 18rem;">
                    <img src="img/python.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                            the
                            card's
                            content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div> -->

        </div>
    </div>

    <div class="container">
        <h3 class="mb-0">Start New Forum</h3>
        <hr>
        <?php
            if(isset($_SESSION['login'])){
                echo '<form action="home.php" method="post">
                <div class="w-50">
                    <div class="my-3">
                    <label for="forum_name" class="form-label"><b>Forum Name</b></label>
                    <input type="text" class="form-control" id="forum_name" name="forum_name"
                        placeholder="Enter forum name..." required>
                    <small id="emailHelp" class="form-text text-muted">Keep your name as short and crisp as
                        possible</small>
                    </div>
                    <div class="my-3">
                    <label for="forum_desc" class="form-label"><b>Forum Description</b></label>
                    <textarea class="form-control" id="forum_desc" name="forum_desc"
                        placeholder="Enter some description about the forum..." required></textarea>
                    </div>
                </div>
                <div class="mb-3"><button type="submit" class="btn btn-danger btn-sm"><b>Add</b></button></div>
            </form>';
            }
            else{
                echo '<p>Please login to start a forum
                      <button type="button" class="btn btn-link px-0" data-bs-toggle="modal" data-bs-target="#loginModal"
                    data-bs-whatever="@mdo">Login</button></p>';
            }
        ?>
    </div>

    <?php
        include "literals/footer.php";
    ?>

    <!-- Bootstrap Javascript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
    </script>

</body>

</html>