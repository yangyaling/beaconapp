<?php
/**
 * Created by PhpStorm.
 * User: jimiao
 * Date: 2015/07/16
 * Time: 21:02
 */

header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

define("SAE_MYSQL_HOST_M",     "ja-cdbr-azure-east-a.cloudapp.net");
define("SAE_MYSQL_USER",     "b5b35eecdcd068");
define("SAE_MYSQL_PASS",     "b5074189");
define("SAE_MYSQL_DB",     "rdbeacoAd7N1JMXE");

$conn = @mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);
mysql_select_db(SAE_MYSQL_DB,$conn);
$sql = "SELECT r.roomid,r.roomname,ifnull(count(us.useruuid),0) as num FROM rdroom r
        left join rdbeaconinfo b on b.roomid = r.roomid
        left join rduserstatus us on b.uuid=us.uuid and b.major=us.major and b.minor=us.minor
        and date_format(us.updatetime,'%Y-%m-%d') = date_format(now(),'%Y-%m-%d')
        where r.visible >0
        group by r.roomid";


$result = mysql_query($sql, $conn);
while ($row=mysql_fetch_row($result)) {
    $d = array("roomid"=>$row[0],"roomname"=>$row[1],"num"=>$row[2]);
    echo "data:".json_encode($d)."\n\n";

    @ob_flush();
    flush();
    sleep(1);
}
mysql_close($conn);