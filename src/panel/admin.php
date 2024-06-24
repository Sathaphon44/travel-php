<?php
    session_start();
    if(count($_SESSION) == 0){
      header('location: ../login.php');
    }

    require_once __DIR__ . '/../db/connect.php';
    
    // ดึงข้อมูลเพื่อจะได้รู้ว่ามีข้อมูลทั้งหมดเท่าไร
    $sql = "SELECT * FROM content WHERE hide = '0'";
    $database = $conn->query($sql);

    if(isset($_GET['logout'])){
      session_destroy();
      header('location: ../login.php');
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
    <title>page admin</title>
</head>
<body>
    <header>
        <nav class="navbar container">
            <div class="container-fluid">
                <div>
                  <h1 class="navbar-brand fs-1 fw-bolder">Control panel</h1>
                </div>
                <div>
                  <a id="head-link" class='btn btn-success navbar-brand fs-6' href="add_content.php">add</a>
                  <a id="head-link" class="btn btn-secondary navbar-brand fs-6" href="show_hide.php">hide</a>
                  <a id="head-link" class="btn btn-danger navbar-brand fs-6" href="admin.php?logout=test">Log out</a>
                </div>
            </div>
        </nav>
    </header>
    <main>
      <div class="container p-5">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Id</th>
              <th scope="col">Name</th>
              <th scope="col">Image</th>
              <th scope="col">Edit</th>
            </tr>
          </thead>
          <tbody>
            <?php
              while($row = $database->fetch_assoc()) {
            ?>
              <tr>
              <th scope="row"> <?php echo $row["id"]; ?> </th>
                <td><?php echo $row["name"];?></td>
                <td><?php echo $row['image'];?></td>
                <td> 
                  <div id="edit">
                    <a id="btn-edit" class="col btn btn-outline-warning"  href="edit_content.php?idC=<?php echo $row['id']; ?>">แก้ไข</a>
                    <a id="btn-hide" class="col btn btn-outline-secondary" href="hide_db.php?idC=<?php echo $row['id']; ?>&hide=<?php echo $row['hide']; ?>">
                        ซ่อน
                    </a>
                    <a id="btn-delete" class="col btn btn-outline-danger" href="delete_db.php?idC=<?php echo $row['id']; ?>&nameImage=<?php echo $row['image'] ?>"> ลบ </a>
                  </div>
                </td>
              </tr>
            <?php
              }
              ?>
            </tbody>
          </table>
      </div>
    </main>
</body>
</html>

