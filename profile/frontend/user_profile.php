<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <?php
            session_start();
            if(!isset($_SESSION['username']) &&
                !isset($_SESSION['userid'])){
        ?>

        <div class="text-center">
            <div style='max-width: 500px; margin: auto;' class='alert alert-danger mt-3 text-center' role='alert'>You don't have access to this page</div>
            <a href="../../user/frontend/login.php" class="btn btn-primary mt-3">Login</a>
        </div>

        <?php } else {
            $username = $_SESSION['username'];
            $email = $_SESSION['email'];
            $birthday = $_SESSION['birthday'];
        ?>

        <h1 class="text-center mt-3">Profile</h1>
        <div class="mt-4 p-4 border-2 rounded-4 mx-auto" style="max-width: 500px; background-color: #DEDEDE;">
            <hr>
            <table class="table table-borderless">
                <tr>
                    <th>Username :</th>
                    <td><?php echo $username;?></td>
                </tr>
                <tr>
                    <th>Email :</th>
                    <td><?php echo $email;?></td>
                </tr>
                <tr>
                    <th>Birthday :</th>
                    <td><?php echo $birthday;?></td>
                </tr>
                <tr>
                    <th>Password :</th>
                    <td>********</td>
                </tr>
            </table>
            <hr>
            <div class="text-center mb-3">
                <a href="edit_profile.php" class="btn btn-primary w-50">Edit Profile</a>
            </div>
            <div class="text-center mb-2">
                <a href="../../index.php" class="btn btn-primary w-50">Go Back</a>
            </div>
        </div>
        <?php }?>
    </div>
</body>
</html>