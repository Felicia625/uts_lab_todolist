<?php

$id = $_GET['id'];
require_once('../../db.php');

$sql = "SELECT * FROM list WHERE listid = ?";
$stmt = $db->prepare($sql);
$stmt->execute([$id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<htl lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="text-center mt-3">Edit Task</h1>

        <div class="mt-4 p-4 border-2 rounded-4" style="max-width: 500px; margin: auto; background-color: #DEDEDE;">
            <form action="../backend/edit_task_process.php?id=<?= $id;?>" method="post">
                <div class="mb-3">
                    <label for="Title" class="form-label">Title:</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="<?= $row['title']?>" />
                </div>

                <div class="mb-3">
                    <label for="category" class="form-label">Category:</label>
                    <select class="form-select" id="category" name="category">
                        <option value=""><?= $row['category']?></option>
                        <option value="Work">Work</option>
                        <option value="Personal">Personal</option>
                        <option value="Grocery">Grocery</option>
                        <option value="Activity">Activity</option>
                        <option value="Other">Other</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description:</label>
                    <input type="text" class="form-control" id="description" name="description" maxlength="200" placeholder="<?= $row['description'];?>" />
                </div>

                <div class="mb-3">
                    <label for="deadline" class="form-label">Deadline: <?=date("d-M-Y H:ia", strtotime($row['deadline']))?></label>
                    <input type="datetime-local" class="form-control" id="deadline" name="deadline"/>
                </div>
                
                <div class="text-center">
                    <button type="submit" class="btn btn-primary w-50">Save Edit</button>
                </div>
            </form>

            <div class="mt-3 text-center">
                <a href="view.php?id=<?= $id;?>" class="btn btn-primary w-50">Cancel</a>
            </div> 
        </div>
    </div>
</body>
</html>