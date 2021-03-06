<?
/*
   File name         : deletecontact.php
   Version           : 2.0.0
   Last Modified By  : Pete Larsen
   e-mail            : pete@postaciwebmail.org
   Last modified     : 28 Feb 2005
*/

session_start();
include ("includes/global.inc");
include ("includes/functions.inc");

// ID comparison between logged hash and session. If they are both the same, let the user to go on...
$dbq = $db->execute("select log_id,user_id,username from tblLoggedUsers where hash = '$ID'");
$log_id   = $dbq->fields['log_id'];
$user_id  = $dbq->fields['user_id'];
$username = $dbq->fields['username'];
$dbq->close();

// security check
$item_id = clean_data($item_id);
$dbq = $db->execute("select user_id from tblAdressbook where item_id=$item_id");
$auth_user = $dbq->fields['user_id'];
if ($auth_user != $user_id) {
  Header("Location: index.php?error_id=1");
}
$dbq->close();

if ($log_id == ""){
  Header("Location: index.php?error_id=1");
} else {

  $dbq = $db->execute("delete from tblAdressbook where item_id = $item_id and user_id = $user_id");
  $dbq->close();

  Header("Location: addressbook.php");
}

?>
