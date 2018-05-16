<?php
//include config
require_once('../includes/config.php');

//if not logged in redirect to login page
//if(!$user->is_logged_in()){ header('Location: login.php'); }

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Admin - Member Activity</title>
    <link rel="stylesheet" href="../style/normalize.css">
    <link rel="stylesheet" href="../style/main.css">
    <script language="JavaScript" type="text/javascript">
        function deluser(id, title)
        {
            if (confirm("Are you sure you want to delete '" + title + "'"))
            {
                window.location.href = 'users.php?deluser=' + id;
            }
        }
    </script>
</head>
<body>

<div id="wrapper">

    <?php include('menu.php');?>



    <table>
        <tr>
            <th>Username</th>
            <th>Email</th>
            <th>Activity</th>
            <th>Date</th>
        </tr>
        <?php
        try {

            $stmt = $db->query('SELECT username,email,activity,date_t FROM ( SELECT * FROM members JOIN mem_notification ON members.memberID = mem_notification.id GROUP BY username )  AS T');
            while($row = $stmt->fetch()){

                echo '<tr>';
                echo '<td>'.$row['username'].'</td>';
                echo '<td>'.$row['email'].'</td>';
                echo '<td>'.$row['activity'].'</td>';
                echo '<td>'.$row['date_t'].'</td>';


                ?>
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
