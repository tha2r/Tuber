<?php

              function print_page($content='')
              {
                       GLOBAL $options,$TP,$lang,$DB,$local,$nav,$template;
                       GLOBAL $navbar,$footer,$headinclude,$header;
                       GLOBAL $stylevar,$st,$CP,$titleetc,$webcontent;

                            print(''.$TP->GetTemp('page').'');
              }

              function checkval($variable)
              {
                      $val=intval(trim($variable));
                      return $val;
              }

              function checkvar($variable)
              {
                       return htmlspecialchars($variable);
              }


              function redirect($message,$link)
              {
                GLOBAL $TP,$lang,$CP,$stylevar,$options;
                GLOBAL $headinclude,$DB;

                  $GLOBALS['redirect_message'] = $message;
                  $GLOBALS['url']              = $link;

                      Echo $TP->GetTemp("redirection");
                      exit;
              }

              function error($error)
              {
                GLOBAL $TP,$local,$lang,$stylevar,$errormessage,$arbb,$DB;
                $TP->WebTemp('error');
                   print_page();
                   exit;
              }
?>
