<!-- <?php
      echo '<pre>';
      print_r($produtos);
      echo '</pre>';
      ?> -->

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= APP_NAME ?></title>
  <link rel="stylesheet" href="<?= BASE_URL ?>/css/style.css" />
  <link rel="stylesheet" href="<?= BASE_URL ?>/css/produtos.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>

<body>
  <?php require_once 'partials/navbar.php'; ?>

  <section class="page-header">
    <div class="container">
      <h1>Nossos Produtos</h1>
      <div class="breadcrumb">
        <a href="index.html">Início</a> / <span>Produtos</span>
      </div>
    </div>
  </section>

  <section class="products-section">
    <div class="container">
      <div class="products-container">
        <div class="filters">
          <form method="get" id="filters-form">
            <!-- Filtro de Categorias -->
            <div class="filter-group">
              <h3>Categorias</h3>
              <ul>
                <li><a href="?<?= $this->getQueryString(['categoria', 'pagina']) ?>"
                    class="<?= empty($filtros['categoria_id']) ? 'active' : '' ?>">Todas as Plantas</a></li>
                <?php foreach ($categorias as $categoria): ?>
                  <li>
                    <a href="?categoria=<?= $categoria['id'] ?>&<?= $this->getQueryString(['categoria', 'pagina']) ?>"
                      class="<?= ($filtros['categoria_id'] ?? '') == $categoria['id'] ? 'active' : '' ?>">
                      <?= htmlspecialchars($categoria['nome']) ?>
                    </a>
                  </li>
                <?php endforeach; ?>
              </ul>
            </div>

            <!-- Filtro de Preço -->
            <div class="filter-group">
              <h3>Preço</h3>
              <div class="price-range">
                <input type="range" min="0" max="500" value="<?= $filtros['preco_max'] ?? 500 ?>"
                  class="slider" id="priceRange" name="preco_max">
                <div class="price-values">
                  <span>R$ 0</span>
                  <span id="priceValue">R$ <?= $filtros['preco_max'] ?? 500 ?></span>
                </div>
              </div>
            </div>

            <!-- Filtro de Tamanho -->
            <div class="filter-group">
              <h3>Tamanho</h3>
              <div class="checkbox-group">
                <?php
                $tamanhos = ['pequeno', 'medio', 'grande'];
                foreach ($tamanhos as $tamanho):
                  $checked = in_array(strtolower($tamanho), $filtros['tamanhos'] ?? []) ? 'checked' : '';
                ?>
                  <label>
                    <input type="checkbox" name="tamanhos[]" value="<?= strtolower($tamanho) ?>" <?= $checked ?>>
                    <?= $tamanho ?>
                  </label>
                <?php endforeach; ?>
              </div>
            </div>

            <!-- Filtro de Nível de Cuidado -->
            <div class="filter-group no-margin">
              <h3>Nível de Cuidado</h3>
              <div class="checkbox-group">
                <?php
                $niveis = ['facil', 'medio', 'avancado'];
                foreach ($niveis as $nivel):
                  $checked = in_array(strtolower($nivel), $filtros['niveis'] ?? []) ? 'checked' : '';
                ?>
                  <label>
                    <input type="checkbox" name="niveis[]" value="<?= strtolower($nivel) ?>" <?= $checked ?>>
                    <?= $nivel ?>
                  </label>
                <?php endforeach; ?>
              </div>
            </div>

            <input type="hidden" name="pagina" value="1">
            <button type="submit" class="btn filter-btn">Aplicar Filtros</button>
          </form>
        </div>

        <div class="products-list">
          <div class="products-header">
            <div class="products-count">
              <?php if (!empty($produtos)): ?>
                <?php
                $inicio = (($paginaAtual - 1) * $itensPorPagina) + 1;
                $fim = min($paginaAtual * $itensPorPagina, $totalProdutos);
                ?>
                <p>Mostrando <?= $inicio ?>-<?= $fim ?> de <?= $totalProdutos ?> produtos</p>
              <?php else: ?>
                <p>Nenhum produto encontrado</p>
              <?php endif; ?>
            </div>

            <div class="products-sort">
              <form method="get" id="sort-form" class="sort-form">
                <label for="sort">Ordenar por:</label>
                <select id="sort" name="ordenar" onchange="this.form.submit()">
                  <option value="relevance">Relevância</option>
                  <option value="price-low" <?= ($filtros['ordenacao'] ?? '') === 'price-low' ? 'selected' : '' ?>>Preço: Menor para Maior</option>
                  <option value="price-high" <?= ($filtros['ordenacao'] ?? '') === 'price-high' ? 'selected' : '' ?>>Preço: Maior para Menor</option>
                  <option value="newest" <?= ($filtros['ordenacao'] ?? '') === 'newest' ? 'selected' : '' ?>>Mais Recentes</option>
                  <option value="popular" <?= ($filtros['ordenacao'] ?? '') === 'popular' ? 'selected' : '' ?>>Mais Populares</option>
                </select>

                <!-- Manter outros parâmetros GET -->
                <input type="hidden" name="pagina" value="1">
                <?php if (!empty($filtros['categoria_id'])): ?>
                  <input type="hidden" name="categoria" value="<?= htmlspecialchars($filtros['categoria_id']) ?>">
                <?php endif; ?>
                <?php if (!empty($filtros['preco_max'])): ?>
                  <input type="hidden" name="preco_max" value="<?= htmlspecialchars($filtros['preco_max']) ?>">
                <?php endif; ?>
              </form>
            </div>
          </div>

          <div class="product-grid">
            <?php if (!empty($produtos)): ?>
              <?php foreach ($produtos as $produto): ?>
                <div class="product-card">
                  <div class="product-image">
                    <img src="<?= htmlspecialchars($produto['imagem_principal'] ?? BASE_URL . '/img/sem-imagem.jpg') ?>"
                      alt="<?= htmlspecialchars($produto['nome']) ?>" />

                    <?php /* if ($produto['novo'] == 1): ?>
                          <div class="product-tag">Novo</div>
                         <?php endif; */ ?>

                    <?php if ($produto['destaque'] == 1): ?>
                      <div class="product-tag">Destaque</div>
                    <?php endif; ?>
                  </div>
                  <div class="product-info">
                    <h3><?= htmlspecialchars($produto['nome']) ?></h3>
                    <p class="product-description">
                      <?= htmlspecialchars($produto['descricao_curta']) ?>
                    </p>
                    <div class="product-price">
                      <?php if (!empty($produto['preco_promocional']) && $produto['preco_promocional'] < $produto['preco']): ?>
                        <span class="price">R$ <?= number_format($produto['preco_promocional'], 2, ',', '.') ?></span>
                      <?php else: ?>
                        <span class="price">R$ <?= number_format($produto['preco'], 2, ',', '.') ?></span>
                      <?php endif; ?>
                    </div>
                    <button class="btn-add-cart">Adicionar ao Carrinho</button>
                  </div>
                </div>
              <?php endforeach; ?>
            <?php else: ?>
              <?php if (
                !empty($filtros['categoria_id']) || !empty($filtros['preco_max']) ||
                !empty($filtros['tamanhos']) || !empty($filtros['niveis'])
              ): ?>
                <p class="no-products">Nenhum produto encontrado com os filtros selecionados.</p>
              <?php else: ?>
                <p class="no-products">Nenhum produto encontrado.</p>
              <?php endif; ?>
            <?php endif; ?>
          </div>

          <?php if ($totalPaginas > 1): ?>
            <div class="pagination">
              <?php if ($paginaAtual > 1): ?>
                <a href="?pagina=<?= $paginaAtual - 1 ?><?= $this->getQueryString(['pagina']) ?>">
                  <i class="fas fa-chevron-left"></i> Anterior
                </a>
              <?php endif; ?>

              <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                <a href="?pagina=<?= $i ?><?= $this->getQueryString(['pagina']) ?>"
                  class="<?= $i == $paginaAtual ? 'active' : '' ?>">
                  <?= $i ?>
                </a>
              <?php endfor; ?>

              <?php if ($paginaAtual < $totalPaginas): ?>
                <a href="?pagina=<?= $paginaAtual + 1 ?><?= $this->getQueryString(['pagina']) ?>">
                  Próximo <i class="fas fa-chevron-right"></i>
                </a>
              <?php endif; ?>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </section>

  <?php require_once 'partials/footer.php'; ?>

  <script>
    // Atualiza o valor exibido do range de preço
    document.getElementById('priceRange').addEventListener('input', function() {
      document.getElementById('priceValue').textContent = 'R$ ' + this.value;
    });

    // Remove o submit automático e mantém apenas a atualização visual
    document.getElementById('priceRange').addEventListener('change', function() {
      document.getElementById('priceValue').textContent = 'R$ ' + this.value;
    });

    // Remove o submit automático dos checkboxes
    document.querySelectorAll('.checkbox-group input[type="checkbox"]').forEach(checkbox => {
      checkbox.addEventListener('change', function() {});
    });
  </script>
</body>

</html>