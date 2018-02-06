<?php

function print_page()
{
GLOBAL $title,$webcontent;
Echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="rtl" lang="ar">
<head>
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="-1" />
<meta http-equiv="Cache-Control" content="no-cache" />
<meta http-equiv="Content-Type" content="text/html; charset=windows-1256" />

<LINK href="default/controlpanel.css" type=text/css rel=stylesheet>
        <title>'.$title.' - N3san.net - لوحة التحكم</title>
      <script type="text/javascript">
        function set_title()
        {
         parent.document.title = (document.title != \'\' ? document.title : \'N3san.net Control Panel\');
        }
        </script>
</head>
<body onload=\'set_title();\'>
'.$webcontent.'
</body>
</html>';
}

function error($error)
{
$webcontent='        <table  class="table_border" cellpadding="6" cellspacing="1" border="0" align="center" width="50%">
          <tr class="tcat">
            <td align="left" colspan="2"><b>خطأ</b></td>
          </tr>
          <tr class="td2">
            <td align="left" colspan="2"><b>'.$error.'</b></td>
          </tr>
          <tr class="thead">
            <td align="left" colspan="2">&nbsp;</td>
          </tr>
        </table>';
        GLOBAL $webcontent;
}

function redirect($error,$url)
{
        GLOBAL $webcontent;
$webcontent='
        <meta http-equiv="Refresh" content="2; URL='.$url.'">
        <table  class="table_border" cellpadding="6" cellspacing="1" border="0" align="center" width="50%">
          <tr class="tcat">
            <td align="left" colspan="2"><b>رسالة</b></td>
          </tr>
          <tr class="td2">
            <td align="left" colspan="2"><b>'.$error.'</b></td>
          </tr>
          <tr class="thead">
            <td align="left" colspan="2">&nbsp;</td>
          </tr>
        </table>';
        GLOBAL $webcontent;
}
?>
