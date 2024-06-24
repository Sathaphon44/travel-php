<?php
    include "../db/connect.php";
    $sql = "SELECT * FROM province";
    $database = $conn->query($sql);
    $nameErr = $detailErr = $fileErr = $selectErr = $imgErr = "";

    if (isset($_POST['submit'])) {

        if (empty($_POST['text_name'])) {
            $nameErr = "* กรุณากรอก name content!";
        } else {
            $nameErr = "";
            $name = $_POST['text_name'];
        }

        if (empty($_POST['text_detail'])) {
            $detailErr = "* กรุณากรอก detail content!";
        } else {    
            $detailErr = "";
            $detail = $_POST['text_detail'];
        }

        if ($_POST['select'] == "0") {
            $selectErr = "* กรุณาเลือก จังหวัด";
        } else {
            $selectErr = "";
            $prov = $_POST['select'];
        }

        if (empty($_FILES['fileImage']['name'])) {
            $fileErr = "กรุณาใส่รูปภาพ!";
        } else {
            $fileErr = "";         
            $image = $_FILES['fileImage']['name'];
            $type = $_FILES['fileImage']['type'];
            $size = $_FILES['fileImage']['size'];
            $temp = $_FILES['fileImage']['tmp_name'];
        }
        if ($nameErr == "" and  $detailErr == "" and  $fileErr == "" and  $selectErr == "" and  $imgErr == "") {
            if ($type == "image/jpg" or $type == "image/jpeg" or $type == "image/png"){
                if ($size < 500000) {
                    move_uploaded_file($temp, '../images/travel/'.$image);
                    $sql = "INSERT INTO content (name, details, image, hide, id_prov)
                    VALUES ('$name', '$detail', '$image', '0', '$prov')";
                    $conn->query($sql);
                    header("location: admin.php");
                }
            }  
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
    <link rel="stylesheet" href="../css/style_add.css">
    <link rel="icon" type="image/png" href="../airplane.png">
    <title>add page</title>
</head>
<body>
    <header>
        <nav class="navbar container">
            <div class="container-fluid">
                <p class="navbar-brand fs-3 fw-bolder">เพื่อรายการ</p>
                <a class="btn btn-secondary navbar-brand fs-6" href="admin.php">ย้อนกลับ</a>
            </div>
        </nav>
    </header>
    <div id="content-main">
        <div id="form-control" class="container w-50">
            <form method="POST" class="form-horizontal" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label">name content</label>
                    <span class="text-danger"><?php echo $nameErr; ?></span>
                    <textarea id="text1" class="form-control" id="exampleFormControlTextarea1" rows="1" name="text_name"  maxlength="255"></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">detail content</label>
                    <span class="text-danger"><?php echo $detailErr; ?></span>
                    <textarea id="text2" class="form-control" rows="5" name="text_detail"></textarea>
                </div>
                <div class="mb-3">
                    <label for="inputState">จังหวัด</label>
                    <select id="inputState" class="form-control" name="select" require>
                        <option selected value="0">เลือกจังหวัด</option>
                    <?php
                        while($row = $database->fetch_assoc()) {
                    ?>
                        <option value="<?php echo $row['id_prov'] ?>"><?php echo $row["name_prov"]; ?></option>
                        <?php } ?>
                    </select>
                    <span class="text-danger"><?php echo $selectErr; ?></span>
                </div>
                <div class=" mb-3">
                    <input type="file" id="myFile" name="fileImage"><br>
                    <span class="text-danger"> <?php echo $fileErr; ?></span>
                </div>

                <button class="btn btn-success w-100" type="submit" name="submit">บันทึก</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>