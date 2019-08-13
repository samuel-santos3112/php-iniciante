<html>
 <head>
  <title>Operadores Matemáticos Básicos</title>
 </head>
 <body>
 <?php
    // Adição
    $numero1 = 4;
    $numero2 = 5;
    echo "ADIÇÃO\n $numero1 + $numero2 = ";
    $soma = $numero1+$numero2;
    echo "$soma";
  ?>
<br>
  <?php
    // Subtração
    $numero1 = 5;
    $numero2 = 4;
    echo "SUBTRAÇÃO\n $numero1 - $numero2 = ";
    $resultado = $numero1-$numero2;
    echo "$resultado"
  ?>
<br>
    <?php
    // Divisão
    $numero1 = 4;
    $numero2 = 2;
    echo "DIVISÃO\n $numero1 / $numero2 = ";
    $resultado = $numero1/$numero2;
    echo "$resultado"
    ?>
<br>
    <?php
    // Multiplicação
    $numero1 = 3;
    $numero2 = 4;
    echo "MULTIPLICAÇÃO\n $numero1 * $numero2 = ";
    $resultado = $numero1*$numero2;
    echo "$resultado"

    ?>
<br>
    <?php
    // Módulo 
    $numero1 = 7;
    $numero2 = 3;
    echo "MÓDULO\n $numero1 % $numero2 = ";
    $resultado = $numero1 % $numero2;
    echo "$resultado" 
    ?>
<br>
    <?php
    // Potência
    $numero = 2;
    $potencia = 2;
    echo "O número $numero elevado a potencia $potencia é = ";
    $resultado = $numero ** $potencia;
    echo "$resultado"
    ?>
 </body>
</html>