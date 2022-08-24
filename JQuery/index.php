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
    <div class="gc_marketplace__combination-tags gc_marketplace__combination-sizes">
        <div class="gc_marketplace__combination-title">
            <span class="title">Tallas</span>
        </div>
        <div class="scrollcontainer">
            <div class="split left">
                <?php
                    for ($i = 0; $i < 10; $i++){
                        if($i != 9){
                            echo '<div class="gc_marketplace__combination-attribute">
                                        <label class="gc_marketplace__combination-label">
                                            <input type="checkbox" value="0">
                                            <span class="gc_marketplace__combination-text">Celeste intermedio</span>
                                        </label>
                                    
                               </div>';
                        }else {
                            echo '<div class="gc_marketplace__combination-attribute">
                                        <label class="gc_marketplace__combination-label">
                                            <input type="checkbox" value="0" id="celeste_intermedio">
                                            <span class="gc_marketplace__combination-text">Celeste intermedio</span>
                                        </label>
                               </div>';
                        }

                    }
                ?>

            </div>
            <div class="split right">
                <?php
                for ($i = 0; $i < 10; $i++){
                echo '<div class="gc_marketplace__combination-attribute">
                        <label class="gc_marketplace__combination-label">
                            <input type="checkbox" value="0">
                            <span class="gc_marketplace__combination-text">Celeste intermedio</span>
                        </label>
                       </div>';
                }
                ?>
            </div>

        </div>
    </div>

</body>
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="scripts.js"></script>
</html>