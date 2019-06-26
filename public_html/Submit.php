<?php
require_once ('conn.php');
?>
<?php 
session_start();
if (ISSET($_SESSION['student'])){
	$r=$_SESSION['student'];
	$f=$_SESSION['matric'];

}
else{
    header("Location: Login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Welcome to the submit page</title>
	<link rel="stylesheet" type="text/css" href="Homestyle.css">
</head>
<body>
<?php echo 'Welcome'." ". $r.'<br/>';
echo '<a href="logout1.php">Logout</a>'.'<br>';
echo '<a href="index.php">Home</a>';
?>
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

<div id="Submit">
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" enctype="multipart/form-data">
<aside>
	<label>Enter Assignment ID:</label><br/><input type="text" name="ass_id"/><br/><br/>
	<label>Content:</label><br/><textarea name="content"></textarea><br/><br/>
</aside>
	<label>Select Media attachment: </label><input type="file" name="file"/>&nbsp;
	<input id="action" type="submit" value="SUBMIT" name="submit"><br/>
</form>
    <?php
    if (isset($_POST['submit'])){
        $ass_id=$_POST['ass_id'];
        $name=$r;
        $matric=$f;
        $content=$_POST['content'];
        $file= ($_FILES["file"]['name']);
        $fname=str_replace(' ','',$file);
        $path='./stupload/'."$fname";
        move_uploaded_file($_FILES['file']['tmp_name'],$path);




        $ssd = "insert into $ass_id (name,matric,content,media_name,media) values (?,?,?,?,?)";
        $result = $conn->prepare($ssd);
        $launch = $result->execute(array($name,$matric,$content,$matric,$path));
        if ($launch){

           header('Location: Student.php?message=<p>Success</p>');
        }
    }

    ?>
</div>
</div>
</body>
</html>