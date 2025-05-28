<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= APP_NAME ?></title>
  <link rel="stylesheet" href="<?= BASE_URL ?>/css/style.css" />
  <link rel="stylesheet" href="<?= BASE_URL ?>/css/sobre.css" />
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
          <li><a href="<?= BASE_URL ?>/categorias">Categorias</a></li>
          <li><a href="<?= BASE_URL ?>/sobre" class="active">Sobre</a></li>
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
      <h1>Sobre Nós</h1>
      <div class="breadcrumb">
        <a href="index.html">Home</a> / <span>Sobre Nós</span>
      </div>
    </div>
  </section>

  <!-- About Intro Section -->
  <section class="about-intro">
    <div class="container">
      <div class="about-intro-container">
        <div class="about-intro-content">
          <h2>Conheça a Plantas Marketplace</h2>
          <p class="subtitle">Transformando espaços com verde desde 2015</p>
          <p>
            Somos uma empresa apaixonada por plantas e pela natureza, dedicada
            a trazer mais verde para a vida das pessoas. Nossa jornada começou
            com uma pequena loja física e hoje somos um dos maiores
            marketplaces de plantas do Brasil.
          </p>
          <p>
            Na Plantas Marketplace, acreditamos que cada planta tem o poder de
            transformar um ambiente e melhorar a qualidade de vida. Por isso,
            trabalhamos com dedicação para oferecer as melhores espécies,
            cuidadosamente selecionadas e cultivadas com amor.
          </p>

          <div class="about-stats">
            <div class="stat-item">
              <div class="stat-number">8+</div>
              <div class="stat-text">Anos de Experiência</div>
            </div>
            <div class="stat-item">
              <div class="stat-number">5000+</div>
              <div class="stat-text">Clientes Satisfeitos</div>
            </div>
            <div class="stat-item">
              <div class="stat-number">300+</div>
              <div class="stat-text">Variedades de Plantas</div>
            </div>
            <div class="stat-item">
              <div class="stat-number">98%</div>
              <div class="stat-text">Taxa de Satisfação</div>
            </div>
          </div>
        </div>
        <div class="about-intro-image">
          <img
            src="images/about/about-intro.jpg"
            alt="Equipe Plantas Marketplace" />
        </div>
      </div>
    </div>
  </section>

  <!-- Our Story Section -->
  <section class="our-story">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title">Nossa História</h2>
        <p class="section-subtitle">
          Uma jornada de paixão, crescimento e amor pelas plantas
        </p>
      </div>

      <div class="timeline">
        <div class="timeline-item">
          <div class="timeline-dot"></div>
          <!-- <div class="timeline-date">2015</div> -->
          <div class="timeline-content">
            <h3>O Início</h3>
            <p>
              Tudo começou com uma pequena loja física no bairro Jardim
              Botânico, fundada pelos amigos Maria e João, ambos apaixonados
              por plantas e jardinagem.
            </p>
          </div>
        </div>

        <div class="timeline-item">
          <div class="timeline-dot"></div>
          <!-- <div class="timeline-date">2017</div> -->
          <div class="timeline-content">
            <h3>Expansão</h3>
            <p>
              Com o crescimento da demanda, expandimos nossa loja física e
              começamos a oferecer serviços de paisagismo e consultoria em
              jardinagem.
            </p>
          </div>
        </div>

        <div class="timeline-item">
          <div class="timeline-dot"></div>
          <!-- <div class="timeline-date">2019</div> -->
          <div class="timeline-content">
            <h3>Entrada no Digital</h3>
            <p>
              Lançamos nossa primeira loja online, permitindo que clientes de
              todo o Brasil tivessem acesso às nossas plantas e produtos.
            </p>
          </div>
        </div>

        <div class="timeline-item">
          <div class="timeline-dot"></div>
          <!-- <div class="timeline-date">2020</div> -->
          <div class="timeline-content">
            <h3>Crescimento Durante a Pandemia</h3>
            <p>
              Durante a pandemia, vimos um aumento significativo na demanda
              por plantas para decoração de interiores, o que nos levou a
              expandir nossa equipe e operações.
            </p>
          </div>
        </div>

        <div class="timeline-item">
          <div class="timeline-dot"></div>
          <!-- <div class="timeline-date">2022</div> -->
          <div class="timeline-content">
            <h3>Marketplace</h3>
            <p>
              Transformamos nosso e-commerce em um marketplace, permitindo que
              produtores e vendedores de plantas de todo o país pudessem
              oferecer seus produtos em nossa plataforma.
            </p>
          </div>
        </div>

        <div class="timeline-item">
          <div class="timeline-dot"></div>
          <!-- <div class="timeline-date">2023</div> -->
          <div class="timeline-content">
            <h3>Presente e Futuro</h3>
            <p>
              Hoje, somos um dos maiores marketplaces de plantas do Brasil,
              com mais de 300 variedades de plantas e milhares de clientes
              satisfeitos. Continuamos crescendo e inovando, sempre com o
              objetivo de aproximar as pessoas da natureza.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Our Mission Section -->
  <section class="our-mission">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title">Missão, Visão e Valores</h2>
        <p class="section-subtitle">
          Os princípios que guiam nossa empresa e nosso trabalho
        </p>
      </div>

      <div class="mission-container">
        <div class="mission-item">
          <div class="mission-icon">
            <i class="fas fa-seedling"></i>
          </div>
          <h3>Missão</h3>
          <p>
            Aproximar as pessoas da natureza, oferecendo plantas de qualidade
            e conhecimento sobre seu cultivo, contribuindo para ambientes mais
            saudáveis e harmoniosos.
          </p>
        </div>

        <div class="mission-item">
          <div class="mission-icon">
            <i class="fas fa-eye"></i>
          </div>
          <h3>Visão</h3>
          <p>
            Ser reconhecida como a principal referência em plantas e
            jardinagem no Brasil, inspirando as pessoas a cultivarem seu
            próprio verde e a valorizarem a natureza.
          </p>
        </div>

        <div class="mission-item">
          <div class="mission-icon">
            <i class="fas fa-heart"></i>
          </div>
          <h3>Valores</h3>
          <p>
            Sustentabilidade, qualidade, conhecimento, paixão pela natureza,
            atendimento personalizado e compromisso com a satisfação do
            cliente.
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- Our Team Section -->
  <section class="our-team">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title">Nossa Equipe</h2>
        <p class="section-subtitle">
          Conheça as pessoas apaixonadas que fazem a Plantas Marketplace
          acontecer
        </p>
      </div>

      <div class="team-container">
        <div class="team-member">
          <div class="member-image">
            <img src="images/team/maria.jpg" alt="Maria Silva" />
          </div>
          <div class="member-info">
            <h3>Maria Silva</h3>
            <div class="member-role">Co-fundadora e CEO</div>
            <p class="member-bio">
              Bióloga por formação e apaixonada por plantas desde a infância,
              Maria é a mente criativa por trás da Plantas Marketplace.
            </p>
            <div class="member-social">
              <a href="#"><i class="fab fa-linkedin-in"></i></a>
              <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
          </div>
        </div>

        <div class="team-member">
          <div class="member-image">
            <img src="images/team/joao.jpg" alt="João Santos" />
          </div>
          <div class="member-info">
            <h3>João Santos</h3>
            <div class="member-role">Co-fundador e COO</div>
            <p class="member-bio">
              Com experiência em gestão e logística, João é responsável por
              garantir que todas as operações da empresa funcionem
              perfeitamente.
            </p>
            <div class="member-social">
              <a href="#"><i class="fab fa-linkedin-in"></i></a>
              <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
          </div>
        </div>

        <div class="team-member">
          <div class="member-image">
            <img src="images/team/ana.jpg" alt="Ana Oliveira" />
          </div>
          <div class="member-info">
            <h3>Ana Oliveira</h3>
            <div class="member-role">Especialista em Botânica</div>
            <p class="member-bio">
              Mestre em Botânica, Ana é nossa especialista em plantas e
              responsável pela seleção e qualidade de todas as espécies que
              oferecemos.
            </p>
            <div class="member-social">
              <a href="#"><i class="fab fa-linkedin-in"></i></a>
              <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
          </div>
        </div>

        <div class="team-member">
          <div class="member-image">
            <img src="images/team/pedro.jpg" alt="Pedro Almeida" />
          </div>
          <div class="member-info">
            <h3>Pedro Almeida</h3>
            <div class="member-role">Gerente de E-commerce</div>
            <p class="member-bio">
              Com vasta experiência em comércio eletrônico, Pedro lidera nossa
              equipe digital e é responsável pela experiência do cliente
              online.
            </p>
            <div class="member-social">
              <a href="#"><i class="fab fa-linkedin-in"></i></a>
              <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Testimonials Section -->
  <section class="testimonials">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title">O Que Nossos Clientes Dizem</h2>
        <p class="section-subtitle">
          Depoimentos de pessoas que transformaram seus espaços com nossas
          plantas
        </p>
      </div>

      <div class="testimonials-slider">
        <div class="testimonial-item">
          <div class="testimonial-content">
            <div class="testimonial-rating">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
            </div>
            <p class="testimonial-text">
              "Comprei várias plantas para meu apartamento e fiquei
              impressionada com a qualidade e o cuidado no envio. Todas
              chegaram perfeitas e estão se desenvolvendo muito bem. O
              atendimento foi excelente!"
            </p>
            <div class="testimonial-author">
              <img src="images/testimonials/client1.jpg" alt="Carla Mendes" />
              <div class="author-info">
                <h4>Carla Mendes</h4>
                <span>São Paulo, SP</span>
              </div>
            </div>
          </div>
        </div>

        <div class="testimonial-item">
          <div class="testimonial-content">
            <div class="testimonial-rating">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
            </div>
            <p class="testimonial-text">
              "As suculentas que comprei são lindas e vieram muito bem
              embaladas. O guia de cuidados que acompanha cada planta é muito
              útil. Já recomendei para vários amigos!"
            </p>
            <div class="testimonial-author">
              <img
                src="images/testimonials/client2.jpg"
                alt="Roberto Costa" />
              <div class="author-info">
                <h4>Roberto Costa</h4>
                <span>Rio de Janeiro, RJ</span>
              </div>
            </div>
          </div>
        </div>

        <div class="testimonial-item">
          <div class="testimonial-content">
            <div class="testimonial-rating">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star-half-alt"></i>
            </div>
            <p class="testimonial-text">
              "O que mais me impressionou foi o atendimento personalizado. A
              equipe me ajudou a escolher as plantas ideais para meu
              escritório, considerando a iluminação e o espaço disponível.
              Resultado incrível!"
            </p>
            <div class="testimonial-author">
              <img
                src="images/testimonials/client3.jpg"
                alt="Fernanda Lima" />
              <div class="author-info">
                <h4>Fernanda Lima</h4>
                <span>Belo Horizonte, MG</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Partners Section -->
  <section class="partners">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title">Nossos Parceiros</h2>
        <p class="section-subtitle">
          Empresas e instituições que confiam em nosso trabalho
        </p>
      </div>

      <div class="partners-grid">
        <div class="partner-item">
          <img src="images/partners/partner1.png" alt="Parceiro 1" />
        </div>
        <div class="partner-item">
          <img src="images/partners/partner2.png" alt="Parceiro 2" />
        </div>
        <div class="partner-item">
          <img src="images/partners/partner3.png" alt="Parceiro 3" />
        </div>
        <div class="partner-item">
          <img src="images/partners/partner4.png" alt="Parceiro 4" />
        </div>
        <div class="partner-item">
          <img src="images/partners/partner5.png" alt="Parceiro 5" />
        </div>
        <div class="partner-item">
          <img src="images/partners/partner6.png" alt="Parceiro 6" />
        </div>
      </div>
    </div>
  </section>

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
          <button class="btn">Inscrever-se</button>
        </form>
      </div>
    </div>
  </section>

  <?php require_once 'partials/footer.php'; ?>
</body>

</html>


  <!-- Newsletter Section -->