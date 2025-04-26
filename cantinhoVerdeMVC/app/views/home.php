<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= APP_NAME ?></title>
  <link rel="stylesheet" href="<?= BASE_URL ?>/css/style.css" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>

<body>
  <?php require_once 'partials/navbar.php'; ?>

  <section class="hero">
    <div class="container">
      <div class="hero-content">
        <h2>Transforme seu espaço com nossas plantas</h2>
        <p>
          Descubra uma variedade de plantas para interior e exterior com
          entrega em todo o Brasil
        </p>
        <a href="<?= BASE_URL ?>/produtos" class="btn">Explorar Coleção</a>
      </div>
    </div>
  </section>

  <section class="categories">
    <div class="container">
      <h2 class="section-title">Categorias Populares</h2>
      <div class="category-grid">
        <?php
        if (!empty($categorias)) {
          foreach ($categorias as $categoria) {
        ?>
            <div class="category-card">
              <img src="<?= $categoria['imagem'] ?>" alt="<?= htmlspecialchars($categoria['nome']) ?>" />
              <h3><?= htmlspecialchars($categoria['nome']) ?></h3>
              <a href="categorias.html?cat=<?= urlencode($categoria['slug']) ?>" class="btn-small">Ver Mais</a>
            </div>
        <?php
          }
        } else {
          echo '<p>Não há categorias disponíveis no momento.</p>';
        }
        ?>
      </div>
    </div>
  </section>

  <section class="featured-products">
    <div class="container">
      <h2 class="section-title">Plantas em Destaque</h2>
      <div class="product-grid">
        <?php
        if (!empty($produtos)) {
          foreach ($produtos as $produto) {
        ?>
            <div class="product-card">
              <div class="product-image">
                <img src="<?= $produto['imagem_principal'] ?>" alt="<?= htmlspecialchars($produto['nome']) ?>" />
                <?php if ($produto['novo'] === 1) { ?>
                  <div class="product-tag">Novo</div>
                <?php } else { ?>
                  <div class="product-tag">Destaque</div>
                <?php } ?>
              </div>
              <div class="product-info">
                <h3><?= htmlspecialchars($produto['nome']) ?></h3>
                <p class="product-description"><?= htmlspecialchars($produto['descricao_curta']) ?></p>
                <div class="product-price">
                  <?php if (!empty($produto['preco_promocional'])) { ?>
                    <span class="price">R$ <?= number_format($produto['preco_promocional'], 2, ',', '.') ?></span>
                  <?php } else { ?>
                    <span class="price">R$ <?= number_format($produto['preco'], 2, ',', '.') ?></span>
                  <?php } ?>
                </div>
                <button class="btn-add-cart">Adicionar ao Carrinho</button>
              </div>
            </div>
        <?php
          }
        } else {
          echo '<p>Não há produtos disponíveis no momento.</p>';
        }
        ?>
      </div>
      <div class="view-all">
        <a href="<?= BASE_URL ?>/produtos" class="btn">Ver Todos os Produtos</a>
      </div>
    </div>
  </section>

  <section class="benefits">
    <div class="container">
      <div class="benefits-grid">
        <div class="benefit-card">
          <i class="fas fa-truck"></i>
          <h3>Entrega Rápida</h3>
          <p>Entregamos em todo o Brasil</p>
        </div>
        <div class="benefit-card">
          <i class="fas fa-leaf"></i>
          <h3>Plantas Saudáveis</h3>
          <p>Garantia de qualidade</p>
        </div>
        <div class="benefit-card">
          <i class="fas fa-headset"></i>
          <h3>Suporte Especializado</h3>
          <p>Dúvidas sobre cuidados</p>
        </div>
        <div class="benefit-card">
          <i class="fas fa-undo"></i>
          <h3>Troca Garantida</h3>
          <p>Em caso de problemas</p>
        </div>
      </div>
    </div>
  </section>

  <section class="newsletter">
    <div class="container">
      <div class="newsletter-content">
        <h2>Receba Novidades e Promoções</h2>
        <p>
          Cadastre-se para receber dicas de cuidados com plantas e ofertas
          exclusivas
        </p>
        <form class="newsletter-form">
          <input type="email" placeholder="Seu melhor e-mail" required />
          <button type="submit" class="btn">Inscrever-se</button>
        </form>
      </div>
    </div>
  </section>

  <?php require_once 'partials/footer.php'; ?>
</body>

</html>