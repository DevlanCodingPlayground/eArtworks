<?php
/*
 *   Crafted On Sun Aug 21 2022
 *
 * 
 *   https://bit.ly/MartMbithi
 *   martdevelopers254@gmail.com
 *
 *
 *   The MartDevelopers End User License Agreement
 *   Copyright (c) 2022 MartDevelopers
 *
 *
 *   1. GRANT OF LICENSE 
 *   MartDevelopers hereby grants to you (an individual) the revocable, personal, non-exclusive, and nontransferable right to
 *   install and activate this system on two separated computers solely for your personal and non-commercial use,
 *   unless you have purchased a commercial license from MartDevelopers. Sharing this Software with other individuals, 
 *   or allowing other individuals to view the contents of this Software, is in violation of this license.
 *   You may not make the Software available on a network, or in any way provide the Software to multiple users
 *   unless you have first purchased at least a multi-user license from MartDevelopers.
 *
 *   2. COPYRIGHT 
 *   The Software is owned by MartDevelopers and protected by copyright law and international copyright treaties. 
 *   You may not remove or conceal any proprietary notices, labels or marks from the Software.
 *
 *
 *   3. RESTRICTIONS ON USE
 *   You may not, and you may not permit others to
 *   (a) reverse engineer, decompile, decode, decrypt, disassemble, or in any way derive source code from, the Software;
 *   (b) modify, distribute, or create derivative works of the Software;
 *   (c) copy (other than one back-up copy), distribute, publicly display, transmit, sell, rent, lease or 
 *   otherwise exploit the Software. 
 *
 *
 *   4. TERM
 *   This License is effective until terminated. 
 *   You may terminate it at any time by destroying the Software, together with all copies thereof.
 *   This License will also terminate if you fail to comply with any term or condition of this Agreement.
 *   Upon such termination, you agree to destroy the Software, together with all copies thereof.
 *
 *
 *   5. NO OTHER WARRANTIES. 
 *   MARTDEVELOPERS  DOES NOT WARRANT THAT THE SOFTWARE IS ERROR FREE. 
 *   MARTDEVELOPERS SOFTWARE DISCLAIMS ALL OTHER WARRANTIES WITH RESPECT TO THE SOFTWARE, 
 *   EITHER EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO IMPLIED WARRANTIES OF MERCHANTABILITY, 
 *   FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT OF THIRD PARTY RIGHTS. 
 *   SOME JURISDICTIONS DO NOT ALLOW THE EXCLUSION OF IMPLIED WARRANTIES OR LIMITATIONS
 *   ON HOW LONG AN IMPLIED WARRANTY MAY LAST, OR THE EXCLUSION OR LIMITATION OF 
 *   INCIDENTAL OR CONSEQUENTIAL DAMAGES,
 *   SO THE ABOVE LIMITATIONS OR EXCLUSIONS MAY NOT APPLY TO YOU. 
 *   THIS WARRANTY GIVES YOU SPECIFIC LEGAL RIGHTS AND YOU MAY ALSO 
 *   HAVE OTHER RIGHTS WHICH VARY FROM JURISDICTION TO JURISDICTION.
 *
 *
 *   6. SEVERABILITY
 *   In the event of invalidity of any provision of this license, the parties agree that such invalidity shall not
 *   affect the validity of the remaining portions of this license.
 *
 *
 *   7. NO LIABILITY FOR CONSEQUENTIAL DAMAGES IN NO EVENT SHALL MARTDEVELOPERS OR ITS SUPPLIERS BE LIABLE TO YOU FOR ANY
 *   CONSEQUENTIAL, SPECIAL, INCIDENTAL OR INDIRECT DAMAGES OF ANY KIND ARISING OUT OF THE DELIVERY, PERFORMANCE OR 
 *   USE OF THE SOFTWARE, EVEN IF MARTDEVELOPERS HAS BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES
 *   IN NO EVENT WILL MARTDEVELOPERS  LIABILITY FOR ANY CLAIM, WHETHER IN CONTRACT 
 *   TORT OR ANY OTHER THEORY OF LIABILITY, EXCEED THE LICENSE FEE PAID BY YOU, IF ANY.
 *
 */
session_start();
require_once('../app/settings/config.php');
require_once('../app/settings/checklogin.php');
checklogin();
require_once('../app/partials/landing_head.php');
?>

