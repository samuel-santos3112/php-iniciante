
<html>
 <head>
 </head>
 <body>
     
 </body>
 <?php
    //Sample Database Connection Syntax for PHP and MySQL.

    //Connect To Database

    $hostname="localhost";
    $username="root";
    $password="";
    $dbname="pessoa";
    $usertable="usuario";
    $yourfield = "nome";

    $con = mysqli_connect($hostname,$username, $password);
    //ou desconexão ("html>script language='JavaScript'>alert(“Não foi possível se conectar ao banco de dados! Tente novamente mais tarde.'),history.go(-1)/script>/html>");
    mysqli_select_db($con,$dbname);

    # Verifique se o registro existe

    $query = "SELECT * FROM $usertable";

    $result = mysqli_query($con,$query);

    if($result){
        while($row = mysqli_fetch_array($result)){
            $name = $row["$yourfield"];
            echo "Nome: ".$name."<br/>";
        }
    }
 ?>
 </body>
</html>