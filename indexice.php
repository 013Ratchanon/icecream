<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css">
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="style.css">
    <title>ร้านไอศครีมไผ่ทอง</title>
    <div class="topnav">
        <a class="active" href="order.php">จองคิว</a>
        <a href="index.php">เพิ่มรสชาติไอศครีม</a>
    </div>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12"> <br>
                <h3><img src="./image/logo.png" alt="ร้านไอศครีมไผ่ทอง"><a href="addice.php" class="btn btn-info float-end">+เพิ่มรสชาติ</a> </h3> <br />
                <!-- <table class="table table-striped  table-hover table-responsive table-bordered"> -->
                <table id="flavorTable" class="display table table-striped  table-hover table-responsive table-bordered ">

                    <thead align="center">
                        <tr>
                            <th width="10%">รหัสอาหาร</th>
                            <th width="30%">ชื่ออาหาร</th>
                            <th width="10%">ราคา</th>
                            <th width="10%">ประเภทอาหาร</th>
                            <th width="10%">ภาพ</th>
                            <th width="5%">แก้ไข</th>
                            <th width="5%">ลบ</th>
                        </tr>

                    </thead>
                    <tbody>
                        <?php
                        require 'connect.php';
                        $sql =
                            'SELECT * FROM flavor , menu  WHERE flavor.MenuID = menu.MenuID';
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();
                        $result = $stmt->fetchAll();
                        foreach ($result as $r) { ?>
                            <tr>
                                <td><?= $r['FlavorID'] ?></td>
                                <td><?= $r['FlavorName'] ?></td>
                                <td><?= $r['Flavorprice'] ?></td>
                                <td align="right"><?= $r['MenuName'] ?></td>
                                <td><img src="./image/<?= $r['Flavorimage']; ?>" width="50px" height="50" alt="image" onclick="enlargeImg()" id="img1"></td>

                                <td><a href="updateForm.php?FlavorID=<?= $r['FlavorID'] ?>" class="btn btn-warning btn-sm">แก้ไข</a></td>
                                <td><a href="delete.php?FlavorID=<?= $r['FlavorID'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('ยืนยันการลบข้อมูล !!');">ลบ</a></td>
                            </tr>
                        <?php }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('customerTable').DataTable();
        });
    </script>


</body>

</html>