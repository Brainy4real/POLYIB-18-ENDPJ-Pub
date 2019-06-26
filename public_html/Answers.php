<?php
require_once ('conn.php');
session_start();
if (!ISSET($_SESSION['admin'])){
    header('Location: Admin.php');
}
if (ISSET($_SESSION['admin'])){
    $r=$_SESSION['admin'];
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Welcome students</title>
	<link rel="stylesheet" type="text/css" href="Homestyle.css">
</head>
<body>
<?php echo 'Welcome'." ". $r;
echo '<a href="logout.php">Logout</a>';
?>
<div class="Date"><P id="Date">Today:</P></div>
<script type="text/javascript">
			var date=Date()
			var subDate=date.substring(0,date.length-51);
		document.getElementById("Date").innerHTML="Today: " + subDate;
		</script>
<br/><br/>
<div class="Top">ANNOUNCEMENT: <marquee id="Announce">When Scoring Students, Please Input Assignment ID again before Clicking on GO</marquee>

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

<div id="post">
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">

<table>

<tr>
	<td><label>Select Required Answers ID:</label><br/><input type="text" name="ass_id" /></td><br/>
	
	<td><input id="action" type="submit" value="PUBLISH" name="publish" required></td>
	<td><input id="action" type="submit" value="CLEAR TABLE" name="Clear"></td>

</tr>
</table><br/>
<table id="answers">
    <thead>
<tr>
    <th>NAME</th>
    <th>MATRIC</th>
    <th>CONTENTS</th>
    <th>MEDIA</th>
    <th>REMARK</th>
    <th>SAVE</th>
</tr>
    </thead>
    <tbody>
    <?php
    if (isset($_POST['publish'])){
    $ass_id = $_POST['ass_id'];

    $sql = "select * from $ass_id";
    $row = $conn->query($sql);

    while ($f = $row->fetch(PDO::FETCH_ASSOC)){
    $matric = $f['matric'];
    ?>
    <tr>

        <td><?php echo $f['name'] ?></td>
        <td><?php echo $matric ?></td>
        <td><?php echo $f['content'] ?></td>
        <td><?php echo "<a download=" . $f['media'] . " href=" . $f['media'] . ">" . $f['media_name'] . "</a>";?></td>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
        <td><input id="rem" type="text" name="remark" ></td>

        <td><input id="action" type="submit" value="GO" name="go"></td>
        </form>
<?php   }} ?>
        <?php
        if (isset($_POST['go'])) {
            $ass_id = $_POST['ass_id'];
            $remark = $_POST['remark'];
        if ($ass_id==""){
            echo "Pls Fill Assignment ID";
        }else{
        $sql = "select * from $ass_id";
        $row = $conn->query($sql);


        if ($f = $row->fetch(PDO::FETCH_ASSOC)) {
        $matric = $f['matric'];

        $ssd = "UPDATE student SET remark='$remark' WHERE matric='$matric'";
        $result = $conn->prepare($ssd);
        $result->execute();


        try {


        // sql to delete a record
        $sql = "DELETE FROM $ass_id WHERE matric='$matric'";

        // use exec() because no results are returned
        $conn->exec($sql);
        $ass_id = $_POST['ass_id'];
        $sql = "select * from $ass_id";
        $row = $conn->query($sql);

        while ($f = $row->fetch(PDO::FETCH_ASSOC)){
        $matric = $f['matric'];
        ?>
    <tr>

        <td><?php echo $f['name'] ?></td>
        <td><?php echo $matric ?></td>
        <td><?php echo $f['content'] ?></td>
        <td><?php echo "<a download=" . $f['media'] . " href=" . $f['media'] . ">" . $f['media_name'] . "</a>"; ?></td>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
            <td><input id="rem" type="text" name="remark"></td>

            <td><input id="action" type="submit" value="GO" name="go"></td>
        </form>
        <?php }

        }
        catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }


        }

        }


        }?>


</tr>
    </tbody>
</table>

</form>
</div>
</div>
</body>
</html>