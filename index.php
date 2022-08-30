<?php 
    include_once 'config/Db.php';
    include_once 'object/Song.php';
    include_once 'object/Singer.php';
    $database = new Db();
    $db = $database->getConnection();
    $singerObj = new Singer($db);
    $singers = $singerObj->read();
    $singers_count = $singers->rowCount();
    $songObj = new Song($db);
    $songs = $songObj->read();
    $songs_count = $songs->rowCount();
?>
<html>
    <head>
        <style>
            td {
                border: 1px solid black;
                text-align: center;
                padding: 3px;
            }
        </style>
    </head>
    <h2>Welcome</h2>
    <h3>Singers</h3>
    <?php
    if ($singers_count>0) {
        echo "<table>
            <tr>
                <td>First name</td>
                <td>Last name</td>
                <td>Year started</td>
            </tr>";
        while ($row = $singers->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            echo "<tr><td>" . $row['name'] . "</td>";
            echo "<td>" . $row['lastname'] . "</td>";
            echo "<td>" . $row['startyear'] . "</td>";
            echo "<td> <a href='view_singer.html#" . $row['id'] . "'>View</a>";
            echo "<td> <a href='update_singer.html#" . $row['id'] . "'>Edit</a>";
            echo "<td> <a href='delete_singer.html#" . $row['id'] . "'>Delete</a>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No singers listed yet.</p>";
    }
    ?>
    <p><a href="add_singer.html"><button>Add a singer</button></a></p>
    <h3>Songs</h3>
    <?php
    if($songs_count>0) {
        echo "<table>
            <tr>
                <td>Title</td>
                <td>Artist</td>
                <td>Year</td>
            </tr>";
        while ($row = $songs->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            echo "<tr><td>" . $row['title'] . "</td>";
            echo "<td>" . $row['artist'] . "</td>";
            echo "<td>" . $row['year'] . "</td>";
            echo "<td> <a href='update_song.html#" . $row['id'] . "'>Edit</a>";
            echo "<td> <a href='delete_song.html#" . $row['id'] . "'>Delete</a>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No songs listed yet.</p>";
    }
    ?>
    <p><a href="add_song.html"><button>Add a song</button></a></p>
</html>