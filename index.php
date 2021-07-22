<?php
    include "literals/header.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <link rel="stylesheet" href="css/design.css">
</head>

<body style="background-color:#cec5c54d;">
    <div class="container pt-3">
        <div class="card">
            <h3 class="card-header">Best Forum for Programmers</h3>
            <div class="card-body">
                <h5 class="card-title">Welcome to iCoder</h5>
                <p class="card-text">By registering with us, you'll be able to discuss and share with other members of
                    our community.</p>
                <?php
                    if(!isset($_SESSION['login'])){
                        echo '<button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#signupModal"
                        data-bs-whatever="@mdo"><b>SignUp for iCoder!</b></button>';
                    }
                ?>
            </div>
        </div>
    </div>

    <div class="container my-5">
        <div class="card w-50 mx-auto">
            <img src="img/index_1.jpg" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title text-center">Public Q&A</h5>
                <p class="card-text text-center">Get answers of your question from anywhere in the world. Level up with
                    iCoder while you work. Share knowledge privately with your coworkers using our Q&A forum.</p>
                <p class="text-center"><a href="home.php"><button class="btn btn-primary btn-lg"><b>Browse Questions</b></button></a></p>
            </div>
        </div>
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