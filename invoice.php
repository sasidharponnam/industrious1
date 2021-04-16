<?php
include 'sub/db.php';
    session_start();
    if (!isset($_SESSION['email'])) {
        header('location:login.php');
    }
       $email = $_SESSION['email'];
       $query = mysqli_query($con, "SELECT * FROM `registration` WHERE `email` = '$email' ");
       $user = mysqli_fetch_assoc($query);

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
    <style>
        div.invoice {
            border: 1px solid #ccc;
            margin: 30px;
            margin-left: 300px;
            padding: 10px;
            height: 800pt;
            width: 570pt;
        }

        div.company-address {
            border: 1px solid #ccc;
            float: left;
            width: 200pt;
        }

        div.invoice-details {
            border: 1px solid #ccc;
            float: right;
            width: 200pt;
        }

        div.customer-address {
            border: 1px solid #ccc;
            float: right;
            margin-bottom: 50px;
            margin-top: 100px;
            width: 200pt;
        }

        div.clear-fix {
            clear: both;
            float: none;
        }

        table {
            width: 100%;
        }

        th {
            text-align: left;
        }

        .text-left {
            text-align: left;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }
    </style>




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
        <h1>Invoice</h1>
    </div>

    <body>

        <div class="invoice">
            <div class="company-address">
                AMRUT EXPORTS
                <br />
                <br />
                1. GE-4030, 4th Floor, Bharat Diamond Bourse, BKC, Bandra East,
                <br />
                Mumbai-400 051
                <br />
                Tel : +91 22 42457777 / 09
                <br />
                Fax : +91 22 23682006
                <br />
            </div>

            <div class="invoice-details">
                Invoice Number: <?php echo @$user['id']; ?>
                <br />
                <?php
            echo 'Date: '.date('Y/m/d').'<br>';
            ?>
            </div>

            <div class="customer-address">
                To:
                <br />
                Mr. <?php echo @$user['contact_person']; ?>
                <br />
                <?php echo @$user['address']; ?>
                <br />
                <?php echo @$user['city']; ?>,<?php echo @$user['state']; ?>-<?php echo @$user['zip']; ?>
                <br />
            </div>

            <div class="clear-fix"></div>
            <table border='1' cellspacing='0'>
                <tr>
                    <th width=250>Description</th>
                    <th width=80>Amount</th>
                    <th width=100>Unit price</th>
                    <th width=100>Total price</th>
                </tr>

                <?php
            $total = 0;
            $vat = 0.15;
            $total_price = 0.0;

            foreach ($_SESSION['shopping_cart'] as $articles) {
                $description = $articles['shape'];
                $amount = $articles['quantity'];
                $unit_price = $articles['price'];
                $total_price += ($articles['price'] * $articles['quantity']);
                $total += $total_price;
                echo '<tr>';
                echo "<td>$description</td>";
                echo "<td class='text-center'>$amount</td>";
                echo "<td class='text-right'>$$unit_price</td>";
                echo "<td class='text-right'>$$total_price</td>";
                echo '</tr>';
            }

            echo '<tr>';
            echo "<td colspan='3'>Sub total</td>";
            echo "<td class='text-right'>$".number_format($total, 2).'</td>';
            echo '</tr>';
            echo '<tr>';
            echo "<td colspan='3' class='text-right'>Tax</td>";
            echo "<td class='text-right'>$".number_format(($total * $vat), 2).'</td>';
            echo '</tr>';
            echo '<tr>';
            echo "<td colspan='3' class='text-right'><b>TOTAL</b></td>";
            echo "<td class='text-right'><b>$".number_format(((($total * $vat)) + $total), 2).'</b></td>';
            echo '</tr>';
            ?>
                <tr>
                    <td colspan='4' class='text-right'>

                        <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
                            <input type='hidden' name='business' value='sb-gdxzw5467765@business.example.com'>

                            <input type='hidden' name='item_name' value='All Items'> <input type='hidden'
                                name='item_number'
                                value='<?php echo count($_SESSION['shopping_cart']); ?>'>
                            <input type='hidden' name='amount' value=<?php echo $total; ?>>

                            <input type='hidden' name='no_shipping' value='1'>
                            <input type='hidden' name='currency_code' value='USD'> <input type='hidden'
                                name='notify_url'
                                value='http://sitename/paypal-payment-gateway-integration-in-php/notify.php'>
                            <input type='hidden' name='cancel_return'
                                value='http://sitename/paypal-payment-gateway-integration-in-php/cancel.php'>
                            <input type='hidden' name='return'
                                value='http://sitename/paypal-payment-gateway-integration-in-php/return.php'>
                            <input type="hidden" name="cmd" value="_xclick"> <input type="submit" name="pay_now"
                                id="pay_now" Value="Pay Now">
                        </form>

                    </td>

                </tr>
            </table>
        </div>

        <!-- Footer -->
        <footer id="footer">
            <div class="inner">
                <div class="content">
                    <section>
                        <h3><i class="fa fa-diamond"> Amrut Exports</i></h3>
                        <p><b>Address</b><br />1. GE-4030, 4th Floor, Bharat Diamond Bourse, BKC, Bandra East,
                            Mumbai-400
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
                            <li><a href="https://www.instagram.com/"><i
                                        class="icon fa-instagram">&nbsp;</i>Instagram</a>
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