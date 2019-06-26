<?php
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
	<title>Welcome Admin</title>
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
<div class="Top">ANNOUNCEMENT: <Marquee id="Announce">Nothing</marquee>

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
<div id="Register">
<div id="Heading"> Welcome Admin. Please select desired course of action</div>
	<p><a href="Post.php">Give an Assignment</a></p><br/>
	<p><a href="Answers.php">View Submitted Answers</a></p><br/>
	<p><a href="Edit.php">Edit Login Details</a></p><br/>
	<p><a href="Add_Admin.php">Add a Fellow Admin</a></p><br/>
</div>
</div>
</body>
</html>