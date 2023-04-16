<?php
// Configurações do banco de dados
$host = 'localhost';
$user = 'root';
$pass = 'root';
$dbname = 'meubanco';

// Conexão com o banco de dados
$conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);

// Recupera o ID da imagem da URL
$id = $_GET['id'];

// Prepara a consulta SQL para recuperar a imagem com o ID especificado
$stmt = $conn->prepare("SELECT * FROM images WHERE id = :id");
$stmt->bindParam(':id', $id);
$stmt->execute();

// Recupera a imagem do banco de dados
$image = $stmt->fetch();

// Define o cabeçalho HTTP para indicar que o conteúdo é uma imagem
header("Content-Type: {$image['type']}");

// Exibe os dados da imagem
echo $image['data'];
?>
