<?php
$newUser = new UserController;
$newUser->register();

if (isset($_SESSION['username'])) {
    header('location:'.BASE_URL.'index.php');
}

?>

<div id="register" class=" mt-5 main d-flex flex-column align-items-center w-25 mx-auto">

    <h1>Sign up</h1>
    <div class="container">
        <form method="POST" class="signup-form">
            <div class="form-group">
                <label for="name">Full name</label>
                <input type="text" name="name" id="name" class="form-control" />
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" />
            </div>

            <div class="form-group">
                <label for="pass">Password</label>
                <input type="password" name="pass" id="pass" class="form-control" />
            </div>

            <div class="form-group">
                <label for="dob">Date of birth</label>
                <input type="date" name="dob" id="dob" class="form-control" />
            </div>
            
            <div class="form-group">
                <input type="submit" name="register" id="submit" class="submit btn btn-primary my-3" value="Create account" />
            </div>

        </form>

        <p class="loginhere">
            Already have an account ?<a href="login" class="loginhere-link"> Log in</a>
        </p>
    </div>

</div>