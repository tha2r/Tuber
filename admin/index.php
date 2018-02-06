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
if(empty($arbb->input['action']))
{

die('<FRAMESET border=0 frameSpacing=0 frameBorder=0 cols=195,*>
<FRAME border=no name=nav marginWidth=0 marginHeight=0 src="index.php?action=menu" frameBorder=0 scrolling=yes>
<FRAMESET border=0 frameSpacing=0 rows=20,* frameBorder=0>
<FRAME border=no name="head" marginWidth=10 marginHeight=0 src="index.php?action=head" frameBorder=0 noResize scrolling=no>
<FRAME border=no name="main" marginWidth=10 marginHeight=10 src="index.php?action=main" frameBorder=0 scrolling=yes>
</FRAMESET>
</FRAMESET>');

}
elseif($arbb->input['action']=="pass")
{
if($arbb->input['do']=="edit")
{
$password=md5($arbb->input['newpass']);
setcookie('cookie_password',$password,time()+36000);
$query=$DB->query("update admin set password='$password'");
redirect('Êã ÊÛííÑ ßáãÉ ÇáãÑæÑ ÈäÌÇÍ .. æíÑÌì ÇÓÊÎÏÇã ßáãÉ ÇáãÑæÑ ÇáÌÏíÏÉ ÚäÏ ÊÓÌíá ÇáÏÎæá İí ÇáãÑÉ ÇáŞÇÏãÉ','index.php');
}
else
{
$webcontent.='<p><br>
&nbsp;</p>
<form action="index.php?action=pass&do=edit" method="post">
      <table class="table_border" cellSpacing="1" cellPadding="6" width="100%" border="0">
        <tr>
          <td class="tcat" align="middle" colSpan="2">ÊÛííÑ ßáãÉ ÇáãÑæÑ ÇáÎÇÕÉ ÈÇáãÔÑİ ÇáÚÇã</td>
        </tr>

        <tr>
          <td class="td2" align="middle" colSpan="2">ãáÇÍÙÉ : ÊÛííÑ ßáãÉ ÇáãÑæÑ áÇ íÄËÑ Úáì ÇÓã ÇáãÓÊÎÏã..</td>
        </tr>
        <tr>
          <td class="td1" vAlign="top" width="40%">ßáãÉ ÇáãÑæÑ ÇáÌÏíÏÉ</td>
          <td class="td1" vAlign="top" width="60%"><input type=text name=newpass></td>
        </tr>
        <tr class="tcat">
      <td width="50%" align="center">
      <input type="submit" name="add" value="ÊÛííÑ ßáãÉ ÇáãÑæÑ" size="30"></td>
      <td width="50%" align="center">
      <input type="reset" name="reset" value="ÇÚÇÏÉ ÊÚííä" size="30"></td>
        </tr>
    </table>
    &nbsp;</form>';
}
}
elseif($arbb->input['action']=='logout')
{
setcookie('cookie_username','',time()-36000);
setcookie('cookie_password','',time()-36000);

redirect('Êã ÊÓÌíá ÇáÎÑæÌ ÈäÌÇÍ','../index.php?s='.time().'');
}
elseif($arbb->input['action']=='menu')
{
$webcontent='        <link href="default/controlpanel.css" type=text/css rel=stylesheet>
<br>
<div align="center">
áæÍÉ ÇáÊÍßã<br>N3san.net
<br>
<table class="table_border"  cellpadding="3" cellspacing="1" border="0" width="95%" align="center">
  <TR vAlign=top align="center" class=tcat>
    <TD><a href="index.php?action=pass" target="main">ÊÛííÑ ßáãÉ ÇáãÑæÑ</a></TD>
  </TR>

</TABLE>

<br>
<table class="table_border"  cellpadding="3" cellspacing="1" border="0" width="95%" align="center">
<tbody>
<tr>
<td class="thead" align="center">ÇáÊÍßã ÈÇáÇŞÓÇã</td>
</tr>
</tbody>
<tbody>
<tr>
<td class="td1"><a href="cat.php?action=add" target="main">ÇÖÇİÉ ŞÓã</a></td>
</tr><tr>
<td class="td1"><a href="cat.php?action=edit" target="main">ÊÚÏíá ŞÓã</a></td>
</tr><tr>
<td class="td1"><a href="cat.php?action=del" target="main">ÍĞİ ŞÓã</a></td>
</tr>
</tbody>
</table>
<br>
<table class="table_border"  cellpadding="3" cellspacing="1" border="0" width="95%" align="center">
<tbody>
<tr>
<td class="thead" align="center">ÇáÊÍßã ÈÇáãŞÇØÚ</td>
</tr>
</tbody>
<tbody>
<tr>
<td class="td1"><a href="maq.php?action=add" target="main">ÇÖÇİÉ ãŞØÚ</a></td>
</tr><tr>
<td class="td1"><a href="maq.php?action=edit" target="main">ÊÚÏíá ãŞØÚ</a></td>
</tr><tr>
<td class="td1"><a href="maq.php?action=del" target="main">ÍĞİ ãŞØÚ</a></td>
</tr>
</tbody>
</table>


</div>
<br><br>
<table class="table_border"  cellpadding="3" cellspacing="1" border="0" width="95%" align="center">
  <TR vAlign=top align="left" class=tcat>
    <TD class="smallfont" style="TEXT-ALIGN: center"><A href="../index.php" target=_blank>ÇáÑÆíÓíÉ</A> | <A href="index.php?action=logout" target=_top>ÊÓÌíá ÇáÎÑæÌ</A>
    </TD>
  </TR>

</TABLE>';

}
elseif($arbb->input['action']=='main')
{

$webcontent='        <link href="default/controlpanel.css" type=text/css rel=stylesheet>
<br>
<div align="center">
ãÑÍÈÇ Èß İí áæÍÉ ÇáÊÍßã<br><br>
<br>
<table class="table_border"  cellpadding="3" cellspacing="1" border="0" width="95%" align="center">
  <TR vAlign=top align="center" class=tcat>
    <TD><a href="index.php?action=pass" target="main">ÊÛííÑ ßáãÉ ÇáãÑæÑ</a></TD>
  </TR>

</TABLE>

<br>
<table class="table_border"  cellpadding="3" cellspacing="1" border="0" width="95%" align="center">
<tbody>
<tr>
<td class="thead" align="center">ÇåáÇ æÓåáÇ Èß İí áæÍÉ ÇáÊÍßã</td>
</tr>
</tbody>
<tbody>
<tr>
<td class="td1">áæÍÉ ÇáÊÍßã Êãßäß ãä ÇáÊÍßã ÈÇáÓßÑÈÊ .. ÍíË íãßäß ÇÖÇİÉ ãŞÇØÚ Çæ ÇŞÓÇã ááãŞÇØÚ æÇáÊÍßã ÈåÇ æÇáÊÚÏíá ÚáíåÇ ..</td>
</tr><tr>
</tbody>
</table>


</div>
<br><br>
<table class="table_border"  cellpadding="3" cellspacing="1" border="0" width="95%" align="center">
  <TR vAlign=top align="left" class=tcat>
    <TD class="smallfont" style="TEXT-ALIGN: center"><A href="../index.php" target=_blank>ÇáÑÆíÓíÉ</A> | <A href="index.php?action=logout" target=_top>ÊÓÌíá ÇáÎÑæÌ</A>
    </TD>
  </TR>

</TABLE>';

}
elseif($arbb->input['action']=='head')
{
$webcontent='<LINK href="default/controlpanel.css" type=text/css rel=stylesheet>

<TABLE height="100%" width="100%" border="0">
  <TR vAlign=top align="left">
    <TD class="smallfont"><B>áæÍÏ ÇáÊÍßã</B> N3san Tube</TD>
    <TD>
    </TD>
    <TD class="smallfont" style="TEXT-ALIGN: right"><A href="../index.php" target=_blank>ÇáÑÆíÓíÉ</A> | <A href="index.php?action=logout" target=_top>ÊÓÌíá ÇáÎÑæÌ</A>
    </TD>
  </TR>

</TABLE>';
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

if($arbb->input['action']=='login')
{
$usn=$arbb->input['username'];
$usp=md5($arbb->input['password']);
$query=$DB->query("select * from admin where name='$usn' and password='$usp'");
if($DB->num_rows($query)>0)
{
setcookie('cookie_username',$usn,time()+36000);
setcookie('cookie_password',$usp,time()+36000);

redirect('Êã ÊÓÌíá ÇáÏÎæá ÈäÌÇÍ','index.php?s='.time().'');
}
}
print_page();
?>
