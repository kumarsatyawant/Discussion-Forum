<?php
    include "literals/header.php";
    include "literals/dbconnect.php";
    $sent = false;
?>

<!-- Comment post handling -->
<?php
    $query_id = $_GET['query_id'];
    if($_SERVER["REQUEST_METHOD"] == 'POST'){
        $comment_desc = $_POST["comment_desc"];
        $poster = $_SESSION['poster'];

        $comment_desc = str_replace("<", "&lt;", $comment_desc);
        $comment_desc = str_replace(">", "&gt;", $comment_desc); 

        $sql = "INSERT INTO `comments` (`comment_desc`, `query_id`, `post_id`, `comment_time`) 
                VALUES ('$comment_desc', '$query_id', '$poster', CURRENT_TIMESTAMP());";
        $save = mysqli_query($conn, $sql);
        if($save){
            $sent = true;
        }

        if($sent){
            echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
            <strong>Posted successfully! </strong>.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
    }

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comments</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <!-- jumbotron CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="css/design.css">
</head>

<body>
    <!-- Displaying description of the question -->
    <?php
        //$query_id=$_GET['query_id'];
        $sql = "SELECT * FROM `queries` WHERE query_id = $query_id";
        $output = mysqli_query($conn, $sql);
        $row=mysqli_fetch_assoc($output);
        $post_id=$row['post_id'];
        $sql = "SELECT * FROM `users` WHERE user_id = $post_id";
        $name = mysqli_query($conn, $sql);
        $name_1=mysqli_fetch_assoc($name);
        echo '<div class="container my-3">
                    <div class="jumbotron">
                        <h2>'.$row['query_title'].'</h2>      
                        <p class="lead">'.$row['query_desc'].'</p>
                        <hr>
                        <p class="lead"><b>Asked by</b>: '.$name_1['firstname'].' '.$name_1['lastname'].' on '.$row['posted_on'].'</p>
                    </div>
                </div>';
    ?>

    <h3 class="container">Comment Your Answer</h3>

    <!-- Comment post form -->
    <?php
        if(isset($_SESSION['login']) && $_SESSION['login']== true){
            echo '<div class="container">
            <hr>
            <form action="'.$_SERVER["REQUEST_URI"].'" method="post">
                <div class="mb-3">
                    <label for="comment_desc" class="form-label"></label>
                    <textarea class="form-control" id="comment_desc" name="comment_desc" rows="3"
                        placeholder="Type your comment..." required></textarea>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary" type="button"><b>Submit</b></button>
                    <button type="reset" class="btn btn-primary" type="button"><b>Reset</b></button>
                </div>
            </form>
        </div>';
        }
        else{
            echo '<div class="container">
                    <hr>
                    <p>Please login to comment
                    <button type="button" class="btn btn-link px-0" data-bs-toggle="modal" data-bs-target="#loginModal"
                    data-bs-whatever="@mdo">Login</button></p>
                    </div>';
        }
     ?>

    <!-- Displaying every comments for a particular question -->
    <?php
        echo '<h3 class="container mt-5 mb-4">Community Answers<hr></h3>';

        $sql = "SELECT * FROM `comments` WHERE query_id = $query_id";
        $output = mysqli_query($conn, $sql);

        $result = mysqli_num_rows($output);
        if($result >= 1){
            while($row=mysqli_fetch_assoc($output)){
                $post_id = $row['post_id'];
                $sql_1 = "SELECT * FROM `users` WHERE user_id = $post_id";
                $result = mysqli_query($conn, $sql_1);
                $row_1=mysqli_fetch_assoc($result);
                echo '<div class="container my-3">
                        <div class="card">
                            <div class="card-body">
                                <p class="card-text"><strong>Posted by: </strong>'.$row_1['firstname'].' '.$row_1['lastname'].' on '.$row['comment_time'].'</p>
                                <p class="card-title">'.$row['comment_desc'].'</p>
                            </div>
                         </div>
                        </div>';
            }
        }
        else{
            echo '<div class="container">
                    <div class="jumbotron">
                        <h4>No Comments posted by community</h4>      
                        <p class="lead">Be the first one to comment your answer!</p>
                    </div>
                  </div>>';
        }
        
    ?>

    <?php
        include "literals/footer.php";
    ?>
    <!-- Bootstrap Javascript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
    </script>
</body>

</html>