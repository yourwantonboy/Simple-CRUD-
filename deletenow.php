<?php
#Includes the connections.php file 
include("connections.php");
#New variable, could be anything else but we'll stick to $user_id
$user_id = $_POST["user_id"]; #$user_id, same with the one at confirmdelete.php
#Delete query
mysqli_query($connections, "DELETE FROM mytbl WHERE id = '$user_id' ");

#Notification and redirect
echo "<script language='javascript'>alert('Record has been deleted!')</script>";
echo "<script>window.location.href='index.php';</script>";