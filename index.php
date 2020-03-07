
<?php
#These variables shall hold what you input in the textbox
$name = $address = $email = "";
#These shall handle the error if the textboxes are empty.
$nameErr = $addressErr = $emailErr = "";

#This if statement checks if a field/textbox has content, so if a box has none, this gives value to error messages.
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    #This nested if statement checks whether "name" has content or not.
    if (empty($_POST["name"]))
    {
        #If "name" is empty, $nameErr will be given the value "Name is required!"
        $nameErr = "Name is required!";
    }
    else
    {
        $name = $_POST["name"];
    }
    if (empty($_POST["address"]))
    {
        $addressErr = "Address is required!";
    }
    else
    {
        $address = $_POST["address"];
    }
    if(empty($_POST["email"]))
    {
        $emailErr = "Email is required!";
    }
    else
    {
        $email = $_POST["email"];
    }
}
?>
<!--This style tag contains the '.error' class and 'color:red;', the color of error message when it appears.-->
<style>
    .error
    {
        color: red;
    }
</style>

<form method = "POST" action="<?php htmlspecialchars("PHP_SELF"); ?>">

<!--The purpose of <?php echo $name; ?> is to retain the input value and not get lost if a field turns out to be empty.-->
<input type="text" name="name" value="<?php echo $name; ?>"> <br>
<!--Before trying to make error appear, make sure $nameErr is echoed-->
<!--The <span> tag below has an 'error' class which means, if it detects an 'error' class within the tag, all that's inside the <span> tag will turn red.-->
<!--<?php echo $nameErr; ?> (see line below) notifies you if name is empty.-->
<span class="error"> <?php echo $nameErr; ?> </span> <br>

<input type="text" name="address" value="<?php echo $address; ?>"> <br>
<span class="error"> <?php echo $addressErr; ?> </span> <br>

<input type="text" name="email" value="<?php echo $email; ?>"> <br>
<span class="error"> <?php echo $emailErr; ?> </span> <br>

<input type="submit" value="Submit">

</form>

<hr>

<?php
#To know if you're connected to the database or not.
#All that's inside connections.php will be imported to index.php.
include("connections.php");

    #If $name, $address, and $email are NOT empty
    if($name && $address && $email)
    {
        #' . ' means "To concatenate"
        #$query's job is to handle or query for inserting/adding data to database.
        #The $connections parameter is the $connections variable in connections.php.
        #The INSERT INTO at second parameter corresponds to the columns made at the database.
        #All that's inside 'VALUES' are respective to what was input first
        $query = mysqli_query($connections, "INSERT INTO mytbl (name, address, email) VALUES('$name', '$address', '$email')");

        echo "<script language='javascript'>alert('New record has been inserted!')</script>";
        echo "<script>window.location.href='index.php';</script>";
    }

    $view_query = mysqli_query($connections, "SELECT * FROM mytbl");

    echo "<table border='1' width='50%'>";
    echo "<tr>
            <td>Name</td>
            <td>Address</td>
            <td>Email</td>

            <td>Option</td>


         </tr>";
    #While loop
    while($row = mysqli_fetch_assoc($view_query))
    {
        #These variables shall handle the four fields inside the table 'mytbl'
        $user_id = $row["id"];
        $db_name = $row["name"];
        $db_address = $row["address"];
        $db_email = $row["email"];

        #Echo the variables within the table inside the while loop
        echo "<tr>
                <td>$db_name</td>
                <td>$db_address</td>
                <td>$db_email</td>

                <td>
                <a href='edit.php?id=$user_id'>Update</a>
                &nbsp;
                <a href='confirmdelete.php?id=$user_id'>Delete</a>
                </td>

              </tr>";

        #Echo $db_name and concatenate the break line. (code deleted)
    }

    echo "</table>";
?>