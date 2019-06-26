<?php
/**
 * Created by PhpStorm.
 * User: Octavia
 * Date: 12/11/2018
 * Time: 3:20 PM
 */

        if (isset($_POST['publish'])) {
            $remark = $_POST['remark'];
            $sql = "select * from '$ass_id'";
            $row = $conn->query($sql);


            while ($f = $row->fetch(PDO::FETCH_ASSOC)) {
                $matric = $f['matric'];

                $ssd = "insert into student (remark) where matric = '$matric' values (?) ";
                $result = $conn->prepare($ssd);
                $launch = $result->execute(array($remark));
                if ($launch) {

                    try {


                        // sql to delete a record
                        $sql = "DELETE FROM $ass_id WHERE matric=$matic";

                        // use exec() because no results are returned
                        $conn->exec($sql);
                        echo "Record deleted successfully";
                    } catch (PDOException $e) {
                        echo $sql . "<br>" . $e->getMessage();
                    }


                } else {
                    echo 'error';
                }
            }

        }?>

