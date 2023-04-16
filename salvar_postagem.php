<?php
$pdo = new PDO('mysql:host=localhost;dbname=meubanco', 'root', 'root');

// Recupera os dados do formulário
$titulo = $_POST['titulo'];
$conteudo = $_POST['conteudo'];

// Converte as imagens em base64 e salva na tabela de imagens
$dom = new DOMDocument();
$dom->loadHTML($conteudo);
$images = $dom->getElementsByTagName('img');
foreach ($images as $image) {
  $data = file_get_contents($image->getAttribute('src'));
  $base64 = base64_encode($data);
  $stmt = $pdo->prepare("INSERT INTO imagens (base64) VALUES (:base64)");
  $stmt->bindParam(':base64', $base64);
  $stmt->execute();
  $image->setAttribute('src', 'data:image/png;base64,' . $base64);
}

// Salva a postagem no banco de dados, incluindo o conteúdo modificado com as imagens em base64
$novo_conteudo = $dom->saveHTML();
$stmt = $pdo->prepare("INSERT INTO postagens (titulo, conteudo) VALUES (:titulo, :conteudo)");
$stmt->bindParam(':titulo', $titulo);
$stmt->bindParam(':conteudo', $novo_conteudo);
$stmt->execute();
header('Location: posts.php');
