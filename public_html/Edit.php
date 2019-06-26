<?php
session_start();
require_once ('conn.php');
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
	<div id="Heading"><h3>Enter New Details</h3></div>
	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
		<label>Name</label><br/>
		<input type="text" name="name" required><br/><br/>

		<label>ID</label><br/>
		<input type="text" name="id" value="" required><br/><br/>

		<label>Enter Previous Password:</label><br/>
		<input type="password" name="pre_password" value="" required/><br/><br/>

		<label>Enter New Password:</label><br/>
		<input type="password" name="password" required/><br/><br/>

		<label>Re-enter New Password:</label><br/>
		<input type="password" name="re_password" required/><br/><br/>

		<input type="Submit" value="UPDATE" name="update" /><br/><br/>
		<p>Want to Add a fellow Admin Instead? </p>
		<p>Goto <a href="Add_Admin.php">ADD NEW ADMIN</a> Instead</p>
		<div id=""></div>
	</form>
    <?php

    if(isset($_POST['update'])) {
        $name = $_POST['name'];
        $id=$_POST['id'];
        $pre_password=md5($_POST['pre_password']);
        $password=$_POST['password'];
        $re_password=$_POST['re_password'];

        $sql = "select * from admin where password='$pre_password'";
        $row = $conn->query($sql);
        $result = $row->rowCount();
        if ($result < 1) {
            echo "Admin Not Found";

        } else {
            if ($password == $re_password) {
                $password = md5($password);
                $ssd = "UPDATE admin SET name='$name', admin_id='$id', password='$password' WHERE password='$pre_password'";
                $result = $conn->prepare($ssd);
                 $result->execute();
                if ($result){
                    echo 'Details Updated';
                }
                else{
                    echo "Failed To Update. Try Again";
                }
            }
            else {
                echo "Password Mismatch";
            }
        }
    }


    ?>
</div>
</body>
</html>
