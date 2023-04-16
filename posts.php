<?php
// Conecta ao banco de dados
$pdo = new PDO('mysql:host=localhost;dbname=meubanco', 'root', 'root');

// Recupera as postagens do banco de dados
$stmt = $pdo->query("SELECT * FROM postagens ORDER BY id DESC");
$postagens = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Exibe as postagens em uma lista
foreach ($postagens as $postagem) {
  echo '<h2>' . $postagem['titulo'] . '</h2>';
  echo '<div>' . $postagem['conteudo'] . '</div>';
}
