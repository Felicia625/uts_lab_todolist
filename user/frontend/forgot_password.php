<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Info Validation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="text-center mt-3">User Info Validation</h1>
        <?php
            if(isset($_GET['error'])){
                if($_GET['error'] == 'email'){
                    echo "<div style='max-width: 500px; margin: auto;' class='alert alert-danger mt-3 text-center' role='alert'>Email not found. Please try again.</div>";
                } elseif($_GET['error'] == 'username'){
                    echo "<div style='max-width: 500px; margin: auto;' class='alert alert-danger mt-3 text-center' role='alert'>Username don't match. Please try again.</div>";
                } elseif($_GET['error'] == 'birthday'){
                    echo "<div style='max-width: 500px; margin: auto;' class='alert alert-danger mt-3 text-center' role='alert'>Birthday don't match. Please try again.</div>";
                }
            }
        ?>

        <div class="mt-4 p-4 border-2 rounded-4" style="max-width: 500px; margin: auto; background-color: #DEDEDE;">
            <form action="../backend/forgot_password_process.php" method="post">
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required/>
                </div>

                <div class="mb-3">
                    <label for="username" class="form-label">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" required/>
                </div>

                <div class="mb-3">
                    <label for="birthday" class="form-label">Birthday:</label>
                    <input type="date" class="form-control" id="birthday" name="birthday" required />
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary w-50">Confirm</button>
                </div>
            </form>
            <div class="text-center mt-3">
                <a href="login.php" class="btn btn-primary w-50">Go Back</a>
            </div>
        </div>
    </div>
</body>
</html>