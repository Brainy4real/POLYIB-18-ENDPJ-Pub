<?php
/**
 * Created by PhpStorm.
 * User: Octavia
 * Date: 12/6/2018
 * Time: 1:42 PM
 */
session_start();
session_unset();
session_destroy();
header("Location: Login.php");
exit();