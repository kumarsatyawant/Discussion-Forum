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
    <div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Your Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="literals/signup_handler.php" method="post">
                        <div class="mb-3">
                            <label for="fname" class="col-form-label"><b>First Name:</b>
                                <small id="emailHelp" class="form-text required">*</small>
                            </label>
                            <input type="text" class="form-control" id="fname" name="fname"
                                placeholder="Enter your name.." required>
                        </div>
                        <div class="mb-3">
                            <label for="lname" class="col-form-label"><b>Last Name:</b><small id="emailHelp"
                                    class="form-text required">*</small></label>
                            <input type="text" class="form-control" id="lname" name="lname"
                                placeholder="Enter your last name.." required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="col-form-label"><b>Email:</b><small id="emailHelp"
                                    class="form-text required">*</small></label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Enter your email.." required>
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                                else.</small>
                        </div>
                        <div class="mb-3">
                            <label for="country" class="col-form-label"><b>Country:</b><small id="emailHelp"
                                    class="form-text required">*</small></label>
                            <input type="text" class="form-control" id="country" name="country"
                                placeholder="Enter your nationality.." required>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="col-form-label"><b>UserName:</b><small id="emailHelp"
                                    class="form-text required">*</small></label>
                            <input type="text" class="form-control" id="username" name="username" maxlength="15"
                                placeholder="Select your username.." required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="col-form-label"><b>Password:</b><small id="emailHelp"
                                    class="form-text required">*</small></label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Select your password.." required>
                        </div>
                        <div class="mb-3">
                            <label for="confirm_password" class="col-form-label"><b>Confirm Password:</b><small
                                    id="emailHelp" class="form-text required">*</small></label>
                            <input type="password" class="form-control" id="confirm_password"
                                placeholder="Retype your password.." name="confirm_password" required>
                        </div>
                        <div class="mb-3 d-grid gap-2">
                            <button type="submit" class="btn btn-warning"><b>Register</b></button>
                            <button type="reset" class="btn btn-warning"><b>Reset</b></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
    </script>

</body>

</html>