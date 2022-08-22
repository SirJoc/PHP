<!DOCTYPE html>
<html>
    <head>
        
    </head>
    <body>
        <?php

            class Accesorios {
                private $gorra;
                private $mochila;
                function __construct()
                {
                    $this->gorra = false;
                    $this->mochila = false;
                }

                function getMochila() {
                    return $this->mochila;
                }

                function setMochila($data) {
                    $this->mochila = $data;
                }
            }
            class Característica {
                private $accesorio;
                function __construct()
                {
                    $this->accesorio = new Accesorios();
                }

                function getAccesorio() {
                    return $this->accesorio;
                }
            }

            $caracteristicas = []
        
        ?>

        <label for="pets">Choose your pets:</label>
        <div id="pets">
            <input type="checkbox" class="checksito" id="vehicle1" name="vehicle" value="Bike">
            <label for="vehicle1"> I have a bike</label><br>
            <input type="checkbox" class="checksito" id="vehicle2" name="vehicle" value="Car">
            <label for="vehicle2"> I have a car</label><br>
            <input type="checkbox" class="checksito" id="vehicle3" name="vehicle" value="Boat">
            <label for="vehicle3"> I have a boat</label><br><br>
        </div>
        
        
        <button id="submit">Get Selected Values</button>
    </body>
    <script src="main.js"></script>
</html>