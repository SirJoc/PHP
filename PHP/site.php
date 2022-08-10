<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>
    <body>
        <?php
            $characterName = "John";
            $characterAge = 35;
            echo("Hello world");
            echo "<hr>";
            echo "<p>This is my paragraph $characterName </p>";
            echo "<p>This is my paragraph $characterAge </p>";
            echo $characterAge + 0.25;
            echo strtolower($characterName);

            
        ?>
        <form action="site2.php" method="get">
            Name: <input type="text" name="Username">
           <br>
            <input type="submit">
        </form>

        <form action="site.php" method="post">
            Apples: <input type="checkbox" name="fruits[]" value="apples"> <br>
            Oranges: <input type="checkbox" name="fruits[]" value="oranges"> <br>
            Pears: <input type="checkbox" name="fruits[]" value="pears">
            <br>
            <input type="submit">
        </form>
        <br>
        <h3>Fruits selected</h3>
        <?php
            $fruits = $_POST["fruits"];
            echo $fruits[1];
            echo "<hr> <br>";
            if(isset($_GET["Username"])):
                echo $_GET["Username"];
            endif;
        ?>
        <button>
                <a href="site2.php">Go to Site2</a>
        </button>

        <br><hr><br>
        <h3>Associative Arrays</h3>
        <br>
        <form action="site.php" method="get">
            <input type="text" name="name">
            <input type="submit">
        </form>
        <?php
            
            $grades = array("Jim"=>"A+", "Juan"=>"A+");
            echo $grades[$_GET["name"]];
        ?>
        <hr>
        <h3>If statements</h3>
        <?php
            $isMale = false;
            $isTall = false;
            if ($isMale && $isTall) {
                echo "Esta bien";
            }elseif($isMale && !$isTall) {
                echo "No hay problema ok";
            }else {
                echo "Creo que está bien también";
            }
        ?>
        <hr>
        <h3>Calculator</h3>
        <button>
            <a href="site3.php">Calculator</a>
        </button>
    </body>
</html>