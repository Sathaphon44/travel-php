<?php
    session_start();

    include "../db/connect.php";
    $ErrorNameImage = "";
    $id = $_REQUEST['idC'];

    //* เช็คว่า user admin ได้ทำการล็อกอินหรือยัง ถ้ายังจะกลับไปหน้า index.php
    if (count($_SESSION) == 0){
        header("location: ../index.php");
    };

    $sql = "SELECT * FROM content WHERE id='$id'";
    $database = $conn->query($sql);
    while($row = $database->fetch_assoc()) {
        $name = $row['name'];
        $details = $row['details'];
        $image = $row['image'];
        $id_prov = $row['id_prov'];
    };

    $sql1 = "SELECT * FROM province";
    $database1 = $conn->query($sql1);
    
    if(isset($_POST['submit'])){

        $idUpdate = $_REQUEST['idC']; // id content ของสถานที่ท่องเที่ยวที่เรากด
        $nameUpdate = $_POST['name']; // ชื่อ ของสถานที่ท่องเที่ยว
        $text_areaUpdate = $_POST['text_area']; // รายละเอียดของสถานที่ท่องเที่ยว
        $idProv = $_POST['select']; // id ของจังหวัด ที่เราเลือก

        // เก็บข้อมูลต่างๆ ที่เกี่ยวกับไฟล์ ไปไว้ในตัวแปร
        $imageUpdate = $_FILES['fileImage']['name'];
        if ($imageUpdate != "") {
            $type = $_FILES['fileImage']['type'];
            $size = $_FILES['fileImage']['size'];
            $temp = $_FILES['fileImage']['tmp_name'];

            $sql = "SELECT * FROM content WHERE image='$imageUpdate'";
            $database = $conn->query($sql);

            while ($row = $database->fetch_assoc()) {
                $ErrorNameImage = "* ชื่อรูปภาพซ้ำกรุณาเปลี่ยนชื่อรูปภาพ";
            };

            if ($ErrorNameImage == "") {

                if ($imageUpdate != '') {
                    if ($type == "image/jpg" or $type == "image/jpeg" or $type == "image/png") {
                        $directory = "../images/travel/".$image;
                        if ($size < 500000) {

                            $sql = "UPDATE content SET name='$nameUpdate', details='$text_areaUpdate', image='$imageUpdate', id_prov='$idProv'  WHERE id='$idUpdate'";
                            $conn->query($sql); 

                            unlink($directory); // delete file
                            move_uploaded_file($temp, '../images/travel/'.$imageUpdate); // move flie
                            header("location: admin.php");
                        }
                    }
                }
            }

        } else {
            $sql = "UPDATE content SET name='$nameUpdate', details='$text_areaUpdate', id_prov='$idProv' WHERE id='$idUpdate'";
            $conn->query($sql);
            header("location: admin.php");
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
    <link rel="stylesheet" href="../css/style_admin.css">
    <link rel="icon" type="image/png" href="../airplane.png">
    <title>page | Edit</title>
</head>
<body>
    <header class="container pt-4">
        <nav class="navbar container">
            <div class="container-fluid">
                <h1 class="navbar-brand fs-1 fw-bolder">แก้ไข</h1>
                <a class="btn btn-danger navbar-brand fs-6" href="admin.php">ย้อนกลับ</a>
            </div>
        </nav>
    </header>
    <div class="container" style="padding:25px">
        <form action="edit_content.php?idC=<?php echo $id; ?>"  method="post" enctype="multipart/form-data">
            <div class="modal-body">
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label fs-5">ชื่อสถานที่ท่องเที่ยว:</label>
                    <textarea type="text" class="form-control" id="text-name" name="name" rows="1"><?php echo $name; ?></textarea>
                </div>
                <div class="mb-3 pt-4">
                    <label for="message-text" class="col-form-label fs-5">รายละเอียด:</label>
                    <textarea type="text" class="form-control" id="message-text" name="text_area" style="height: 300px"><?php echo $details; ?></textarea>
                </div>
                <div class="mb-3 pt-4">
                    <p class="fs-5">การตั้งค่าจังหวัด</p>
                    <select id="inputState" class="form-control w-25" name="select" require>
                        <?php   
                            while($row = $database1->fetch_assoc()) { 
                                if ($row["id_prov"] == $id_prov) {
                                    echo "<option selected value=". $row['id_prov'].">". $row['name_prov']."</option>";
                                } else {
                                    echo "<option value=". $row['id_prov']. ">".$row['name_prov']."</option>";
                                }
                            }
                        ?>
                    </select>
                </div>
                <div class="mb-3 pt-4">
                    <div class="mb-3">
                        <p class="fs-5">รูปภาพปัจจุบัน</p>
                        <p>ชื่อรูปภาพ <?php echo $image; ?></p>
                        <p><img src="../images/travel/<?php echo $image; ?>" alt="" width='400px'></p>
                    </div>
                    <div class=" mb-3">
                        <p class="fs-5">เปลี่ยนรูปภาพ</p>
                        <input type="file" id="myFile" name="fileImage"><br>
                        <span class="text-danger"><?php echo $ErrorNameImage; ?></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-md-center">
                <button type="submit" class="btn btn-success container w-25" name="submit">บันทึก</button>
                <button  class="btn btn-secondary container w-25"  data-bs-dismiss="modal">คืนค่าทั้งหมด</button>
            </div>
        </form>
    </div>
</body>
</html>