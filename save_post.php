<?php
// Configurações do banco de dados
$host = 'localhost';
$user = 'root';
$pass = 'root';
$dbname = 'meubanco';

// Conexão com o banco de dados
$conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);

// Prepara a consulta SQL para inserir uma nova postagem
$stmt = $conn->prepare("INSERT INTO posts (title, content) VALUES (:title, :content)");

// Insere a postagem no banco de dados
$stmt->bindParam(':title', $_POST['title']);
$stmt->bindParam(':content', $_POST['content']);
$stmt->execute();

// Redireciona para a página de visualização da postagem
header('Location: view_post.php');
