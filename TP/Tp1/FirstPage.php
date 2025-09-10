<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My First Page</title>
    <style>
        a{
            text-decoration: none;
            color: white;
            margin: 0 10px;
            font-weight: bold;
        }
        .container{
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: gray;
        }
        .logo{
            width: 60px;
            height: 60px;
            margin-right: 10px;
            border: 2px solid #888;
            border-radius: 8px;
        }
        .brandName{
            font-size: 1.5em;
            font-family: monospace;
            background: #333;
            color: #eee;
            padding: 6px 16px;
            border-radius: 6px;
        }
        nav.menu {
            padding: 10px;
        }
    </style>
</head>
<body>
    <?php include("band_generators.php"); ?>
    <?php
        $bandName = generate_bandname();
        $logo = generate_bandlogo();
        $mainImage = "images.jpg";
    ?>
    <div class="container">
        <div style="display:flex;align-items:center;">
            <img class="logo" src="<?php echo $logo; ?>" alt="Logo">
            <span class="brandName"><?php echo $bandName; ?></span>
        </div>
        <nav class="menu">
            <a href="FirstPage.php">Home</a>
            <a href="brand.php">Brand</a>
            <a href="">Setlist</a>
            <a href="">Contact</a>
        </nav>
    </div>
    <img src="<?php echo $mainImage; ?>" alt="Band" style="width:100%;height:auto;object-fit:cover;">
    <footer style="background:#222;color:#fff;padding:6px 18px;font-size:0.95em;">
        Nous sommes le <?php echo date('d F Y'); ?> | Il est <?php echo date('H:i:s'); ?>
    </footer>
</body>
</html>
