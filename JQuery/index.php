<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="style.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>

</head>
<body>
<div class="show_alert">
    Mostrar Alerta
</div>

<div class="gc_marketplace__combination-container">
    <div class="gc_marketplace__show-tags">
        <img src="assets/show.svg">
        <!-- <img src="assets/white_option.svg"> -->
    </div>
    <?php 
        for($int = 0; $int < 3; $int++){
            echo @include 'pages/test.php';
        }
    ?>

</body>
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="scripts.js"></script>
</html>