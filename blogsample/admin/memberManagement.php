<?php
//include config
require_once('../includes/config.php');

//if not logged in redirect to login page
//if(!$user->is_logged_in()){ header('Location: login.php'); }


//show message from add / edit page
if(isset($_GET['deluser'])){


        $stmt = $db->prepare('DELETE FROM members WHERE memberID = :memberID') ;
        $stmt->execute(array(':memberID' => $_GET['deluser']));

        header('Location: memberManagement.php?action=deleted');
        exit;


}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Admin - Subscribers</title>
    <link rel="stylesheet" href="../style/normalize.css">
    <link rel="stylesheet" href="../style/main.css">
    <script language="JavaScript" type="text/javascript">
        function deluser(id, title)
        {
            if (confirm("Are you sure you want to delete '" + title + "'"))
            {
                window.location.href = 'memberManagement.php?deluser=' + id;
            }
        }
    </script>
</head>
<body>

<div id="wrapper">

    <?php include('menu.php');?>

    <?php
    //show message from add / edit page
    if(isset($_GET['action'])){
        echo '<h3>Subscriber '.$_GET['action'].'.</h3>';
    }
    ?>

    <table>
        <tr>
            <th>Member ID</th>
            <th>Username</th>
            <th>Zip</th>
            <th>E-Mail</th>
            <th>Action</th>
        </tr>
        <?php
        try {

            $stmt = $db->query('SELECT DISTINCT memberID, username, email,zip FROM members ORDER BY username');
            while($row = $stmt->fetch()){

                echo '<tr>';
                echo '<td>'.$row['memberID'].'</td>';
                echo '<td>'.$row['username'].'</td>';
                echo '<td>'.$row['zip'].'</td>';
                echo '<td>'.$row['email'].'</td>';
                ?>

                <td>
                    <a href="edit-user.php?id=<?php echo $row['memberID'];?>">Edit</a>
                    <?php if($row['memberID'] !=0){?>
                        | <a href="javascript:deluser('<?php echo $row['memberID'];?>','<?php echo $row['username'];?>')">Delete</a>
                    <?php } ?>
                </td>

                <?php
                echo '</tr>';

            }

        } catch(PDOException $e) {
            echo $e->getMessage();
        }
        ?>
    </table>



</div>

</body>
</html>
