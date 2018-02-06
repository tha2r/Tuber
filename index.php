<?php
$templatelist="index_table,videos_cat,videos_sub,videos_subb,";
include "globals.php";
$titleetc="ÇáÕÝÍÉ ÇáÑÆíÓíÉ";
$query=$DB->query("select m.*,c.title as ctitle from movies m left join cat c on(c.id=m.cat_id) order by id desc limit 0,1");
while($m=$DB->fetch_array($query))
{
  $TP->WebTemp("index_table");
}

$query=$DB->query("select m.*,c.title as ctitle from movies m left join cat c on(c.id=m.cat_id) order by rand() desc limit 0,8");
while($m=$DB->fetch_array($query))
{
$i++;

  $sub_v.=$TP->GetTemp("videos_sub");
  $sub_v2.=$TP->GetTemp("videos_subb");
if($i==4)
{
$sub_v.="</tr><tr>".$sub_v2."</tr><tr><td colspan=4 class=\"alt2\">&nbsp</td></tr><tr>";
$sub_v2="";
}
}
$sub_v.="</tr><tr>".$sub_v2;
 $TP->WebTemp("videos_cat");
print_page();
?>
