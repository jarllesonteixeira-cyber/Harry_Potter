<?php
require_once __DIR__ . '/dao/HARRYDAO.php';

$dao      = new HARRYDAO();
$mensagem = '';
$id       = $_GET['id'] ?? 0;

$feitico = $dao->readById($id);

if (!$feitico) { ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Feitiço não encontrado</title>
  <link rel="stylesheet" href="css/editar.css">
</head>
<body>
  <div class="hp-card hp-not-found">
    <div class="hp-nf-icon">🔮</div>
    <h2 class="hp-nf-title">Feitiço não encontrado</h2>
    <p class="hp-nf-text">Os registros do Ministério da Magia não contêm este encantamento.</p>
    <a class="hp-btn-back hp-nf-btn" href="index.php">← Voltar à Lista</a>
  </div>
</body>
</html>
<?php exit; }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $feitico->setNome($_POST['nome'] ?? '');
    $feitico->setTipo($_POST['tipo'] ?? '');
    $feitico->setMovimento_Varinha($_POST['movimento_varinha'] ?? '');
    $feitico->setEfeito($_POST['efeito'] ?? '');
    $feitico->setNivel_Dificuldade($_POST['nivel_dificuldade'] ?? '');
    $feitico->setProibido($_POST['proibido'] ?? '');

    if ($dao->update($feitico)) {
        $mensagem = "Feitiço atualizado com sucesso!";
        $feitico  = $dao->readById($id);
    } else {
        $mensagem = "Erro ao atualizar o feitiço.";
    }
}

/* Helper: selected em selects */
function sel(string $opcao, string $atual): string {
    return $opcao === $atual ? ' selected' : '';
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Feitiço</title>
  <link rel="stylesheet" href="css/editar.css">
</head>
<body>

  <div class="hp-card">

    <header class="hp-header">
      <span class="hp-crest">✏️</span>
      <h1 class="hp-title">Editando Feitiço</h1>
      <span class="hp-spell-name"><?= htmlspecialchars($feitico->getNome()) ?></span>
      <p class="hp-subtitle">Ministério da Magia — Registro de Encantamentos</p>
    </header>

    <hr class="hp-divider">

    <?php if ($mensagem): ?>
      <?php $classe = str_contains($mensagem, 'sucesso') ? 'hp-alert-success' : 'hp-alert-error'; ?>
      <div class="<?= $classe ?>">
        <?= htmlspecialchars($mensagem) ?>
      </div>
    <?php endif; ?>

    <form method="post">
      <div class="hp-grid">

        <div class="hp-field full">
          <label class="hp-label" for="nome">Nome do Feitiço</label>
          <input class="hp-input hp-edit-accent" type="text" id="nome" name="nome" required
                 value="<?= htmlspecialchars($feitico->getNome()) ?>">
        </div>

        <div class="hp-field">
          <label class="hp-label" for="tipo">Tipo</label>
          <select class="hp-select" id="tipo" name="tipo" required>
            <option value="">-- Selecione --</option>
            <option value="Encantamento"   <?= sel('Encantamento',    $feitico->getTipo()) ?>>Encantamento</option>
            <option value="Maldição"       <?= sel('Maldição',        $feitico->getTipo()) ?>>Maldição</option>
            <option value="Contrafeitiço"  <?= sel('Contrafeitiço',   $feitico->getTipo()) ?>>Contrafeitiço</option>
            <option value="Transformação"  <?= sel('Transformação',   $feitico->getTipo()) ?>>Transformação</option>
            <option value="Feitiço de Cura"<?= sel('Feitiço de Cura', $feitico->getTipo()) ?>>Feitiço de Cura</option>
          </select>
        </div>

        <div class="hp-field">
          <label class="hp-label" for="nivel_dificuldade">Dificuldade</label>
          <select class="hp-select" id="nivel_dificuldade" name="nivel_dificuldade" required>
            <option value="">-- Selecione --</option>
            <option value="Fácil"        <?= sel('Fácil',         $feitico->getNivel_Dificuldade()) ?>>Fácil</option>
            <option value="Médio"        <?= sel('Médio',         $feitico->getNivel_Dificuldade()) ?>>Médio</option>
            <option value="Difícil"      <?= sel('Difícil',       $feitico->getNivel_Dificuldade()) ?>>Difícil</option>
            <option value="Muito Difícil"<?= sel('Muito Difícil', $feitico->getNivel_Dificuldade()) ?>>Muito Difícil</option>
          </select>
        </div>

        <div class="hp-field full">
          <label class="hp-label" for="movimento_varinha">Movimento da Varinha</label>
          <input class="hp-input hp-edit-accent" type="text" id="movimento_varinha" name="movimento_varinha" required
                 value="<?= htmlspecialchars($feitico->getMovimento_Varinha()) ?>">
        </div>

        <div class="hp-field full">
          <label class="hp-label" for="efeito">Efeito</label>
          <input class="hp-input hp-edit-accent" type="text" id="efeito" name="efeito" required
                 value="<?= htmlspecialchars($feitico->getEfeito()) ?>">
        </div>

        <div class="hp-field">
          <label class="hp-label" for="proibido">Proibido</label>
          <select class="hp-select" id="proibido" name="proibido" required>
            <option value="">-- Selecione --</option>
            <option value="1" <?= $feitico->getProibido() ? ' selected' : '' ?>>Sim</option>
            <option value="0" <?= !$feitico->getProibido() && $feitico->getProibido() !== '' ? ' selected' : '' ?>>Não</option>
          </select>
        </div>

      </div>

      <div class="hp-actions">
        <button class="hp-btn-save" type="submit">✦ Salvar Edição</button>
        <a class="hp-btn-back" href="index.php">← Voltar à Lista</a>
      </div>
    </form>

  </div>

</body>
</html>