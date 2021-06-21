
<?php

$sql = "SELECT * FROM blog ORDER BY id DESC";
$result = mysqli_query($db, $sql);

while ($row = mysqli_fetch_array($result)){
    $title = $row['title'];
    $subtitle = $row['subtitle'];
    $content = $row['content'];
?>
<h2><?php echo $title; ?> - <small><?php echo $subtitle; ?></small></h2>
    <p><?php echo $content; ?> </p>
<hr />

<?php
}
?>
