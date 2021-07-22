<?php
    include "literals/header.php";
    include "literals/dbconnect.php";
?>

<?php
    //Showing alert for wrong input during password change
    if(isset($_GET['pass_error'])){
        echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
                    <strong>Error! </strong>'.$_GET['pass_error'].'
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                   </div>';
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

<body style="background-color:#cec5c54d;">
    <div class="container min_height">
        <?php
            include "literals/profile_header.php";
        ?>
        <hr>

        <h3 class="pt-5">Change password</h3>
        <hr>

        <?php
            $username = $_SESSION['username'];  

            echo '<form action="account_security_handler.php" method="post" class="row g-3 w-50">
                        <div class="col-12">
                            <label for="oldpass" class="form-label"><b>Old password</b></label>
                            <input type="password" class="form-control" id="oldpass" name="oldpass" required>
                        </div>
                        <div class="col-12">
                            <label for="newpass" class="form-label"><b>New password</b></label>
                            <input type="password" class="form-control" id="newpass" name="newpass" required>
                        </div>
                        <div class="col-12">
                            <label for="confirm_newpass" class="form-label"><b>Confirm new password</b></label>
                            <input type="password" class="form-control" id="confirm_newpass" name="confirm_newpass" required>
                        </div>

                        <input type="hidden" class="form-control" id="username" name="username" value="'.$username.'">

                        <div class="col-12">
                            <button type="submit" class="btn btn-danger"><b>Update password</b></button>
                        </div>
                  </form>';
        ?>
    </div>

    <?php
            include "literals/footer.php";
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
    </script>

</body>

</html>