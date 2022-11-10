<?php 
    include "../db/connect.php";
    $sql = "SELECT * FROM content 
            INNER JOIN province 
            ON content.id_prov = province.id_prov";
    $result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table style="text-align:center;">
        <tr>
            <th style="padding-left: 30px;">id</th>
            <th style="padding-left: 30px;">name</th>
            <th style="padding-left: 30px;">id_prov</th>
            <th style="padding-left: 30px;">province</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()){ ?>
            <tr>
                <td style="padding-left: 30px; padding-top: 5px;"><?php echo $row['id']; ?></td>
                <td style="padding-left: 30px; padding-top: 5px;"><?php echo $row['name']; ?></td>
                <td style="padding-left: 30px; padding-top: 5px;"><?php echo $row['id_prov']; ?></td>
                <td style="padding-left: 30px; padding-top: 5px;"><?php echo $row['name_prov']; ?></td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>