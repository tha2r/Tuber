<?php
include "globals.php";
include 'admin/functions.php';
$loggedin=false;
$usn=$arbb->input['cookie_username'];
$usp=$arbb->input['cookie_password'];
if(strlen($usp)>10)
{
$query=$DB->query("select * from admin where name='$usn' and password='$usp'");
if($DB->num_rows($query)>0)
{

$loggedin=true;
}
}
if($loggedin == true)
{
 if($arbb->input['action']=='add')
 {
  if($arbb->input['do']=='add')
  {
  $tiitle=$arbb->input['title'];
   $query=$DB->query("insert into cat (title)VALUES('$tiitle')");
   redirect('Êã ÇÖÇİÉ ÇáŞÓã ÇáÌÏíÏ ÈäÌÇÍ','cat.php?action=edit');
  }
  else
  {
$webcontent='<p><br>
&nbsp;</p>
<form action="cat.php?action=add&do=add" method="post">
      <table class="table_border" cellSpacing="1" cellPadding="6" width="100%" border="0">
        <tr>
          <td class="tcat" align="middle" colSpan="2">ÇÖÇİÉ ŞÓã ááãŞÇØÚ</td>
        </tr>
        <tr>
          <td class="td1" vAlign="top" width="40%">ÚäæÇä ÇáŞÓã</td>
          <td class="td1" vAlign="top" width="60%">
          <input type="text" name="title" size="32" value=""></td>
        </tr>
        <tr class="tcat">
      <td width="50%" align="center">
      <input type="submit" name="add" value="ÇÖÇİÉ" size="30"></td>
      <td width="50%" align="center">
      <input type="reset" name="reset" value="ÇÚÇÏÉ ÊÚííä" size="30"></td>
        </tr>
    </table>
    &nbsp;</form>
';
   }
 }
 elseif($arbb->input['action']=='edit')
 {
   if(empty($arbb->input['do']))
   {
  $query=$DB->query("select * from cat where 1=1 order by id asc");
$webcontent='<p><br>
&nbsp;</p>
      <table class="table_border" cellSpacing="1" cellPadding="6" width="100%" border="0">
        <tr>
          <td class="tcat" align="middle" colSpan="3">ÊÚÏíá ÇáÇŞÓÇã</td>
        </tr>';

while($cat = $DB->fetch_array($query))
{
$webcontent.='        <tr>
          <td class="td1" vAlign="top" width="40%">'.$cat['title'].'</td>
          <td class="td1" vAlign="top" width="30%"><a href="cat.php?action=edit&do=edit&id='.$cat['id'].'">ÊÚÏíá</a></td>
          <td class="td1" vAlign="top" width="30%"><a href="cat.php?action=del&do=del&id='.$cat['id'].'">ÍĞİ</a></td>
        </tr> ';
}
$webcontent.='        <tr class="tcat">
      <td width="50%" align="center" colspan=3>&nbsp;</td>
        </tr>
    </table>
    &nbsp;
';
    }
    elseif($arbb->input['do']=='edit')
    {
      $query=$DB->query("select * from cat where id='".$arbb->input['id']."'");
      while($cat=$DB->fetch_array($query))
      {
$webcontent='<p><br>
&nbsp;</p>
<form action="cat.php?action=edit&do=do_edit" method="post">
<input type=hidden name=catid value="'.$cat['id'].'">
      <table class="table_border" cellSpacing="1" cellPadding="6" width="100%" border="0">
        <tr>
          <td class="tcat" align="middle" colSpan="2">ÊÚÏíá : '.$cat['title'].'</td>
        </tr>
        <tr>
          <td class="td1" vAlign="top" width="40%">ÚäæÇä ÇáŞÓã</td>
          <td class="td1" vAlign="top" width="60%">
          <input type="text" name="title" size="32" value="'.$cat['title'].'"></td>
        </tr>
        <tr class="tcat">
      <td width="50%" align="center">
      <input type="submit" name="add" value="ÊÚÏíá" size="30"></td>
      <td width="50%" align="center">
      <input type="reset" name="reset" value="ÇÚÇÏÉ ÊÚííä" size="30"></td>
        </tr>
    </table>
    &nbsp;</form>
';
             }
    }

    elseif($arbb->input['do']=='do_edit')
    {
      $catid=$arbb->input['catid'];
      $array=array('title'=>$arbb->input['title']);
      $DB->update($array,'cat','id='.$catid.'');
      redirect('Êã ÊÚÏíá ÇáŞÓã ÈäÌÇÍ','cat.php?action=edit&s='.time().'');
    }

 }
 elseif($arbb->input['action']=='del')
 {
   if(empty($arbb->input['do']))
   {
  $query=$DB->query("select * from cat where 1=1 order by id asc");
$webcontent='<p><br>
&nbsp;</p>
      <table class="table_border" cellSpacing="1" cellPadding="6" width="100%" border="0">
        <tr>
          <td class="tcat" align="middle" colSpan="3">ÊÚÏíá ÇáÇŞÓÇã</td>
        </tr>';

while($cat = $DB->fetch_array($query))
{
$webcontent.='        <tr>
          <td class="td1" vAlign="top" width="40%">'.$cat['title'].'</td>
          <td class="td1" vAlign="top" width="30%"><a href="cat.php?action=edit&do=edit&id='.$cat['id'].'">ÊÚÏíá</a></td>
          <td class="td1" vAlign="top" width="30%"><a href="cat.php?action=del&do=del&id='.$cat['id'].'">ÍĞİ</a></td>
        </tr> ';
}
$webcontent.='        <tr class="tcat">
      <td width="50%" align="center" colspan=3>&nbsp;</td>
        </tr>
    </table>
    &nbsp;
';
    }
        elseif($arbb->input['do']=='del')
    {
      $query=$DB->query("select * from cat where id='".$arbb->input['id']."'");
      while($cat=$DB->fetch_array($query))
      {
$webcontent='<p><br>
&nbsp;</p>
<form action="cat.php?action=del&do=do_del" method="post">
<input type=hidden name=catid value="'.$cat['id'].'">
      <table class="table_border" cellSpacing="1" cellPadding="6" width="100%" border="0">
        <tr>
          <td class="tcat" align="middle" colSpan="2">ÍĞİ : '.$cat['title'].'</td>
        </tr>

        <tr>
          <td class="td2" align="middle" colSpan="2">åá ÇäÊ ãÊÇßÏ ãä Çäß ÊÑíÏ ÍĞİ åĞÇ ÇáŞÓã .. ãáÇÍÙÉ åĞÇ ÇáÚãá áÇ íãßä ÇáÊÑÇÌÚ Úäå æÓíÊã ÍĞİ ÌãíÚ ÇáãŞÇØÚ ÇáÊí ÈÏÇÎá åĞÇ ÇáŞÓã</td>
        </tr>
        <tr>
          <td class="td1" vAlign="top" width="40%">ÚäæÇä ÇáŞÓã</td>
          <td class="td1" vAlign="top" width="60%">'.$cat['title'].'</td>
        </tr>
        <tr class="tcat">
      <td width="50%" align="center">
      <input type="submit" name="add" value="äÚã ãÊÇßÏ .. Şã ÈÇáÍĞİ" size="30"></td>
      <td width="50%" align="center">
      <input type="reset" name="reset" value="ÇÚÇÏÉ ÊÚííä" size="30"></td>
        </tr>
    </table>
    &nbsp;</form>
';
             }
    }

    elseif($arbb->input['do']=='do_del')
    {
      $catid=$arbb->input['catid'];
      $DB->query("delete from cat where id='$catid'");
      $DB->query("delete from movies where cat_id='$catid'");
      redirect('Êã ÇáÍĞİ ÈäÌÇÍ','cat.php?action=del&s='.time().'');
    }
 }
}
else
{
$webcontent = '<br>
      <form action="index.php?action=login" method="post">
        <table  class="table_border" cellpadding="6" cellspacing="1" border="0" align="center" width="50%">
          <tr class="tcat">
            <td align="left" colspan="2"><b>Login</b></td>
          </tr>
          <tr class="td2">
            <td align="left" colspan="2"><b>ÊÓÌíá ÇáÏÎæá : N3san.net</b></td>
          </tr>
          <tr class="td1">
            <td>ÇÓã ÇáãÓÊÎÏã</td>
            <td><input size="35" name="username" value=""></td>
          </tr>
          <tr  class="td1">
            <td>ßáãÉ ÇáãÑæÑ</td>
            <td><input type="password" size="35" value name="password"></td>
          </tr>
          <tr class="td2">
            <td align="left" colspan="2"><b>áÇ íæÌÏ áÏíß ÇáÕáÇÍíÇÊ áÏÎæá åĞå ÇáãäØŞÉ</b></td>
          </tr>
          <tr class="thead">
            <td align="middle" colSpan="2">
            <input class="input-button" type="submit" value=" - - ÊÓÌíá ÇáÏÎæá - - "></td>
          </tr>
        </table>
      </form>
';
$title='áæÍÉ ÇáÊÍßã';
}


print_page();
?>
