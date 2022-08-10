<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">

    </head>
    <body>
        <header></header>
        <main>
            <?php
                if(isset($_GET["Username"])):
                    echo $_GET["Username"];
                endif;
            ?>

            <button>
                <a href="site.php"> Home </a>
            </button>
            <hr>
            <br>
            <h3>Funcitons in Php</h3>
            <br>
            <?php
                function values($val){
                    return $val + 1;
                }
                $variable = values(4);
                echo "<p>Aqui esta el valor: $variable</p>";
            ?>
        </main>
        <footer></footer>
    </body>
</html>