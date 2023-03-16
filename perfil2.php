<?php
session_start();
require "db_config.php";

if (!isset($_SESSION['id'])) {
  header('Location: login.php');
  exit;
}

// obter o ID do usuário a partir do cookie ou da sessão
$user_id = $_SESSION['id'] ?? null;

// buscar os dados do usuário no banco de dados
$sql = "SELECT nome, email, imagem, imagem_tipo, imagem_conteudo FROM usuarios WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id]);
$user = $stmt->fetch();

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Perfil do Usuário</title>
</head>

<body>
  <h1>Perfil do Usuário</h1>
  <?php
  echo "<p>Nome: " . $user['nome'] . "</p>";
  echo "<p>Email: " . $user['email'] . "</p>";

  // exibir a imagem do usuário, se ela existir
  // if (!empty($user['imagem'])) {
  //   $imagem = base64_encode($user['imagem']);
  //   echo "<img src='data:image/jpeg;base64," . $imagem . "'>";
  // }
  ?>
  <h2>Imagens</h2>
  <?php foreach ($imagens as $imagem) : ?>
    <img src="data:<?php echo $user['imagem_tipo']; ?>;base64,<?php echo base64_encode($user['imagem_conteudo']); ?>" alt="Imagem do usuário">
  <?php endforeach; ?>
</body>

</html>