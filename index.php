<!doctype html>
<html>
<head>
    <title>Index</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        function submitFilterForm() {
            document.getElementById("filterForm").submit();
        }
    </script>
</head>

<body>
    <div class="container">
        <?php
            session_start();
            if(!isset($_SESSION['username']) && !isset($_SESSION['userid'])){
        ?>

        <div class="text-center">
            <div style='max-width: 500px; margin: auto;' class='alert alert-danger mt-3 text-center' role='alert'>You don't have access to this page</div>
            <a href="user/frontend/login.php" class="btn btn-primary mt-3">Login</a>
        </div>

        <?php
            } else {
                require_once("db.php");

                $userid = $_SESSION['userid'];
                $username = $_SESSION['username'];

                $filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';
                $search = isset($_GET['search']) ? $_GET['search'] : '';

                $sql = "SELECT * FROM list WHERE userid = :userid";

                // Modify the query based on the filter
                if($filter == 'completed'){
                    $sql .= " AND (status = 'Done' OR status = 'Done Late')";
                } else if($filter == 'incomplete'){
                    $sql .= " AND status = 'Not Done'";
                } else if($filter == 'work'){
                    $sql .= " AND category = 'Work'";
                } else if($filter == 'personal'){
                    $sql .= " AND category = 'Personal'";
                } else if($filter == 'grocery'){
                    $sql .= " AND category = 'Grocery'";
                } else if($filter == 'activity'){
                    $sql .= " AND category = 'Activity'";
                } else if($filter == 'other'){
                    $sql .= " AND category = 'Other'";
                }

                // Add search functionality for task title
                if (!empty($search)) {
                    $sql .= " AND title LIKE :search";
                }

                // Prepare and execute the query
                $stmt = $db->prepare($sql);
                $stmt->bindParam(':userid', $userid, PDO::PARAM_INT);

                if (!empty($search)) {
                    $searchTerm = "%" . $search . "%";
                    $stmt->bindParam(':search', $searchTerm, PDO::PARAM_STR);
                }

                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href='index.php'>To Do List</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="todolist/frontend/create.php">Create Task</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="profile/frontend/user_profile.php">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="user/backend/logout_process.php">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Welcome message -->
        <h1 class="mt-3 text-center">Welcome to <?= $username?>'s To Do List</h1>

        <!-- Content -->
        <div class="mx-auto my-4" style="max-width: 900px;">

            <!-- Filter & Search -->
            <div class="my-3">
                <form id="filterForm" method="GET" action="">
                    <div class="mb-3">
                        <label for="filter" class="me-3">Filter:    </label>
                        <select name="filter" id="filter" class="form-select d-inline-block" style="max-width: 210px;" onchange="submitFilterForm()">
                            <option value="all" <?= $filter == 'all' ? 'selected' : ''; ?>>All Tasks</option>
                            <option value="completed" <?= $filter == 'completed' ? 'selected' : ''; ?>>Completed Tasks</option>
                            <option value="incomplete" <?= $filter == 'incomplete' ? 'selected' : ''; ?>>Incomplete Tasks</option>
                            <option value="work" <?= $filter == 'work' ? 'selected' : ''; ?>>Category: Work</option>
                            <option value="personal" <?= $filter == 'personal' ? 'selected' : ''; ?>>Category: Personal</option>
                            <option value="grocery" <?= $filter == 'grocery' ? 'selected' : ''; ?>>Category: Grocery</option>
                            <option value="activity" <?= $filter == 'activity' ? 'selected' : ''; ?>>Category: Activity</option>
                            <option value="other" <?= $filter == 'other' ? 'selected' : ''; ?>>Category: Other</option>
                        </select>
                    </div>

                    <!-- Search Bar -->
                    <div>
                        <label for="search" class="me-1">Search:</label>
                        <input type="text" name="search" id="search" value="<?= htmlentities($search); ?>" class="form-control d-inline-block" style="max-width: 210px" placeholder="Search by title">
                        <button type="submit" class="btn btn-light">Search</button>
                    </div>
                </form>
            </div>

            <!-- Display Task List -->
            <div>
            <?php foreach ($result as $row) { ?>
                <div class="card my-2 mx-auto">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title"><?= $row['title']; ?></h5>
                            <div>#<?= $row['category']; ?></div>
                        </div>
                        <div class="card-text">Due:
                            <?php
                            if ($row['deadline'] != NULL) {
                                if ((time() > strtotime($row['deadline']) && $row['status'] == 'Not Done') || ($row['status'] == 'Done Late')) {
                                    echo "<span style='color: red;'>" . date("d-M-Y H:ia", strtotime($row['deadline'])) . "</span>";
                                } else {
                                    echo date("d-M-Y H:ia", strtotime($row['deadline']));
                                }
                            } else {
                                echo "No deadline";
                            }
                            ?>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="card-text" <?php
                                if ($row['status'] == 'Done') echo "style='color: green;'";
                                else if (($row['deadline'] != NULL && time() > strtotime($row['deadline']) && $row['status'] == 'Not Done') || ($row['status'] == 'Done Late')) echo "style='color: red;'";
                            ?>><?= $row['status']; ?>
                            </div>
                            <div><a href="todolist/frontend/view.php?id=<?= $row['listid']; ?>" class="btn btn-primary">View</a></div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            </div>
        <?php } ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
