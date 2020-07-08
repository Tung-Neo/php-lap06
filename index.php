<?php
$_SESSION['username'] = 'Admin';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>My Portfolio</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900|Cormorant+Garamond:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
<header>
    <a href="index.html" class="header-brand">mmtuts</a>
    <nav>
        <ul>
            <li><a href="portfolio.html">Portfolio</a></li>
            <li><a href="about.html">About me</a></li>
            <li><a href="contact.html">Contact</a></li>
        </ul>
        <a href="cases.html" class="header-cases">Cases</a>
    </nav>
</header>
<main>
    <section class="gallery-links">
        <div class="wrapper">
            <h2>Gallery</h2>
            <div class="gallery-container">
                <?php
                include_once 'includes/dbh.inc.php';
                $sql = "select * from gallery order by orderGallery desc";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)){
                    echo "SQL statemnet failed!";
                }else{
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    while ($row = mysqli_stmt_get_result($stmt)){
                        echo '<a href="#">
                            <div style="background-image: url(img/gallery/'.$row["imgFullNameGallery"].');"></div>
                            <h3>'.$row["titleGallery"].'</h3>
                            <p>'.$row["descGallery"].'</p>
                        </a>';
                    }
                }
                ?>
            </div>
            <?php
            if (isset($_SESSION['username'])){
                echo '<div class="gallery-upload">
                    <h2>Upload</h2>
                    <form action="includes/gallery-upload.inc.php" method="post" enctype="multipart/form-data">
                        <input type="text" name="filename" placeholder="File name...">
                        <input type="text" name="filetitle" placeholder="Image title...">
                        <input type="text" name="filedesc" placeholder="Image description...">
                        <input type="file" name="file">
                        <button type="submit" name="submit">Upload</button>
                    </form>
            </div>';
            }
            ?>
        </div>
    </section>
</main>
</body>
</html>