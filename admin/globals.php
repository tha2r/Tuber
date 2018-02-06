<?php

if(eregi('globals.php',$HTTP_SERVER_VARS['PHP_SELF']))
{
die('You Cant Access This File ');
}
chdir("../");
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
$DB = new arbb_dbclass;
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


  ini_set('zlib.output_compression_level',7);
  if(function_exists('ob_gzhandler') AND function_exists('ob_start'))
  {
      ob_start('ob_gzhandler');
  }

  ?>