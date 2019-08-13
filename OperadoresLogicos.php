<html>
 <head>
  <title>Operadores Lógicos</title>
 </head>
 <body>
 <?php
// VERIFICANDO SE UM NÚMERO É PAR.
    $a = 2;
    if($a % 2 == 0)
    {
        echo "O número $a é par! ";
    }else {
        echo "O número $a é ímpar! ";
    }
 ?>
 <br>
 <?php
// VERIFICANDO SE UM NÚMERO É POSITIVO.
    $a = -1;
    if($a > 0 ){
        echo "O número $a é positivo! ";
    }else {
        echo "O número $a é negativo! ";
    }
 ?>
<br>
<?php
//VERIFICANDO QUAL MAIOR E SE HÁ IGUALDADE
    $a = 4;
    $b = 3;
    if ($a > $b){
        echo "O número $a é maior que o número $b";
    }else if ($a == $b){
        echo "O número $a é igual o número $b";
    }else{
        echo "O número $a é menor que o número $b";
    }
?>
<br>
<?php
    $a = 2;
    $b = 3; 
    if ($a % 2 == 0 and $b % 2 == 0){
        echo "Os dois números são pares! ";
    }else if ($a % 2 != 0 and $b % 2 != 0){
        echo "Os dois números são impares! ";
    }else {
        echo "Um dos números é impar.";
    }
    

?>
    
 </body>
</html>