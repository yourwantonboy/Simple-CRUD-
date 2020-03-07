<?php

    #This $user_id variable uses the $_REQUEST[""] method, which holds "id"
    $user_id = $_REQUEST["id"];

    include("connections.php");
    #Delete query, includes variable $connections
    #Also includes a select query
    $query_delete = mysqli_query($connections, "SELECT * FROM mytbl WHERE id = '$user_id' ");

    #While loop
    #$query_delete above should be the same with the variable inside the loop below.
    while($row_delete = mysqli_fetch_assoc($query_delete))
    {
        $user_id = $row_delete["id"];
        $db_name = $row_delete["name"];
        $db_address = $row_delete["address"];
        $db_email = $row_delete["email"];
    }

    #For confirmation only
    echo "<h1> Are you sure you want to delete $db_name? </h1>";
?>
<!--Put a form under the ending tag of php-->
                    <!-- Put file "deletenow.php" inside action -->
<form method="POST" action="deletenow.php">
<!-- [name="user_id"] is where we will call the user_id name when we $_POST from this page to another.  -->
<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">

<Br>
<Br>
<!-- Button, of course -->
                                        <!-- In case you change minds about deleting it, -->
                                        <!-- it shall redirect you to the main page (index.php) -->
<input type="submit" value="Yes"> &nbsp; <a href='index.php'>No</a>
</form>
