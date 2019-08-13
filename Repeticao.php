<html>
 <head>
  <title>Estrutura de repetição</title>
 </head>
 <body>
 <?php
 // IMPRIMINDO VETOR.
    //$vetor = array(1,2,3,4,5);
    //foreach($vetor as $item)
    //{
        //echo $item;
    //}
 ?>

 <?php
    //Tabuada de 1 a 10
    //for ($i = 1; $i <=10; $i++ ){
    //    for($j = 1; $j <=10; $j++){
    //        $soma = $i * $j;
    //        echo ("$i x $j = $soma <br>");
    //    }
    //    echo("<br>");
    //}
 ?>

 <?php
    //Calculo fatorial
    $fatorial = 6;
    $resultado = 1;
    for($i = $fatorial; $i > 1; $i--){
        $resultado *= $fatorial; 
      //Calculo de cima sem resumir
      //$resultado = $resultado*$fatorial;
        $fatorial--;
        echo("$resultado<br>");
	}
    echo("$resultado");
    
 ?>
 </body>
</html>