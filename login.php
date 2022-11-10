<?php
    session_start();
    $adminUserErr = $passwordErr = $logInErr ="";
    $admin = $pass = "";
    
    if(isset($_POST['submit'])){
        if (empty($_POST['adminUser'])){
            $adminUserErr = "กรุณากรอก admin name";
        }else{
            $admin = $_POST['adminUser'];
        }
        if (empty($_POST['password'])) {
            $passwordErr = "กรุณากรอก password";
        }else{
            $pass = $_POST['password'];
        }
        if ($adminUserErr == "" and $passwordErr == "") {
            include 'db/connect.php';
            $sql = "SELECT * FROM admin WHERE admin_name='$admin' and admin_password = '$pass'";
            $database = $conn->query($sql);
            if ($database->num_rows > 0) {
                // output data of each row
                while($row = $database->fetch_assoc()) {
                    $_SESSION["admin_id"] = $row['id_admin'];
                    $_SESSION["admin_user"] = $admin;
                    $_SESSION["admin_password"] = $pass;
                    header('location: panel/admin.php');
                }
            } else {
                $logInErr = "show";
            };
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="icon" type="image/png" href="airplane.png">
    <link rel="stylesheet" href="css/style_login.css">
    <title>login</title>
</head>
<body>
    <div id="content_main">
        <div id="main">
            <div id='head'>
                <p id="admin">Admin</p>
            </div>
            <div id="form">
                <form method="POST">
                    <div class="m-3 text-align-center" >
                        <label for="userName" class="form-label">Admin name</label>
                        <input type="text" class="form-control" id="userName" require name=adminUser value="<?php echo $admin; ?>">
                        <span class="text-danger"><?php echo $adminUserErr; ?></span>
                    </div>
                    <div class="m-3 text-align-center">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" require name=password value="<?php echo $pass; ?>">
                        <span  class="text-danger"><?php echo $passwordErr; ?></span>

                    </div>
                    <div id="btn" class="m-3">
                        <button id="btn-login" name="submit" class="btn btn-success  m-1">log in</button>
                        <a id="btn-cancel" class="btn btn-danger m-1" href="index.php">cancel</a>
                    </div>
                </form>
            </div>
        </div>
        <div class="text-danger">
            <div class="alert alert-danger alert-dismissible fade <?php echo $logInErr; ?>" role="alert">
                <strong>admin user หรือ password ของท่านอาจไม่ถูกต้อง กรุณาตรวจสอบแล้วกรอกใหม่อีกครั้ง!</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>

