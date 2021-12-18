<!DOCTYPE html>
<html>

<body>

    <?php
    echo "Login\n";
    ?>
    <br><br />
    <form method="get" >
        <?php
        echo "Username: ";
        ?>
        <input type="text" name="uname" value="">
        <br><br />
        <?php
        echo "Password: ";
        ?>
        <input type="text" name="upass" value="">
        <br><br />
        <input type="submit" name="submit" value="Submit" action=>
    </form>

    <?php

    function buttonAction()
    {
        session_start();
        // Create connection
        $conn = new mysqli("dijkstra.cs.bilkent.edu.tr:3306", "berdan.akyurek", "pqsah83r", "berdan_akyurek");
        //echo "Clicked";
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $queryStr = "SELECT * FROM student WHERE sid = ".$_GET['upass']." AND sname LIKE '".$_GET['uname']."';";
        //$queryStr = "SELECT * FROM student;";
        //echo $queryStr;
        $sidd = $_GET['upass'];
        $snamee = $_GET['uname'];

        $_SESSION['sid'] = $sidd;
        $_SESSION['sname'] = $snamee;
        $_SESSION['con'] = $conn;
        $result = mysqli_query($conn, $queryStr);
        # print_r($result);

        if($_GET['upass'] == "" || $_GET['uname'] == "" )
        {
            if($_GET['uname'] == "" )
            {
                echo "Username cannot be empty. \n";
            }
            if($_GET['upass'] == "" )
            {
                echo "Password cannot be empty. \n";
            }
        }   
        else if ($result == NULL)
        {
            echo "Invalid email and/or password";
        }
        else
        {
            header("Location: studentmain.php");
        }

        //$conn->close();
    }

    if (array_key_exists('submit', $_GET)) {
        buttonAction();
    }

    ?>

</body>

</html>