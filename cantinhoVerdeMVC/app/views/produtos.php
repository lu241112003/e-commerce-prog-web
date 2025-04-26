<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= APP_NAME ?></title>
  <link rel="stylesheet" href="<?= BASE_URL ?>/css/style.css" />
  <link rel="stylesheet" href="<?= BASE_URL ?>/css/produtos.css" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
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
          <div class="filter-group">
            <h3>Categorias</h3>
            <ul>
              <li><a href="#" class="active">Todas as Plantas</a></li>
              <li><a href="#">Plantas de Interior</a></li>
              <li><a href="#">Plantas de Exterior</a></li>
              <li><a href="#">Suculentas</a></li>
              <li><a href="#">Cactos</a></li>
              <li><a href="#">Flores</a></li>
              <li><a href="#">Vasos e Acessórios</a></li>
            </ul>
          </div>

          <div class="filter-group">
            <h3>Preço</h3>
            <div class="price-range">
              <input
                type="range"
                min="0"
                max="500"
                value="500"
                class="slider"
                id="priceRange" />
              <div class="price-values">
                <span>R$ 0</span>
                <span id="priceValue">R$ 500</span>
              </div>
            </div>
          </div>

          <div class="filter-group">
            <h3>Tamanho</h3>
            <div class="checkbox-group">
              <label> <input type="checkbox" checked /> Pequeno </label>
              <label> <input type="checkbox" checked /> Médio </label>
              <label> <input type="checkbox" checked /> Grande </label>
            </div>
          </div>

          <div class="filter-group">
            <h3>Nível de Cuidado</h3>
            <div class="checkbox-group">
              <label> <input type="checkbox" checked /> Fácil </label>
              <label> <input type="checkbox" checked /> Médio </label>
              <label> <input type="checkbox" checked /> Avançado </label>
            </div>
          </div>

          <button class="btn filter-btn">Aplicar Filtros</button>
        </div>

        <div class="products-list">
          <div class="products-header">
            <div class="products-count">
              <p>Mostrando 1-12 de 48 produtos</p>
            </div>
            <div class="products-sort">
              <label for="sort">Ordenar por:</label>
              <select id="sort">
                <option value="relevance">Relevância</option>
                <option value="price-low">Preço: Menor para Maior</option>
                <option value="price-high">Preço: Maior para Menor</option>
                <option value="newest">Mais Recentes</option>
                <option value="popular">Mais Populares</option>
              </select>
            </div>
          </div>

          <div class="product-grid">
            <!-- Produto 1 -->
            <div class="product-card">
              <div class="product-image">
                <img src="img/produto1.jpg" alt="Zamioculca" />
                <div class="product-tag">Destaque</div>
              </div>
              <div class="product-info">
                <h3>Zamioculca</h3>
                <p class="product-description">
                  Planta resistente ideal para ambientes internos
                </p>
                <div class="product-price">
                  <span class="price">R$ 89,90</span>
                </div>
                <button class="btn-add-cart">Adicionar ao Carrinho</button>
              </div>
            </div>


            <div class="product-card" data-id="1">
              <div class="product-image">
                <img src="images/produtos/planta1.jpg" alt="Nome da Planta" />
                <div class="product-tags">
                  <span class="tag tag-new">Novo</span>
                </div>
              </div>
              <div class="product-content">
                <h3 class="product-title">Nome da Planta</h3>
                <div class="product-category">Plantas de Interior</div>
                <div class="product-rating">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
                  <span>(4.5)</span>
                </div>
                <div class="product-price">R$ 59,90</div>
                <div class="product-actions">
                  <button class="add-to-cart" data-id="1">
                    <i class="fas fa-shopping-cart"></i> Adicionar
                  </button>
                  <button
                    class="add-to-wishlist"
                    data-id="1"
                    title="Adicionar à lista de desejos">
                    <i class="far fa-heart"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>

          <div class="pagination">
            <a href="#" class="active">1</a>
            <a href="#">2</a>
            <a href="#">3</a>
            <a href="#">4</a>
            <a href="#" class="next">Próximo <i class="fas fa-chevron-right"></i></a>
          </div>
        </div>
      </div>
  </section>

  <?php require_once 'partials/footer.php'; ?>
</body>

</html>