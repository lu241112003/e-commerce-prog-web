
```sql project="Fork of Plantas marketplace site" file="sql/database.sql" type="code"
-- Criação do banco de dados
CREATE DATABASE IF NOT EXISTS plantas_marketplace;
USE plantas_marketplace;

-- Tabela de Categorias
CREATE TABLE categorias (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100) NOT NULL,
  slug VARCHAR(100) NOT NULL UNIQUE,
  descricao TEXT,
  imagem VARCHAR(255),
  destaque BOOLEAN DEFAULT FALSE,
  ordem INT DEFAULT 0,
  data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  data_atualizacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabela de Produtos
CREATE TABLE produtos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(255) NOT NULL,
  slug VARCHAR(255) NOT NULL UNIQUE,
  sku VARCHAR(50),
  descricao_curta TEXT,
  descricao_completa TEXT,
  preco DECIMAL(10, 2) NOT NULL,
  preco_promocional DECIMAL(10, 2),
  estoque INT NOT NULL DEFAULT 0,
  categoria_id INT,
  tamanho ENUM('pequeno', 'medio', 'grande'),
  nivel_cuidado ENUM('facil', 'medio', 'avancado'),
  necessidade_luz ENUM('baixa', 'media', 'alta'),
  frequencia_rega ENUM('diaria', 'semanal', 'quinzenal', 'mensal'),
  purifica_ar BOOLEAN DEFAULT FALSE,
  pet_friendly BOOLEAN DEFAULT FALSE,
  baixa_manutencao BOOLEAN DEFAULT FALSE,
  medicinal BOOLEAN DEFAULT FALSE,
  comestivel BOOLEAN DEFAULT FALSE,
  destaque BOOLEAN DEFAULT FALSE,
  novo BOOLEAN DEFAULT FALSE,
  status ENUM('published', 'draft', 'outofstock') DEFAULT 'published',
  visualizacoes INT DEFAULT 0,
  vendas INT DEFAULT 0,
  data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  data_atualizacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (categoria_id) REFERENCES categorias(id) ON DELETE SET NULL
);

-- Tabela de Imagens de Produtos
CREATE TABLE imagens_produtos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  produto_id INT NOT NULL,
  url VARCHAR(255) NOT NULL,
  ordem INT DEFAULT 0,
  principal BOOLEAN DEFAULT FALSE,
  data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (produto_id) REFERENCES produtos(id) ON DELETE CASCADE
);

-- Tabela de Tags
CREATE TABLE tags (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(50) NOT NULL,
  slug VARCHAR(50) NOT NULL UNIQUE,
  data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela de Relacionamento Produtos-Tags
CREATE TABLE produtos_tags (
  produto_id INT NOT NULL,
  tag_id INT NOT NULL,
  PRIMARY KEY (produto_id, tag_id),
  FOREIGN KEY (produto_id) REFERENCES produtos(id) ON DELETE CASCADE,
  FOREIGN KEY (tag_id) REFERENCES tags(id) ON DELETE CASCADE
);

-- Tabela de Usuários
CREATE TABLE usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL UNIQUE,
  senha VARCHAR(255) NOT NULL,
  tipo ENUM('admin', 'cliente') NOT NULL DEFAULT 'cliente',
  status ENUM('ativo', 'inativo') DEFAULT 'ativo',
  ultimo_acesso TIMESTAMP NULL,
  data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  data_atualizacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabela de Clientes
CREATE TABLE clientes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  usuario_id INT NOT NULL,
  cpf VARCHAR(14) UNIQUE,
  telefone VARCHAR(20),
  data_nascimento DATE,
  genero ENUM('masculino', 'feminino', 'outro', 'prefiro_nao_informar'),
  newsletter BOOLEAN DEFAULT FALSE,
  data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  data_atualizacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
);

-- Tabela de Endereços
CREATE TABLE enderecos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  cliente_id INT NOT NULL,
  nome VARCHAR(100) NOT NULL,
  cep VARCHAR(9) NOT NULL,
  logradouro VARCHAR(255) NOT NULL,
  numero VARCHAR(20) NOT NULL,
  complemento VARCHAR(100),
  bairro VARCHAR(100) NOT NULL,
  cidade VARCHAR(100) NOT NULL,
  estado CHAR(2) NOT NULL,
  principal BOOLEAN DEFAULT FALSE,
  tipo ENUM('entrega', 'cobranca', 'ambos') DEFAULT 'ambos',
  data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  data_atualizacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (cliente_id) REFERENCES clientes(id) ON DELETE CASCADE
);

-- Tabela de Pedidos
CREATE TABLE pedidos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  cliente_id INT,
  codigo VARCHAR(20) NOT NULL UNIQUE,
  status ENUM('aguardando_pagamento', 'pagamento_confirmado', 'em_processamento', 'enviado', 'entregue', 'cancelado') DEFAULT 'aguardando_pagamento',
  subtotal DECIMAL(10, 2) NOT NULL,
  desconto DECIMAL(10, 2) DEFAULT 0,
  frete DECIMAL(10, 2) DEFAULT 0,
  total DECIMAL(10, 2) NOT NULL,
  metodo_pagamento ENUM('cartao_credito', 'boleto', 'pix', 'transferencia') NOT NULL,
  endereco_entrega_id INT,
  endereco_cobranca_id INT,
  observacoes TEXT,
  data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  data_atualizacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (cliente_id) REFERENCES clientes(id) ON DELETE SET NULL,
  FOREIGN KEY (endereco_entrega_id) REFERENCES enderecos(id) ON DELETE SET NULL,
  FOREIGN KEY (endereco_cobranca_id) REFERENCES enderecos(id) ON DELETE SET NULL
);

-- Tabela de Itens do Pedido
CREATE TABLE itens_pedido (
  id INT AUTO_INCREMENT PRIMARY KEY,
  pedido_id INT NOT NULL,
  produto_id INT,
  nome_produto VARCHAR(255) NOT NULL,
  quantidade INT NOT NULL,
  preco_unitario DECIMAL(10, 2) NOT NULL,
  subtotal DECIMAL(10, 2) NOT NULL,
  data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (pedido_id) REFERENCES pedidos(id) ON DELETE CASCADE,
  FOREIGN KEY (produto_id) REFERENCES produtos(id) ON DELETE SET NULL
);

-- Tabela de Pagamentos
CREATE TABLE pagamentos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  pedido_id INT NOT NULL,
  status ENUM('pendente', 'aprovado', 'recusado', 'estornado') DEFAULT 'pendente',
  valor DECIMAL(10, 2) NOT NULL,
  metodo ENUM('cartao_credito', 'boleto', 'pix', 'transferencia') NOT NULL,
  codigo_transacao VARCHAR(100),
  detalhes TEXT,
  data_pagamento TIMESTAMP NULL,
  data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  data_atualizacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (pedido_id) REFERENCES pedidos(id) ON DELETE CASCADE
);

-- Tabela de Avaliações de Produtos
CREATE TABLE avaliacoes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  produto_id INT NOT NULL,
  cliente_id INT,
  nome VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL,
  titulo VARCHAR(255),
  comentario TEXT,
  nota INT NOT NULL CHECK (nota BETWEEN 1 AND 5),
  status ENUM('pendente', 'aprovado', 'rejeitado') DEFAULT 'pendente',
  data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (produto_id) REFERENCES produtos(id) ON DELETE CASCADE,
  FOREIGN KEY (cliente_id) REFERENCES clientes(id) ON DELETE SET NULL
);

-- Tabela de Lista de Desejos
CREATE TABLE lista_desejos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  cliente_id INT NOT NULL,
  produto_id INT NOT NULL,
  data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (cliente_id) REFERENCES clientes(id) ON DELETE CASCADE,
  FOREIGN KEY (produto_id) REFERENCES produtos(id) ON DELETE CASCADE,
  UNIQUE KEY (cliente_id, produto_id)
);

-- Tabela de Cupons de Desconto
CREATE TABLE cupons (
  id INT AUTO_INCREMENT PRIMARY KEY,
  codigo VARCHAR(20) NOT NULL UNIQUE,
  tipo ENUM('percentual', 'valor_fixo') NOT NULL,
  valor DECIMAL(10, 2) NOT NULL,
  data_inicio TIMESTAMP NOT NULL,
  data_fim TIMESTAMP NOT NULL,
  quantidade_maxima INT,
  quantidade_utilizada INT DEFAULT 0,
  valor_minimo DECIMAL(10, 2),
  primeira_compra BOOLEAN DEFAULT FALSE,
  status ENUM('ativo', 'inativo') DEFAULT 'ativo',
  data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  data_atualizacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabela de Configurações
CREATE TABLE configuracoes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  chave VARCHAR(100) NOT NULL UNIQUE,
  valor TEXT NOT NULL,
  descricao VARCHAR(255),
  data_atualizacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabela de Logs
CREATE TABLE logs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  usuario_id INT,
  acao VARCHAR(255) NOT NULL,
  tabela VARCHAR(100),
  registro_id INT,
  dados TEXT,
  ip VARCHAR(45),
  data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE SET NULL
);

-- Inserção de dados iniciais

-- Categorias
INSERT INTO categorias (nome, slug, descricao, destaque, ordem) VALUES
('Plantas de Interior', 'plantas-de-interior', 'Plantas ideais para ambientes internos com pouca luz direta', TRUE, 1),
('Plantas de Exterior', 'plantas-de-exterior', 'Plantas resistentes para jardins e áreas externas', TRUE, 2),
('Suculentas', 'suculentas', 'Plantas suculentas de baixa manutenção', TRUE, 3),
('Cactos', 'cactos', 'Variedade de cactos decorativos', TRUE, 4),
('Flores', 'flores', 'Plantas com flores para decoração', TRUE, 5),
('Acessórios', 'acessorios', 'Vasos, substratos e ferramentas para jardinagem', FALSE, 6);

-- Tags
INSERT INTO tags (nome, slug) VALUES
('Purifica o Ar', 'purifica-o-ar'),
('Pet Friendly', 'pet-friendly'),
('Baixa Manutenção', 'baixa-manutencao'),
('Medicinal', 'medicinal'),
('Comestível', 'comestivel'),
('Sombra', 'sombra'),
('Meia Sombra', 'meia-sombra'),
('Sol Pleno', 'sol-pleno'),
('Planta Pendente', 'planta-pendente'),
('Planta Tropical', 'planta-tropical');

-- Usuário Admin
INSERT INTO usuarios (nome, email, senha, tipo) VALUES
('Administrador', 'admin@plantasmarketplace.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');

-- Produtos
INSERT INTO produtos (nome, slug, sku, descricao_curta, descricao_completa, preco, categoria_id, tamanho, nivel_cuidado, necessidade_luz, frequencia_rega, purifica_ar, baixa_manutencao, destaque, estoque) VALUES
('Zamioculca', 'zamioculca', 'PLT-ZAM-001', 'A Zamioculca é uma planta de interior conhecida por sua resistência e baixa manutenção. Ideal para ambientes internos com pouca luz.', 'A Zamioculca (Zamioculcas zamiifolia) é uma planta tropical originária da África Oriental. Conhecida por sua resistência e capacidade de sobreviver em condições adversas, é uma escolha perfeita para iniciantes ou para quem não tem muito tempo para cuidar de plantas.\n\nSuas folhas são brilhantes, de um verde escuro intenso, e crescem em hastes eretas que podem atingir até 1 metro de altura. A planta tem um crescimento lento e pode viver por muitos anos com os cuidados adequados.\n\nAlém de sua beleza ornamental, a Zamioculca também é conhecida por suas propriedades purificadoras de ar, ajudando a melhorar a qualidade do ambiente interno.\n\nCuidados:\n- Luz: Prefere luz indireta, mas tolera ambientes com pouca luminosidade\n- Rega: Moderada, deixando o solo secar entre as regas\n- Solo: Bem drenado\n- Temperatura: Entre 18°C e 26°C\n- Umidade: Tolera ambientes secos\n- Adubação: A cada 3 meses durante a primavera e verão', 89.90, 1, 'medio', 'facil', 'baixa', 'quinzenal', TRUE, TRUE, TRUE, 15),
('Espada de São Jorge', 'espada-de-sao-jorge', 'PLT-ESJ-001', 'A Espada de São Jorge é uma planta resistente e de fácil cultivo, perfeita para iniciantes. Conhecida por suas propriedades protetoras.', 'A Espada de São Jorge (Sansevieria trifasciata) é uma planta originária da África Ocidental, conhecida por sua resistência e longevidade. Suas folhas são eretas, pontiagudas e apresentam listras horizontais em tons de verde e amarelo, dependendo da variedade.\n\nÉ uma planta extremamente resistente, que sobrevive em condições adversas e requer pouquíssima manutenção. Além de seu valor ornamental, é conhecida na cultura popular por suas propriedades protetoras e capacidade de purificar o ar, removendo toxinas como formaldeído e benzeno.\n\nCuidados:\n- Luz: Adapta-se a diferentes condições de luminosidade, desde luz indireta até sombra parcial\n- Rega: Pouca, apenas quando o solo estiver completamente seco\n- Solo: Bem drenado\n- Temperatura: Entre 15°C e 30°C\n- Umidade: Tolera ambientes secos\n- Adubação: A cada 6 meses', 64.50, 1, 'medio', 'facil', 'baixa', 'mensal', TRUE, TRUE, FALSE, 23),
('Suculenta Echeveria', 'suculenta-echeveria', 'PLT-SUC-001', 'A Echeveria é uma suculenta com rosetas de folhas carnudas em tons de verde, azul ou roxo. Perfeita para decoração de interiores.', 'A Echeveria é um gênero de plantas suculentas originárias do México e América Central. Caracteriza-se por formar rosetas de folhas carnudas, que podem apresentar diversas colorações, desde tons de verde até azul, roxo e rosa, dependendo da espécie e das condições de cultivo.\n\nSão plantas de pequeno porte, ideais para decoração de interiores, jardins de rochas ou composições com outras suculentas. Sua beleza está na simetria perfeita das rosetas e na diversidade de cores e texturas.\n\nCuidados:\n- Luz: Prefere luz direta pela manhã e indireta à tarde\n- Rega: Pouca, apenas quando o solo estiver completamente seco\n- Solo: Bem drenado, específico para cactos e suculentas\n- Temperatura: Entre 18°C e 27°C\n- Umidade: Prefere ambientes secos\n- Adubação: A cada 3 meses durante a primavera e verão', 29.90, 3, 'pequeno', 'facil', 'media', 'quinzenal', FALSE, TRUE, FALSE, 42),
('Cacto Mandacaru', 'cacto-mandacaru', 'PLT-CAC-001', 'O Mandacaru é um cacto nativo do Brasil, de crescimento colunar e flores brancas noturnas. Símbolo da resistência do sertão nordestino.', 'O Mandacaru (Cereus jamacaru) é um cacto nativo do Brasil, símbolo da caatinga e da resistência do sertão nordestino. Caracteriza-se por seu crescimento colunar, podendo atingir até 5 metros de altura em seu habitat natural.\n\nSeu caule é verde-azulado, com 4 a 6 costelas bem definidas e espinhos amarelados. Produz flores brancas, grandes e perfumadas, que se abrem durante a noite e duram apenas um dia. Após a floração, desenvolve frutos comestíveis de polpa branca com sementes pretas.\n\nCuidados:\n- Luz: Sol pleno\n- Rega: Mínima, apenas quando o solo estiver completamente seco\n- Solo: Bem drenado, específico para cactos\n- Temperatura: Entre 15°C e 35°C\n- Umidade: Prefere ambientes secos\n- Adubação: A cada 6 meses na primavera e verão', 39.90, 4, 'medio', 'facil', 'alta', 'mensal', FALSE, TRUE, FALSE, 18),
('Orquídea Phalaenopsis', 'orquidea-phalaenopsis', 'PLT-ORQ-001', 'A Phalaenopsis é uma orquídea de fácil cultivo, com flores duradouras em diversos tons. Perfeita para presentear e decorar ambientes.', 'A Phalaenopsis, conhecida como Orquídea Borboleta, é uma das orquídeas mais populares e fáceis de cultivar. Originária do sudeste asiático, caracteriza-se por suas flores grandes, exuberantes e duradouras, que podem permanecer abertas por até 3 meses.\n\nSuas flores aparecem em hastes longas e arqueadas, em diversos tons como branco, rosa, lilás, amarelo e mesclados. As folhas são verde-escuras, brilhantes e carnudas, dispostas em forma de roseta.\n\nCuidados:\n- Luz: Indireta e abundante, sem sol direto\n- Rega: Moderada, quando o substrato estiver quase seco\n- Substrato: Específico para orquídeas, com boa drenagem\n- Temperatura: Entre 18°C e 30°C\n- Umidade: Prefere ambientes úmidos\n- Adubação: Quinzenal durante a primavera e verão', 96.00, 5, 'medio', 'medio', 'media', 'semanal', FALSE, FALSE, TRUE, 3),
('Costela de Adão', 'costela-de-adao', 'PLT-CDA-001', 'A Costela de Adão é uma planta tropical com folhas grandes e recortadas. Tendência na decoração de interiores pelo seu visual exótico.', 'A Costela de Adão (Monstera deliciosa) é uma planta tropical originária das florestas da América Central. Tornou-se uma verdadeira tendência na decoração de interiores devido às suas folhas grandes, brilhantes e recortadas, que conferem um visual exótico e tropical aos ambientes.\n\nÉ uma planta de crescimento rápido e pode atingir grandes dimensões em condições ideais. Suas folhas jovens são inteiras e, à medida que a planta amadurece, desenvolvem os característicos recortes e furos, adaptação natural para resistir a ventos fortes e permitir a passagem de luz para as folhas inferiores na floresta.\n\nCuidados:\n- Luz: Indireta e abundante, sem sol direto\n- Rega: Moderada, mantendo o solo levemente úmido\n- Solo: Rico em matéria orgânica e bem drenado\n- Temperatura: Entre 18°C e 30°C\n- Umidade: Prefere ambientes úmidos\n- Adubação: Mensal durante a primavera e verão', 79.90, 1, 'grande', 'medio', 'media', 'semanal', TRUE, FALSE, TRUE, 0);

-- Imagens de Produtos
INSERT INTO imagens_produtos (produto_id, url, principal) VALUES
(1, 'images/products/planta1.jpg', TRUE),
(2, 'images/products/planta2.jpg', TRUE),
(3, 'images/products/planta3.jpg', TRUE),
(4, 'images/products/planta4.jpg', TRUE),
(5, 'images/products/planta5.jpg', TRUE),
(6, 'images/products/planta6.jpg', TRUE);

-- Relacionamento Produtos-Tags
INSERT INTO produtos_tags (produto_id, tag_id) VALUES
(1, 1), -- Zamioculca - Purifica o Ar
(1, 3), -- Zamioculca - Baixa Manutenção
(2, 1), -- Espada de São Jorge - Purifica o Ar
(2, 3), -- Espada de São Jorge - Baixa Manutenção
(3, 3), -- Suculenta Echeveria - Baixa Manutenção
(4, 3), -- Cacto Mandacaru - Baixa Manutenção
(6, 1); -- Costela de Adão - Purifica o Ar

-- Configurações
INSERT INTO configuracoes (chave, valor, descricao) VALUES
('site_title', 'Plantas Marketplace', 'Título do site'),
('site_description', 'Loja especializada em plantas ornamentais, suculentas, cactos e acessórios para jardinagem.', 'Descrição do site'),
('contact_email', 'contato@plantasmarketplace.com', 'Email de contato'),
('contact_phone', '(11) 99999-9999', 'Telefone de contato'),
('address', 'Av. das Plantas, 123 - Jardim Botânico', 'Endereço físico'),
('shipping_free_above', '150', 'Valor mínimo para frete grátis'),
('currency', 'BRL', 'Moeda utilizada no site'),
('currency_symbol', 'R$', 'Símbolo da moeda'),
('store_open', '1', 'Loja aberta para pedidos (1 = sim, 0 = não)');

-- Índices para otimização de consultas
CREATE INDEX idx_produtos_categoria ON produtos(categoria_id);
CREATE INDEX idx_produtos_status ON produtos(status);
CREATE INDEX idx_produtos_destaque ON produtos(destaque);
CREATE INDEX idx_produtos_novo ON produtos(novo);
CREATE INDEX idx_pedidos_cliente ON pedidos(cliente_id);
CREATE INDEX idx_pedidos_status ON pedidos(status);
CREATE INDEX idx_avaliacoes_produto ON avaliacoes(produto_id);
CREATE INDEX idx_avaliacoes_status ON avaliacoes(status);
