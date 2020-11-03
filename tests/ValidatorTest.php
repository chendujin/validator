<?php
require '../vendor/autoload.php';

use \DataTrans\Validator;

$mobilephone = '18665027895s';
$ok = Validator::is_mobilephone($mobilephone);
if ($ok) {
    echo '是手机号码';
} else {
    echo '不是手机号码';
}