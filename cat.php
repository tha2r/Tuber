<?php
$templatelist="cat_cat,cat_video,cat_videoo,";
include "globals.php";
$perpage=20;
$query=$DB->query("select * from cat where id=\"".checkval($arbb->input['id'])."\"");
while($cat=$DB->fetch_array($query))
{

$titleetc=$cat['title'];
$page=($arbb->input['page'])?$arbb->input['page']:1;
$query=$DB->query("select id from movies where cat_id=$cat[id]");
$num=$DB->num_rows($query);
$start=($perpage*$page)-$perpage;
$limit="limit $start,$perpage";
$query=$DB->query("select * from movies where cat_id=$cat[id] order by id desc $limit");
while($m=$DB->fetch_array($query))
{
$i++;

  $sub_v.=$TP->GetTemp("cat_video");
  $sub_v2.=$TP->GetTemp("cat_videoo");
if($i==4)
{
$sub_v.="</tr><tr>".$sub_v2."</tr><tr><td colspan=4 class=\"tfoot\">&nbsp</td></tr><tr>";
$sub_v2="";
$i=0;
}
}
if($i < 4)
{
for($iii=$i;$iii<4;$iii++)
{
$sub_v.="<td class=\"tfoot\">&nbsp</td>";
}
}
$sub_v.="</tr><tr>".$sub_v2;
if($i < 4)
{
for($iii=$i;$iii<4;$iii++)
{
$sub_v.="<td class=\"alt2\">&nbsp</td>";
}
}

$pages = ceil($num / $perpage);
if($pages > 1)
{
$pagesp="";
for($i=0;$i<$pages;$i++)
{
$ii=$i+1;
if($page==$ii)
{
$pagesp.="<td class=\"tfoot\">$ii</td>";
}
else
{
$pagesp.="<td class=\"alt1\"><a href=\"cat-$cat[id]-$ii.html\">$ii</a></td>";
}

}

$pages_t='<br><br><table class="tborder" cellpadding="3" cellspacing="1" border="0" align="center">'
             ."<tr><td>«Œ — ’›Õ… ··«‰ ﬁ«·</td>$pagesp</tr></table>";
}
$webcontent.=$pages_t;
$TP->webtemp("cat_cat");
$webcontent.=$pages_t;

}
print_page();
?>
