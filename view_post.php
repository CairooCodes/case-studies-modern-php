<?php
// Configurações do banco de dados
$host = 'localhost';
$user = 'root';
$pass = 'root';
$dbname = 'meubanco';

// Conexão com o banco de dados
$conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);

// Recupera o ID da postagem da URL
$id = $_GET['id'];

// Prepara a consulta SQL para recuperar a postagem com o ID especificado
$stmt = $conn->prepare("SELECT * FROM posts WHERE id = :id");
$stmt->bindParam(':id', $id);
$stmt->execute();

// Recupera a postagem do banco de dados
$post = $stmt->fetch();

// Exibe o título e o conteúdo da postagem
echo "<h1>{$post['title']}</h1>";
echo $post['content'];

// Prepara a consulta SQL para recuperar as imagens da postagem
$stmt = $conn->prepare("SELECT * FROM images WHERE post_id = :id");
$stmt->bindParam(':id', $id);
$stmt->execute();

// Exibe as imagens da postagem
while ($image = $stmt->fetch()) {
	// Cria a URL para a imagem
	$image_url = "get_image.php?id={$image['id']}";

	// Exibe a imagem
	echo "<img src='$image_url' alt='{$image['name']}'><br>";
}
