<?php
/**
 * Created by PhpStorm.
 * User: Joker
 * Date: 3/4/2015
 * Time: 9:43 AM
 */

$mysql_connection = mysqli_connect("localhost", "root", "password", "battleon_aq");

if (mysqli_connect_errno()) {
    echo 'MYSQLI Error:' . mysqli_connect_error();


} else {

    if (isset($_POST['uuu'])) {

        $strUsername = mysqli_real_escape_string($mysql_connection, $_POST['uuu']);
        $BirthDate = mysqli_real_escape_string($mysql_connection, $_POST['dob']);
        $strEmail = mysqli_real_escape_string($mysql_connection, $_POST['eee']);
        $strPassword = mysqli_real_escape_string($mysql_connection, $_POST['ppp']);


        $User_Check_Query = $mysql_connection->query('SELECT * FROM aq_logins WHERE Username="'.$strUsername.'"');

        if ($User_Check_Query->num_rows > 0) {

            die('&status=taken&stupid=CAFIREWALL');

        } else {

            $User_Check_Query = $mysql_connection->query("INSERT INTO aq_logins (Username, Password, Email, BirthDate) VALUES ('$strUsername', '$strPassword', '$strEmail', '$BirthDate')");

            if ($User_Check_Query) {

                $Get_UserID = $mysql_connection->query("SELECT id FROM aq_logins WHERE Username=".$strUsername);
                $row = $Get_UserID->fetch_assoc();
                $userId = $row["id"];

                echo "&status=success&userid=$userId&stupid=CAFIREWALL&email=success&whatever=huh";
            }

        }
    } else {
        echo 'Invalid Data.';
    }
    $mysql_connection->close();
}

$mysql_connection->close();
?>
