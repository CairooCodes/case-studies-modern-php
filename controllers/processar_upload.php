<?php
require "../db_config.php";
session_start();

if (!isset($_SESSION['id'])) {
  header('Location: ../login.php');
  exit;
}

// obter o ID do usuário a partir do cookie ou da sessão
$user_id = $_SESSION['id'] ?? null;

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Verifica se foram enviados arquivos
  if (isset($_FILES['imagens'])) {
    $imagens = $_FILES['imagens'];

    // Loop pelos arquivos enviados
    foreach ($imagens['tmp_name'] as $indice => $caminho_imagem) {
      // Obtém o tipo e o tamanho da imagem
      $tipo_imagem = $imagens['type'][$indice];
      $tamanho_imagem = $imagens['size'][$indice];

      // Verifica se o tipo da imagem é válido
      $tipos_permitidos = ['image/jpeg', 'image/png'];
      if (!in_array($tipo_imagem, $tipos_permitidos)) {
        echo 'Erro: Tipo de imagem não permitido.';
        exit;
      }

      // Verifica se o tamanho da imagem é válido
      $tamanho_maximo = 1024 * 1024; // 1 MB
      if ($tamanho_imagem > $tamanho_maximo) {
        echo 'Erro: Tamanho da imagem excedeu o limite permitido.';
        exit;
      }

      // Converte o conteúdo da imagem para base64
      $conteudo = file_get_contents($caminho_imagem);
      $conteudo_base64 = base64_encode($conteudo);

      // Atualiza a coluna imagem da tabela de usuários
      $stmt = $pdo->prepare("UPDATE usuarios SET imagem_tipo = ?, imagem_conteudo = ? WHERE id = ?");
      $stmt->execute([$tipo_imagem, $conteudo_base64, $user_id]);
    }

    echo 'Imagens enviadas com sucesso!';
  }
}
