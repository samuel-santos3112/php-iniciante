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
        <meta charset="UTF-8">
        <title>Agenda de contatos</title>
    </head>
    <body>
        <form action="?act=save" method="POST" name="form1">
            <h1>Agenda de contatos</h1>
            <hr>
            <input type="hidden" name="id" <?php 
            if (isset($id) && $id != null || $id != ""){
                echo "value=\"{$id}\"";
            }
            ?>/>
            Nome:
            <input type="text" name="nome" <?php 
            if (isset($nome) && $nome != null || $nome != ""){
                echo "value=\"{$nome}\"";
            }
            ?>/>
            E-mail:
            <input type="text" name="email"<?php 
            if (isset($email) && $email != null || $email != ""){
                echo "value=\"{$email}\"";
            }
            ?>/>
            Celular:
            <input type="text" name="celular" <?php 
            if (isset($celular) && $celular != null || $celular != ""){
                echo "value=\"{$celular}\"";
            }
            ?>/>
            <input type="submit" value="Salvar"/>
            <input type="reset" value="Limpar">
            <hr>
        </form>
        <table border="1" width="100%" >
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
                                ."</td><td><center><a href=\"?act=update&id=" . $resultSet->id . "\">[Alterar]</a>"
                                ."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
                                ."<a href=\"?act=delete&id=" .$resultSet->id . "\">[Excluir]</a></center></td>";
                            echo "</tr>";
                            
                            
                        }
                    }else {
                        echo "Erro: Não foi possível recuperar os dados do banco de dados";
                    }
                }catch(PDOException $erro){
                    echo "Erro: ".$erro->getMessage();
                }?>
        </table>
    </body>
</html>

