<?php
/**
 * Created by PhpStorm.
 * User: jimiao
 * Date: 2015/06/04
 * Time: 11:55
 */

include 'librd.php';

$arrReturn = getlocation();
sendResponse(json_encode($arrReturn));

?>