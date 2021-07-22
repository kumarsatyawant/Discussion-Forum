<?php
    include "literals/header.php";
    include "literals/dbconnect.php";
?>

<?php
    $username = $_SESSION['username']; 
    $sql = "SELECT * FROM `users` WHERE `username` = '$username'";
    $output = mysqli_query($conn, $sql);
    $row=mysqli_fetch_assoc($output);
    $firstname = $row['firstname'];
    $lastname = $row['lastname'];
    $user_id = $row['user_id'];

    //fetch total number of questions posted by a user
    $sql = "SELECT post_id FROM `queries` WHERE `post_id` = '$user_id'";
    $output = mysqli_query($conn, $sql);
    $questions = mysqli_num_rows($output);

    $no_of_questions = $questions;

    if($questions<=0){
        $no_of_questions = 0;
    }

    //fetch total number of comments posted by a user
    $sql = "SELECT post_id FROM `comments` WHERE `post_id` = '$user_id'";
    $output = mysqli_query($conn, $sql);
    $comments = mysqli_num_rows($output);

    $no_of_comments = $comments;

    if($comments<=0){
        $no_of_comments = 0;
    }
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <link rel="stylesheet" href="css/design.css">

</head>

<body>
    <div class="container min_height">
        <?php
            include "literals/profile_header.php";
        ?>
        <hr>

        <div class="d-flex">
            <div class="d-flex flex-column bd-highlight justify-content-center align-items-center mb-3">
                <img src="img/profile.jpg" alt="">
                <?php
                    echo '<h4>'.$firstname.' '.$lastname.'</h4>';
                ?>
                <a href="profile.php"><button type="button" class="btn btn-outline-danger my-2"><b>Edit
                            profile</b></button></a>

            </div>

            <div class="row mt-5 ms-5">
                <div class="col">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">Total Questions posted</h5>
                            <hr>
                            <?php
                                echo '<p class="card-text">'.$no_of_questions.' questions.</p>';
                            ?>
                            <a href="home.php" class="btn btn-primary btn-sm">Post more</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">Forums added</h5>
                            <hr>
                            <?php
                                    //Total forums added
                                    $sql = "SELECT category_name FROM `categories` WHERE `added_by` = '$user_id'";
                                    $output = mysqli_query($conn, $sql);
                                    $no_forums = mysqli_num_rows($output);
                                    if($no_forums<=0){
                                        echo '<p class="card-text">No forums created </p>';
                                    }
                                    else{
                                        echo '<ul>';
                                        while($row=mysqli_fetch_assoc($output)){
                                            echo'<li>'.$row['category_name'].'</li>';
                                        }
                                        echo '</ul>';
                                    }
                                ?>
                            <a href="home.php" class="btn btn-primary btn-sm">Add new</a>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row mt-5">
                <div class="col">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">Total Comments</h5>
                            <hr>
                            <?php
                                echo '<p class="card-text">'.$no_of_comments.' comments.</p>';
                            ?>
                            <a href="home.php" class="btn btn-primary btn-sm">Comment more</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <?php
            include "literals/footer.php";
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
    </script>
</body>

</html>