<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TBM</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    <header>
        <a class="homeLinkTitle" href="index.php">
            <h1 class="main-title">The Books Manager</h1>
        </a>
    </header>

    <?php
    if(isset($_GET["message"])){
        $message = $_GET["message"];
        echo "<p class='message'>$message</p>";
    }

    if(isset($_GET["p"])){
        $page = $_GET["p"];
        if($page == "home"){
            include_once("pages/home.html");
        }elseif($page == "new"){
            include_once("pages/new.html");
        }elseif($page == "view"){
            include_once("pages/view.html");
        }
    }else{
        include_once("pages/home.html");
    }
    ?>

</body>
</html>