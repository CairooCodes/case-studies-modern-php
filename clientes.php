<?php
require "db_config.php";

// Obter a lista de clientes
$clientes = obterClientes();

// Função para obter a lista de clientes
function obterClientes()
{
  global $pdo;
  $stmt = $pdo->prepare("SELECT * FROM products");
  $stmt->execute();
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Lista de Clientes</title>
</head>

<body>
  <h1>Lista de Clientes</h1>
  <a href="adicionar_cliente.php">Adicionar Cliente</a>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>E-mail</th>
        <th>Telefone</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($clientes as $cliente) : ?>
        <tr>
          <td><?php echo $cliente['id']; ?></td>
          <td><?php echo $cliente['nome']; ?></td>
          <td><?php echo $cliente['email']; ?></td>
          <td><?php echo $cliente['telefone']; ?></td>
          <td>
            <a href="editar_cliente.php?id=<?php echo $cliente['id']; ?>">Editar</a>
            <a href="./controllers/delete_client.php?id=<?php echo $cliente['id']; ?>">Excluir</a>
          </td>
        </tr>
      <?php endforeach ?>
    </tbody>
  </table>
</body>

</html>