<body class="cart_page">
    <div id="ec-overlay"><span class="loader_img"></span></div>

    <!-- Header start  -->
    <?php require_once('../app/partials/landing_navigation.php'); ?>
    <!-- Header End  -->


    <!-- Ec breadcrumb start -->
    <div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row ec_breadcrumb_inner">
                        <div class="col-md-6 col-sm-12">
                            <h2 class="ec-breadcrumb-title">Cart</h2>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <!-- ec-breadcrumb-list start -->
                            <ul class="ec-breadcrumb-list">
                                <li class="ec-breadcrumb-item"><a href="../">Home</a></li>
                                <li class="ec-breadcrumb-item active">Cart</li>
                            </ul>
                            <!-- ec-breadcrumb-list end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ec breadcrumb end -->

    <!-- Ec cart page -->
    <section class="ec-page-content section-space-p">
        <div class="container">
            <div class="row">
                <div class="ec-cart-leftside col-lg-8 col-md-12 ">
                    <!-- cart content Start -->
                    <div class="ec-cart-content">
                        <div class="ec-cart-inner">
                            <div class="row">
                                <form action="#">
                                    <div class="table-content cart-table-content">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>Product</th>
                                                    <th>Price</th>
                                                    <th style="text-align: center;">Quantity</th>
                                                    <th>Total</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td data-label="Product" class="ec-cart-pro-name"><a href="product-left-sidebar.html"><img class="ec-cart-pro-img mr-4" src="assets/images/product-image/1.jpg" alt="" />Stylish Baby Shoes</a></td>
                                                    <td data-label="Price" class="ec-cart-pro-price"><span class="amount">$56.00</span></td>
                                                    <td data-label="Quantity" class="ec-cart-pro-qty" style="text-align: center;">
                                                        <div class="cart-qty-plus-minus">
                                                            <input class="cart-plus-minus" type="text" name="cartqtybutton" value="1" />
                                                        </div>
                                                    </td>
                                                    <td data-label="Total" class="ec-cart-pro-subtotal">$56.00</td>
                                                    <td data-label="Remove" class="ec-cart-pro-remove">
                                                        <a href="#"><i class="ecicon eci-trash-o"></i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td data-label="Product" class="ec-cart-pro-name"><a href="product-left-sidebar.html"><img class="ec-cart-pro-img mr-4" src="assets/images/product-image/2.jpg" alt="" />Unisex Fully Solid Hoodie</a></td>
                                                    <td data-label="Price" class="ec-cart-pro-price"><span class="amount">$75.00</span></td>
                                                    <td data-label="Quantity" class="ec-cart-pro-qty" style="text-align: center;">
                                                        <div class="cart-qty-plus-minus">
                                                            <input class="cart-plus-minus" type="text" name="cartqtybutton" value="1" />
                                                        </div>
                                                    </td>
                                                    <td data-label="Total" class="ec-cart-pro-subtotal">$75.00</td>
                                                    <td data-label="Remove" class="ec-cart-pro-remove">
                                                        <a href="#"><i class="ecicon eci-trash-o"></i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td data-label="Product" class="ec-cart-pro-name"><a href="product-left-sidebar.html"><img class="ec-cart-pro-img mr-4" src="assets/images/product-image/3.jpg" alt="" />Beautiful T-shirt For Women</a></td>
                                                    <td data-label="Price" class="ec-cart-pro-price"><span class="amount">$48.00</span></td>
                                                    <td data-label="Quantity" class="ec-cart-pro-qty" style="text-align: center;">
                                                        <div class="cart-qty-plus-minus">
                                                            <input class="cart-plus-minus" type="text" name="cartqtybutton" value="1" />
                                                        </div>
                                                    </td>
                                                    <td data-label="Total" class="ec-cart-pro-subtotal">$48.00</td>
                                                    <td data-label="Remove" class="ec-cart-pro-remove">
                                                        <a href="#"><i class="ecicon eci-trash-o"></i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td data-label="Product" class="ec-cart-pro-name"><a href="product-left-sidebar.html"><img class="ec-cart-pro-img mr-4" src="assets/images/product-image/4.jpg" alt="" />Wool Hat For Men</a></td>
                                                    <td data-label="Price" class="ec-cart-pro-price"><span class="amount">$95.00</span></td>
                                                    <td data-label="Quantity" class="ec-cart-pro-qty" style="text-align: center;">
                                                        <div class="cart-qty-plus-minus">
                                                            <input class="cart-plus-minus" type="text" name="cartqtybutton" value="1" />
                                                        </div>
                                                    </td>
                                                    <td data-label="Total" class="ec-cart-pro-subtotal">$95.00</td>
                                                    <td data-label="Remove" class="ec-cart-pro-remove">
                                                        <a href="#"><i class="ecicon eci-trash-o"></i></a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="ec-cart-update-bottom">
                                                <a href="#">Continue Shopping</a>
                                                <button class="btn btn-primary">Check Out</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--cart content End -->
                </div>
                <!-- Sidebar Area Start -->
                <div class="ec-cart-rightside col-lg-4 col-md-12">
                    <div class="ec-sidebar-wrap">
                        <!-- Sidebar Summary Block -->
                        <div class="ec-sidebar-block">
                            <div class="ec-sb-title">
                                <h3 class="ec-sidebar-title">Summary</h3>
                            </div>
                            <div class="ec-sb-block-content">
                                <h4 class="ec-ship-title">Estimate Shipping</h4>
                                <div class="ec-cart-form">
                                    <p>Enter your destination to get a shipping estimate</p>
                                    <form action="#" method="post">
                                        <span class="ec-cart-wrap">
                                            <label>Country *</label>
                                            <span class="ec-cart-select-inner">
                                                <select name="ec_cart_country" id="ec-cart-select-country" class="ec-cart-select">
                                                    <option selected="" disabled="">United States</option>
                                                    <option value="1">Country 1</option>
                                                    <option value="2">Country 2</option>
                                                    <option value="3">Country 3</option>
                                                    <option value="4">Country 4</option>
                                                    <option value="5">Country 5</option>
                                                </select>
                                            </span>
                                        </span>
                                        <span class="ec-cart-wrap">
                                            <label>State/Province</label>
                                            <span class="ec-cart-select-inner">
                                                <select name="ec_cart_state" id="ec-cart-select-state" class="ec-cart-select">
                                                    <option selected="" disabled="">Please Select a region, state
                                                    </option>
                                                    <option value="1">Region/State 1</option>
                                                    <option value="2">Region/State 2</option>
                                                    <option value="3">Region/State 3</option>
                                                    <option value="4">Region/State 4</option>
                                                    <option value="5">Region/State 5</option>
                                                </select>
                                            </span>
                                        </span>
                                        <span class="ec-cart-wrap">
                                            <label>Zip/Postal Code</label>
                                            <input type="text" name="postalcode" placeholder="Zip/Postal Code">
                                        </span>
                                    </form>
                                </div>
                            </div>

                            <div class="ec-sb-block-content">
                                <div class="ec-cart-summary-bottom">
                                    <div class="ec-cart-summary">
                                        <div>
                                            <span class="text-left">Sub-Total</span>
                                            <span class="text-right">$80.00</span>
                                        </div>
                                        <div>
                                            <span class="text-left">Delivery Charges</span>
                                            <span class="text-right">$80.00</span>
                                        </div>
                                        <div>
                                            <span class="text-left">Coupan Discount</span>
                                            <span class="text-right"><a class="ec-cart-coupan">Apply Coupan</a></span>
                                        </div>
                                        <div class="ec-cart-coupan-content">
                                            <form class="ec-cart-coupan-form" name="ec-cart-coupan-form" method="post" action="#">
                                                <input class="ec-coupan" type="text" required="" placeholder="Enter Your Coupan Code" name="ec-coupan" value="">
                                                <button class="ec-coupan-btn button btn-primary" type="submit" name="subscribe" value="">Apply</button>
                                            </form>
                                        </div>
                                        <div class="ec-cart-summary-total">
                                            <span class="text-left">Total Amount</span>
                                            <span class="text-right">$80.00</span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- Sidebar Summary Block -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Start -->
    <?php require_once('../app/partials/landing_footer.php'); ?>
    <!-- Footer Area End -->

    <!-- Vendor JS -->
    <?php require_once('../app/partials/landing_scripts.php'); ?>

</body>


</html>