<?php
session_start();
include 'sub/db.php';
$id = $_GET['id'];
$status = '';
if (!isset($_SESSION['email'])) {
    header('location:login.php');
}
   $email = $_SESSION['email'];
   $query = mysqli_query($con, "SELECT * FROM `registration` WHERE `email` = '$email' ");
   $user = mysqli_fetch_assoc($query);
$a = mysqli_query($con, "SELECT * FROM `product` WHERE `id` = '$id' ");
$row = mysqli_fetch_assoc($a);

if (isset($_POST['code']) && $_POST['code'] != '') {
    // $id = $_POST['id'];
    $shape = $row['shape'];
    $idProduct = $row['id'];
    $price = $row['price'];
    $image = $row['image'];

    $cartArray = [
 $idProduct => [
 'shape' => $shape,
 'idProduct' => $idProduct,
 'price' => $price,
 'quantity' => 1,
 'image' => $image, ],
];
    $check = false;

    if (empty($_SESSION['shopping_cart'])) {
        $_SESSION['shopping_cart'] = $cartArray;
        $status = "<div class='box'>Product is added to your cart!</div>";
        $array_keys = array_keys($_SESSION['shopping_cart']);
    } elseif (!empty($_SESSION['shopping_cart'])) {
        foreach ($_SESSION['shopping_cart'] as $re) {
            if ($idProduct == $re['idProduct']) {
                $check = true;
            }
        }
        if ($check) {
            $status = "<div class='box' style='color:red;'>
		Product is already added to your cart!</div>";
        } else {
            $_SESSION['shopping_cart'] = array_merge(
                $_SESSION['shopping_cart'],
                $cartArray
        );
            $status = "<div class='box'>Product is added to your cart!</div>";
        }
    }
}
?>
<html>

<head>
	<title>Elements - Industrious by TEMPLATED</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<link rel="icon" type="image/png" href="images/d1.png">

	<link rel="stylesheet" href="assets/css/main.css" />
</head>

<body class="is-preload">

	<!-- Header -->
	<header id="header">
		<?php
        if ($_SESSION['email'] == @$user['email']) {?>
		<a class="logo" href="index.php">Logout <?php echo @$user['contact_person']; ?></a>
		<?php } else {?>
		<a class="logo" href="login.php">Log in</a>
		<?php
        }
        ?>

		<nav>
			<?php

if (!empty($_SESSION['shopping_cart'])) {
    $cart_count = count(array_keys($_SESSION['shopping_cart'])); ?>

			<a href="cart.php"><img src="images/carts.png" /><span>
					<?php echo $cart_count; ?></span></a>
			<?php
}
                       ?>
			<a href="#menu">Menu</a>

		</nav>
	</header>

	<!-- Nav -->
	<nav id="menu">
		<ul class="links">
			<li><a href="index.php">Home</a></li>
			<li><a href="gallery.php">Gallery</a></li>
			<li><a href="product.php">Product</a></li>
			<li><a href="events.php">Events</a></li>
			<li><a href="about.php">About us</a></li>
		</ul>
	</nav>

	<!-- Heading -->
	<div id="heading">
		<h1>Diamond Summary</h1>
	</div>

	<!-- Main -->
	<section id="main" class="wrapper">
		<div class="inner">
			<div class="content" style="margin-top: -86px;">

				<!-- Elements -->
				<div class="row">
					<div class="col-7 col-12-medium" style=" width: 53%;margin-left: 23px;">
						<!-- Image -->
						<p>
							<span class="image left"><img
									src="admin/<?php echo 'upload/'.@$row['image']; ?>"
									alt="" style="width:345px;" /></span>
						<div style="margin-top: 398px;">
							<ul class="confidence-checklist" style="list-style-type: none;    font-weight: 1000;">
								<li><i class="fa fa-check" style="color:limegreen;"></i>&nbsp;&nbsp;&nbsp;GIA Graded
								</li>
								<li><i class="fa fa-check" style="color:limegreen;"></i>&nbsp;&nbsp;&nbsp;Diamond Price
									Guarantee</li>
								<li><i class="fa fa-check" style="color:limegreen;"></i>&nbsp;&nbsp;&nbsp;Eligible for
									Diamond Upgrade</li>
							</ul>
						</div>
						<div class="link-wrapper">
							<ul style="list-style-type: none;    font-weight: 1000;">
								<li>
									<a href="tel:1-888-565-7641" data-fallback-url="contact.php" style="
    text-decoration:  none;
"><i class="fa fa-phone"></i>&nbsp;&nbsp;&nbsp;<span>+91 9033849692</span></a>
								</li>
								<li> <a href="mailto:jenilnarola@gmail.com" data-email-address="amrutexport@gmail.com"
										style="
    text-decoration:  none;
