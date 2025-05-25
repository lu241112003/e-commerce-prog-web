<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= APP_NAME ?></title>
  <link rel="stylesheet" href="<?= BASE_URL ?>/css/style.css" />
  <link rel="stylesheet" href="<?= BASE_URL ?>/css/categoria.css" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>

<body>
  <!-- <?php require_once 'partials/navbar.php'; ?> -->
  <header>
    <div class="container">
      <div class="logo">
        <h1>Cantinho<span>Verde</span></h1>
      </div>
      <nav>
        <ul>
          <li><a href="<?= BASE_URL ?>/home">Início</a></li>
          <li><a href="<?= BASE_URL ?>/produtos">Produtos</a></li>
          <li><a href="<?= BASE_URL ?>/categorias" class="active">Categorias</a></li>
          <li><a href="<?= BASE_URL ?>/sobre">Sobre</a></li>
          <li><a href="<?= BASE_URL ?>/contato">Contato</a></li>
        </ul>
      </nav>
      <div class="icons">
        <a href="<?= BASE_URL ?>/carrinho"><i class="fas fa-shopping-cart"></i></a>
        <a href="<?= BASE_URL ?>/conta"><i class="fas fa-user"></i></a>
        <a href="<?= BASE_URL ?>/pesquisa"><i class="fas fa-search"></i></a>
      </div>
    </div>
  </header>

  <!-- Page Header -->
  <section class="page-header">
    <div class="container">
      <h1>Categorias de Plantas</h1>
      <div class="breadcrumb">
        <a href="index.html">Home</a> / <span>Categorias</span>
      </div>
    </div>
  </section>

  <!-- Categories Section -->
  <section class="categories-section">
    <div class="container">
      <div class="categories-intro">
        <h2>Explore Nossas Categorias</h2>
        <p>
          Descubra a variedade de plantas que oferecemos para transformar seu
          espaço em um verdadeiro oásis verde.
        </p>
      </div>

      <div class="categories-grid">
        <!-- Category 1 -->
        <div class="category-card">
          <div class="category-image">
            <img
              src="images/categories/plantas-interior.jpg"
              alt="Plantas de Interior" />
            <div class="category-overlay">
              <a
                href="produtos.html?categoria=interior"
                class="btn-view-category">Ver Produtos</a>
            </div>
          </div>
          <div class="category-info">
            <h3>Plantas de Interior</h3>
            <p>
              Plantas perfeitas para decorar e purificar o ar de ambientes
              internos.
            </p>
            <div class="category-meta">
              <span class="category-count">42 produtos</span>
              <a href="produtos.html?categoria=interior" class="category-link">Explorar <i class="fas fa-arrow-right"></i></a>
            </div>
          </div>
        </div>

        <!-- Category 2 -->
        <div class="category-card">
          <div class="category-image">
            <img
              src="images/categories/plantas-exterior.jpg"
              alt="Plantas de Exterior" />
            <div class="category-overlay">
              <a
                href="produtos.html?categoria=exterior"
                class="btn-view-category">Ver Produtos</a>
            </div>
          </div>
          <div class="category-info">
            <h3>Plantas de Exterior</h3>
            <p>
              Espécies resistentes e coloridas para jardins, varandas e áreas
              externas.
            </p>
            <div class="category-meta">
              <span class="category-count">38 produtos</span>
              <a href="produtos.html?categoria=exterior" class="category-link">Explorar <i class="fas fa-arrow-right"></i></a>
            </div>
          </div>
        </div>

        <!-- Category 3 -->
        <div class="category-card">
          <div class="category-image">
            <img src="images/categories/suculentas.jpg" alt="Suculentas" />
            <div class="category-overlay">
              <a
                href="produtos.html?categoria=suculentas"
                class="btn-view-category">Ver Produtos</a>
            </div>
          </div>
          <div class="category-info">
            <h3>Suculentas</h3>
            <p>
              Plantas de baixa manutenção com formas e cores variadas, ideais
              para decoração.
            </p>
            <div class="category-meta">
              <span class="category-count">25 produtos</span>
              <a
                href="produtos.html?categoria=suculentas"
                class="category-link">Explorar <i class="fas fa-arrow-right"></i></a>
            </div>
          </div>
        </div>

        <!-- Category 4 -->
        <div class="category-card">
          <div class="category-image">
            <img src="images/categories/cactos.jpg" alt="Cactos" />
            <div class="category-overlay">
              <a
                href="produtos.html?categoria=cactos"
                class="btn-view-category">Ver Produtos</a>
            </div>
          </div>
          <div class="category-info">
            <h3>Cactos</h3>
            <p>
              Plantas resistentes e de fácil cuidado, perfeitas para ambientes
              secos e ensolarados.
            </p>
            <div class="category-meta">
              <span class="category-count">20 produtos</span>
              <a href="produtos.html?categoria=cactos" class="category-link">Explorar <i class="fas fa-arrow-right"></i></a>
            </div>
          </div>
        </div>

        <!-- Category 5 -->
        <div class="category-card">
          <div class="category-image">
            <img src="images/categories/flores.jpg" alt="Flores" />
            <div class="category-overlay">
              <a
                href="produtos.html?categoria=flores"
                class="btn-view-category">Ver Produtos</a>
            </div>
          </div>
          <div class="category-info">
            <h3>Flores</h3>
            <p>
              Plantas floríferas que trazem cor e alegria para qualquer
              ambiente.
            </p>
            <div class="category-meta">
              <span class="category-count">30 produtos</span>
              <a href="produtos.html?categoria=flores" class="category-link">Explorar <i class="fas fa-arrow-right"></i></a>
            </div>
          </div>
        </div>

        <!-- Category 6 -->
        <div class="category-card">
          <div class="category-image">
            <img
              src="images/categories/arvores.jpg"
              alt="Árvores e Arbustos" />
            <div class="category-overlay">
              <a
                href="produtos.html?categoria=arvores"
                class="btn-view-category">Ver Produtos</a>
            </div>
          </div>
          <div class="category-info">
            <h3>Árvores e Arbustos</h3>
            <p>
              Espécies de maior porte para jardins e áreas externas maiores.
            </p>
            <div class="category-meta">
              <span class="category-count">15 produtos</span>
              <a href="produtos.html?categoria=arvores" class="category-link">Explorar <i class="fas fa-arrow-right"></i></a>
            </div>
          </div>
        </div>

        <!-- Category 7 -->
        <div class="category-card">
          <div class="category-image">
            <img src="images/categories/horta.jpg" alt="Horta e Temperos" />
            <div class="category-overlay">
              <a
                href="produtos.html?categoria=horta"
                class="btn-view-category">Ver Produtos</a>
            </div>
          </div>
          <div class="category-info">
            <h3>Horta e Temperos</h3>
            <p>Ervas aromáticas e plantas comestíveis para sua cozinha.</p>
            <div class="category-meta">
              <span class="category-count">22 produtos</span>
              <a href="produtos.html?categoria=horta" class="category-link">Explorar <i class="fas fa-arrow-right"></i></a>
            </div>
          </div>
        </div>

        <!-- Category 8 -->
        <div class="category-card">
          <div class="category-image">
            <img src="images/categories/acessorios.jpg" alt="Acessórios" />
            <div class="category-overlay">
              <a
                href="produtos.html?categoria=acessorios"
                class="btn-view-category">Ver Produtos</a>
            </div>
          </div>
          <div class="category-info">
            <h3>Acessórios</h3>
            <p>
              Vasos, ferramentas e produtos para o cuidado das suas plantas.
            </p>
            <div class="category-meta">
              <span class="category-count">35 produtos</span>
              <a
                href="produtos.html?categoria=acessorios"
                class="category-link">Explorar <i class="fas fa-arrow-right"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Featured Collections -->
  <section class="featured-collections">
    <div class="container">
      <h2 class="section-title">Coleções em Destaque</h2>
      <p class="section-subtitle">
        Seleções especiais de plantas para diferentes necessidades e estilos.
      </p>

      <div class="collections-grid">
        <!-- Collection 1 -->
        <div class="collection-card">
          <div class="collection-image">
            <img
              src="images/collections/purificadoras.jpg"
              alt="Plantas Purificadoras de Ar" />
          </div>
          <div class="collection-content">
            <h3>Plantas Purificadoras de Ar</h3>
            <p>
              Espécies que melhoram a qualidade do ar em ambientes internos.
            </p>
            <a
              href="produtos.html?colecao=purificadoras"
              class="btn-collection">Ver Coleção</a>
          </div>
        </div>

        <!-- Collection 2 -->
        <div class="collection-card">
          <div class="collection-image">
            <img
              src="images/collections/baixa-manutencao.jpg"
              alt="Plantas de Baixa Manutenção" />
          </div>
          <div class="collection-content">
            <h3>Plantas de Baixa Manutenção</h3>
            <p>
              Perfeitas para quem tem pouco tempo ou está começando no mundo
              das plantas.
            </p>
            <a
              href="produtos.html?colecao=baixa-manutencao"
              class="btn-collection">Ver Coleção</a>
          </div>
        </div>

        <!-- Collection 3 -->
        <div class="collection-card">
          <div class="collection-image">
            <img
              src="images/collections/pet-friendly.jpg"
              alt="Plantas Pet Friendly" />
          </div>
          <div class="collection-content">
            <h3>Plantas Pet Friendly</h3>
            <p>Espécies seguras para lares com animais de estimação.</p>
            <a
              href="produtos.html?colecao=pet-friendly"
              class="btn-collection">Ver Coleção</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Category Guide -->
  <!-- <section class="category-guide">
    <div class="container">
      <div class="guide-content">
        <div class="guide-text">
          <h2>Guia de Categorias</h2>
          <p>
            Não sabe qual planta escolher? Nosso guia ajuda você a encontrar a
            planta perfeita para seu espaço e estilo de vida.
          </p>
          <ul class="guide-features">
            <li>
              <i class="fas fa-check-circle"></i> Recomendações baseadas no
              seu ambiente
            </li>
            <li>
              <i class="fas fa-check-circle"></i> Dicas de cuidados
              específicos para cada categoria
            </li>
            <li>
              <i class="fas fa-check-circle"></i> Combinações de plantas para
              diferentes espaços
            </li>
            <li>
              <i class="fas fa-check-circle"></i> Soluções para problemas
              comuns
            </li>
          </ul>
          <a href="guia-categorias.html" class="btn-guide">Acessar o Guia Completo</a>
        </div>
        <div class="guide-image">
          <img src="images/category-guide.jpg" alt="Guia de Categorias" />
        </div>
      </div>
    </div>
  </section> -->

  <!-- Newsletter Section -->
  <section class="newsletter-section">
    <div class="container">
      <div class="newsletter-container">
        <div class="newsletter-content">
          <h2>Inscreva-se em nossa Newsletter</h2>
          <p>
            Receba dicas de cuidados com plantas e ofertas exclusivas
            diretamente no seu e-mail.
          </p>
        </div>
        <form class="newsletter-form">
          <input type="email" placeholder="Seu endereço de e-mail" required />
          <button class="btn"">Inscrever-se</button>
        </form>
      </div>
    </div>
  </section>

  <?php require_once 'partials/footer.php'; ?>
</body>

</html>