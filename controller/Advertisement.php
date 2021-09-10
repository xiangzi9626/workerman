<?php
include "../db/PDO.class.php";
$dbh=DBPDO::getDB();
$action=$_POST["action"];
switch ($action){
    case "save":
      $sel=$dbh->prepare("select id from welive_advertisement");
       $sel->execute();
       $num=$sel->rowCount();
       if ($num==0){
           $insert=$dbh->prepare("insert into welive_advertisement(`left`,`right`) values(?,?)");
           $insert->bindParam(1,$_POST["left"]);
           $insert->bindParam(2,$_POST["right"]);
           if ($insert->execute()){
               echo "ok";
           }else{
               echo "保存失败请重试";
           }
       }else{
           $up=$dbh->prepare("update welive_advertisement set `left`=?,`right`=?");
           $up->bindParam(1,$_POST["left"]);
           $up->bindParam(2,$_POST["right"]);
           if ($up->execute()){
               echo "ok";
           }else{
               echo "保存失败请重试";
           }
       }
        break;
}
?>