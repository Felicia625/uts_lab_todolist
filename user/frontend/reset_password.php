<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        function validatePassword(){
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirmPassword').value;
            const submitButton = document.querySelector('button[type="submit"]');
            const message = document.getElementById('passwordMessage');
            
            if(password == confirmPassword){
                submitButton.disabled = false;
                message.textContent = '';
            } else {
                submitButton.disabled = true;
                message.textContent = 'Passwords do not match!';
                message.style.color ='red';
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <h1 class="text-center mt-3">Reset Password</h1>
        <div class="mt-4 p-4 border-2 rounded-4 mx-auto" style="max-width: 500px; background-color: #DEDEDE;">
            <form action="../backend/reset_password_process.php" method="post">
                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required onkeyup="validatePassword()"/>
                </div>

                <div class="mb-3">
                    <label for="confirmPassword" class="form-label">Confirm Password:</label>
                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" required onkeyup="validatePassword()"/>
                </div>

                <p id="passwordMessage" class="text-center"></p>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary w-50" disabled>Renew Password</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>