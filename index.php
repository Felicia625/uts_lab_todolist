<!doctype html>
<html>
<head>
    <title>Index</title>
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
            <a href="user/frontend/login.php" class="btn btn-primary mt-3">Login</a>
        </div>

        <?php
            }else{
                require_once("db.php");

                $userid = $_SESSION['userid'];
                $username = $_SESSION['username'];

                $sql = "SELECT * FROM list WHERE userid = $userid";
                $result = $db->query($sql);
        ?>
        <h1 class="mt-3 text-center">Wellcome to <?= $username?>'s To Do List</h1>
        <div class="mx-auto my-4" style="max-width: 900px;">
            <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
                <div class="card my-2 mx-auto">
                    <div class="card-body">
                        <h5 class="card-title"><?= $row['title'];?></h5>
                        <div class="card-text">Due:
                            <?php
                            if($row['deadline'] != NULL){
                                if((date("now") < date($row['deadline']) && $row['status'] == 'Not Done') || ($row['status'] == 'Done Late')){
                                    echo "<span style='color: red;'>". date("d-M-Y H:ia",strtotime($row['deadline'])). "</span>";
                                } else {
                                    echo date("d-M-Y h:i", strtotime($row['deadline']));
                                }
                            }else{
                                echo "No deadline";
                            }
                            ?>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="card-text">Status: <?= $row['status'];?></div>
                            <div><a href="todolist/frontend/view.php" class="btn btn-primary">View</a></div>
                        </div>
                    </div>
                </div>
            <?php }?>
        </div>
        <div class="text-center">
            <a href="todolist/frontend/create.php" class="btn btn-primary mt-3">Create Task</a>
            <a href="user/backend/logout_process.php" class="btn btn-primary mt-3">Logout</a>
            <a href="profile/frontend/user_profile.php" class="btn btn-primary mt-3">Profile</a>
        </div>

        <?php }?>
    </div>
</body>
</html>
