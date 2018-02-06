<?php
/*======================================================================*\
|| #################################################################### ||
|| #                     Arbb 1.0.0 (beta 1)                          # ||
|| #       All Copyrights are saved Arabian bulletin board team       # ||
|| #                   Copyright © 2006 ArBB Team                     # ||
|| #           ArBB Is Free Bulletin Board and not for sale           # ||
|| #################################################################### ||
\*======================================================================*/
#// Database Functions Class Started

if(!defined('IN_ARBB'))
{
die("<title>ArBB</title>\nYou Cant Access This File !!\n<br>\nArBB");
}

Class arbb_dbclass{
//# Start Vars

            var $QueryFirst;
            Var $result;
            var $dbname;
            var $dblink;
            var $dbhost;
            var $dbusername;
            var $dbpassword;
            var $field;
            var $table;
            var $values;
            var $query_id;
            var $qn=0;
            var $returnarray;

//# End Vars


                 function query($querynow,$debug=true)
                 {

                 $this->qn++;

            //     Echo $this->qn." -> ".$querynow."<br>\n";
                         $this->QueryFirst=$querynow;

                         if(!$debug)
                         {
                          $query=mysql_query($this->QueryFirst,$this->dblink);
                         }
                         else
                         {
                          $query=mysql_query($this->QueryFirst,$this->dblink) or die($this->error($querynow));
                         }

                         return $query;
                 }

                 function free_result($query_id)
                 {
                         $this->query_id=$query_id;
                                 return @mysql_free_result($this->query_id);
                 }

                 function query_now($query_string)
                 {
                        $this->query_id = $this->query($query_string);
                        if(!$this->query_id)
                        {
                                return FALSE;
                        }
                        else
                        {
                        $this->returnarray = $this->fetch_array($this->query_id);
                        $this->free_result($query_id);
                        return $this->returnarray;
                        }

                 }

                 function fetch_array($result)
                 {
                         $this->result=$result;

                          return mysql_fetch_array($this->result);

                 }
                 function num_rows($result)
                 {
                         $this->result=$result;
                          return mysql_num_rows($this->result); // or die($this->error());
                 }
                 function insert_id()
                 {
                          return mysql_insert_id($this->dblink);
                 }

                 function selectdb($dbname)
                 {
                         $this->dbname=$dbname;
                          return mysql_select_db($this->dbname,$this->dblink);
                 }

                 function error($query){
                       $this->error = mysql_error();
                       $this->errno = mysql_errno();
                       $this->errordate = date('l dS of F Y h:i:s A');
                          Echo "<html dir=ltr>
                                                                                            <head>
                                                                                      <title>".IN_ARBB." : Databade Error</title>
                                                                              <style>p, body{ font-family:Windows UI,arial; font-size:12px; }</style>
                                                                            </head>
                                                                 <body>
                                                    <b>             &nbsp;There Is an error in the mysql query</b>
                                                                 <br>
                                                                  &nbsp;To refresh the page click <a href='javascript:window.location=window.location;'>here</a><br>
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;If you noticed the problem again please send a message to the web administrator&nbsp;
                                                    ..<br><BR><br>
<textarea ReadOnly rows='15' cols='60' name='Mysql_error' dir=ltr>
Error Num  : $this->errno
Error IS   : $this->error
Error Date : $this->errordate
Error Query: $query
</textarea>
                                                    <br>
                                                    <div align=center><h5>This website is using arabian bulletin board</h5>
                                                    ".IN_ARBB.'
                                                                 <body>';
                 }

                 function connect($dbhost,$dbusername,$dbpassword)
                 {
                        $this->dbhost=$dbhost;
                        $this->dbusername=$dbusername;
                        $this->dbpassword=$dbpassword;
                        $this->dblink = mysql_connect($this->dbhost,$this->dbusername,$this->dbpassword) or Die("ArBB Error .. Make sure you have configured arbb with currect information for your database");
                        return $this->dblink;
                 }

                 function close()
                 {
                 if($this->dblink)
                 {
                     return mysql_close($this->dblink) or die($this->error());
                           }
                           else
                           {
                              return mysql_close() or die($this->error());
                                   }
                 }

                 function affected_rows()
                 {
                     return mysql_affected_rows();
                 }

                 function multible_insert($array,$table)
                 {
                  $inserteed='(';$comma='`';$commma='';$values='(';

                        foreach($array as $insert => $value)
                        {
                           $inserteed.=$comma.$insert.'`';
                           $values.=$commma."'".$value."'";
                           $comma=', `';
                           $commma=',' ;
                        }
                  $inserteed.=')';$values.=')';

                   return $this->query('INSERT INTO '._PREFIX_."$table $inserteed values $values");

                 }

                 function insert($array,$table)
                 {
                  $inserteed='(';$comma='`';$commma='';$values='(';

                        foreach($array as $insert => $value)
                        {
                           $inserteed.=$comma.$insert.'`';
                           $values.=$commma."'".$value."'";
                           $comma=', `';
                           $commma=',' ;
                        }
                  $inserteed.=')';$values.=')';

                   return $this->query('INSERT INTO '._PREFIX_."$table $inserteed values $values");

                 }

                 function update($array,$table,$where)
                 {
                  $updates="";

                        foreach($array as $key => $value)
                        {
                           $updates.=$comma.''.$key."='$value'";
                           $comma=',';
                        }
                   return $this->query('UPDATE '._PREFIX_."$table set $updates where $where");

                 }

                 function escape_string($string)
                 {
                         if(function_exists('mysql_real_escape_string'))
                         {
                                 $string = mysql_real_escape_string($string);
                         }
                         else
                         {
                                 $string = addslashes($string);
                         }
                         return $string;
                 }

                 //# DB Class Functions Finished
                 }
#// All Done ... DB Functions Class Finished

?>