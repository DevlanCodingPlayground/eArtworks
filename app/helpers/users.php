<?php
/*
 *   Crafted On Sat Aug 20 2022
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


/* Register Customer */

/* Update Customer */

/* Delete Customer */

/* Update Customer Account */
if (isset($_POST['Update_Customer_Profile'])) {
    $user_id = mysqli_real_escape_string($mysqli, $_SESSION['user_id']);
    $user_first_name = mysqli_real_escape_string($mysqli, $_POST['user_first_name']);
    $user_last_name  = mysqli_real_escape_string($mysqli, $_POST['user_last_name']);
    $user_email = mysqli_real_escape_string($mysqli, $_POST['user_email']);
    $user_dob  = mysqli_real_escape_string($mysqli, $_POST['user_dob']);
    $user_phone_number  = mysqli_real_escape_string($mysqli, $_POST['user_phone_number']);
    $user_default_address  = mysqli_real_escape_string($mysqli, $_POST['user_default_address']);
    /* Check If User Profile Has A File In It */
    if (!empty($_FILES['user_profile_picture']['name'])) {
        /* Process User Image */
        $temp_user_image = explode('.', $_FILES['user_profile_picture']['name']);
        $new_user_image = 'Customer_' . (round(microtime(true)) . '.' . end($temp_user_image));
        move_uploaded_file(
            $_FILES['user_profile_picture']['tmp_name'],
            '../public/uploads/users/' . $new_user_image
        );
        /*Check If User Had 
        Existing Profile Photo And If It
        Was There Delete It From Storage Then Replace With New One
        */
        $sql = "SELECT * FROM  users WHERE  user_id = '{$user_id}'";
        $res = mysqli_query($mysqli, $sql);
        $row = mysqli_fetch_assoc($res);
        if (!empty($row['user_profile_picture'])) {
            /* User Has Old Photo */
            $old_profile_photo = $row['user_profile_picture'];
            $old_profile_photo_location = '../public/uploads/users/' . $old_profile_photo;
            /* Delete It */
            unlink($old_profile_photo_location);
        }
        /* Process  User Accout Update */
        $update_sql = "UPDATE users SET user_first_name = '{$user_first_name}', user_last_name = '{$user_last_name}', 
        user_email = '{$user_email}', user_dob = '{$user_dob}',user_phone_number = '{$user_phone_number}',user_default_address = '{$user_default_address}',
        user_profile_picture = '{$new_user_image}' WHERE user_id = '{$user_id}'";

        /* Persist */
        if (mysqli_query($mysqli, $update_sql)) {
            $success = "Profile details updated";
        } else {
            $err = "Failed, please try again later";
        }
    } else {
        /* Process User Account Update Without Changing Profile Photo */
        $update_sql = "UPDATE users SET user_first_name = '{$user_first_name}', user_last_name = '{$user_last_name}', 
        user_email = '{$user_email}', user_dob = '{$user_dob}',user_phone_number = '{$user_phone_number}',user_default_address = '{$user_default_address}'
        WHERE user_id = '{$user_id}'";

        /* Persist */
        if (mysqli_query($mysqli, $update_sql)) {
            $success = "Profile details updated";
        } else {
            $err = "Failed, please try again later";
        }
    }
}

/* Update Customer Account Password Details */
if (isset($_POST['Update_Customer_Password'])) {
    $user_id = mysqli_real_escape_string($mysqli, $_SESSION['user_id']);
    $old_password = sha1(md5(mysqli_real_escape_string($mysqli, $_POST['old_password'])));
    $new_password  = sha1(md5(mysqli_real_escape_string($mysqli, $_POST['new_password'])));
    $confirm_password = sha1(md5(mysqli_real_escape_string($mysqli, $_POST['confirm_password'])));

    if ($new_password != $confirm_password) {
        /* Check If Passwords Match */
        $err = "Passwords does not match";
    } else {

        /* Does Old Password Match */
        $sql = "SELECT * FROM  users   WHERE user_id = '{$user_id}'";
        $res = mysqli_query($mysqli, $sql);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            if ($row['user_password'] != $old_password) {
                $err = "Enter correct old password";
            } else {
                /* Persist Password Update */
                $update_sql = "UPDATE users SET user_password  = '{$confirm_password}' WHERE user_id = '{$user_id}'";
                /* Prepare */
                if (mysqli_query($mysqli, $update_sql)) {
                    $success = "Password updated";
                } else {
                    $err = "Failed, please try again";
                }
            }
        }
    }
}

/* Enable Or Disable 2FA */
if (isset($_POST['Customer_2FA'])) {
    $user_2fa_status = mysqli_real_escape_string($mysqli, $_POST['user_2fa_status']);
    $user_id = mysqli_real_escape_string($mysqli, $_SESSION['user_id']);
    $alert = mysqli_real_escape_string($mysqli, $_POST['alert']);

    /* Persist  */
    $sql  = "UPDATE users SET user_2fa_status = '{$user_2fa_status}' WHERE user_id = '{$user_id}'";

    /* Prepare */
    if (mysqli_query($mysqli, $sql)) {
        $success = $alert;
    } else {
        $err = "Failed!, Please Try Again";
    }
}
