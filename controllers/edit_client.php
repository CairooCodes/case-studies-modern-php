<?php
// Conectar ao banco de dados usando a classe PDO
$pdo = new PDO('mysql:host=localhost;dbname=miraceu', 'root', '');

// Verificar se o ID do cliente foi enviado
if (!empty($_GET['id'])) {
  // Obter o ID do cliente
  $id = $_GET['id'];

  // Verificar se o formulário foi enviado
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obter os dados do formulário
    $name = $_POST['name'];
    $price = $_POST['price'];
    $categorie_id = $_POST['categorie_id'];

    // Atualizar o cliente
    atualizarCliente($id, $name, $price, $categorie);

    // Redirecionar para a página de lista de clientes
    header('Location: listar_clientes.php');
    exit();
  }

  // Obter o cliente a ser editado
  $cliente = obterCliente($id);
} else {
  // Redirecionar para a página de lista de clientes se o ID do cliente não for fornecido
  header('Location: clientes.php');
  exit();
}

// Função para obter um cliente pelo ID
function obterCliente($id)
{
  global $pdo;
  $stmt = $pdo->prepare("SELECT * FROM products WHERE id = :id");
  $stmt->bindParam(':id', $id);
  $stmt->execute();
  return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Função para atualizar um cliente
function atualizarCliente($id, $name, $price, $categorie_id)
{
  global $pdo;
  $stmt = $pdo->prepare("UPDATE products SET name = :name, price = :price, categorie_id = :categorie_id WHERE id = :id");
  $stmt->bindParam(':name', $name);
  $stmt->bindParam(':price', $price);
  $stmt->bindParam(':categorie_id', $categorie_id);
  $stmt->bindParam(':id', $id);
  $stmt->execute();
}
