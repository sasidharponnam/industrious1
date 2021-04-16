<?php
session_start();
error_reporting(0);
include 'includes/config.php';
if (strlen($_SESSION['alogin']) == '') {
    header('Location: index.php');
} else {
    if (isset($_POST['submit'])) {
        /*$file = $_FILES['image']['tmp_name'];
        $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
        $image_name = addslashes($_FILES['image']['name']);

        move_uploaded_file($_FILES['image']['tmp_name'], 'upload/'.$_FILES['image']['name']);
        $photo = 'upload/'.$image_name; //$_FILES['image']['name'];
        $image_name = $_FILES['image']['name'];
        $img = 'Image';
        $shape = $_POST['shape'];
        $price = $_POST['price'];
        $carat = $_POST['carat'];
        $cut = $_POST['cut'];
        $color = $_POST['color'];
        $clarity = $_POST['clarity'];
        $depth = '57.3%';
        $table = '53.3%';
        $polish = 'Good';
        $symmetry = 'Excellent';
        $girdle = 'Thick';
        $measurement = '3.92 x 3.45 x 3.45mm';
        $stock = 'LD099999';

        //move_uploaded_file($_FILES['image']['tmp_name'], 'upload/'.$_FILES['image']['name']);

        $a = "insert into product(image,shape,price,carat,cut,color,clarity,depth,table,polish,symmetry,girdle,measurement,stock) values('$img','$shape','$price','$carat','$cut','$color','$clarity','$depth','$table','$polish','$symmetry','$girdle','$measurement','$stock')";
        $s = mysqli_query($con, "insert into product(image,shape,price,carat,cut,color,clarity,depth,table,polish,symmetry,girdle,measurement,stock) values('$img','$shape','$price','$carat','$cut','$color','$clarity','$depth','$table','$polish','$symmetry','$girdle','$measurement','$stock')");
        if ($s) {
            header('location:add-diamond.php');
        } else {
            $msg = 'event not entered correctly';
        }

        //move_uploaded_file($_FILES["image"]["tmp_name"],"upload/" . $_FILES["image"]["name"]);*/
        $image_name = addslashes($_FILES['image_new']['name']);

        move_uploaded_file($_FILES['image_new']['tmp_name'], 'upload/'.$_FILES['image_new']['name']);

        $shape = $_POST['shape'];
        $price = $_POST['price'];
        $carat = $_POST['carat'];
        $cut = $_POST['cut'];
        $color = $_POST['color'];
        $clarity = $_POST['clarity'];
        $depth = $_POST['depth'];
        $polish = $_POST['polish'];
        $symmetry = $_POST['symmetry'];
        $girdle = $_POST['girdle'];
        $measurement = $_POST['measurement'];
        $stock = $_POST['stock'];
        $m = mysqli_query($con, "insert into product_new(image,shape,price,carat,cut,color,clarity,depth,polish,symmetry,girdle,measurement,stock) values('$image_name','$shape','$price','$carat','$cut','$color','$clarity','$depth','$polish','$symmetry','$girdle','$measurement','$stock') ");
        //move_uploaded_file($_FILES["image"]["tmp_name"],"upload/" . $_FILES["image"]["name"]);
        //$photo = 'upload/'.$_FILES['image']['name'];
        // $type = 'white'; //$_POST['type'];

        //$m = mysqli_query($con, "insert into image(name,data,type) values('$image_name','$photo','$type') ");
        if ($m) {
            $msg = 'Photo Upload Sucessfully !';
            header('location:add-diamond.php');
        } else {
            $msg = 'Invalid File !';
        }
    }
    $data = mysqli_query($con, 'select * from product_new');
    if (isset($_GET['del_id'])) {
        mysqli_query($con, 'delete from product_new where id='.$_GET['del_id']);
        header('location:add-diamond.php');
    }
}

?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DIAM| Events </title>
    <link rel="stylesheet" href="css/bootstrap.min.css" media="screen">
    <link rel="stylesheet" href="css/font-awesome.min.css" media="screen">
    <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen">
    <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen">
    <link rel="stylesheet" href="css/prism/prism.css" media="screen">
    <link rel="stylesheet" href="css/select2/select2.min.css">
    <link rel="stylesheet" href="css/main.css" media="screen">
    <link rel="icon" type="image/png" href="images/d1.png">
    <script src="js/modernizr/modernizr.min.js"></script>
</head>

