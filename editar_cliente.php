<?php
include "./controllers/edit_client.php"
?>
<!DOCTYPE html>
<html>

<head>
  <title>Editar Cliente</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.1.1/tailwind.min.css">
</head>

<body>
  <div class="container mx-auto mt-4">
    <h1 class="text-2xl font-bold mb-4">Editar Cliente</h1>
    <form action="./controllers/edit_client.php?id=<?php echo $cliente['id']; ?>" method="POST">
      <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="nome">
          Nome
        </label>
        <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nome" name="name" type="text" value="<?php echo $cliente['name']; ?>">
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="email">
          E-mail
        </label>
        <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" name="price" type="text" value="<?php echo $cliente['price']; ?>">
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="email">
          E-mail
        </label>
        <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="telefone" name="categorie_id" type="text" value="<?php echo $cliente['categorie_id']; ?>">
      </div>
      <button type="submit">Editar</button>
    </form>