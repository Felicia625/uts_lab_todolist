<?php
session_start();

$username = $_SESSION['username'];
$email = $_SESSION['email'];
$birthday = $_SESSION['birthday'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">

        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="../../index.php">To Do List</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="../../index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../todolist/frontendcreate.php">Create Task</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="user_profile.php">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../user/backend/logout_process.php">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <h1 class="text-center mt-3">Edit Profile</h1>
        <?php
            if(isset($_GET['error'])){
                if($_GET['error'] == 'emailtaken'){
                    echo "<div style='max-width: 500px; margin: auto;' class='alert alert-danger mt-3 text-center' role='alert'>Email already taken. Please try something else.</div></div>";
                } elseif($_GET['error'] == 'invalidEmail'){
                    echo "<div style='max-width: 500px; margin: auto;' class='alert alert-danger mt-3 text-center' role='alert'>Invalid email format. Please enter a valid email address.</div></div>";
                }
            }
        ?>

        <div class="mt-4 p-4 border-2 rounded-4" style="max-width: 500px; margin: auto; background-color: #DEDEDE;">
            <form action="../backend/edit_profile_process.php" method="post">
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="<?= $email?>"/>
                </div>

                <div class="mb-3">
                    <label for="username" class="form-label">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="<?= $username?>"/>
                </div>

                <div class="mb-3">
                    <label for="birthday" class="form-label">Birthday:</label>
                    <input type="date" class="form-control" id="birthday" name="birthday" placeholder="<?=$birthday?>"/>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="*******"/>
                </div>
                
                <div class="text-center">
                    <button type="submit" class="btn btn-primary w-50">Save</button>
                </div>
            </form>

            <div class="mt-3 text-center">
                <a href="user_profile.php" class="btn btn-primary w-50">Cancel</a>
            </div> 
        </div>
    </div>
</body>
</html>
