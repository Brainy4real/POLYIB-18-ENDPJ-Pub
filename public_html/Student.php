<?php 
session_start();
if (ISSET($_SESSION['student'])){
	$r=$_SESSION['student'];
	$f=$_SESSION['matric'];
	$l=$_SESSION['level'];
	$k=$_SESSION['remark'];
	echo 'Welcome'." ". $r.'<br/>';
echo '<a href="logout1.php">Logout</a>'.'<br>';
echo '<a href="index.php">Home</a>';
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Welcome to your Dashboard</title>
	<link rel="stylesheet" type="text/css" href="Homestyle.css">
</head>
<body>

<div class="Date"><P id="Date">Today:</P></div>
<script type="text/javascript">
			var date=Date()
			var subDate=date.substring(0,date.length-51);
		document.getElementById("Date").innerHTML="Today: " + subDate;
		</script>
<br/><br/>
<div class="Top">ANNOUNCEMENT: <marquee id="Announce">Nothing</marquee>

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

<div id="Student">
<form method="post">
<table>
	<tr><th> YOUR DETAILS:</th></tr>
	<tr><td>NAME: <?php echo $r ?></td></tr>
	<tr><td>MATRIC NO: <?php echo $f ?></td></tr>
	<tr><td>LEVEL: <?php echo $l ?></td></tr>
</table><br/>
<section>
	<label>Remark of Previously Submitted Assignment:</label><b> <?php echo $k ?></b><br/><br/>
	<p>Click <a href="Submit.php">HERE</a> to Submit an Assignment</p>
</section>
</form>
</div>
</div>
</body>
</html>