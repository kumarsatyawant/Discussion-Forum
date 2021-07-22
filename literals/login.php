<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to iCoder</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="css/design.css">
</head>

<body>
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Login to iCoder Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="literals/login_handler.php" method="post">
                        <div class="mb-3">
                            <label for="login_username" class="col-form-label"><b>UserName:</b><small id="emailHelp"
                                    class="form-text required">*</small></label>
                            <input type="text" class="form-control" id="login_username" name="login_username" required>
                        </div>
                        <div class="mb-3">
                            <label for="login_password" class="col-form-label"><b>Password:</b><small id="emailHelp"
                                    class="form-text required">*</small></label>
                            <input type="password" class="form-control" id="login_password" name="login_password"
                                required>
                        </div>
                        <div class="mb-3 d-grid gap-2">
                            <button type="submit" class="btn btn-warning"><b>Login</b></button>
                            <button type="reset" class="btn btn-warning"><b>Reset</b></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>