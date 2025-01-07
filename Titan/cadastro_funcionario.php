<?php
$conn = new mysqli('localhost', 'root', 'Doug@le5728', 'php_bd');

$empresas = $conn->query("SELECT * FROM tbl_empresa");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];
    $id_empresa = $_POST['id_empresa'];

    if (empty($nome) || empty($cpf) || empty($email) || empty($id_empresa)) {
        echo "Todos os campos são obrigatórios!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Email inválido!";
    } else {
        $sql = "INSERT INTO tbl_funcionario (nome, cpf, email, id_empresa) 
                VALUES ('$nome', '$cpf', '$email', '$id_empresa')";

        if ($conn->query($sql) === TRUE) {
            echo "Funcionário cadastrado com sucesso!";
        } else {
            echo "Erro ao cadastrar funcionário!";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Funcionário</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            padding: 20px;
        }
        .container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        .input-field {
            margin-bottom: 15px;
        }
        .input-field label {
            font-size: 14px;
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        .input-field input, select {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        button {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            background-color: #00508d;
            color: white;
            border: none;
            border-radius: 5px;
        }
        button:hover {
            background-color: #003f6f;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Cadastro de Funcionário</h2>
        <form method="POST" action="cadastro_funcionario.php">
            <div class="input-field">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome" required>
            </div>
            <div class="input-field">
                <label for="cpf">CPF:</label>
                <input type="text" name="cpf" id="cpf" required>
            </div>
            <div class="input-field">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div class="input-field">
                <label for="id_empresa">Empresa:</label>
                <select name="id_empresa" required>
                    <?php while ($row = $empresas->fetch_assoc()): ?>
                        <option value="<?php echo $row['id_empresa']; ?>"><?php echo $row['nome']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <button type="submit">Cadastrar</button>
        </form>
    </div>
</body>
</html>

<?php
$conn->close();
?>
