<?php
if(eregi('globals.php',$HTTP_SERVER_VARS['PHP_SELF']))
{
die('You Cant Access This File ');
}

if((@ini_get('register_globals') || !@ini_get('gpc_order')) && (isset($_POST) || isset($_GET) || isset($_COOKIE)))
{
        foreach(array_keys($_POST+$_GET+$_COOKIE+$_SERVER+$_FILES) as $key)
        {
                if(($key != 'templatelist')&&($key != 'phrasearray'))
                {

                $$key='';
                unset($$key);
                $$key='';

                }
        }
}
if(isset($_POST['GLOBALS'])||isset($_GET['GLOBALS'])||isset($_FILES['GLOBALS'])||isset($_COOKIE['GLOBALS'])||isset($_REQUEST['GLOBALS'])||isset($_ENV['GLOBALS']))
{
    die('Hacking attempt !!<br>you cant make your own global variables :)');
}

Define('TIMENOW',time(),true);
Define('IN_ARBB',time(),true);
Define('_PREFIX_','',true);
//# now we include the class variable $arbb class file

require('./includes/class_main.php');

//# Now We Get our own inputs array

$arbb = new arbb_main;

$arbb->input = $_GET;

if(!is_array($arbb->input))
{

        $arbb->input = $_POST;
        }
        else
        {
                if(is_array($_POST))
                  {

                $arbb->input = array_merge($arbb->input,$_POST);

                               }
                }

                if(is_array($_COOKIE))
                {
                    if(is_array($arbb->input))
                    {
                        $arbb->input = array_merge($arbb->input,$_COOKIE);
                            }
                            else
                            {
                                $arbb->input = $_COOKIE;
                                    }

                        }



        //#
        //#         Checking if magic quotes are on
        //#  if not this code add slashes to the GPC keys
        //#

        foreach($arbb->input as $key => $val)
        {
           if(!get_magic_quotes_gpc())
           {
               $arbb->input[$key] = addslashes($val);
                   }
                   else
                   {
                      $arbb->input[$key] = $val;
                           }
                }


//#
//#      Getting The Config File ..
//#

require('./includes/config.php');

//#
//#            Defining Table Prefix And Cookie Prefix
//#

//#
//#     Get The DB Functions
//#

require('./includes/class_db.php');
require('./includes/class_templates.php');
require('./includes/functions.php');
$DB = new arbb_dbclass;
$TP = new arbb_templates;
//#
//#      Connect To DB
//#


$dbconnect = $DB->connect($db_host,$db_user,$db_pass);
if(!$dbconnect)
{
 Die('Make sure you have configured arbb with currect information for your database');
}
$dbselect  = $DB->selectdb($db_name,$dbconnect);
if(!$dbselect)
{
 Die('Make sure you have configured arbb with currect information for your database');
}

$templatelist.='page,redirection,error';

$TP->templatesused($templatelist);

  ini_set('zlib.output_compression_level',7);
  if(function_exists('ob_gzhandler') AND function_exists('ob_start'))
  {
      ob_start('ob_gzhandler');
  }


$rightmenu='<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="95%" align="center">
<tr>
<td class="thead">ÇáŞÇÆãÉ ÇáÑÆíÓíÉ</td>
</tr>
<tr>
<td class="alt1"><a href="index.html">ÇáÕİÍÉ ÇáÑÆíÓíÉ</a></td>
</tr>
<tr>
<td class="alt1"><a href="http://songs.n3san.net/">ÃÛÇäí äÚÓÇä</a></td>
</tr>
<tr>
<td class="alt1"><a href="http://vb.n3san.net/">ãäÊÏíÇÊ äÚÓÇä</a></td>
</tr>
<tr>
<td class="alt1"><a href="http://www.n3san.net/online/news.php">ÇáÇÎÈÇÑ æÇáãŞÇáÇÊ</a></td>
</tr>
<tr>
<td class="alt1"><a href="http://www.n3san.net/online/downloads.php">ÇáÈÑÇãÌ</a></td>
</tr>
<tr>
<td class="alt1"><a href="http://www.n3san.net/online/photogallery.php">ãÚÑÖ ÇáÕæÑ</a></td>
</tr>
<tr>
<td class="alt1"><a href="http://www.n3san.net/online/weblinks.php">Ïáíá ÇáãæÇŞÚ</a></td>
</tr>
<tr>
<td class="alt1"><a href="http://www.n3san.net/online/viewpage.php?page_id=4">ÇáÏÑÏÔÉ</a></td>
</tr>
<tr>
<td class="alt1"><a href="http://www.n3san.net/online/contact.php">ÑÇÓáäÇ</a></td>
</tr>
<tr>
<td class="tcat">ÃŞÓÇã ÇáÃİáÇã</td>
</tr>
';

$query=$DB->query("select * from cat order by id asc");

while($cat = $DB->fetch_array($query))
{
 $rightmenu.="<tr><td class=\"alt1\">- - <a href='cat-$cat[id].html'>$cat[title]</a></td></tr>";
}
 $rightmenu.="</table><br>";

 $rightmenu.='<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="95%" align="center">
<tr>
<td class="thead">ãŞØÚ ÚÔæÇÆí</td>
</tr>

';

$query=$DB->query("select * from movies order by rand() limit 0,1");

while($m = $DB->fetch_array($query))
{
 $rightmenu.="<tr>
<td class=\"tcat\">$m[title]</td>
</tr>
<tr><td class=\"alt1\" align=center><a href='view-$m[id].html'><img alt=\"$cat[title]\" src=\"videos/images/$m[pic]\"></a></td></tr>";
}
 $rightmenu.="</table>";


  $rightmenu.='<br><br><table class="tborder" cellpadding="6" cellspacing="1" border="0" width="95%" align="center">
<tr>
<td class="thead">ÃßËÑ ãŞØÚ Êã ÒíÇÑÊå</td>
</tr>

';

$query=$DB->query("select * from movies order by views desc limit 0,1");

while($m = $DB->fetch_array($query))
{
 $rightmenu.="<tr>
<td class=\"tcat\">$m[title]</td>
</tr>
<tr><td class=\"alt1\" align=center><a href='view-$m[id].html'><img alt=\"$cat[title]\" src=\"videos/images/$m[pic]\"></a></td></tr>";
}
 $rightmenu.="</table>";


//# Globals File EnD
?>