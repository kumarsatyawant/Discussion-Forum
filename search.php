<?php
    include "literals/header.php";
    include "literals/dbconnect.php";

    $search = $_GET['search'];
    echo '<div class="container" style="margin-top:75px;">
                    <h2 class="text-light bg-dark">Search Results for :- '. $search.'</h2><hr>
          </div>';
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="css/design.css">
</head>

<body>
    <div class="container min_height">
        <!-- Pulling match search results from the database -->
        <?php
        $sql = "SELECT * FROM `queries` WHERE MATCH (query_title, query_desc) against ('$search')";
        $output = mysqli_query($conn, $sql);

        $result = mysqli_num_rows($output);
        if($result >= 1){
            while($row=mysqli_fetch_assoc($output)){
                echo '<div class="container my-3">
                        <div class="card">
                            <div class="card-header">
                                <a href="comments.php?query_id='.$row['query_id'].'" class="text-dark">
                                <h5 class="card-title">'.$row['query_title'].'</h5></a>
                            </div>
                            <div class="card-body">
                                <p class="card-title">'.$row['query_desc'].'</p>
                            </div>
                         </div>
                        </div>';
            }
        }
        else{
            echo '<div class="container my-5">
                    <div class="jumbotron">
                        <h4>No Results Found for your Search!</h4> 
                        <hr>     
                        <p class="lead">Please make sure, you have entered correct search input.</p>
                    </div>
                  </div>';
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