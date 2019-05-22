<?php

use core\service\MySqlService;

$files = scandir("wp-content/uploads/auto");
echo sizeof($files);
$sql = MySqlService::getInstance();
foreach($files as $file){
//    $to = preg_replace("#\.jpg\.jpg#", ".jpg", $file);
//    rename("wp-content/uploads/auto/" . $file, "wp-content/uploads/auto/".$to);





    $tmp1 = preg_split("#\.#", $file);
    $res = preg_split("#\_#", $tmp1[0]);
    if(sizeof($res)<2){
        continue;
    }
    $to = null;
    $nm = $res[0]."_".$res[1];
    if(sizeof($res) == 2){
        $to = $res[0];
    }elseif(sizeof($res) == 3){
        $to = $res[0]."_".$res[2];
    }


    if($nm){
        $row = $sql->smart_select_row("SELECT ID FROM wp_posts WHERE post_name=%s AND post_type='attachment'", $nm);
        if($row && $row->ID){
            if(sizeof($res) == 2){
                $to = $row->ID;
            }elseif(sizeof($res) == 3){
                $to = $row->ID."_".$res[2];
            }
            rename("wp-content/uploads/auto/".$file, "to/".$to.".jpg");
        }
    }



}