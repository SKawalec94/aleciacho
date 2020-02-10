<?php
include('session.php');

switch ($_POST["log"])
{
    case "0":
        $_SESSION["username"] = "";
        $_SESSION["log_state"] = 0;
        $_SESSION['admin'] = 0;
        header('Location: '.$domain);
        break;

    case "1":
        $pwd = mysqli_real_escape_string($conn, $_POST["password"]);
        $login = mysqli_real_escape_string($conn, $_POST["user"]);

        $sql = "SELECT login, haslo FROM Userzy WHERE login = '$login';";

        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        if(password_verify($pwd, $row["haslo"]))
        {
            $_SESSION["username"] = $row["login"];
            $username = $_SESSION["username"];

            $sql2 = "SELECT imie FROM Klienci WHERE login='$login';";
            $result2 = mysqli_query($conn, $sql2);

            $row2 = mysqli_fetch_assoc($result2);

            $_SESSION["imie"] = $row2["imie"];

            $_SESSION["log_state"] = 1;
            if($username != 'admin') $_SESSION['admin'] = 0;
            else $_SESSION['admin'] = 1;
        }
        else
        {
            $_SESSION["log_state"] = 0;
            $denied = 1;
            echo $denied;
        }
        break;
}