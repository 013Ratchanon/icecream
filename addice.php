<!--<!DOCTYPE html>-->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <title>User Registration 265</title>
    <style type="text/css">
        img {
            transition: transform 0.25s ease;
        }

        img:hover {
            -webkit-transform: scale(1.5);
            /* or some other value */
            transform: scale(1.5);
        }
    </style>


</head>

<body>
    <?php
    require 'connect.php';

    $sql_select = 'SELECT * FROM menu ORDER BY MenuID';
    $stmt_s = $conn->prepare($sql_select);
    $stmt_s->execute();

    if (isset($_POST['submit'])) {
        if (!empty($_POST['FlavorName'])) {


            $uploadFile = $_FILES['Flavorimage']['name'];
            $tmpFile = $_FILES['Flavorimage']['tmp_name'];

            $sql = "insert into flavor (MenuID,FlavorName,Flavorimage,Flavorprice)
							values (:MenuID,:FlavorName,:Flavorimage,:Flavorprice)";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':MenuID', $_POST['MenuID']);
            $stmt->bindParam(':FlavorName', $_POST['FlavorName']);
            $stmt->bindParam(':Flavorimage', $uploadFile);
            $stmt->bindParam(':Flavorprice', $_POST['Flavorprice']);



            $fullpath = "./image/" . $uploadFile;
            move_uploaded_file($tmpFile, $fullpath);

            echo '
                <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

            try {
                if ($stmt->execute()) :
                    //$message = 'Successfully add new Flavor';
                    echo '
                        <script type="text/javascript">        
                        $(document).ready(function(){
                    
                            swal({
                                title: "Success!",
                                text: "Successfuly add Flavor",
                                type: "success",
                                timer: 2500,
                                showConfirmButton: false
                            }, function(){
                                    window.location.href = "index.php";
                            });
                        });                    
                        </script>
                    ';
                else :
                    $message = 'Fail to add new Flavor';
                endif;
                // echo $message;
            } catch (PDOException $e) {
                echo 'Fail! ' . $e;
            }
            $conn = null;
        }
    }
    ?>

    <div class="container">
        <div class="row">
            <div class="col-md-4"> <br>
                <h3>ฟอร์มเพิ่มรสชาติไอศครีม</h3>
                <form action="addice.php" method="POST" enctype="multipart/form-data">
                    <!-- ศึกษาเพิ่มเติมการอัปโหลดไฟล์ https://www.w3schools.com/php/php_file_upload.asp -->
                    <input type="text" placeholder="FlavorName" name="FlavorName" required>
                    <br> <br>
                    <input type="number" placeholder="Flavorprice" name="Flavorprice">
                    <br> <br>
                    <label>Select a Menu</label>
                    <select name="MenuID">
                        <?php
                        while ($cc = $stmt_s->fetch(PDO::FETCH_ASSOC)) :
                        ?>
                            <option value="<?php echo $cc['MenuID']; ?>">
                                <?php echo $cc['MenuName']; ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                    <br><br>
                    แนบรูปภาพ:
                    <input type="file" name="Flavorimage" required>
                    <br><br>
                    <input type="submit" value="Submit" name="submit">
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('#flavorTable').DataTable();
        });
    </script>



</body>

</html>