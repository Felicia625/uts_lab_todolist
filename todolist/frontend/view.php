<?php

$id = $_GET['id'];
require_once('../../db.php');

$sql = "SELECT * FROM list WHERE listid = ?";
$stmt = $db->prepare($sql);
$stmt->execute([$id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Task Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
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
        
        <h1 class="text-center mt-3">View Task Details</h1>
        <div class="mt-4 p-4 border-2 rounded-4 mx-auto" style="max-width: 500px; background-color: #DEDEDE;">
            <div class="d-flex justify-content-between">
                <h3><?= $row['title']?></h3>
                <div># <?= $row['category']?></div>
            </div>
            <hr>
            <div>Due:
                <?php
                    date_default_timezone_set('Asia/Jakarta');
                    if($row['deadline'] != NULL){
                        if((time() >  strtotime($row['deadline']) && $row['status'] == 'Not Done') || ($row['status'] == 'Done Late')){
                            echo "<span style='color: red;'>". date("d-M-Y H:ia",strtotime($row['deadline'])). "</span>";
                        } else {
                            echo date("d-M-Y H:ia", strtotime($row['deadline']));
                        }
                    }else{
                        echo "No deadline";
                    }
                ?>
            </div>
            
            <div
                <?php
                    if($row['status'] == 'Done') echo "style='color: green;'";
                    else if(($row['deadline'] != NULL && time() >  strtotime($row['deadline']) && $row['status'] == 'Not Done') || ($row['status'] == 'Done Late')) echo "style='color: red;'";
                ?>
                ><?= $row['status'];?>
            </div>

            <div class="mt-2 p-3 border-2 rounded-3" style="background-color:#FFFFFF"><?= $row['description']?></div>
            <div class="mt-3 row text-center d-flex justify-content-between">
                <div class="col-12 col-md-auto mb-2">
                    <?php
                        if ($row['status'] == 'Not Done') {
                            echo "<a href='../backend/status_process.php?id=" . $row['listid'] . "&status=done' class='btn btn-success w-100' >Mark As Done</a>";
                        } else {
                            echo "<a href='../backend/status_process.php?id=" . $row['listid'] . "&status=undone' class='btn btn-secondary w-100'>Cancel Done</a>";
                        }
                    ?>
                </div>
                <div class="col-12 col-md-auto mb-2"><a href="edit_task.php?id=<?= $row['listid']?>" class="btn btn-warning w-100">Edit Task</a></div>
                <div class="col-12 col-md-auto mb-2"><button type="button" class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">Delete Task</button></div>
            </div>
        </div>
        <div class="text-center mt-3">
            <a href="../../index.php" class="btn btn-primary">Go Back</a>
        </div>
    </div>

    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    Are you sure you want to delete this task? This action cannot be undone.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <a href="../backend/delete_process.php?id=<?= $row['listid'] ?>" class="btn btn-danger">Delete</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>