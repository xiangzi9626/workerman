<?php if(!defined('ROOT')) die('Access denied.');
class c_advertisement extends Admin {
    public function index(){
       /* if (isset($_GET["left"]) && isset($_GET["right"])){
            $res=APP::$DB->getOne("select id from welive_advertisement");
            if (count($res)==0){
          APP::$DB->exe("insert into welive_advertisement(`left`,`right`) values({$_GET["left"]},{$_GET["right"]})");
            }else{
                APP::$DB->exe("update welive_advertisement set `left`={$_GET["left"]},`right`={$_GET["right"]}");
            }
        }*/
       echo "<script src='/js/ajax.js'></script>";
        $res=APP::$DB->getOne("select * from welive_advertisement");
        echo "<script>
function save() {
  var left=document.getElementById('left');
  var right=document.getElementById('right');
 var left_val=encodeURIComponent(left.value);
var  right_val=encodeURIComponent(right.value);
  var string='action=save&left='+left_val+'&right='+right_val;
   ajax('/controller/Advertisement.php',string,function(str) {
     if (str==='ok'){
         alert('保存成功');
         window.location=window.location.href;
     }else{
         alert(str);
     }
   })
}
</script>";
        echo "<div style='margin: auto;'>
    <h3>广告位</h3>
    <div style='margin-top:10px;'>
     <table>
     <tr>
     <td>左侧广告位代码</td>
     <td style='padding-left:30px;'>右侧广告位代码</td>
</tr>
<tr>
<td><textarea id='left' style='margin-top:5px;' cols='90' rows='10'>{$res["left"]}</textarea></td>
<td style='padding-left:30px;'><textarea id='right' style='margin-top:5px;' cols='90' rows='10'>{$res["right"]}</textarea></td>
</tr>
</table>
</div>
<div style='margin:50px auto 200px 50px;'>
<a onclick='save()' href='javascript:void(0)' style='padding:4px 15px;background:dodgerblue;color: #FFFFFF;font-weight:600;font-size:15px;'>保存</a></div>
</div>";
    }
    public function get(){
        echo "abcee";
    }
}
?>