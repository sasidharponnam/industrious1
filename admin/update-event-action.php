<?php
include 'includes/config.php';
$ch = $_GET['chn_id'];
$m = '';
$data = mysqli_query($con, 'select * from events where id='.$ch);

//count data

$i = 0;
    while ($row = mysqli_fetch_assoc($data)) {
        if (isset($_POST['update'])) {
            //$image_name = 'upload/'.$_FILES['image_new']['name'];
            $image_name = addslashes($_FILES['image_new']['name']);
            if ($image_name) {
                move_uploaded_file($_FILES['image_new']['tmp_name'], 'upload/'.$_FILES['image_new']['name']);
            } else {
                $image_name = @$row['image'];
            }

            $des = $_POST['des'];
            $name = $_POST['name'];
            //move_uploaded_file($_FILES["image"]["tmp_name"],"upload/" . $_FILES["image"]["name"]);
            $query = mysqli_query($con, "UPDATE `events` SET `name`='".$name."', `image`='".$image_name."', `des`='".$des."' WHERE id=".$ch);
            //$query = mysqli_query($con, 'UPDATE `events` SET `name=`'.$name."',`image=`".$image_name."' , `des=`".$des."' WHERE id=".$ch);
            // $query = mysqli_query($con, 'UPDATE `events` SET `name=`'.$name."',`image=`".$image_name."' , `des=`".$des."' WHERE id=".$ch);
            // mysqli_query($con,"UPDATE `image` SET name='".$image_name."', data='".$photo."'  WHERE id='".$img_id."'");
            $data = mysqli_query($con, 'select * from events where id='.$ch);
            if ($query) {
                header('location:add-event.php');
            } else {
                $m = 'error content';
            }
        } ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DIAM| Update Diamond Info < </title>
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
                                <h2 class="title">Update Event</h2>

                            </div>

                            <!-- /.col-md-6 text-right -->
                        </div>
                        <!-- /.row -->
                        <div class="row breadcrumb-div">
                            <div class="col-md-6">
                                <ul class="breadcrumb">
                                    <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>

                                    <li class="active">Update Event</li>
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
                                            <h5>Update the Event</h5>
                                        </div>
                                    </div>
                                    <div class="panel-body">

                                        <form class="form-horizontal" method="post" enctype="multipart/form-data">


                                            <div class="form-group">
                                                <label for="default" class="col-sm-2 control-label">Event Name:</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="name" class="form-control"
                                                        value="<?php echo @$row['name']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="default" class="col-sm-2 control-label">image:</label>
                                                <div class="col-sm-10">
                                                    <img src="<?php echo 'upload/'.@$row['image']; ?>"
                                                        width="100" height="100">
                                                    <input type="file" name="image_new" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="default" class="col-sm-2 control-label">Description:</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="des" class="form-control"
                                                        value="<?php echo @$row['des']; ?>">
                                                </div>
                                            </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" name="update" class="btn btn-primary">Update</button>
                                        </div>
                                    </div>
                                    </form>


                                    <?php $i = $i + 1;
    }
                        ?>

                                </div>
                            </div>
                        </div>
                        <!-- /.col-md-12 -->
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

</body>

</html>


<html>

<body>

</body>

</html>