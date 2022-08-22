<?php

/*
 *   Crafted On Fri Aug 19 2022
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

/* Login */
if (isset($_POST['User_Login'])) {
    $user_email = mysqli_real_escape_string($mysqli, $_POST['user_email']);
    $user_password = sha1(md5(mysqli_real_escape_string($mysqli, $_POST['user_password'])));

    /* Persist*/
    $stmt = $mysqli->prepare("SELECT user_id, user_email, user_password, user_access_level, user_delete_status, user_2fa_status FROM users
    WHERE user_email = '{$user_email}' AND user_password = '{$user_password}' AND user_delete_status != '1'");
    $stmt->execute();
    $stmt->bind_result($user_id, $user_email, $user_password, $user_access_level, $user_delete_status, $user_2fa_status);
    $rs = $stmt->fetch();
    /* Persist Sessions */
    $_SESSION['user_id'] = $user_id;
    $_SESSION['user_access_level'] = $user_access_level;


    /* Determiner Where To Redirect Based On Access Leveles */
    if (($rs && $user_access_level == 'Administrator') ||  ($rs && $user_access_level == 'Staff)')) {
        $_SESSION['success'] = "Welcome to back office module";
        header('Location: dashboard');
        exit;
    } else if ($rs && $user_access_level == 'Customer') {
        /* Nested If Statement On Customer Check If They Have Enaled 2FA  */
        if ($user_2fa_status == '1') {
            /* Email User An OTP */
            header('Location: landing_otp_confirm');
            exit;
        } else {
            $_SESSION['success'] = 'Login success';
            header('Location: ../');
            exit;
        }
    } else {
        $err = "Failed!, Incorrect Login Credentials";
    }
}

/* Confirm 2FA */
if (isset($_POST['Customer_Confirm_2FA'])) {
    $user_id = mysqli_real_escape_string($mysqli, $_SESSION['user_id']);
    $user_2fa_code = mysqli_real_escape_string($mysqli, $_POST['user_2fa_code']);

    /* Login User Using This Code */
    $stmt = $mysqli->prepare("SELECT user_id, user_2fa_status  FROM users  WHERE 
    user_2fa_status = '{$user_2fa_code}' AND user_id = '{$user_id}' ");
    $stmt->execute();
    $stmt->bind_result($user_2fa_status);
    $rs = $stmt->fetch();
    /* Prepare */
    if ($rs) {
        /* Allow Login */
        $_SESSION['success'] = 'Login success';
        header('Location: ../');
        exit;
    } else {
        $err = "Failed, please enter correct code";
    }
}

/* Register */
if (isset($_POST['User_Register'])) {
    $user_first_name = mysqli_real_escape_string($mysqli, $_POST['user_first_name']);
    $user_last_name  = mysqli_real_escape_string($mysqli, $_POST['user_last_name']);
    $user_email = mysqli_real_escape_string($mysqli, $_POST['user_email']);
    $user_dob  = mysqli_real_escape_string($mysqli, $_POST['user_dob']);
    $user_phone_number  = mysqli_real_escape_string($mysqli, $_POST['user_phone_number']);
    $user_default_address  = mysqli_real_escape_string($mysqli, $_POST['user_default_address']);
    $user_access_level  = mysqli_real_escape_string($mysqli, 'Customer');
    $new_password = sha1(md5(mysqli_real_escape_string($mysqli, $_POST['new_password'])));
    $confirm_password = sha1(md5(mysqli_real_escape_string($mysqli, $_POST['confirm_password'])));

    /* Check If Passwords Match */
    if ($new_password != $confirm_password) {
        $err = "Passwords Does Not Match";
    } else {
        /* Avoid Duplications */
        $sql = "SELECT * FROM  users   WHERE user_email = '{$user_email}' AND  user_phone_number = '{$user_phone_number}'";
        $res = mysqli_query($mysqli, $sql);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            if (
                $user_email == $row['user_email'] || $user_phone_number == $row['user_phone_number']
            ) {
                $err = 'Phone Number Or Email Already Exists';
            }
        } else {
            /* Persist */
            $insert_sql = "INSERT INTO users (user_first_name, user_last_name, user_email, user_dob, user_phone_number, user_default_address, user_password, user_access_level)
            VALUES('{$user_first_name}', '{$user_last_name}', '{$user_email}', '{$user_dob}', '{$user_phone_number}', '{$user_default_address}', '{$confirm_password}', '{$user_access_level}')";

            /* Prepare */
            if (mysqli_query($mysqli, $insert_sql)) {
                $_SESSION['success'] = "Account created, proceed to log in";
                header('Location: login');
                exit;
            } else {
                $err = "Failed!, Please Try Again";
            }
        }
    }
}
 /* Reset Password Step 1 */

 /* Reset Password Step 2 */