<?php 
require_once('conn.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Welcome Admin</title>
	<link rel="stylesheet" type="text/css" href="Homestyle.css">
	<meta name="viewport" content="width=device-width">
</head>
<body>
<?php 
if (ISSET($_SESSION['admin'])){
echo 'Welcome'." ". $r;
echo '<a href="logout.php">Logout</a>';
}
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
<div id="Register">
	<div id="Heading"><h3>ADMIN LOGIN</h3></div>
	<form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
		<label>ID</label><br/>
		<input type="text" name="id" required><br/><br/>

		<label>Password:</label><br/>
		<input type="password" name="password" required/><br/><br/>
		<input type="Submit" value="LOGIN" name="login" /><br/>
        <?php

        if(isset($_POST['login'])) {
            $admin_id = $_POST['id'];
            $password = md5($_POST['password']);

            $sql = "select * from admin where admin_id = '$admin_id'";
            $row = $conn->query($sql);
            $result = $row->rowCount();
            if ($result < 1) {
                echo "Admin Not Found";

            } else {
                if ($r = $row->fetch(PDO::FETCH_ASSOC)) {
                    if ($password != $r['password']) {
                        echo "Wrong Password";
                    } else {

                        $_SESSION['admin'] = $r['name'];
                        header("Location: Admin_Home.php?login=success");
                    }
                }
            }
        }
        ?>
		<div id=""></div>
	</form>
</div>
</div>
</body>
</html>