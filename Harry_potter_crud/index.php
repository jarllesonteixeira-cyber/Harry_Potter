<?php
require_once __DIR__ . '/dao/HARRYDAO.php';

$dao     = new HARRYDAO();
$feiticos = $dao->readAll();

/* Helper: badge de dificuldade */
function dificuldadeBadge(string $nivel): string {
    $mapa = [
        'Fácil'        => 'hp-badge-facil',
        'Médio'        => 'hp-badge-medio',
        'Difícil'      => 'hp-badge-dificil',
        'Muito Difícil'=> 'hp-badge-muito-dificil',
    ];
    $classe = $mapa[$nivel] ?? 'hp-badge-tipo';
    return '<span class="hp-badge ' . $classe . '">' . htmlspecialchars($nivel) . '</span>';
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Grimório Digital</title>
  <link rel="stylesheet" href="css/grimorio.css">
</head>
<body>

  <header class="hp-header">
    <span class="hp-crest">📖</span>
    <h1 class="hp-title">Grimório Digital</h1>
    <p class="hp-subtitle">Ministério da Magia — Registro de Encantamentos</p>
  </header>

  <hr class="hp-divider">

  <div class="hp-toolbar">
    <a href="create.php" class="hp-btn-new">✦ Novo Feitiço</a>
  </div>

  <div class="hp-table-wrap">
    <table class="hp-table">
      <thead>
        <tr>
          <th>#</th>
          <th>Nome</th>
          <th>Tipo</th>
          <th>Movimento da Varinha</th>
          <th>Efeito</th>
          <th>Dificuldade</th>
          <th>Proibido</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>

        <?php if (count($feiticos) === 0): ?>
          <tr>
            <td class="hp-td-empty" colspan="8">Nenhum feitiço cadastrado ainda.</td>
          </tr>
        <?php endif; ?>

        <?php foreach ($feiticos as $feitico): ?>
          <?php $proibido = $feitico->getProibido(); ?>
          <tr>
            <td class="hp-td-id"><?= $feitico->getId() ?></td>
            <td class="hp-td-name"><?= htmlspecialchars($feitico->getNome()) ?></td>
            <td>
              <span class="hp-badge hp-badge-tipo">
                <?= htmlspecialchars($feitico->getTipo()) ?>
              </span>
            </td>
            <td><?= htmlspecialchars($feitico->getMovimento_Varinha()) ?></td>
            <td><?= htmlspecialchars($feitico->getEfeito()) ?></td>
            <td><?= dificuldadeBadge($feitico->getNivel_Dificuldade()) ?></td>
            <td>
              <?php if ($proibido): ?>
                <span class="hp-badge hp-badge-proibido-sim">Sim</span>
              <?php else: ?>
                <span class="hp-badge hp-badge-proibido-nao">Não</span>
              <?php endif; ?>
            </td>
            <td>
              <div class="hp-actions">
                <a class="hp-btn-edit" href="edit.php?id=<?= $feitico->getId() ?>">✎ Editar</a>
                <a class="hp-btn-del"
                   href="delete.php?id=<?= $feitico->getId() ?>"
                   onclick="return confirm('Tem certeza que deseja excluir este feitiço?')">
                  ✕ Excluir
                </a>
              </div>
            </td>
          </tr>
        <?php endforeach; ?>

      </tbody>
    </table>
  </div>

</body>
</html>