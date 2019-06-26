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
	<div id="Heading"><h3>Add New Admin</h3></div>
	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
		<label>Name</label><br/>
		<input type="text" name="name" required><br/><br/>

		<label>ID</label><br/>
		<input type="text" name="id" value="" required><br/><br/>

		<label>Create Password:</label><br/>
		<input type="password" name="password" required/><br/><br/>

		<label>Re-enter Password:</label><br/>
		<input type="password" name="re_password" required/><br/><br/>

		<label>Enter Existing Admin Password for Authentication:</label><br/>
		<input type="password" name="pre_password" value="" required/><br/><br/>

		<input type="Submit" value="ADD ADMIN" name="add" /><br/><br/>
		<p>Want to Edit Admin details Instead? </p>
		<p>Goto <a href="Edit.php">EDIT ADMIN LOGIN</a> Instead</p>
		<div id=""></div>
	</form>
    <?php
    if(isset($_POST['add'])) {
        $name = $_POST['name'];
        $id=$_POST['id'];
        $pre_password=md5($_POST['pre_password']);
        $password=$_POST['password'];
        $re_password=$_POST['re_password'];

        $sql = "select * from admin where admin_id='$id'";
        $row = $conn->query($sql);
        $result = $row->rowCount();
        if ($result > 0) {
            echo "ID Already Taken";

        } else {
            $sql = "select * from admin WHERE password='$pre_password'";
            $row = $conn->query($sql);


            if ($f = $row->fetch(PDO::FETCH_ASSOC)) {
                if ($password == $re_password) {
                    $password = md5($password);
                    $ssd = "insert into admin (name,admin_id,password) values (?,?,?)";
                    $result = $conn->prepare($ssd);
                    $launch = $result->execute(array($name, $id, $password));
                    if ($launch){
                        echo 'Admin Added Succesfully';
                    }
                    else{
                        echo "Failed To Add Admin. Try Again";
                    }
                }
                else {
                    echo "Password Mismatch";
                }
            }
            else{
                echo "Incorrect Admin Password";
            }

        }
    }

    ?>
</div>
</body>
</html>