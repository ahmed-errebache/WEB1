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
        .menu{
            padding: 10px;
        }
    </style>
</head>
<body>
    <?php 
        include("band_generators.php");
        $bandName = generate_bandname();
        $logo = generate_bandlogo();
        $mainImage = "images.jpg";
        $dakka = "dakka.jpeg";
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
    <div style="margin:30px 0; padding:20px; background:#f4f4f4; border-radius:8px;">
        <img src="<?php echo $dakka; ?>" alt="dakka marakchoa" style="width:25%;height:auto;object-fit:cover;display:block;margin:0 auto 20px auto;border-radius:12px;">
        <h2>Description du groupe</h2>
        <p><strong>Dakka Marrackech</strong> est un groupe musical passionné par la musique tradutionel du maroc. Leur style unique.</p>
    </div>
    <footer style="background:#222;color:#fff;padding:6px 18px;font-size:0.95em;">
        Nous sommes le <?php echo date('d F Y'); ?> | Il est <?php echo date('H:i:s'); ?>
    </footer>
</body>
</html>
