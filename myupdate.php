<?php

//require_once 'smarty2_head.php';

//mysql_connect
define("SAE_MYSQL_HOST_M",     "ja-cdbr-azure-east-a.cloudapp.net");
define("SAE_MYSQL_USER",     "bf7588dfac7e65");
define("SAE_MYSQL_PASS",     "92137672");
define("SAE_MYSQL_DB",     "rdbeacoAvghw9hxk");

$conn = @mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS) or die("connect failed" . mysql_error());

mysql_select_db(SAE_MYSQL_DB, $conn);

//params

$id = $_POST['id'];

$locationname = $_POST['locationname'];

$uuid = $_POST['uuid'];
$major = $_POST['major'];
$minor = $_POST['minor'];
//updata db

$sql = sprintf("update %s set locationname='%s',uuid='%s',major=%s,minor=%s where id=%d", 'RDBEACONINFO', $locationname, $uuid,$major,$minor, $id);

$result=mysql_query($sql, $conn);

mysql_close($conn);

if ($result)

    echo 't';

else

    echo 'f';

?>