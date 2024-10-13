<?php
session_start();
if(isset($_SESSION['user_id'])){
    header('Location: ../../index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="text-center mt-3">Login</h1>
        <?php
            if(isset($_GET['error'])){
                if($_GET['error'] == 'email'){
                    echo "<div style='max-width: 500px; margin: auto;' class='alert alert-danger mt-3 text-center' role='alert'>Email not found. Please try again.</div>";
                } elseif($_GET['error'] == 'password'){
                    echo "<div style='max-width: 500px; margin: auto;' class='alert alert-danger mt-3 text-center' role='alert'>Incorrect password. Please try again.</div>";
                }
            } else if(isset($_GET['success'])){
                if($_GET['success'] == 'renewpassword'){
                    echo "<div style='max-width: 500px; margin: auto;' class='alert alert-success mt-3 text-center' role='alert'>Password successfully renewed</div>";
                }
            }
        ?>

        <div class="mt-4 p-4 border-2 rounded-4" style="max-width: 500px; margin: auto; background-color: #DEDEDE;">
            <form action="../backend/login_process.php" method="post">
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="Email" required/>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required/>
                </div>

                <div class="text-center mb-3">
                    <a href="forgot_password.php" class="small">Forgot Password?</a>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary w-50">Login</button>
                </div>
            </form>
            <div class="text-center mt-3">
                <a href="register.php" class="btn btn-primary w-50">Register</a>
            </div>
        </div>
    </div>
</body>
</html>


