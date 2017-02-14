<?php
/**
 * Created by PhpStorm.
 * User: Joker
 * Date: 3/5/2015
 * Time: 9:05 AM
 */

$num_chars = 0;

//MYSQL Connection.
$mysql_connection = mysqli_connect("localhost", "root", "password", "battleon_aq");

//Checking if there is a error.
if (mysqli_connect_errno()) {
    echo 'MYSQLI Error:' . mysqli_connect_error();

} else {

    if (isset($_POST['u'])) {

        $Post_Username = mysqli_real_escape_string($mysql_connection, $_POST['u']);
        $Post_Pass = mysqli_real_escape_string($mysql_connection, $_POST['p']);

        $Post_Username = stripslashes($Post_Username);
        $Post_Pass = stripslashes($Post_Pass);

        $Check_User_Exist = $mysql_connection->query('SELECT Username FROM aq_logins WHERE Username="' . $Post_Username . '"');
        if ($Check_User_Exist->num_rows == 0) {
            echo '&status=usernotfound&stupidsoftware=CAFIREWALL';

        } else {

            $Check_UP = $mysql_connection->query('SELECT * FROM aq_logins WHERE Username="' . $Post_Username . '" AND Password="' . $Post_Pass . '"');
            if ($Check_UP->num_rows == 0) {
                echo '&status=badpassword&stupidsoftware=CAFIREWALL';

            } else {

                $Check_chars = $mysql_connection->query('SELECT * FROM aq_characters WHERE User_Owner="' . $Post_Username . '"');
                if($Check_chars->num_rows == 0) {
                    $user = $Check_UP->fetch_assoc();

                    echo "&id=".$user['id']."&idLore_Users=".$user['id']."&strEmail=".$user['Email']."&intCanEmail=1&intHits=0&userpass=$Post_Pass&numchars=$num_chars&status=success&stupidsoftware=CAFIREWALL";

                } else {
                    //Get all the characters
                }
            }
        }
    } else {
        echo 'Invalid Data.';
    }
    $mysql_connection->close();

}
$mysql_connection->close();
?>