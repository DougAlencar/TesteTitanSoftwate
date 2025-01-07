<?php
session_start();
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header('Location: login.php');
    exit();
}

$conn = new mysqli('localhost', 'root', 'Doug@le5728', 'php_bd');
if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

$sql = "SELECT * FROM tbl_funcionario";
$result = $conn->query($sql);

echo "<h1></h1>";
echo "<a href='cadastro_empresa.php'>Cadastrar Empresa</a> | <a href='cadastro_funcionario.php'>Cadastrar Funcionário</a>";

while ($row = $result->fetch_assoc()) {
    echo "<p>{$row['nome']} - {$row['email']}</p>";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }
        h1 {
            color: #00508d;
        }
        a {
            color: #00508d;
            text-decoration: none;
            margin: 0 10px;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

</html>
