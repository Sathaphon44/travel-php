<?php
    session_start();

    if(count($_SESSION) == 0){
        header('location: index.php');
    }
    include '../db/connect.php';
    // ดึงข้อมูลเพื่อจะได้รู้ว่ามีข้อมูลทั้งหมดเท่าไร
    $sql = "SELECT * FROM content WHERE hide = '1' ORDER BY id DESC";
    $database = $conn->query($sql);

    if(empty($_GET['id'])){

    }else{
        $id = $_GET['id'];
        $sql = "UPDATE content SET hide='0' WHERE id='$id'";
        $conn->query($sql);
        header('location: show_hide.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style_show_hide.css">
    <link rel="icon" type="image/png" href="../airplane.png">
    <title>page hide</title>
</head>
<body>
    <header>
        <nav class="navbar container">
            <div class="container-fluid">
                <div>
                    <p class="navbar-brand fs-2 fw-bolder">รายการที่ซ่อน</p>
                </div>
                <div>
                    <a class="btn btn-secondary navbar-brand fs-6" href="admin.php">ย้อนกลับ</a>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <div class="container">
            <?php $amount = $database->num_rows; ?>
            <?php if ($amount > 0){ ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ลำดับ</th>
                            <th scope="col">ชื่อ</th>
                            <th scope="col">รูปภาพ</th>
                            <th scope="col">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $number = 1;
                            while($row = $database->fetch_assoc()) { 
                        ?>
                            <tr>
                                <th scope="row"> <?php echo $number; ?> </th>
                                <td> <?php echo $row["name"]; ?> </td>
                                <td> <?php echo $row['image']; ?> </td>
                                <td class="row"> 
                                    <a id="btn-hide" class="col btn btn-danger p-1 m-1" href="show_hide.php?id=<?php echo $row['id'];?>&hide=<?php echo $row['hide'];?>"> แสดง </a>
                                </td>
                            </tr>
                        <?php 
                            $number ++;
                        } 
                    ?>
                    </tbody>
                </table>
            <?php }else {?>
                <div id="center-text"> ไม่มีรายการที่ซ่อน </div>
            <?php }; ?>
        </div>
    </main>
</body>
</html>

