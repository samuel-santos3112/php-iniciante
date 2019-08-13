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
            $idade = $row["idade"];
            $email = $row["email"];

            echo "Nome: ".$name."<br/>";
            echo "Idade: ".$idade."<br/>";
            echo "E-mail: ".$email."<br/>";
        }
    }


    //Inserindo registros
    //$sql = "INSERT INTO Usuario (nome, email, idade) VALUES ('Vitor','vitor123@gmail.com',22)";
    //if (mysqli_query($con, $sql)) {
    //  echo "New record created successfully";
    //} else {
    //    echo "Error: " . $sql . "<br>" . mysqli_error($con);
    //}
    //mysqli_close($con);
    
    //Deletando registros
    //$nome = 'Vitor';
    //$sql = "DELETE FROM Usuario where nome = '$nome'";
    //if(mysqli_query($con, $sql)){
    //    echo "$nome foi apagado!";
    //} else {
    //    echo "Error: " . $sql . "<br>" . mysqli_error($con);
    //}
    //mysqli_close($con);
    $nome = 'Samuel Souza';
    $email = 'saamuel_live@hotmail.com';
    $idade = 21;
    $id = 1;
    $sql = "UPDATE Usuario SET nome = $nome, email = $email, idade = $idade WHERE id = $id";
    if (mysqli_query($con, $sql)) {
      echo "Record updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }
    mysqli_close($con);
 ?>
 </body>
</html>