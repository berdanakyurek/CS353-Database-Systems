<!DOCTYPE html>
<html>

<body>

    <?php
        session_start();
        $sname = $_SESSION['sname'];
        $sid = $_SESSION['sid'];
        echo "Logged in as ".$sname;
        $conn = $_SESSION['con'];
        $conn = new mysqli("dijkstra.cs.bilkent.edu.tr:3306", "berdan.akyurek", "pqsah83r", "berdan_akyurek");
    ?>
    <a href='/'>Logout</a>
    <button onclick='history.go(-1);'>Go Back </button>
    <br><br/>
    Applied Companies:
    <br><br/>
    <?php

        $queryStr = "SELECT cid, cname FROM apply NATURAL JOIN company WHERE sid = $sid ";
        $result = mysqli_query($conn, $queryStr);
        while($row = mysqli_fetch_array($result))
        {
            $a = $row['cid'];
            $b = $row['cname'];
            echo $a." ".$b." ";
            //echo "<button onclick="header('Location: studentmain.php');">Logout </button>";
            echo "<a href = 'deleteApplication.php?sd=$sid&cd=$a'>cancel</a>";
            echo "<br><br/>";
        } 
        echo "<a href = 'applyPage.php?sd=$sid'>Apply New Company</a>";
    ?>
    
        

</body>

</html>