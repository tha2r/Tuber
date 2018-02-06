<?php
$templatelist="view_video,view_cat,view_sub,view_subb,";
include "globals.php";
$perpage=20;
$query=$DB->query("select m.*,c.title as ctitle from movies m LEFT JOIN cat c on (c.id = m.cat_id) where m.id=\"".checkval($arbb->input['id'])."\"");
while($mo=$DB->fetch_array($query))
{
$DB->query("update movies set views=views+1 where id=$mo[id]");  
   $TP->webtemp("view_video");

$query=$DB->query("select m.*,c.title as ctitle from movies m left join cat c on(c.id=m.cat_id) where m.cat_id=$mo[cat_id] order by rand() desc limit 0,8");
while($m=$DB->fetch_array($query))
{
$i++;

  $sub_v.=$TP->GetTemp("view_sub");
  $sub_v2.=$TP->GetTemp("view_subb");
if($i==4)
{
$sub_v.="</tr><tr>".$sub_v2."</tr><tr><td colspan=4 class=\"alt2\">&nbsp</td></tr><tr>";
$sub_v2="";
}
}
$sub_v.="</tr><tr>".$sub_v2;
 $TP->WebTemp("view_cat");
}
print_page();
?>
