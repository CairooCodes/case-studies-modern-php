<!DOCTYPE html>
<html>
<head>
  <title>Imagens</title>
</head>
<body>

<?php
// Conecta ao banco de dados
$pdo = new PDO('mysql:host=localhost;dbname=meubanco', 'root', 'root');

// Recupera as imagens do banco de dados
$stmt = $pdo->query("SELECT * FROM imagens");
$imagens = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Exibe as imagens em uma lista
foreach ($imagens as $imagem) {
  echo '<img src="data:image/jpeg;base64,' . $imagem['valor'] . '">';
}
?>

</body>
</html>
