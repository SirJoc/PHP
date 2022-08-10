<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="style.css">
    <head>
        <meta charset="utf-8">
    </head>
    <body>

    <?php
            class Calculator {
                private $num1;
                private $num2;
                function __construct()
                {
                    echo "Bienvenido a la nueva calculadora";
                    $this->num1 = 0;
                    $this->num2 = 0;
                }
                
                /* Get */
                function getNum1(){
                    return $this->num1;
                }
                function getNum2(){
                    return $this->num2;
                }

                /* Set */
                function setNum1($num){
                    $this->num1 = $num;
                }
                function setNum2($num){
                    $this->num2 = $num;
                }
                
                function operate($op) {
                    switch($op){
                        case '+': 
                            return $this->num1 + $this->num2;
                            break;
                        case '-': 
                            return $this->num1 - $this->num2;
                            break;
                        case '*': 
                            return $this->num1 * $this->num2;
                            break;
                        case '/': 
                            if ($this->num2 != 0){
                                return $this->num1 / $this->num2;
                            }else {
                                echo "Ingrese un operador valido";
                            }
                            
                            break;
                        default: 
                            echo "Ingrese un operador valido";
                            break;

                    }
                }

                
            }
            $objeto = new Calculator();
            $num1 = $_POST["num1"];
            $num2 = $_POST["num2"];
            $operator = $_POST["operator"];
            $objeto->setNum1($num1);
            $objeto->setNum2($num2);
            $resultado = $objeto->operate($operator);
        ?>

        <div class="to_do">
            <div class="Formulario">
                <form action="home.php" method="POST">
                    Numero 1: <input type="number" name="num1" step="0.01">
                    <br>
                    Operacion: <input class="op" type="text" name="operator">
                    <br>
                    Numero 2: <input type="number" name="num2"  step="0.01">
                    <br>
                    <input class="submit" type="submit">
                </form>
            </div>
            
            

            <div class="resultado">
                <?php
                    echo $resultado;
                ?>
            </div>
        </div>
        
    </body>
</html>
