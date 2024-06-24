<?php
    include 'db/connect.php';
    // ดึงข้อมูลเพื่อจะได้รู้ว่ามีข้อมูลทั้งหมดเท่าไร

    if (isset($_REQUEST['id_prov'])){
        $id_prov = $_REQUEST['id_prov'];
        $sql = "SELECT * FROM content WHERE id_prov='$id_prov'";
        $sql1 = "SELECT * FROM province";
        $content = $conn->query($sql);
        $content1 = $conn->query($sql1);
    } else {
        $sql = "SELECT * FROM content WHERE hide=0";
        $sql1 = "SELECT * FROM province";
        $content = $conn->query($sql);
        $content1 = $conn->query($sql1);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style_index.css">
    <link rel="icon" type="images/png" href="images/airplane.png">
    <title>สถานที่ท่องเที่ยวที่แนะนำ</title>
</head>
<body>
    <header>
        <nav class="navbar container">
            <div class="container-fluid">
                <a class="navbar-brand fs-1 fw-bolder" href="index.php">TRAVEL</a>
                <a class="navbar-brand fs-6 fw-bolder" href="login.php">admin</a>
            </div>
        </nav>
    </header>
    <main>
        <div id="control" class="container pt-5">
            <section id="section-head" class="fs-1 fw-bolder">สถานที่ท่องเที่ยวที่น่าสนใจ </section>
            <div id="test_dropdown">
                <div class="dropdown">
                    <a class="btn btn-secondary dropdown-toggle btn-sm" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">จังหวัด</a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <li id="prov-url"><a class="dropdown-item fs-6" href="index.php">ทุกจังหวัด</a></li>
                        <?php while($row = $content1->fetch_assoc()) { ?>
                            <li id="prov-url"><a class="dropdown-item fs-6" href="index.php?id_prov=<?php echo $row['id_prov']; ?>"><?php echo $row['name_prov']; ?></a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
        <div id='main' class="container">
            <?php
                if ($content->num_rows > 0){ ?>      
                    <div id='travel-content' class="col pt-3">
                    <?php while($row = $content->fetch_assoc()) { ?>
                            <div id="main-content" class='pt-2'>
                                <div id='content'>
                                    <a id='<?php echo $row["id"]; ?>' href='showContent.php?travel_id=<?php echo $row['id']; ?>'>
                                        <img src='images/travel/<?php echo $row['image']; ?>'>
                                        <p id='p-name' class='pt-3'><?php echo $row["name"]; ?></p>
                                    </a>
                                </div>
                            </div> 
                    <?php } ?>
                    </div>
            <?php } else{ ?>
                    <div id="none-content"  class='pt-2'>
                        <div id='content'>
                            <h1>ไม่มีเนื้อหา</h1>
                        </div>
                    </div> 
            <?php } ?>
        </div>
    </main>
    <footer>
        <div id='footer-content' class="container">
            <h5>จัดทำโดย</h5>
            <p>
                1. นาย สถาพร คงโนนกอก
            </p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>