<body class="top-navbar-fixed">
    <div class="main-wrapper">

        <!-- ========== TOP NAVBAR ========== -->
        <?php include 'includes/topbar.php'; ?>
        <!-- ========== WRAPPER FOR BOTH SIDEBARS & MAIN CONTENT ========== -->
        <div class="content-wrapper">
            <div class="content-container">

                <!-- ========== LEFT SIDEBAR ========== -->
                <?php include 'includes/leftbar.php'; ?>
                <!-- /.left-sidebar -->

                <div class="main-page">

                    <div class="container-fluid">
                        <div class="row page-title-div">
                            <div class="col-md-6">
                                <h2 class="title">Add Diamond</h2>

                            </div>

                            <!-- /.col-md-6 text-right -->
                        </div>
                        <!-- /.row -->
                        <div class="row breadcrumb-div">
                            <div class="col-md-6">
                                <ul class="breadcrumb">
                                    <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>

                                    <li class="active">Add Diamond</li>
                                </ul>
                            </div>

                        </div>
                        <!-- /.row -->
                    </div>
                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel">
                                    <div class="panel-heading">
                                        <div class="panel-title">
                                            <h5>Fill the Diamond info</h5>
                                        </div>
                                    </div>
                                    <div class="panel-body">

                                        <form class="form-horizontal" method="post" enctype="multipart/form-data">

                                            <div class="form-group">
                                                <label for="default" class="col-sm-2 control-label">Add image:</label>
                                                <div class="col-sm-10">
                                                    <input type="file" name="image_new" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="default" class="col-sm-2 control-label">Enter Shape:</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="shape" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="default" class="col-sm-2 control-label">Enter Price:</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="price" class="form-control">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="default" class="col-sm-2 control-label">Enter Carat:</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="carat" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="default" class="col-sm-2 control-label">Enter Cut:</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="cut" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="default" class="col-sm-2 control-label">Enter Color:</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="color" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="default" class="col-sm-2 control-label">Clarity:</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="clarity" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="default" class="col-sm-2 control-label">Depth:</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="depth" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="default" class="col-sm-2 control-label">Polish:</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="polish" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="default" class="col-sm-2 control-label">Symmetry:</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="symmetry" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="default" class="col-sm-2 control-label">Girdle:</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="girdle" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="default" class="col-sm-2 control-label">Measurement:</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="measurement" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="default" class="col-sm-2 control-label">Stock:</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="stock" class="form-control">
                                                </div>
                                            </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" name="submit" class="btn btn-primary">Add</button>
                                        </div>
                                    </div>
                                    </form>
                                    <table>
                                        <?php
                        //count data

                        $i = 0;
                            while ($row = mysqli_fetch_assoc($data)) {
                                if ($i % 2 == 0) {
                                    ?>
                                        <tr> <?php
                                } ?>
                                            <td>

                                                <img src="upload/<?php echo @$row['image']; ?>"
                                                    width="200" height="200">
                                            <td>
                                                <div class="content">Shape: <?php echo @$row['shape']; ?>
                                                </div>
                                                <div class="content">Price:<?php echo @$row['price']; ?>
                                                </div>
                                                <div class="content">Carat:<?php echo @$row['carat']; ?>
                                                </div>
                                                <div class="content">Cut:<?php echo @$row['cut']; ?>
                                                </div>
                                                <div class="content">Color:<?php echo @$row['color']; ?>
                                                </div>
                                                <div class="content">Clarity:<?php echo @$row['clarity']; ?>
                                                </div>
                                                <div class="content">Depth:<?php echo @$row['depth']; ?>
                                                </div>
                                                <div class="content">Polish:<?php echo @$row['polish']; ?>
                                                </div>
                                                <div class="content">Symmetry:<?php echo @$row['symmetry']; ?>
                                                </div>
                                                <div class="content">Girdle:<?php echo @$row['girdle']; ?>
                                                </div>
                                                <div class="content">Measurement:<?php echo @$row['measurement']; ?>
                                                </div>
                                                <div class="content">Stock:<?php echo @$row['stock']; ?>
                                                </div>
                                                <div style="margin-top:5px; color:red;"><a
                                                        href="add-diamond.php?del_id=<?php echo $row['id']; ?>"
                                                        style="height:30px; width:30px;"
                                                        name="<?php echo $row['id']; ?>"><img
                                                            src="images\trash.png" style="width:30px ; height:30px;">
                                                        Remove</a>
                                                    <a href="update-diamond-action.php?chn_id=<?php echo $row['id']; ?>"
                                                        style="height:30px; width:30px;"
                                                        name="<?php echo $row['id']; ?>">
                                                        <img src="images\edit.png"
                                                            style="width:30px ; height:30px;">Edit </a>
                                                </div>

                                            </td>

                                            </td>

                                            <?php $i = $i + 1;
                            }
                        ?>
                                    </table>

                                </div>
                            </div>
                        </div>
                        <!-- /.col-md-12 -->
                    </div>
                </div>
            </div>
            <!-- /.content-container -->
        </div>
        <!-- /.content-wrapper -->
    </div>
    <!-- /.main-wrapper -->
    <script src="js/jquery/jquery-2.2.4.min.js"></script>
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <script src="js/pace/pace.min.js"></script>
    <script src="js/lobipanel/lobipanel.min.js"></script>
    <script src="js/iscroll/iscroll.js"></script>
    <script src="js/prism/prism.js"></script>
    <script src="js/select2/select2.min.js"></script>
    <script src="js/main.js"></script>
    <script>
        $(function($) {
            $(".js-states").select2();
            $(".js-states-limit").select2({
                maximumSelectionLength: 2
            });
            $(".js-states-hide").select2({
                minimumResultsForSearch: Infinity
            });
        });
    </script>
</body>

</html>