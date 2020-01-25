<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="src/styles.css">
    <link rel="stylesheet" href="src/styles1.css">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script type="text/javascript">
      $(window).on('scroll', function() {
        if ($(window).scrollTop()) {
          $('nav').addClass('black');
  
        } else {
          $('nav').removeClass('black');
        }
      })
    </script>
</head>
<body class="body1">
    <?php

    session_start();    //start the session

    $pass=$uname="";
    $status=true;
    if (!empty($_POST)) {
        if (empty($_POST['uname'])) {
            $status=false;
        }
        else {
            $uname=$_POST['uname'];
        }
        if (empty($_POST['password'])) {
            $status=false;
        }
        else {
            $pass=sha1($_POST['password']);
        }

        $servername= "localhost";
        $username= "root";
        $password= "";
        $dbname="electrothon";

        //create connection
        $com= new mysqli($servername, $username, $password,$dbname);

        //check connection
        if ($com->connect_error ) {
            die("Connection failed ".$com->connect_error);
        }
        else{

        if ($status) {
            $sql="SELECT name, username, password
                FROM login WHERE username='$uname' AND password='$pass'";
            $result=$com->query($sql);//finding out how many rows are being returned
            if ($result->num_rows > 0) {
                $record= $result->fetch_assoc();//converting result to associative array
                $_SESSION['loggedin']=true; //loggedin can be anything
            // $_SESSION['']=$record
                $_SESSION['userDetails']=$record;
                header ("Location: input.php");
            }
            else{
                echo "Invalid credentials. <br>";
            }
        $com->close();
        }
    }

    }
    ?>
    <nav>
                <img class="logo" src="logo.png">
                <ul>
                  <li><a href="signup.php">Signup</a></li>
                </ul>
              </nav>
    <div class="wrap">
    <h1>Login</h1>
        <form method="POST" >
            <p>Username:</p>
            <input type="text" name="uname" placeholder="abc@xyz.com"><br>
            <p>Password:</p>
            <input type="password" name="password" placeholder="password"><br>
            <input type="submit" name="submit" value="Submit">
        </form>
        </div>
</body>
</html>