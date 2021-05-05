<?php
if (isset($_SESSION['username'])) {
    header('location:'.BASE_URL.'index.php');
}

if (isset($_POST['submit'])) {
    $login = new UserController();
    $login->login();

}
?>

<body>
    <div id="login" class="mt-5">
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form p-5" action="" method="POST">
                            <div class="card-header">

                                <h3 class="text-center">Login</h3>
                            </div>

                            <div class="form-group">
                                <label for="email" class="">Email:</label><br>
                                <input type="email" name="email" id="email" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="password" class="">Password:</label><br>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>

                            <div class="form-group mt-3">
                                <input type="submit" name="submit" class="btn btn-primary" value="submit">
                            </div>

                            <div id="register-link" class="text-right">
                                <a href="register" class="">Register here</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>