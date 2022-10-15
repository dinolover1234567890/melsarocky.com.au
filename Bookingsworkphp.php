<?php
if (session_id() == "")
{
   session_start();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['formid'] == 'form1')
{
   if (isset($_POST['captcha_code'],$_SESSION['random_txt']) && md5($_POST['captcha_code']) == $_SESSION['random_txt'])
   {
      unset($_POST['captcha_code'],$_SESSION['random_txt']);
   }
   else
   {
      echo '<b>The entered code was wrong.</b><br>';
      echo '<a href="javascript:history.back()">Go Back</a>';
      exit;
   }
}
?>
<?php
function ValidateEmail($email)
{
   $pattern = '/^([0-9a-z]([-.\w]*[0-9a-z])*@(([0-9a-z])+([-\w]*[0-9a-z])*\.)+[a-z]{2,6})$/i';
   return preg_match($pattern, $email);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['formid']) && $_POST['formid'] == 'form1')
{
   $mailto = 'stoker.08@hotmail.com';
   $mailfrom = isset($_POST['email']) ? $_POST['email'] : $mailto;
   $mailbcc = 'webadmin@melsarocky.com.au';
   $subject = 'MELSA Rockhampton Booking/Event Request';
   $message = 'MELSA Rockhampton Booking/Event Request Form:';
   $success_url = './BookingPlaced.html';
   $error_url = '';
   $error = '';
   $eol = "\n";
   $boundary = md5(uniqid(time()));

   $header  = 'From: '.$mailfrom.$eol;
   $header .= 'Reply-To: '.$mailfrom.$eol;
   $header .= 'Bcc: '.$mailbcc.$eol;
   $header .= 'MIME-Version: 1.0'.$eol;
   $header .= 'Content-Type: multipart/mixed; boundary="'.$boundary.'"'.$eol;
   $header .= 'X-Mailer: PHP v'.phpversion().$eol;
   if (!ValidateEmail($mailfrom))
   {
      $error .= "The specified email address is invalid!\n<br>";
   }

   if (!empty($error))
   {
      $errorcode = file_get_contents($error_url);
      $replace = "##error##";
      $errorcode = str_replace($replace, $error, $errorcode);
      echo $errorcode;
      exit;
   }

   $internalfields = array ("submit", "reset", "send", "filesize", "formid", "captcha_code", "recaptcha_challenge_field", "recaptcha_response_field", "g-recaptcha-response");
   $message .= $eol;
   $logdata = '';
   foreach ($_POST as $key => $value)
   {
      if (!in_array(strtolower($key), $internalfields))
      {
         if (!is_array($value))
         {
            $message .= ucwords(str_replace("_", " ", $key)) . " : " . $value . $eol;
         }
         else
         {
            $message .= ucwords(str_replace("_", " ", $key)) . " : " . implode(",", $value) . $eol;
         }
      }
   }
   $body  = 'This is a multi-part message in MIME format.'.$eol.$eol;
   $body .= '--'.$boundary.$eol;
   $body .= 'Content-Type: text/plain; charset=ISO-8859-1'.$eol;
   $body .= 'Content-Transfer-Encoding: 8bit'.$eol;
   $body .= $eol.stripslashes($message).$eol;
   if (!empty($_FILES))
   {
       foreach ($_FILES as $key => $value)
       {
          if ($_FILES[$key]['error'] == 0)
          {
             $body .= '--'.$boundary.$eol;
             $body .= 'Content-Type: '.$_FILES[$key]['type'].'; name='.$_FILES[$key]['name'].$eol;
             $body .= 'Content-Transfer-Encoding: base64'.$eol;
             $body .= 'Content-Disposition: attachment; filename='.$_FILES[$key]['name'].$eol;
             $body .= $eol.chunk_split(base64_encode(file_get_contents($_FILES[$key]['tmp_name']))).$eol;
          }
      }
   }
   $body .= '--'.$boundary.'--'.$eol;
   if ($mailto != '')
   {
      mail($mailto, $subject, $body, $header);
   }
   header('Location: '.$success_url);
   exit;
}
?>
<!doctype html>
<html>
<head>
<title>MELSA Rockhampton INC</title>
<meta name="generator" content="WYSIWYG Web Builder 9 - http://www.wysiwygwebbuilder.com">
<style>
div#container
{
   width: 994px;
   position: relative;
   margin: 0 auto 0 auto;
   text-align: left;
}
body
{
   background-color: #2D2D2D;
   background-image: url(images/Bookings_bkgrnd.png);
   background-repeat: repeat-x;
   color: #FFFFFF;
   font-family: Arial;
   font-weight: normal;
   font-size: 16px;
   line-height: 1.1875;
   margin: 0;
   text-align: center;
}
a
{
   color: #FFFFFF;
   text-decoration: none;
}
a:hover
{
   color: #FFFF00;
   text-decoration: none;
}
#Image1
{
   border: 0px #000000 solid;
   padding: 0px 0px 0px 0px;
   left: 0;
   top: 0;
   width: 100%;
   height: 100%;
}
#Shape1
{
   width: 1024px;
   height: 454px;
   background-color: #525051;
   background-image: none;
   border: 0px #A0A0A0 solid;
}
#wb_Text12 
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: right;
}
#wb_Text12 div
{
   text-align: right;
}
#Shape7
{
   border-width: 0;
}
#wb_Text13 
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_Text13 div
{
   text-align: left;
}
#Shape5
{
   border-width: 0;
}
#Image3
{
   border: 0px #000000 solid;
   padding: 0px 0px 0px 0px;
   left: 0;
   top: 0;
   width: 100%;
   height: 100%;
}
#wb_Text1 
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_Text1 div
{
   text-align: left;
}
#Layer1
{
   background-color: transparent;
   background-image: none;
}
#wb_CssMenu1
{
   border: 0px #DCDCDC solid;
   background-color: transparent;
}
#wb_CssMenu1 ul
{
   list-style-type: none;
   margin: 0;
   padding: 0;
   position: relative;
   display: inline-block;
}
#wb_CssMenu1 li
{
   float: left;
   margin: 0;
   padding: 0px 1px 0px 0px;
   width: 140px;
}
#wb_CssMenu1 a
{
   display: block;
   float: left;
   color: #FFFFFF;
   border: 0px #272727 none;
   background-color: #A9A9A9;
   background-color: rgba(169,169,169,0.59);
   background: -moz-linear-gradient(top,rgba(243,243,243,0.59) 0%,rgba(209,209,209,0.59) 10%,rgba(170,170,170,0.59) 50%,rgba(102,102,102,0.59) 50%,rgba(202,202,202,0.59) 100%);
   background: -webkit-linear-gradient(top,rgba(243,243,243,0.59) 0%,rgba(209,209,209,0.59) 10%,rgba(170,170,170,0.59) 50%,rgba(102,102,102,0.59) 50%,rgba(202,202,202,0.59) 100%);
   background: -o-linear-gradient(top,rgba(243,243,243,0.59) 0%,rgba(209,209,209,0.59) 10%,rgba(170,170,170,0.59) 50%,rgba(102,102,102,0.59) 50%,rgba(202,202,202,0.59) 100%);
   background: -ms-linear-gradient(top,rgba(243,243,243,0.59) 0%,rgba(209,209,209,0.59) 10%,rgba(170,170,170,0.59) 50%,rgba(102,102,102,0.59) 50%,rgba(202,202,202,0.59) 100%);
   background: linear-gradient(top,rgba(243,243,243,0.59) 0%,rgba(209,209,209,0.59) 10%,rgba(170,170,170,0.59) 50%,rgba(102,102,102,0.59) 50%,rgba(202,202,202,0.59) 100%);
   font-family: Arial;
   font-weight: bold;
   font-size: 16px;
   font-style: normal;
   text-decoration: none;
   width: 130px;
   height: 25px;
   padding: 0px 5px 0px 5px;
   vertical-align: middle;
   line-height: 25px;
   text-align: center;
}
#wb_CssMenu1 li:hover a, #wb_CssMenu1 a:hover, #wb_CssMenu1 .active
{
   color: #FFFF00;
   background-color: #006400;
   background: -moz-linear-gradient(top,#DEEADE 0%,#78AC78 10%,#056705 50%,#003C00 50%,#64A064 100%);
   background: -webkit-linear-gradient(top,#DEEADE 0%,#78AC78 10%,#056705 50%,#003C00 50%,#64A064 100%);
   background: -o-linear-gradient(top,#DEEADE 0%,#78AC78 10%,#056705 50%,#003C00 50%,#64A064 100%);
   background: -ms-linear-gradient(top,#DEEADE 0%,#78AC78 10%,#056705 50%,#003C00 50%,#64A064 100%);
   background: linear-gradient(top,#DEEADE 0%,#78AC78 10%,#056705 50%,#003C00 50%,#64A064 100%);
   border: 0px #74021B none;
}
#wb_CssMenu1 li.firstmain
{
   padding-left: 0px;
}
#wb_CssMenu1 li.lastmain
{
   padding-right: 0px;
}
#wb_CssMenu1 li:hover, #wb_CssMenu1 li a:hover
{
   position: relative;
}
#wb_CssMenu1 a.withsubmenu
{
   padding: 0 5px 0 5px;
   width: 130px;
}
#wb_CssMenu1 li:hover a.withsubmenu, #wb_CssMenu1 a.withsubmenu:hover
{
}
#wb_CssMenu1 ul ul
{
   position: absolute;
   left: 0;
   top: 0;
   visibility: hidden;
   width: 140px;
   height: auto;
   border: none;
   background-color: transparent;
}
#wb_CssMenu1 ul :hover ul
{
   left: 0px;
   top: 25px;
   padding-top: 0px;
   visibility: visible;
}
#wb_CssMenu1 .firstmain:hover ul
{
   left: 0px;
}
#wb_CssMenu1 li li
{
   width: 140px;
   padding: 0 0px 0px 0px;
   border: 0px #C0C0C0 solid;
   border-width: 0 0px;
}
#wb_CssMenu1 li li.firstitem
{
   border-top: 0px #C0C0C0 solid;
}
#wb_CssMenu1 li li.lastitem
{
   border-bottom: 0px #C0C0C0 solid;
}
#wb_CssMenu1 ul ul a, #wb_CssMenu1 ul :hover ul a
{
   float: none;
   margin: 0;
   width: 126px;
   height: auto;
   white-space: normal;
   padding: 6px 6px 6px 6px;
   background-color: #808080;
   background: -moz-linear-gradient(top,#EEEEEE 0%,#BBBBBB 10%,#828282 50%,#4D4D4D 50%,#B1B1B1 100%);
   background: -webkit-linear-gradient(top,#EEEEEE 0%,#BBBBBB 10%,#828282 50%,#4D4D4D 50%,#B1B1B1 100%);
   background: -o-linear-gradient(top,#EEEEEE 0%,#BBBBBB 10%,#828282 50%,#4D4D4D 50%,#B1B1B1 100%);
   background: -ms-linear-gradient(top,#EEEEEE 0%,#BBBBBB 10%,#828282 50%,#4D4D4D 50%,#B1B1B1 100%);
   background: linear-gradient(top,#EEEEEE 0%,#BBBBBB 10%,#828282 50%,#4D4D4D 50%,#B1B1B1 100%);
   border: 1px #C0C0C0 solid;
   color: #FFFFFF;
   font-family: Arial;
   font-weight: normal;
   font-size: 11px;
   font-style: normal;
   line-height: 11px;
   text-align: left;
   text-decoration: none;
}
#wb_CssMenu1 ul :hover ul .firstitem a
{
   margin-top: 0px;
}
#wb_CssMenu1 ul ul :hover a, #wb_CssMenu1 ul ul a:hover, #wb_CssMenu1 ul ul :hover ul :hover a, #wb_CssMenu1 ul ul :hover ul a:hover
{
   background-color: #006400;
   background: -moz-linear-gradient(top,#DEEADE 0%,#78AC78 10%,#056705 50%,#003C00 50%,#64A064 100%);
   background: -webkit-linear-gradient(top,#DEEADE 0%,#78AC78 10%,#056705 50%,#003C00 50%,#64A064 100%);
   background: -o-linear-gradient(top,#DEEADE 0%,#78AC78 10%,#056705 50%,#003C00 50%,#64A064 100%);
   background: -ms-linear-gradient(top,#DEEADE 0%,#78AC78 10%,#056705 50%,#003C00 50%,#64A064 100%);
   background: linear-gradient(top,#DEEADE 0%,#78AC78 10%,#056705 50%,#003C00 50%,#64A064 100%);
   border: 1px #C0C0C0 solid;
   color: #FFFF00;
}
#wb_CssMenu1 br
{
   clear: both;
   font-size: 1px;
   height: 0;
   line-height: 0;
}
#wb_Text2 
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_Text2 div
{
   text-align: left;
}
#wb_Text3 
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: center;
}
#wb_Text3 div
{
   text-align: center;
}
#wb_Form1
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
}
#Button1
{
   border: 1px #A9A9A9 solid;
   background-color: #006400;
   background-image: none;
   color: #FFFFFF;
   font-family: Arial;
   font-weight: normal;
   font-size: 16px;
}
#TextArea1
{
   border: 1px #A9A9A9 solid;
   background-color: #FFFFFF;
   background-image: none;
   color :#000000;
   font-family: Arial;
   font-weight: normal;
   font-size: 16px;
   text-align: left;
   overflow: auto;
   resize: none;
}
#TextArea1:focus
{
   border-color: #66AFE9;
   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   outline: 0;
}
#wb_Text4 
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_Text4 div
{
   text-align: left;
}
#wb_Text5 
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_Text5 div
{
   text-align: left;
}
#TextArea2
{
   border: 1px #A9A9A9 solid;
   background-color: #FFFFFF;
   background-image: none;
   color :#000000;
   font-family: Arial;
   font-weight: normal;
   font-size: 16px;
   text-align: left;
   overflow: auto;
   resize: none;
}
#TextArea2:focus
{
   border-color: #66AFE9;
   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   outline: 0;
}
#wb_Text6 
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_Text6 div
{
   text-align: left;
}
#TextArea3
{
   border: 1px #A9A9A9 solid;
   background-color: #FFFFFF;
   background-image: none;
   color :#000000;
   font-family: Arial;
   font-weight: normal;
   font-size: 16px;
   text-align: left;
   overflow: auto;
   resize: none;
}
#TextArea3:focus
{
   border-color: #66AFE9;
   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   outline: 0;
}
#wb_Text7 
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_Text7 div
{
   text-align: left;
}
#wb_Text8 
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_Text8 div
{
   text-align: left;
}
#wb_Text9 
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_Text9 div
{
   text-align: left;
}
#wb_Text10 
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_Text10 div
{
   text-align: left;
}
#wb_Text11 
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_Text11 div
{
   text-align: left;
}
#TextArea4
{
   border: 1px #A9A9A9 solid;
   background-color: #FFFFFF;
   background-image: none;
   color :#000000;
   font-family: Arial;
   font-weight: normal;
   font-size: 16px;
   text-align: left;
   overflow: auto;
   resize: none;
}
#TextArea4:focus
{
   border-color: #66AFE9;
   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   outline: 0;
}
#wb_Text14 
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_Text14 div
{
   text-align: left;
}
#TextArea5
{
   border: 1px #A9A9A9 solid;
   background-color: #FFFFFF;
   background-image: none;
   color :#000000;
   font-family: Arial;
   font-weight: normal;
   font-size: 16px;
   text-align: left;
   overflow: auto;
   resize: none;
}
#TextArea5:focus
{
   border-color: #66AFE9;
   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   outline: 0;
}
#wb_Text15 
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_Text15 div
{
   text-align: left;
}
#TextArea6
{
   border: 1px #A9A9A9 solid;
   background-color: #FFFFFF;
   background-image: none;
   color :#000000;
   font-family: Arial;
   font-weight: normal;
   font-size: 16px;
   text-align: right;
   overflow: auto;
   resize: none;
}
#TextArea6:focus
{
   border-color: #66AFE9;
   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   outline: 0;
}
#wb_Captcha1 span
{
   display: block;
   overflow: hidden;
   padding: 0 4px 0 5px;
}
#Captcha1
{
   border: 1px #CCCCCC solid;
   border-radius: 4px;
   background-color: #FFFFFF;
   background-image: none;
   color :#000000;
   font-family: Arial;
   font-weight: normal;
   font-size: 16px;
   padding: 1px 1px 1px 1px;
   text-align: left;
   vertical-align: middle;
}
#wb_Text16 
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_Text16 div
{
   text-align: left;
}
</style>
<script>
function ValidateForm1(theForm)
{
   var regexp;
   regexp = /^[A-Za-z¿¡¬√ƒ≈∆«»… ÀÃÕŒœ–—“”‘’÷ÿŸ⁄€‹›ﬁﬂ‡·‚„‰ÂÊÁËÈÍÎÏÌÓÔÒÚÛÙıˆ¯˘˙˚¸˝˛ˇ]*$/;
   if (!regexp.test(theForm.TextArea1.value))
   {
      alert("Please enter only letter characters in the \"Name\" field.");
      theForm.TextArea1.focus();
      return false;
   }
   if (theForm.TextArea1.value == "")
   {
      alert("Please enter a value for the \"Name\" field.");
      theForm.TextArea1.focus();
      return false;
   }
   if (theForm.TextArea1.value.length < 3)
   {
      alert("Please enter at least 3 characters in the \"Name\" field.");
      theForm.TextArea1.focus();
      return false;
   }
   if (theForm.TextArea1.value.length > 30)
   {
      alert("Please enter at most 30 characters in the \"Name\" field.");
      theForm.TextArea1.focus();
      return false;
   }
   regexp = /^[-+]?\d*\.?\d*$/;
   if (!regexp.test(theForm.TextArea2.value))
   {
      alert("Please enter only digit characters in the \"Phone\" field.");
      theForm.TextArea2.focus();
      return false;
   }
   if (theForm.TextArea2.value == "")
   {
      alert("Please enter a value for the \"Phone\" field.");
      theForm.TextArea2.focus();
      return false;
   }
   if (theForm.TextArea2.value.length < 8)
   {
      alert("Please enter at least 8 characters in the \"Phone\" field.");
      theForm.TextArea2.focus();
      return false;
   }
   if (theForm.TextArea2.value.length > 12)
   {
      alert("Please enter at most 12 characters in the \"Phone\" field.");
      theForm.TextArea2.focus();
      return false;
   }
   if (theForm.TextArea2.value != "" && !(theForm.TextArea2.value > ))
   {
      alert("Please enter a value greater than \"\" in the \"Phone\" field.");
      theForm.TextArea2.focus();
      return false;
   }
   regexp = /^([0-9a-z]([-.\w]*[0-9a-z])*@(([0-9a-z])+([-\w]*[0-9a-z])*\.)+[a-z]{2,6})$/i;
   if (!regexp.test(theForm.TextArea3.value))
   {
      alert("Please enter a valid email address.");
      theForm.TextArea3.focus();
      return false;
   }
   if (theForm.TextArea3.value == "")
   {
      alert("Please enter a value for the \"Email\" field.");
      theForm.TextArea3.focus();
      return false;
   }
   if (theForm.TextArea3.value.length < 3)
   {
      alert("Please enter at least 3 characters in the \"Email\" field.");
      theForm.TextArea3.focus();
      return false;
   }
   if (theForm.TextArea3.value.length > 50)
   {
      alert("Please enter at most 50 characters in the \"Email\" field.");
      theForm.TextArea3.focus();
      return false;
   }
   var Event Type_selected = false;
   for (i = 0; i < theForm.Event Type.length; i++)
   {
      if (theForm.Event Type[i].checked)
         Event Type_selected = true;
   }
   if (!Event Type_selected)
   {
      alert("");
      return false;
   }
   regexp = /(0[1-9]|[12][0-9]|3[01])[- \/.](0[1-9]|1[012])[- \/.](19|20)[0-9]{2}/;
   if (!regexp.test(theForm.TextArea4.value))
   {
      alert("The specified value is invalid.");
      theForm.TextArea4.focus();
      return false;
   }
   if (theForm.TextArea4.value == "")
   {
      alert("Please enter a value for the \"Event Date\" field.");
      theForm.TextArea4.focus();
      return false;
   }
   if (theForm.TextArea4.value.length < 10)
   {
      alert("Please enter at least 10 characters in the \"Event Date\" field.");
      theForm.TextArea4.focus();
      return false;
   }
   if (theForm.TextArea4.value.length > 10)
   {
      alert("Please enter at most 10 characters in the \"Event Date\" field.");
      theForm.TextArea4.focus();
      return false;
   }
   regexp = /^[-+]?\d*\.?\d*$/;
   if (!regexp.test(theForm.TextArea5.value))
   {
      alert("Please enter only digit characters in the \"Number Of Passengers\" field.");
      theForm.TextArea5.focus();
      return false;
   }
   if (theForm.TextArea5.value == "")
   {
      alert("Please enter a value for the \"Number Of Passengers\" field.");
      theForm.TextArea5.focus();
      return false;
   }
   if (theForm.TextArea5.value.length < 1)
   {
      alert("Please enter at least 1 characters in the \"Number Of Passengers\" field.");
      theForm.TextArea5.focus();
      return false;
   }
   if (theForm.TextArea5.value.length > 10)
   {
      alert("Please enter at most 10 characters in the \"Number Of Passengers\" field.");
      theForm.TextArea5.focus();
      return false;
   }
   regexp = /^[A-Za-z¿¡¬√ƒ≈∆«»… ÀÃÕŒœ–—“”‘’÷ÿŸ⁄€‹›ﬁﬂ‡·‚„‰ÂÊÁËÈÍÎÏÌÓÔÒÚÛÙıˆ¯˘˙˚¸˝˛ˇ]*$/;
   if (!regexp.test(theForm.TextArea6.value))
   {
      alert("Please enter only letter characters in the \"Preferred Time:\" field.");
      theForm.TextArea6.focus();
      return false;
   }
   if (theForm.TextArea6.value == "")
   {
      alert("Please enter a value for the \"Preferred Time:\" field.");
      theForm.TextArea6.focus();
      return false;
   }
   if (theForm.TextArea6.value.length < 3)
   {
      alert("Please enter at least 3 characters in the \"Preferred Time:\" field.");
      theForm.TextArea6.focus();
      return false;
   }
   if (theForm.TextArea6.value.length > 15)
   {
      alert("Please enter at most 15 characters in the \"Preferred Time:\" field.");
      theForm.TextArea6.focus();
      return false;
   }
   if (theForm.TextArea6.value != "" && !(theForm.TextArea6.value > ))
   {
      alert("Please enter a value greater than \"\" in the \"Preferred Time:\" field.");
      theForm.TextArea6.focus();
      return false;
   }
   return true;
}
</script>
</head>
<body>
<div id="container">
<div id="wb_Image1" style="position:absolute;left:0px;top:0px;width:1024px;height:200px;z-index:49;">
<img src="images/RailwayBanner.jpg" id="Image1" alt=""></div>
<div id="wb_Shape1" style="position:absolute;left:0px;top:162px;width:1024px;height:454px;z-index:50;">
<div id="Shape1"></div></div>
<div id="wb_Text12" style="position:absolute;left:466px;top:625px;width:535px;height:14px;text-align:right;z-index:51;">
<span style="color:#FFFFFF;font-family:Arial;font-size:11px;"> | PO Box 3114 Red Hill NORTH ROCKHAMPTON&nbsp; QLD&nbsp; 4701 | Tel:&nbsp; 07 4933 3078</span></div>
<div id="wb_Shape7" style="position:absolute;left:9px;top:8px;width:399px;height:111px;z-index:52;">
<img src="images/img0026.png" id="Shape7" alt="" style="width:399px;height:111px;"></div>
<div id="wb_Text13" style="position:absolute;left:120px;top:27px;width:454px;height:88px;z-index:53;">
<span style="color:#FFFFFF;font-family:'Trebuchet MS';font-size:19px;"><strong>MODEL ENGINEERS &amp; <br>LIVE STEAMERS ASSOCIATION<br>ROCKHAMPTON INC</strong></span><span style="color:#FFFFFF;font-family:'Trebuchet MS';font-size:24px;"><strong> <br></strong></span></div>
<div id="wb_Shape5" style="position:absolute;left:0px;top:615px;width:1024px;height:4px;z-index:54;">
<img src="images/img0027.gif" id="Shape5" alt="" style="width:1024px;height:4px;"></div>
<div id="wb_Image3" style="position:absolute;left:10px;top:12px;width:104px;height:104px;z-index:55;">
<img src="images/LOGOSMALL.gif" id="Image3" alt=""></div>
<img src="images/img0028.jpg" id="Banner1" alt="Bookings" style="border-width:0;position:absolute;left:5px;top:168px;width:1014px;height:50px;z-index:56;">
<div id="wb_Text1" style="position:absolute;left:6px;top:222px;width:995px;height:2px;z-index:57;">
&nbsp;</div>
<div id="Layer1" style="position:absolute;overflow:auto;text-align:left;left:6px;top:219px;width:1015px;height:390px;z-index:58;">
<div id="wb_Text2" style="position:absolute;left:19px;top:16px;width:617px;height:234px;z-index:22;">
<span style="color:#FFFFFF;font-family:Arial;font-size:16px;">Melsa Rockhampton currently has a number of up coming events listed on it's Calendar. However we are always more then happy to help out for your next birthday or children function, simply check your required date is avaliable and place your requested using the web form below. Once your booking is received one of our club members will contact you to confirm the booking and offer further details. <br><br>The cost for booking of the club is:<br><br>Up to 2 Hours&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; Other Hours<br>$170&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; P.O.A<br><br>This cost covers unlimited rides on the trains and access to the parks toilet block for the duration of the booking / event.</span></div>
<!-- google calendar -->
<div id="Html1" style="position:absolute;left:639px;top:16px;width:353px;height:237px;z-index:23">
<iframe src="http://www.google.com/calendar/embed?showTitle=0&amp;showNav=0&amp;showTabs=0&amp;showCalendars=0&amp;showTz=0&amp;mode=AGENDA&amp;height=240&amp;wkst=2&amp;bgcolor=%23FFFFFF&amp;src=melsarocky@gmail.com&amp;color=%23060D5E&amp;ctz=Australia%2FBrisbane" style=" border-width:0 " width="350" height="240" frameborder="0" scrolling="no"></iframe></div>
<div id="wb_Text3" style="position:absolute;left:762px;top:257px;width:97px;height:14px;text-align:center;z-index:24;">
<span style="color:#FFFFFF;font-family:Arial;font-size:11px;">Current Bookings:</span></div>
<img src="images/img0072.jpg" id="Banner2" alt="Request A Booking" style="border-width:0;position:absolute;left:16px;top:273px;width:978px;height:50px;z-index:25;">
<div id="wb_Form1" style="position:absolute;left:16px;top:323px;width:838px;height:250px;z-index:26;">
<form name="Form1" method="post" action="<?php echo basename(__FILE__); ?>" enctype="multipart/form-data" id="Form1" onsubmit="return ValidateForm1(this)">
<input type="hidden" name="formid" value="form1">
<textarea name="Name" id="TextArea1" style="position:absolute;left:180px;top:4px;width:163px;height:18px;z-index:0;" rows="1" cols="20" maxlength="30" spellcheck="false" title="Contact Name:"></textarea>
<div id="wb_Text4" style="position:absolute;left:16px;top:4px;width:54px;height:18px;z-index:1;">
<span style="color:#FFFFFF;font-family:Arial;font-size:16px;">Name:</span></div>
<div id="wb_Text5" style="position:absolute;left:365px;top:4px;width:54px;height:18px;z-index:2;">
<span style="color:#FFFFFF;font-family:Arial;font-size:16px;">Phone:</span></div>
<textarea name="Phone" id="TextArea2" style="position:absolute;left:444px;top:4px;width:163px;height:18px;z-index:3;" rows="1" cols="20" maxlength="30" spellcheck="false" title="Contact Nmber:"></textarea>
<div id="wb_Text6" style="position:absolute;left:16px;top:35px;width:54px;height:18px;z-index:4;">
<span style="color:#FFFFFF;font-family:Arial;font-size:16px;">Email:</span></div>
<textarea name="Email" id="TextArea3" style="position:absolute;left:180px;top:35px;width:163px;height:18px;z-index:5;" rows="1" cols="20" maxlength="50" spellcheck="false" title="Email Address:"></textarea>
<div id="wb_Text7" style="position:absolute;left:16px;top:62px;width:87px;height:18px;z-index:6;">
<span style="color:#FFFFFF;font-family:Arial;font-size:16px;">Event Type:</span></div>
<input type="radio" id="RadioButton1" name="Event Type" value="Birthday Booking" checked style="position:absolute;left:180px;top:62px;z-index:7;" title="Birthday Booking">
<input type="radio" id="RadioButton2" name="Event Type" value="Playgroup Booking" style="position:absolute;left:180px;top:87px;z-index:8;" title="Playgroup Booking">
<input type="radio" id="RadioButton3" name="Event Type" value="Private Function" style="position:absolute;left:365px;top:62px;z-index:9;" title="Private Function">
<div id="wb_Text8" style="position:absolute;left:205px;top:62px;width:128px;height:18px;z-index:10;">
<span style="color:#FFFFFF;font-family:Arial;font-size:16px;">Birthday Party:</span></div>
<div id="wb_Text9" style="position:absolute;left:205px;top:87px;width:144px;height:18px;z-index:11;">
<span style="color:#FFFFFF;font-family:Arial;font-size:16px;">Playgroup Booking:</span></div>
<div id="wb_Text10" style="position:absolute;left:390px;top:62px;width:144px;height:18px;z-index:12;">
<span style="color:#FFFFFF;font-family:Arial;font-size:16px;">Private Function:</span></div>
<div id="wb_Text11" style="position:absolute;left:16px;top:122px;width:87px;height:18px;z-index:13;">
<span style="color:#FFFFFF;font-family:Arial;font-size:16px;">Event Date:</span></div>
<textarea name="Event Date" id="TextArea4" style="position:absolute;left:180px;top:122px;width:163px;height:18px;z-index:14;" rows="1" cols="20" maxlength="10" spellcheck="false" title="Event Date:">dd/mm/yy</textarea>
<div id="wb_Text14" style="position:absolute;left:16px;top:147px;width:168px;height:34px;z-index:15;">
<span style="color:#FFFFFF;font-family:Arial;font-size:16px;">Number Of Passenger:<br></span><span style="color:#FFFFFF;font-family:Arial;font-size:13px;">(Guest who wish to trains)</span></div>
<textarea name="Number Of Passengers" id="TextArea5" style="position:absolute;left:180px;top:152px;width:163px;height:18px;z-index:16;" rows="1" cols="20" maxlength="10" spellcheck="false" title="Number Of Passengers">25</textarea>
<div id="wb_Text15" style="position:absolute;left:365px;top:122px;width:121px;height:18px;z-index:17;">
<span style="color:#FFFFFF;font-family:Arial;font-size:16px;">Preferred Time:</span></div>
<textarea name="Preferred Time:" id="TextArea6" style="position:absolute;left:498px;top:122px;width:108px;height:18px;z-index:18;" rows="1" cols="13" maxlength="30" spellcheck="false" title="Preferred Time:"></textarea>
<input type="submit" id="Button1" name="Submit" value="Submit" style="position:absolute;left:513px;top:225px;width:96px;height:25px;z-index:19;">
<div id="wb_Captcha1" style="position:absolute;left:367px;top:140px;width:240px;height:34px;z-index:20;">
<img src="captcha1.php" alt="Click for new image" title="Click for new image" style="cursor:pointer;float:left;width:100px;height:38px;" onclick="this.src='captcha1.php?'+Math.random()">
<span><input type="text" id="Captcha1" style="margin-top:18px;width:100%;height:18px;line-height:18px;" name="captcha_code" value="" spellcheck="false"></span></div>
<div id="wb_Text16" style="position:absolute;left:364px;top:184px;width:245px;height:36px;z-index:21;">
<span style="color:#FFFFFF;font-family:Arial;font-size:16px;">Please enter characters without spaces and correct case</span></div>
</form>
</div>
</div>
<div id="wb_CssMenu1" style="position:absolute;left:13px;top:131px;width:996px;height:34px;text-align:center;z-index:59;">
<ul>
<li class="firstmain"><a href="./index.html" target="_self" title="HOME">HOME</a>
</li>
<li><a class="withsubmenu" href="#" target="_self" title="INFORMATION">INFORMATION</a>

<ul>
<li class="firstitem"><a href="./Club_History.html" target="_self" title="Club History">Club&nbsp;History</a>
</li>
<li><a href="./Track_Layout.html" target="_self" title="Track Layout">Track&nbsp;Layout</a>
</li>
<li><a href="./Public_Run_Day.html" target="_self" title="Public Run Day">Public&nbsp;Run&nbsp;Day</a>
</li>
<li><a href="./Queens_bday_inv.html" target="_self" title="Queens Birthday">Queens&nbsp;Birthday</a>
</li>
<li><a href="./Grants.html" target="_self" title="Grants &amp; Sponsorship">Grants&nbsp;&amp;&nbsp;Sponsorship</a>
</li>
<li class="lastitem"><a href="#" target="_self" title="Guestbook">Guestbook</a>
</li>
</ul>
</li>
<li><a class="active" href="./Bookings.php" target="_self" title="BOOKINGS">BOOKINGS</a>
</li>
<li><a class="withsubmenu" href="#" target="_self" title="GALLERY">GALLERY</a>

<ul>
<li class="firstitem"><a href="./Pictures.html" target="_self" title="Pictures">Pictures</a>
</li>
<li class="lastitem"><a href="./Videos.html" target="_self" title="Videos">Videos</a>
</li>
</ul>
</li>
<li><a class="withsubmenu" href="#" target="_self" title="LINKS">LINKS</a>

<ul>
<li class="firstitem"><a href="./Links_For_Sale_&_Supplies.html" target="_self" title="For Sales &amp; Supplies">For&nbsp;Sales&nbsp;&amp;&nbsp;Supplies</a>
</li>
<li class="lastitem"><a href="./links_Club_Directory.html" target="_self" title="Club Directory">Club&nbsp;Directory</a>
</li>
</ul>
</li>
<li><a href="./Contact_Us.html" target="_self" title="CONTACT US">CONTACT&nbsp;US</a>
</li>
<li><a href="./Members.php" target="_self" title="MEMBERS">MEMBERS</a>
</li>
</ul>
</div>
</div>
</body>
</html>