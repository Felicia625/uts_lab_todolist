<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Task</title>
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
                            <a class="nav-link" href="create.php">Create Task</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../profile/frontend/user_profile.php">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../user/backend/logout_process.php">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <h1 class="text-center mt-3">Create Task</h1>

        <div class="mt-4 p-4 border-2 rounded-4" style="max-width: 500px; margin: auto; background-color: #DEDEDE;">
            <form action="../backend/create_process.php" method="post">
                <div class="mb-3">
                    <label for="Title" class="form-label">Title:</label>
                    <input type="text" class="form-control" id="title" name="title" required />
                </div>

                <div class="mb-3">
                    <label for="category" class="form-label">Category:</label>
                    <select class="form-select" id="category" name="category" required>
                        <option value="">Select Category</option>
                        <option value="Work">Work</option>
                        <option value="Personal">Personal</option>
                        <option value="Grocery">Grocery</option>
                        <option value="Activity">Activity</option>
                        <option value="Other">Other</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description:</label>
                    <input type="text" class="form-control" id="description" name="description" maxlength="200" />
                </div>

                <div class="mb-3">
                    <label for="deadline" class="form-label">Deadline:</label>
                    <input type="datetime-local" class="form-control" id="deadline" name="deadline" />
                </div>
                
                <div class="text-center">
                    <button type="submit" class="btn btn-primary w-50">Add Task</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
