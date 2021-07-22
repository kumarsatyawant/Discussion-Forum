<?php
    include "literals/header.php";
    include "literals/dbconnect.php";
    $alert = false;
?>

<!-- Question post handling -->
<?php
    $cat_id = $_GET['category_id'];
    if($_SERVER["REQUEST_METHOD"] == 'POST'){
        $query_title = $_POST["query_title"];
        $query_desc = $_POST["query_desc"];
        $poster = $_SESSION['poster'];

        $query_title = str_replace("<", "&lt;", $query_title);
        $query_title = str_replace(">", "&gt;", $query_title); 

        $query_desc = str_replace("<", "&lt;", $query_desc);
        $query_desc = str_replace(">", "&gt;", $query_desc);

        $sql = "INSERT INTO `queries` (`query_title`, `query_desc`, `cat_id`, `post_id`, `posted_on`) 
                VALUES ('$query_title', '$query_desc', '$cat_id', '$poster', CURRENT_TIMESTAMP())";
        $save = mysqli_query($conn, $sql);
        if($save){
            $alert = true;
        }

        if($alert){
            echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
            <strong>Posted successfully! </strong> Please wait for the community to respond.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
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

    <!-- jumbotron CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="css/design.css">

    <title>Queries</title>
</head>

<body>
    <!-- Displaying heading for specific category -->
    <?php
     if(isset($_GET['category_id'])){
        //$cat_id = $_GET['category_id'];
        $sql = "SELECT * FROM `categories` WHERE category_id = $cat_id";
        $output = mysqli_query($conn, $sql);

        if($output){
            $row=mysqli_fetch_assoc($output);
            echo '<div class="container my-3">
                        <div class="jumbotron">
                            <h1 class="display-4">Welcome to '.$row['category_name'].' Discussion.</h1>
                            <p>'.$row['category_desc'].'</p>
                            <hr class="my-4">
                            <p class="lead">You can post your questions or answer questions asked by other people.</p>
                            <p class="lead">Please make sure to maintain decoram of the portal!</p>
                        </div>
                  </div>';
        }
     }
    ?>

    <h3 class="container mb-3">Ask Question</h3>

    <!-- Question post form -->
    <?php
        if(isset($_SESSION['login']) && $_SESSION['login']== true){
            echo '<div class="container">
            <hr>
            <form action="'.$_SERVER["REQUEST_URI"].'" method="post">
                <div class="mb-3">
                    <label for="query_title" class="form-label"><b>Title</b></label>
                    <input type="text" class="form-control" id="query_title" name="query_title"
                        placeholder="Enter title of your question..." required>
                    <small id="emailHelp" class="form-text text-muted">Keep your title as short and crisp as
                        possible</small>
                </div>
                <div class="mb-3">
                    <label for="query_desc" class="form-label"><b>Description</b></label>
                    <textarea class="form-control" id="query_desc" name="query_desc" rows="3"
                        placeholder="Describe your concern..." required></textarea>
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
                    <p>Please login to ask or post your queries
                    <button type="button" class="btn btn-link px-0" data-bs-toggle="modal" data-bs-target="#loginModal"
                    data-bs-whatever="@mdo">Login</button></p>
                    </div>';
        }
     ?>

    <!-- Displaying all the questions asked by community for a specific category -->
    <?php
        echo '<h3 class="container mt-5 mb-4">Questions Asked By Community<hr></h3>';

        $sql = "SELECT * FROM `queries` WHERE cat_id = $cat_id";
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
                            <div class="card-header">
                                <a href="comments.php?query_id='.$row['query_id'].'" class="text-dark"><h5 class="card-title">'.$row['query_title'].'</h5></a>
                            </div>
                            <div class="card-body">
                                <p class="card-title">'.$row['query_desc'].'</p>
                                <p class="card-text"><strong>Asked by: </strong>'.$row_1['firstname'].' '.$row_1['lastname'].' on '.$row['posted_on'].'</p>
                            </div>
                         </div>
                        </div>';
            }
        }
        else{
            echo '<div class="container">
                    <div class="jumbotron">
                        <h4>No Questions posted by community</h4>      
                        <p class="lead">Be the first one to ask and start the discussion!</p>
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