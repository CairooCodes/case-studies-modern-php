<?php
// Configurações do banco de dados
$host = 'localhost';
$user = 'root';
$pass = 'root';
$dbname = 'meubanco';

// Conexão com o banco de dados
$conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);

// Prepara a consulta SQL para inserir uma nova imagem
$stmt = $conn->prepare("INSERT INTO images (name, data) VALUES (:name, :data)");

// Processa cada imagem enviada
foreach ($_FILES['images']['name'] as $key => $name) {
	// Verifica se o arquivo foi enviado com sucesso
	if ($_FILES['images']['error'][$key] == UPLOAD_ERR_OK) {
		// Lê o conteúdo do arquivo
		$data = file_get_contents($_FILES['images']['tmp_name'][$key]);

		// Define o nome do arquivo
		$name = $_FILES['images']['name'][$key];

		// Insere a imagem no banco de dados
		$stmt->bindParam(':name', $name);
		$stmt->bindParam(':data', $data, PDO::PARAM_LOB);
		$stmt->execute();

		// Recupera o ID da imagem recém-inserida
		$image_id = $conn->lastInsertId


	// Substitui o caminho temporário pelo caminho completo da imagem
	$image_url = "get_image.php?id=$image_id";

	// Adiciona a imagem ao array de imagens do TinyMCE
	$response[] = [
		'url' => $image_url,
		'alt' => $name
	];
}
}

// Envia a resposta para o TinyMCE em formato JSON
header('Content-Type: application/json');
echo json_encode(['images' => $response]);
?>