<!DOCTYPE html>
<html>

<body>

    <?php
    //include("studentmain.php");
    $conn = new mysqli("dijkstra.cs.bilkent.edu.tr:3306", "berdan.akyurek", "pqsah83r", "berdan_akyurek");
    $sid = $_GET['sd'];
    //echo $sid."asd";
    $q = "SELECT * FROM apply WHERE sid = $sid";
    //echo $q;
    $ress = mysqli_query($conn, $q);

    if (mysqli_num_rows($ress) == 3) {
        echo "You cannot have more than 3 applications";
        header("Location: studentmain.php");
    }
    session_start();
    $sname = $_SESSION['sname'];
    $sid = $_SESSION['sid'];
    echo "Logged in as " . $sname;
    $conn = $_SESSION['con'];
    ?>
    <a href='/'>Logout</a>
    <button onclick='history.go(-1);'>Go Back </button>
    <br><br />
    Companies you can apply:
    <br><br />


    <?php
    $conn = new mysqli("dijkstra.cs.bilkent.edu.tr:3306", "berdan.akyurek", "pqsah83r", "berdan_akyurek");
    $queryStr = "SELECT cid, cname FROM company WHERE quota>0 AND cid NOT IN (SELECT cid FROM apply WHERE sid='$sid')";
    $result = mysqli_query($conn, $queryStr);
    while ($row = mysqli_fetch_array($result)) {
        $a = $row['cid'];
        $b = $row['cname'];
        echo $a . " " . $b . " ";
        //echo "<button onclick="header('Location: studentmain.php');">Logout </button>";
        echo "<a href='makeApplication.php?sd=$sid&cd=$a'>Apply</a>";
        echo "<br><br />";
    }
    ?>

</body>

</html>