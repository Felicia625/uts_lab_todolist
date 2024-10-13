<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="text-center mt-3">Register</h1>
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
            <form action="../backend/register_process.php" method="post">
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required />
                </div>

                <div class="mb-3">
                    <label for="username" class="form-label">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" maxlength="50" required />
                </div>

                <div class="mb-3">
                    <label for="birthday" class="form-label">Birthday:</label>
                    <input type="date" class="form-control" id="birthday" name="birthday" required />
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" minlength="5" required />
                </div>
                
                <div class="text-center">
                    <button type="submit" class="btn btn-primary w-50">Register</button>
                </div>
            </form>

            <div class="mt-3 text-center">
                <a href="login.php" class="btn btn-primary w-50">Login</a>
            </div> 
        </div>
    </div>
</body>
</html>
