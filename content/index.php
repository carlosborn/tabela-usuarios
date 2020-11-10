<?php

if (!isset($_GET['usuario'])) {
    printf("Informe o usuario do banco de dados!");
} else if (!isset($_GET['senha'])) {
    printf("Informe a senha do banco de dados!");
} else if (!isset($_GET['host'])) {
    printf("Informe o IP para conexão com banco de dados!");
} else {
    $username = $_GET['usuario'];
    $password = $_GET['senha'];
    $host = $_GET['host'];

    $dir = 'mysql:host=' . $host . ';dbname=trabalho';
    try {
        $conn = new PDO($dir, $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = "SELECT * FROM usuarios";

        $dados = $conn->query($query);
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Usuários</title>
</head>

<body>

    <table border=1>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Status</th>
        </tr>

        <?php
        foreach ($dados as $dado) {

        ?>
            <tr>
                <td>
                    <?php
                    echo $dado['id'];
                    ?>
                </td>
                <td>
                    <?php
                    echo $dado['nome'];
                    ?>
                </td>
                <td>
                    <?php
                    if ($dado['status'] === 'a') {
                        echo 'Ativo';
                    } else {
                        echo 'Inativo';
                    }
                    ?>
                </td>
            <?php
        }
            ?>
            </tr>


    </table>

</body>

</html>