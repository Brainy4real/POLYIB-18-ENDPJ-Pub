<?php
session_start();
require_once ('conn.php');

?>
<!DOCTYPE html>
<html>
<head>
    <title>Welcome students</title>
    <link rel="stylesheet" type="text/css" href="Homestyle.css">
</head>
<body id="Home">
<?php
if (ISSET($_SESSION['student'])){
    $r=$_SESSION['student'];
    echo 'Welcome'." ". $r .'<br/>';
    echo '<a href="logout1.php">Logout</a>'.'<br>';
    echo '<a href="Student.php">Profile</a>';
}
?>
<div class="Date"><P id="Date">Today:</P></div>
<script type="text/javascript">
    var date=Date()
    var subDate=date.substring(0,date.length-51);
    document.getElementById("Date").innerHTML="Today: " + subDate;
</script>
<br/><br/>
<div class="Top">ANNOUNCEMENT: <marquee id="Announce"> New Assignment has been given,
        </marquee>

</div><br/><br/><br/>
<div id="contents"
<!--The side navigating button -->
<nav id="nav" role="navigation">
    <div id="menuToggle">
        <input type="checkbox" />
        <span></span>
        <span></span>
        <span></span>

        <ul id="menu">
            <p><a href="index.php">HOME</a></p>
            <p><a href="Admin.php">STAFF</a></p>
            <p><a href="Login.php">STUDENT</a></p>
            <p><a href="Submit.php">SUBMIT</a></p>
        </ul>

    </div>
</nav>

   <!--  <table cellspacing = "0" >
        <thead>
        <tr>
            <th>ID</th>
            <th>LEVEL</th>
            <th>COURSE</th>
            <th>CONTENTS</th>


        </tr>
        </thead>
        <tbody> -->
        <?php
        $sql = "select * from post";
        $row = $conn->query($sql);



        while( $f=$row->fetch(PDO::FETCH_ASSOC)){
        ?>
<br/>
     <section class="article">
     <b> <?php echo $f['ass_id']?> </b>&nbsp;&nbsp;<b> <?php echo $f['level'] ?> </b>&nbsp;<b><?php echo $f['course'] ?> </b>&nbsp;&nbsp;<br/>
     <p> <?php echo $f['contents'] ?> </p>
      <b> <?php echo  "Deadline: ".$f['deadline'] ?></b>&nbsp;<br/>
   <b> <?php echo 'Download Material: '."<a download=".$f['path']." href=".$f['path'].">".$f['name']."</a>" ?></b>         
     </section><br/>
       <?php } ?>

</div>
</body>
</html>