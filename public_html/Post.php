<?php
require_once('conn.php');
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
<div id="post">
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <td><label>Assignment ID:</label><br/><input type="text" name="ass_id"/></td><br/>
                <td> </td>
                <td><label>Level: </label><br/><input type="text" name="level" /></td>
                <br/>
            </tr>
            <tr>
                <td><label>Course: </label><br/><input type="text" name="course" /></td>
                <td> </td>
                <td><label>Deadline: </label><br/><input type="text" name="deadline" /></td>
            </tr>
            <tr>
                <td colspan="2"><label>Content: (Either Description or Instruction)</label><br/><textarea name="content"></textarea></td>
                <td><label>Attach files here: </label><input type="file" name="file"></td>
            </tr>
            <tr><td><input id="submit" type="submit" value="POST" name="post"></td></tr>
            <?php
            if (isset($_POST['post'])){
                $ass_id=$_POST['ass_id'];
                $table=$ass_id;
                $level=$_POST['level'];
                $course=$_POST['course'];
                $content=$_POST['content'];
                $deadline=$_POST['deadline'];
                $name= ($_FILES['file']['name']);
                $name=str_replace(' ','',$name);
                $path='./upload/'.$name;
                move_uploaded_file($_FILES['file']['tmp_name'],$path);




                $ssd = "insert into post (level,course,contents,ass_id,deadline,name,path) values (?,?,?,?,?,?,?)";
                $result = $conn->prepare($ssd);
                $launch = $result->execute(array($level,$course,$content,$ass_id,$deadline,$name,$path));
                if ($launch){
                    try{
                        // sql to create table
                        $sql = "CREATE TABLE $table(
                         id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                        name TEXT NOT NULL,
                       matric TEXT NOT NULL,
                         content TEXT NOT NULL,
                         media_name TEXT NOT NULL,
                         media TEXT NOT NUll
                           
                           
                          )";

                        // use exec() because no results are returned
                        $conn->exec($sql);

                    }
                    catch (PDOException $e){
                        echo $sql . "<br>" . $e->getMessage();
                    }

                    header('Location: index.php?message=<p>Success</p>');
                }
            }

            ?>
        </table>

    </form>
</div>
</div>
</body>
</html>