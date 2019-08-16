<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $id = (isset($_POST["id"]) && $_POST["id"] != null) ? $_POST["id"] : "";
        $nome = (isset($_POST["nome"]) && $_POST["nome"] != null) ? $_POST["nome"] : "";
        $email = (isset($_POST["email"]) && $_POST["email"] != null) ? $_POST["email"] : "";
        $celular = (isset($_POST["celular"]) && $_POST["celular"] != null) ? $_POST["celular"] : NULL;
    } else if (!isset($id)) {
        $id = (isset($_GET["id"]) && $_GET["id"] != null) ? $_GET["id"] : "";
        $nome = NULL;
        $email = NULL;
        $celular = NULL;
    }
        
?>

<?php
 try {
     $conexao = new PDO("mysql:host=127.0.0.1; dbname=crudsimples", "root","");
     $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 } catch (PDOException $erro) {
    echo "Erro na conexão:" . $erro->getMessage();
 }

 if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $nome != "") {
     try {
         if($id != ""){
             $stmt = $conexao->prepare("UPDATE contatos SET nome=?, email=?,celular=? WHERE id=?");
             $stmt->bindParam(4,$id);
         }else{
            $stmt = $conexao->prepare("INSERT INTO contatos (nome,email,celular) VALUES (?, ?, ?)");
         }   
         $stmt->bindParam(1,$nome);
         $stmt->bindParam(2,$email);
         $stmt->bindParam(3,$celular);
        if ($stmt->execute()) {
            if ($stmt->rowCount()> 0) {
                echo "Dados cadastrados com sucesso!";
                $id = null;
                $nome = null;
                $email = null;
                $celular = null;
            }else{
                echo "Erro ao tentar efetivar cadastro";
            }
        }else {
            throw new PDOException("Erro: Não foi possível executar a declaração sql");
        }
     }catch(PDOException $erro) {
         echo "Erro: " .$erro->getMessage();
     }
 }
 if(isset($_REQUEST["act"]) && $_REQUEST["act"] == "update" && $id != ""){
     try{
         $stmt = $conexao->prepare("SELECT * FROM contatos WHERE id = ?");
         $stmt->bindParam(1,$id, PDO::PARAM_INT);
         if ($stmt->execute()) {
             $resultSet = $stmt->fetch(PDO::FETCH_OBJ);
             $id = $resultSet->id;
             $nome = $resultSet->nome;
             $email = $resultSet->email;
             $celular = $resultSet->celular;
         }else{
             throw new PDOException("Erro: Não foi possível executar a declaração sql");
         }
     }catch (PDOException $erro) {
         echo "Erro: ".$erro->getMessage();
     }
 } 

 if(isset($_REQUEST["act"]) && $_REQUEST["act"] == "delete" && $id != "") {
     try {
         $stmt = $conexao->prepare("DELETE FROM contatos WHERE id=?");
         $stmt->bindParam(1,$id,PDO::PARAM_INT);
         if ($stmt->execute()) {
             echo "Registro foi excluído com êxito";
             $id = null;   
         }else {
             throw new PDOException("Erro: Não foi possível executar a declaração sql");
         }
     }catch (PDOException $erro) {
         echo "Erro: ".$erro->getMessage();
     }
 }
?>



<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="toastify.js">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">    
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>Agenda de contatos</title>
    </head>
    <body>
    <a class="click-action" ng-click="simpleAutoclose()"></a>
        <div class="container-fluid">
            <form action="?act=save" method="POST" name="form1">
                
                <h1>Agenda de contatos</h1>
                <hr>
                <div class="form-group">
                   
                    <div class="form-row">
                        <input type="hidden" name="id"  <?php 
                        if (isset($id) && $id != null || $id != ""){
                            echo "value=\"{$id}\"";
                        }
                        ?>/>
                        
                            <div class="form-column">
                                <input type="text" name="nome" placeholder="Nome" style="width: 15cm" class="form-control" <?php 
                                if (isset($nome) && $nome != null || $nome != ""){
                                    echo "value=\"{$nome}\"";
                                }
                                ?>/>
                                
                                <input type="text" name="email" placeholder="E-mail" style="width: 15cm"  class="form-control"<?php 
                                if (isset($email) && $email != null || $email != ""){
                                    echo "value=\"{$email}\"";
                                }
                                ?>/>
                            
                                <input type="text" name="celular" placeholder="Celular" style="width: 8cm"  class="form-control" <?php 
                                if (isset($celular) && $celular != null || $celular != ""){
                                    echo "value=\"{$celular}\"";
                                }
                                ?>/>
                            </div>
                        
                    </div>
                  
                    <br> 
                    <div class="form-row">   
                        <input type="submit" class="btn btn-primary" value="Salvar"/>
                            &nbsp;
                        <input type="reset" class="btn btn-primary" value="Limpar">
                    </div>
                  
                </div>
                <hr>
            </form>
        </div>
        <div class="container" style="widht: 10">    
            <div class="table-responsive">
                <table class="table table-striped table-bordered" >
                    <tr>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Celular</th>
                        <th>Ações</th>
                    </tr>
                    <?php
                        try {
                            $stmt = $conexao->prepare("SELECT * FROM contatos");
                            if ($stmt->execute()) {
                                while($resultSet = $stmt->fetch(PDO::FETCH_OBJ)){
                                    echo "<tr>";
                                    echo "<td>".$resultSet->nome."</td><td>".$resultSet->email."</td><td>".$resultSet->celular
                                        ."</td><td><center><a class=\"btn btn-primary btn-md\" href=\"?act=update&id=" . $resultSet->id . "\">Alterar</a>"
                                        ."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
                                        ."<a onclick=\"excluir_registro(event);\" class=\"btn btn-primary btn-md\" href=\"?act=delete&id=" .$resultSet->id . "\">Excluir</a></center></td>";
                                    echo "</tr>";
                                }
                            }else {
                                echo "Erro: Não foi possível recuperar os dados do banco de dados";
                            }
                        }catch(PDOException $erro){
                            echo "Erro: ".$erro->getMessage();
                        }?>
                </table>
            </div>
        </div>    
        <style>
        h1{
             text-align:center
        }
        </style>
  
        <script src="main2.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="main.js"></script>
        <script src="toastify.min.js"></script>
        <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.3/angular.min.js"></script>
    </body>
</html>

