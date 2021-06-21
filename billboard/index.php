<?php
session_start();
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
}
session_abort();
if (isset($_SESSION['username'])) {
    $username = ucfirst($_SESSION['username']);

    if ($_POST['submit']) {
        $title = $_POST['title'];
        $subtitle = $_POST['subtitle'];
        $content = $_POST['content'];
        include_once("server.php");
        $sql = "INSERT INTO blog (title, subtitle, content) VALUE ('$title', '$subtitle','$content')";
        mysqli_query($db, $sql);
        echo "Blog entry posted";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div class="header">
    <h2>Home Page</h2>
</div>
<div class="content">
    <!-- notification message -->
    <?php if (isset($_SESSION['success'])) : ?>
        <div class="error success" >
            <h3>
                <?php
                echo $_SESSION['success'];
                unset($_SESSION['success']);
                ?>
            </h3>
        </div>
    <?php endif ?>

    <!-- logged in user information -->
    <?php  if (isset($_SESSION['username'])) : ?>
        <p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
        <p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>
    <?php endif ?>

    <form method="post" action="index.php">
        Title: <input type="text" name="title"/> <br />
        Subtitle: <input type="text" name="subtitle"/><br />
        Content: <textarea name="content"></textarea><br />
        <input class="btn" type="submit" name="submit" value="Post Blog Entry" />
    </form>
</div>
<?php include('product.php') ?>

</body>
</html>