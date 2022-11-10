<?php
    include 'db/connect.php';
    $id = $_REQUEST['travel_id'];
    $sql = "SELECT * FROM content WHERE id='$id'";
    $database = $conn->query($sql);

    while($row = $database->fetch_assoc()) {
        $name = $row['name'];
        $details = $row['details'];
        $image = $row['image'];
    };

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style_showContent.css">
    <link rel="icon" type="image/png" href="airplane.png">
    <title><?php echo $name; ?></title>
</head>
<body>
    <header>
        <nav class="navbar container">
            <div class="container-fluid">
                <a class="navbar-brand fs-1 fw-bolder" href="index.php">TRAVEL</a>
                <a href="index.php" class="navbar-brand fs-5 fw-bolder">ย้อนกลับ</a>
            </div>
        </nav>
    </header>
    <div id='main' class="container">
        <div id='main-content' class='p-4'>
            <div id='content-details'>
                <p id='image' class="pt-5"><img src="images/travel/<?php echo $image; ?>" alt=""></p>

                <h1 id='name' class='fw-bold fs-2 pt-5'>
                    <?php echo $name; ?>
                </h1>

                <p id='detais' class='fs-5 fw-bold pb-4'>
                    <?php echo $details; ?>
                </p>
            </div>
        </div>
    </div>
    <footer>
        <div id='footer-content' class="container">
            <h4>จัดทำโดย</h4>
            <p>
                1. กนกอร อัศวเชษฐ รหัส 6311503939 <br>
                2. นาย ศศินนท์ ชาญสมร รหัส 6311503970 <br>
                3. นาย สถาพร คงโนนกอก รหัส 6311504507
            </p>
        </div>
    </footer>
</body>
</html>