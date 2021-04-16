<?php
include 'sub/db.php';
//$id = $_GET['id'];
$status = '';
//$a = mysqli_query($con, "SELECT * FROM `product` WHERE `id` = '$id' ");
//$row = mysqli_fetch_assoc($a);

session_start();
if (!isset($_SESSION['email'])) {
    header('location:login.php');
}
   $email = $_SESSION['email'];
   $query = mysqli_query($con, "SELECT * FROM `registration` WHERE `email` = '$email' ");
   $user = mysqli_fetch_assoc($query);
$status = '';
if (isset($_POST['action']) && $_POST['action'] == 'remove') {
    if (!empty($_SESSION['shopping_cart'])) {
        foreach ($_SESSION['shopping_cart'] as $key => $value) {
            echo $_POST['id'];
            echo $value['idProduct'];
            if ($_POST['id'] == $value['idProduct']) {
                unset($_SESSION['shopping_cart'][$key]);
                $status = "<div class='box' style='color:red;'>
      Product is removed from your cart!</div>";
            }
            if (empty($_SESSION['shopping_cart'])) {
                unset($_SESSION['shopping_cart']);
            }
        }
    }
}

if (isset($_POST['action']) && $_POST['action'] == 'change') {
    foreach ($_SESSION['shopping_cart'] as &$value) {
        if ($value['idProduct'] === $_POST['id']) {
            $value['quantity'] = $_POST['quantity'];
            break; // Stop the loop after we've found the product
        }
    }
}

if (isset($id) && $id != '') {
    // $id = $_POST['id'];
    $row = mysqli_fetch_assoc($a);
    $shape = $row['shape'];
    $id = $row['id'];
    $price = $row['price'];
    $image = $row['image'];

    $cartArray = [
 $id => [
 'shape' => $shape,
 'id' => $id,
 'price' => $price,
 'quantity' => 1,
 'image' => $image, ],
];
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
        <h1>Cart</h1>
    </div>

    <div class="cart">
        <?php
if (isset($_SESSION['shopping_cart'])) {
                           $total_price = 0; ?>
        <table class="table">
            <tbody>
                <tr>
                    <td></td>
                    <td>ITEM NAME</td>
                    <td>QUANTITY</td>
                    <td>UNIT PRICE</td>
                    <td>ITEMS TOTAL</td>
                    <td>ACTIONS</td>
                </tr>
                <?php
foreach ($_SESSION['shopping_cart'] as $product) {
                               ?>
                <tr>
                    <td>
                        <img src='<?php echo 'images/'.$product['image']; ?>'
                            width="50" height="40" />
                    </td>
                    <td><?php echo $product['shape']; ?>
                    </td>
                    <td>
                        <form method='post' action=''>
                            <input type='hidden' name='id'
                                value="<?php echo $product['idProduct']; ?>" />
                            <input type='hidden' name='action' value="change" />
                            <select name='quantity' class='quantity' onChange="this.form.submit()">
                                <option <?php if ($product['quantity'] == 1) {
                                   echo 'selected';
                               } ?>
                                    value="1">1
                                </option>
                                <option <?php if ($product['quantity'] == 2) {
                                   echo 'selected';
                               } ?>
                                    value="2">2
                                </option>
                                <option <?php if ($product['quantity'] == 3) {
                                   echo 'selected';
                               } ?>
                                    value="3">3
                                </option>
                                <option <?php if ($product['quantity'] == 4) {
                                   echo 'selected';
                               } ?>
                                    value="4">4
                                </option>
                                <option <?php if ($product['quantity'] == 5) {
                                   echo 'selected';
                               } ?>
                                    value="5">5
                                </option>
                            </select>
                        </form>
                    </td>
                    <td><?php echo '$'.$product['price']; ?>
                    </td>
                    <td><?php echo '$'.$product['price'] * $product['quantity']; ?>
                    </td>
                    <td>
                        <form method='post' action=''>
                            <input type='hidden' name='id'
                                value="<?php echo $product['idProduct']; ?>" />
                            <input type='hidden' name='action' value="remove" />
                            <button type='submit' class='btn'>Remove Item</button>
                        </form>
                    </td>
                </tr>
                <?php
$total_price += ($product['price'] * $product['quantity']);
                           } ?>
                <tr>
                    <td colspan="6" align="right">
                        <strong>TOTAL: <?php echo '$'.$total_price; ?></strong>
                    </td>
                </tr>
                <tr>
                    <td colspan="6" align="right">
                        <form method='post' action=invoice.php>
                            <input type="hidden" name="cmd" value="_cart">
                            <input type="hidden" name="business" value="sb-iqppc5403366@personal.example.com ">
                            <input type="hidden" name="upload" value="1">
                            <input type='hidden' name='action' value="placeOrder" />
                            <button type='submit' class='btn'>Place Order</button>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
        <?php
                       } else {
                           echo '<h3>Your cart is empty!</h3>';
                       }
?>
    </div>

    <div style="clear:both;"></div>

    <div class="message_box" style="margin:10px 0px;">
        <?php echo $status; ?>
    </div>


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