<?php
$errors = [];
$success = false;
 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome      = trim($_POST['nome'] ?? '');
    $email     = trim($_POST['email'] ?? '');
    $senha     = $_POST['senha'] ?? '';
    $confirmar = $_POST['confirmar_senha'] ?? '';
    $casa      = $_POST['casa'] ?? '';
 
    if (empty($nome))                                          $errors[] = 'O nome é obrigatório.';
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Insira um e-mail válido.';
    if (strlen($senha) < 6)                                    $errors[] = 'A senha deve ter pelo menos 6 caracteres.';
    if ($senha !== $confirmar)                                 $errors[] = 'As senhas não coincidem.';
    if (empty($casa))                                          $errors[] = 'Escolha sua casa de Hogwarts.';
 
    if (empty($errors)) $success = true;
}
 
$casas = [
    'gryffindor' => ['label' => 'Grifinória', 'emoji' => '🦁'],
    'hufflepuff' => ['label' => 'Lufa-Lufa',  'emoji' => '🦡'],
    'ravenclaw'  => ['label' => 'Corvinal',    'emoji' => '🦅'],
    'slytherin'  => ['label' => 'Sonserina',   'emoji' => '🐍'],
];
$casaSelecionada = $_POST['casa'] ?? '';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hogwarts — Criar Conta</title>
</head>
<body>
 
  <h1>⚡ Hogwarts — Criar Conta</h1>
  <p><em>Draco dormiens nunquam titillandus</em></p>
 
  <hr>
 
  <?php if ($success): ?>
 
    <p>✅ <strong>Cadastro realizado com sucesso!</strong></p>
    <p>
      Bem-vindo(a), <strong><?= htmlspecialchars($nome) ?></strong>!<br>
      O Chapéu Seletor te acolheu na casa
      <strong><?= $casas[$casaSelecionada]['emoji'] ?> <?= $casas[$casaSelecionada]['label'] ?></strong>.
    </p>
 
  <?php else: ?>
 
    <?php if (!empty($errors)): ?>
      <ul>
        <?php foreach ($errors as $e): ?>
          <li><?= htmlspecialchars($e) ?></li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>
 
    <form method="POST">
 
      <p>
        <label for="nome">Nome completo:</label><br>
        <input type="text" id="nome" name="nome"
               placeholder="Ex.: Hermione Granger"
               value="<?= htmlspecialchars($_POST['nome'] ?? '') ?>">
      </p>
 
      <p>
        <label for="email">E-mail:</label><br>
        <input type="email" id="email" name="email"
               placeholder="voce@hogwarts.edu"
               value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
      </p>
 
      <p>
        <label for="senha">Senha:</label><br>
        <input type="password" id="senha" name="senha" placeholder="Mínimo 6 caracteres">
      </p>
 
      <p>
        <label for="confirmar_senha">Confirmar senha:</label><br>
        <input type="password" id="confirmar_senha" name="confirmar_senha" placeholder="Repita a senha">
      </p>
 
      <p><strong>Sua casa em Hogwarts:</strong></p>
      <?php foreach ($casas as $key => $casa): ?>
        <label>
          <input type="radio" name="casa" value="<?= $key ?>"
                 <?= ($casaSelecionada === $key) ? 'checked' : '' ?>>
          <?= $casa['emoji'] ?> <?= $casa['label'] ?>
        </label><br>
      <?php endforeach; ?>
 
      <br>
      <button type="submit" href= 'create.php'>Entrar em Hogwarts</button>
 
    </form>
 
    <p>Já tem uma conta? <a href="login2.php">Fazer login</a></p>
 
  <?php endif; ?>
 
</body>
</html>