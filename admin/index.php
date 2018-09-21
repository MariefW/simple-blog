<?php
include_once("../header.php");

if(!$functions->checkSession('login'))
{
    header("Location: login.php"); exit();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>SIMPLE BLOG</title>

    <style type="text/css">
        .manageTable {
            width: 50%;
            margin: auto;
        }

        table {
            width: 100%;
            margin-top: 20px;
        }

    </style>

</head>
<body>

<div class="manageTable">
    <h2>Selamat Datang! <?=$functions->getSession("fullname")?> (<?=$functions->getSession("userType")?>)</h2>
    <a href="create.php"><button type="button">Add New Post</button></a>
    <a href="logout.php" onClick="return confirm('Are you sure you want to logout?')"><button type="button">Logout</button></a>
    <table border="1">
        <thead>
            <tr>
                <th>id</th>
                <th>Title</th>
                <th>Desc</th>
                <th>Posted Date</th>
                <th>Posted By</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if($functions->rowCount("blogs") > 0) {
                $i = 1;
                foreach($functions->fetchAll("blogs") as $row) { ?>
                    <tr>
                        <td><?=$i?></td>
                        <td><?=$row['title']?></td>
                        <td><?=$row['description']?></td>
                        <td><?=date_format(date_create($row['postedDate']), "d M Y")?></td>
                        <td><?=$row['postedBy']?></td>
                        <td><a href="edit.php?id=<?=$row['id']?>">Edit</a> | <a href="delete.php?id=<?=$row['id']?>" onClick="return confirm('Are you sure you want to delete?')">Delete</a></td>
                    </tr>
               <?php $i++; }
            } else { ?>
                <tr><td colspan='5'><center>No Data Avaliable</center></td></tr>";
            <?php
            }?>
        </tbody>
    </table>
</div>

</body>
</html>
