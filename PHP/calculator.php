<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="../style/style.css">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <main>
            <h1>Calculadora ()</h1>
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
                    


                    function plus(){
                        return $this->num1 + $this->num2;
                    }
                    function minus(){
                        return $this->num1 - $this->num2;
                    }
                    function multiply(){
                        return $this->num1 * $this->num2;
                    }
                    function divide(){
                        return $this->num1 / $this->num2;
                    }
                }

                $cal = new Calculator();
            ?>
            <div class="label-numeros">
                <div>
                    <?php echo $cal->getNum1(); ?>
                </div>
                <div>
                    <?php echo $cal->getNum2(); ?>
                </div>
            </div>
            <div class="calButton">
                <form action="calculator.php" method="get">
                    <button type="submit" name="numero[]" value="1">1</button>
                    <button type="submit" name="numero[]" value="2">2</button>
                    <button name="numero" value="3">3</button>
                    <button name="operation" value="+" style="background-color: rgb(143, 139, 129);">+</button>
                    <button name="numero" value="4">4</button>
                    <button name="numero" value="5">5</button>
                    <button name="numero" value="6">6</button>
                    <button name="operation" value="-" style="background-color: rgb(143, 139, 129);">-</button>
                    <button name="numero" value="7">7</button>
                    <button name="numero" value="8">8</button>
                    <button name="numero" value="9">9</button>
                    <button name="operation" value="*" style="background-color: rgb(143, 139, 129);">*</button>
                    <button name="numero" value="0">0</button>
                    <button name="borrar"  value="borrar">C</button>
                    <button name="m1"  value="<-"><-</button>
                    <button name="operation" value="/" style="background-color: rgb(143, 139, 129);">/</button>
                    
                </form>
            </div>
            

            <?php
                $num1 = "";
                if (isset($_GET["numero"])){
                    $numero = $_GET["numero"];
                    echo "Num1: <label>$numero</label>";
                    for ($i = 0; $i < count($numero); $i++){
                        echo $numero[$i];
                        echo "<br>";
                    }

                    if(isset($_GET["operation"])){
                        $cal->setNum2((int)$numero);


                    }else {
                        echo "hola";
                        $cal->setNum1((int)$numero);
                        echo $cal->getNum2();
                        $num1.=$numero;
                        echo $num1;
                    }
                }
                if (isset($_GET["borrar"])){
                    $borrar = $_GET["borrar"];
                }
                if (isset($_GET["m1"])){
                    $m1 = $_GET["m1"];
                }
                
                
            ?>
        </main>
    </body>
</html>