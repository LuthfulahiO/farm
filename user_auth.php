<?php
define('HOST', 'localhost');
define('USER', 'root');
define('PASS', 'root');
define('DB', 'agronomy');

class User

{
    public function __construct()
    {
        $con = mysqli_connect(HOST, USER, PASS, DB) or die('Connection to database failed' . mysqli_error($con));

    }


    public function register($firstname, $lastname, $username, $password, $country,$gender,$email,$mobile,$reg_date, $con)
        {
            $password = md5($password);
            $query = "Select id from user where email='$email'";
            $checkuser = mysqli_query($con, $query) or die(mysqli_error($con));
            $result = mysqli_num_rows($checkuser);
            if ($result == 0) {
                $register = mysqli_query($con,"Insert into user (first_name, last_name, username,password,country,gender,email,mobile_no,reg_date) values ('$firstname','$lastname','$username','$password','$country','$gender','$email',$mobile,'$reg_date')") or die(mysqli_error($con));
                return $register;
            } else {
                return false;
            }
    }

    public function login($email, $password,$con) {
        $pass = md5($password);
        $check = mysqli_query($con,"Select * from user where email='$email' and password='$pass'");
        $data = mysqli_fetch_array($check);
        $result = mysqli_num_rows($check);
        if ($result == 1) {
            $_SESSION['login'] = true;
            $_SESSION['id'] = $data['id'];
            return true;
        } else {
            return false;
        }
    }

    public function fullname($id,$con) {
        $result = mysqli_query($con,"Select * from user where id='$id'");
        $row = mysqli_fetch_array($result);
        echo $row['username'];
    }

    public function session() {
        if (isset($_SESSION['login'])) {
            return $_SESSION['login'];
        }
    }

    public function logout() {
        $_SESSION['login'] = false;
        session_destroy();
    }
}

?>
