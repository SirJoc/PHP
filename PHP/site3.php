<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <main>
            <h2>Calculator</h2>
            <p>This calculator was made with if statements and functions"</p>
            <form action="calculator.php" method="POST">
                <input type="number" step="0.01" name="num1">
                <input type="text" name="op">
                <input type="number" step="0.01" name="num2">
                <input type="submit">
            </form>

            <?php
                function calculate($num1, $op, $num2) {
                    if ($op == "+"){
                        return $num1 + $num2;
                    } elseif ($op == "-"){
                        return $num1 - $num2;
                    } elseif ($op == "*"){
                        return $num1 * $num2;
                    } elseif ($op == "/"){
                        return $num1 / $num2;
                    } else {
                        return "One of the statements is incorrect";
                    }
                }
                $solution = null;
                if (isset($_POST["num1"]) && $_POST["op"] && $_POST["num2"]){
                    $solution = calculate($_POST["num1"],$_POST["op"],$_POST["num2"]);
                }
                
                echo "<br>The answer is $solution";
            ?>

            <h3>Switch statement</h3> 
            <p>Here we go!</p>
            <form action="calculator.php" method="post">
                Grade: <input type="number" step="0.1" name="grade">
                <input type="submit">
            </form>

            <?php
                $grade = $_POST["grade"];

                switch($grade){
                    case $grade >= 15: 
                        echo "you did amazing";
                        break;
                    case $grade <= 15: 
                        echo "you did bad";
                        break;
                    default:
                        echo "Invalid grade";
                }
             ?>

            <hr>
            <h3>While loop</h3>
            <?php
            $index = 0;
            while($index < 5) {
                $index++;
                echo "$index <br>";
            }
            ?>

            <h3>For loops</h3>
            <?php
                for($index = 1; $index < 4; $index++){
                    echo $index; 
                    echo "<br>";
                }
            ?>

            <?php
            //sending parameters by doing this
            $title = "hola buenas tardes";
            // include "file.html or php"
            class BOOK {
                private $num;
                function __construct()
                {
                    
                }

                function makeSalad(){

                }
            }

            class action extends BOOK {
                
            }

            ?>
        </main>
    </body>
</html>