<?php
include "src/doraconst.php";
include "src/packet.php";
include "src/client.php";

//app server config 
$config = array(
    array("ip"=>"127.0.0.1","port"=>9567),
    //array("ip"=>"127.0.0.1","port"=>9567), you can set more ,the client will random select one,to increase High availability
);

$obj = new DoraRPC\Client($config);
file_put_contents("/tmp/sw_client_test.log","start:".date("Y-m-d H:i:s")."\r\n", FILE_APPEND);
for ($i = 0; $i < 10000; $i++) {
    //single && sync
    // $ret = $obj->singleAPI("get_user", array("nu"=>234, "name"=>$i), true,1);
    // var_dump($ret);

    // WARNING!!! modelsManager and new User at the same time have Problem!  ---Record Exists! ERROR! 

    // multi && async
    $data = array(
        "oak" => array("name" => "add_user", "param" => array("name" => "NO".$i,"department"=>"DEP".$i)),
        // "cd" => array("name" => "update_user", "param" => array("name" => "update".$i,"department"=>"update".$i)),
        "mmm" => array("name" => "insert_user", "param" => array("name" => "insert".$i,"department"=>"insert".$i)),
        "sdgg" => array("name" => "plus_user", "param" => array("name" => "plus".$i,"department"=>"plus".$i)),
    );
    //edit false to true to  use sync
    $ret = $obj->multiAPI($data, false, 1);
    var_dump($ret);

}
file_put_contents("/tmp/sw_client_test.log","End:".date("Y-m-d H:i:s")."\r\n", FILE_APPEND);

