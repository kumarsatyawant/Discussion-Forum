<?php
    session_start();
    include 'dbconnect.php';
    if(isset($_SESSION['login']) && $_SESSION['login']== true){
        $login_status = true;
        $uname = $_SESSION['username'];
        $sql = "SELECT * FROM `users` WHERE `username` = '$uname'";
        $output = mysqli_query($conn, $sql);
        $row=mysqli_fetch_assoc($output);
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
    }
    else{
        $login_status = false;
    }
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <link rel="stylesheet" href="css/design.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/icoder"><b>iCoder</b></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/icoder/home.php"><b>Home</b></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/icoder/about.php"><b>About</b></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/icoder/contact.php"><b>Contact Us</b></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <b>Popular Categories</b>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php
                                $sql = "SELECT category_name, category_id FROM `categories` limit 5";
                                $output = mysqli_query($conn, $sql);
                                while($row=mysqli_fetch_assoc($output)){
                                    echo '<li><a class="dropdown-item" href="queries.php?category_id='.$row['category_id'].'"><b>'.$row['category_name'].'</b></a></li>';
                                }
                            ?>
                            <!-- <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li> -->
                        </ul>
                    </li>
                </ul>
                <form class="d-flex" action="search.php" method="get">
                    <input class="form-control me-2" style="padding: 3px 10px;" name="search" type="search"
                        placeholder="Search" aria-label="Search">
                    <button class="btn btn-warning btn-sm py-0" type="submit"><b>Search</b></button>
                </form>
                <?php
                    if($login_status){
                        // echo '<p class="text-light mb-0 mx-1">Welcome '.$firstname.' '.$lastname.'</p>
                        //         <a href="literals/logout_handler.php"><button type="button" class="btn btn-outline-warning btn-sm mx-2"><b>Logout</b></button></a>';

                        echo '<ul class="navbar-nav mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <b>Hello, '.$firstname.'</b>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li class="ms-3">Signed in as</li>
                                <li class="ms-3"><b>'.$_SESSION['username'].'</b></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                
                                <li><a class="dropdown-item" href="profile_overview.php">Your profile</a></li>
                            </ul>
                        </li>
                    </ul>
                        <a href="literals/logout_handler.php"><button type="button" class="btn btn-outline-warning btn-sm mx-2"><b>Logout</b></button></a>';
                    }
                    else{
                        echo '<button type="button" class="btn btn-outline-warning btn-sm mx-2" data-bs-toggle="modal" data-bs-target="#loginModal"
                                data-bs-whatever="@mdo"><b>Login</b></button>
                                <button type="button" class="btn btn-outline-warning btn-sm" data-bs-toggle="modal" data-bs-target="#signupModal"
                                data-bs-whatever="@mdo"><b>Sign Up</b></button>';
                    }
                ?>
                <!--<button type="button" class="btn btn-warning mx-2" data-bs-toggle="modal" data-bs-target="#loginModal"
                    data-bs-whatever="@mdo"><b>Login</b></button>
                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#signupModal"
                    data-bs-whatever="@mdo"><b>Sign Up</b></button>-->
            </div>
        </div>
    </nav>

    <?php
        include "login.php";
        include "signup.php";
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
    </script>
</body>

</html>

<?php
    //Signup verification
    if(isset($_GET['signup']) && $_GET['signup'] == "true"){
        echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
        <strong>Success! </strong> Your Account has been created.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    elseif(isset($_GET['signup']) && isset($_GET['error'])){
        echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
        <strong>Alert! </strong>'. $_GET['error'].
        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
?>

<?php
    //Login Verification style="margin-top:57px;"
    if(isset($_GET['loginerror'])){
        echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
        <strong>Alert! </strong>'.$_GET['loginerror'].
        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
?>

<?php
    //Showing alert for account password change successfully
    if(isset($_GET['pass_change']) && $_GET['pass_change']=="true"){
        echo '<div class="alert alert-primary alert-dismissible fade show my-0" role="alert">
                <strong>Account password changed successfully! </strong> Please login again
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
    }
?>