"><i class="fa fa-envelope"></i>&nbsp;&nbsp;&nbsp;<span>Email Us</span></a></li>
						</div>
					</div>

					<div class="col-5 col-12-medium">
						<!-- Table -->

						<h3 style="font-size:30px;font-weight: bold;font-family: sans-serif;">price : <?php echo $row['price']; ?>$
							</h2>

							<div class="table-wrapper">
								<table>

									<tbody>
										<tr>
											<td style="font-weight: 800;">Shape</td>
											<td style="text-align: right;font-weight: 500;"><?php echo $row['shape']; ?>
											</td>
										</tr>
										<tr>
											<td style="font-weight: 800;">Cut</td>
											<td style="text-align: right;font-weight: 500;"><?php echo $row['cut']; ?>
											</td>
										</tr>
										<tr>
											<td style="font-weight: 800;">Color</td>
											<td style="text-align: right;font-weight: 500;"><?php echo $row['color']; ?>
											</td>
										</tr>
										<tr>
											<td style="font-weight: 800;">Clarity</td>
											<td style="text-align: right;font-weight: 500;"><?php echo $row['clarity']; ?>
											</td>
										</tr>
										<tr>
											<td style="font-weight: 800;">Carat</td>
											<td style="text-align: right;font-weight: 500;"><?php echo $row['carat']; ?>
											</td>
										</tr>
										<tr>
											<td style="font-weight: 800;">Depth %</td>
											<td style="text-align: right;font-weight: 500;"><?php echo $row['depth']; ?>
											</td>
										</tr>
										<tr>
											<td style="font-weight: 800;">Table %</td>
											<td style="text-align: right;font-weight: 500;"><?php echo $row['table']; ?>
											</td>
										</tr>
										<tr>
											<td style="font-weight: 800;">Polish</td>
											<td style="text-align: right;font-weight: 500;"><?php echo $row['polish']; ?>
											</td>
										</tr>
										<tr>
											<td style="font-weight: 800;">Symmetry</td>
											<td style="text-align: right;font-weight: 500;"><?php echo $row['symmetry']; ?>
											</td>
										</tr>
										<tr>
											<td style="font-weight: 800;">Girdle</td>
											<td style="text-align: right;font-weight: 500;"><?php echo $row['girdle']; ?>
											</td>
										</tr>
										<tr>
											<td style="font-weight: 800;">Measurement</td>
											<td style="text-align: right;font-weight: 500;"><?php echo $row['measurement']; ?>
											</td>
										</tr>
										<tr>
											<td style="font-weight: 800;">Stock Number</td>
											<td style="text-align: right;font-weight: 500;"><?php echo $row['stock']; ?>
											</td>
										</tr>
										<tr>

											<div class=''>
												<form method='post' action=''>
													<input type='hidden' name='code' value=".$row['id']." />
													<button type='submit' class='btn '>Buy Now</button>
												</form>
											</div>

											<div class="message_box" style="margin:10px 0px;">
												<?php echo $status; ?>
											</div>
										</tr>

									</tbody>

								</table>
							</div>
					</div>
					</p>




				</div>
			</div>
		</div>
		</div>
	</section>


	<!-- Footer -->
	<footer id="footer">
		<div class="inner">
			<div class="content">
				<section>
					<h3><i class="fa fa-diamond"> Amrut Exports</i></h3>
					<p><b>Address</b><br />1. GE-4030, 4th Floor, Bharat Diamond Bourse, BKC, Bandra East, Mumbai-400
						051
						Tel : +91 22 42457777 / 09 / Fax : +91 22 23682006
						<br />
						2. Vraj Shila, Kapodra Char Rasta, Varachha Road, Surat-395 006
						Tel : +91 261 2572563 / 64 / 65 Fax : +91 261 2580789
					</p>

					<p><b>Contact</b><br />
						Name : MUKESHBHAI DHAMELIYA<br />
						Email : mukesh8803@gmail.com<br />
						Phone No. : +91 9879508803</p>

				</section>
				<section>
					<h4>Menu</h4>
					<ul class="alt">
						<li><a href="index.php">Home</a></li>
						<li><a href="gallery.php">Gallery</a></li>
						<li><a href="product.php">Product</a></li>
						<li><a href="events.php">Events</a></li>
						<li><a href="about.php">About us</a></li>


					</ul>
				</section>
				<section>

					<ul class="plain">
						<li><a href="https://twitter.com/login?lang=en-gb"><i
									class="icon fa-twitter">&nbsp;</i>Twitter</a></li>
						<li><a
								href="https://www.facebook.com/?stype=lo&jlou=Afcj1HDPdROMhF2XNOnt9h9o2wF4I0dqoy2tfGO3dkUaM3YnOQ1vfKLlT5aKBfAkZzclLIah31SzD1xwn9hH0kE-vKtNemwMu49-HGQt3MsBFg&smuh=26133&lh=Ac9uuQ8MHwc55cxTRP0"><i
									class="icon fa-facebook">&nbsp;</i>Facebook</a></li>
						<li><a href="https://www.instagram.com/"><i class="icon fa-instagram">&nbsp;</i>Instagram</a>
						</li>
						<li><a href="https://github.com/login"><i class="icon fa-github">&nbsp;</i>Github</a></li>
					</ul>
				</section>
			</div>
			<div class="copyright">
				@2018 Amrut Exports
			</div>
		</div>
	</footer>

	<!-- Scripts -->
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/browser.min.js"></script>
	<script src="assets/js/breakpoints.min.js"></script>
	<script src="assets/js/util.js"></script>
	<script src="assets/js/main.js"></script>

</body>

</html>