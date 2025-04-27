-- Criação do banco de dados
CREATE DATABASE plantashop;
USE plantashop;

-- Tabela de Usuários
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    sobrenome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    telefone VARCHAR(20),
    data_nascimento DATE,
    data_cadastro DATETIME DEFAULT CURRENT_TIMESTAMP,
    ultimo_acesso DATETIME,
    status ENUM('ativo', 'inativo', 'bloqueado') DEFAULT 'ativo',
    tipo ENUM('cliente', 'admin', 'vendedor') DEFAULT 'cliente'
);

-- Tabela de Endereços
CREATE TABLE enderecos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    tipo ENUM('entrega', 'cobranca', 'ambos') DEFAULT 'entrega',
    cep VARCHAR(10) NOT NULL,
    logradouro VARCHAR(100) NOT NULL,
    numero VARCHAR(20) NOT NULL,
    complemento VARCHAR(100),
    bairro VARCHAR(100) NOT NULL,
    cidade VARCHAR(100) NOT NULL,
    estado VARCHAR(2) NOT NULL,
    padrao BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
);

-- Tabela de Categorias
CREATE TABLE categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT,
    destaque BOOLEAN DEFAULT FALSE,
    slug VARCHAR(100) NOT NULL UNIQUE,
    imagem VARCHAR(255),
    categoria_pai_id INT,
    status ENUM('ativo', 'inativo') DEFAULT 'ativo',
    FOREIGN KEY (categoria_pai_id) REFERENCES categorias(id) ON DELETE SET NULL
);

-- Tabela de Fornecedores
CREATE TABLE fornecedores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    cnpj VARCHAR(20) UNIQUE,
    email VARCHAR(100),
    telefone VARCHAR(20),
    endereco VARCHAR(255),
    contato_nome VARCHAR(100),
    status ENUM('ativo', 'inativo') DEFAULT 'ativo'
);

-- Tabela de Produtos
CREATE TABLE produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT,
    descricao_curta VARCHAR(255),
    preco DECIMAL(10, 2) NOT NULL,
    preco_promocional DECIMAL(10, 2),
    sku VARCHAR(50) UNIQUE,
    estoque INT NOT NULL DEFAULT 0,
    peso DECIMAL(10, 2),
    dimensoes VARCHAR(50),
    nivel_cuidado ENUM('facil', 'medio', 'avancado'),
    tamanho ENUM('pequeno', 'medio', 'grande'),
    ambiente ENUM('interior', 'exterior', 'ambos'),
    luz ENUM('baixa', 'media', 'alta'),
    agua ENUM('pouca', 'media', 'muita'),
    slug VARCHAR(100) NOT NULL UNIQUE,
    destaque BOOLEAN DEFAULT FALSE,
    novo BOOLEAN DEFAULT FALSE,
    status ENUM('ativo', 'inativo', 'esgotado') DEFAULT 'ativo',
    data_cadastro DATETIME DEFAULT CURRENT_TIMESTAMP,
    data_atualizacao DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    -- fornecedor_id INT,
    -- FOREIGN KEY (fornecedor_id) REFERENCES fornecedores(id) ON DELETE SET NULL
);

-- Tabela de Relacionamento Produto-Categoria
CREATE TABLE produto_categoria (
    produto_id INT NOT NULL,
    categoria_id INT NOT NULL,
    PRIMARY KEY (produto_id, categoria_id),
    FOREIGN KEY (produto_id) REFERENCES produtos(id) ON DELETE CASCADE,
    FOREIGN KEY (categoria_id) REFERENCES categorias(id) ON DELETE CASCADE
);

-- Tabela de Imagens de Produtos
CREATE TABLE produto_imagens (
    id INT AUTO_INCREMENT PRIMARY KEY,
    produto_id INT NOT NULL,
    url VARCHAR(255) NOT NULL,
    ordem INT DEFAULT 0,
    principal BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (produto_id) REFERENCES produtos(id) ON DELETE CASCADE
);

-- Tabela de Avaliações de Produtos
CREATE TABLE avaliacoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    produto_id INT NOT NULL,
    usuario_id INT NOT NULL,
    nota INT NOT NULL CHECK (nota BETWEEN 1 AND 5),
    comentario TEXT,
    data_avaliacao DATETIME DEFAULT CURRENT_TIMESTAMP,
    status ENUM('pendente', 'aprovado', 'rejeitado') DEFAULT 'pendente',
    FOREIGN KEY (produto_id) REFERENCES produtos(id) ON DELETE CASCADE,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
);

-- Tabela de Carrinhos
CREATE TABLE carrinhos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    sessao_id VARCHAR(100),
    data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP,
    data_atualizacao DATETIME ON UPDATE CURRENT_TIMESTAMP,
    status ENUM('ativo', 'abandonado', 'convertido') DEFAULT 'ativo',
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE SET NULL
);

-- Tabela de Itens do Carrinho
CREATE TABLE carrinho_itens (
    id INT AUTO_INCREMENT PRIMARY KEY,
    carrinho_id INT NOT NULL,
    produto_id INT NOT NULL,
    quantidade INT NOT NULL DEFAULT 1,
    preco_unitario DECIMAL(10, 2) NOT NULL,
    data_adicao DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (carrinho_id) REFERENCES carrinhos(id) ON DELETE CASCADE,
    FOREIGN KEY (produto_id) REFERENCES produtos(id) ON DELETE CASCADE
);

-- Tabela de Cupons de Desconto
CREATE TABLE cupons (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo VARCHAR(50) NOT NULL UNIQUE,
    tipo ENUM('percentual', 'valor_fixo') NOT NULL,
    valor DECIMAL(10, 2) NOT NULL,
    data_inicio DATETIME NOT NULL,
    data_fim DATETIME NOT NULL,
    uso_maximo INT,
    uso_atual INT DEFAULT 0,
    valor_minimo DECIMAL(10, 2),
    status ENUM('ativo', 'inativo') DEFAULT 'ativo'
);

-- Tabela de Pedidos
CREATE TABLE pedidos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    endereco_entrega_id INT,
    cupom_id INT,
    codigo VARCHAR(20) NOT NULL UNIQUE,
    subtotal DECIMAL(10, 2) NOT NULL,
    desconto DECIMAL(10, 2) DEFAULT 0,
    frete DECIMAL(10, 2) DEFAULT 0,
    total DECIMAL(10, 2) NOT NULL,
    status ENUM('aguardando_pagamento', 'pagamento_aprovado', 'em_preparacao', 'enviado', 'entregue', 'cancelado') DEFAULT 'aguardando_pagamento',
    metodo_pagamento VARCHAR(50),
    codigo_rastreio VARCHAR(50),
    observacoes TEXT,
    data_pedido DATETIME DEFAULT CURRENT_TIMESTAMP,
    data_atualizacao DATETIME ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE SET NULL,
    FOREIGN KEY (endereco_entrega_id) REFERENCES enderecos(id) ON DELETE SET NULL,
    FOREIGN KEY (cupom_id) REFERENCES cupons(id) ON DELETE SET NULL
);

-- Tabela de Itens do Pedido
CREATE TABLE pedido_itens (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pedido_id INT NOT NULL,
    produto_id INT NOT NULL,
    quantidade INT NOT NULL,
    preco_unitario DECIMAL(10, 2) NOT NULL,
    subtotal DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (pedido_id) REFERENCES pedidos(id) ON DELETE CASCADE,
    FOREIGN KEY (produto_id) REFERENCES produtos(id) ON DELETE CASCADE
);

-- Tabela de Status do Pedido (histórico)
CREATE TABLE pedido_status_historico (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pedido_id INT NOT NULL,
    status ENUM('aguardando_pagamento', 'pagamento_aprovado', 'em_preparacao', 'enviado', 'entregue', 'cancelado') NOT NULL,
    comentario TEXT,
    data_alteracao DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (pedido_id) REFERENCES pedidos(id) ON DELETE CASCADE
);

-- Tabela de Pagamentos
CREATE TABLE pagamentos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pedido_id INT NOT NULL,
    metodo VARCHAR(50) NOT NULL,
    status ENUM('pendente', 'aprovado', 'recusado', 'estornado') DEFAULT 'pendente',
    valor DECIMAL(10, 2) NOT NULL,
    codigo_transacao VARCHAR(100),
    data_pagamento DATETIME,
    data_atualizacao DATETIME ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (pedido_id) REFERENCES pedidos(id) ON DELETE CASCADE
);

-- Tabela de Lista de Desejos
CREATE TABLE lista_desejos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    produto_id INT NOT NULL,
    data_adicao DATETIME DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY (usuario_id, produto_id),
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE,
    FOREIGN KEY (produto_id) REFERENCES produtos(id) ON DELETE CASCADE
);

-- Tabela de Perguntas e Respostas
CREATE TABLE perguntas_respostas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    produto_id INT NOT NULL,
    usuario_id INT NOT NULL,
    pergunta TEXT NOT NULL,
    resposta TEXT,
    data_pergunta DATETIME DEFAULT CURRENT_TIMESTAMP,
    data_resposta DATETIME,
    status ENUM('pendente', 'respondida', 'rejeitada') DEFAULT 'pendente',
    FOREIGN KEY (produto_id) REFERENCES produtos(id) ON DELETE CASCADE,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
);

-- Tabela de Newsletter
CREATE TABLE newsletter (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL UNIQUE,
    nome VARCHAR(100),
    data_cadastro DATETIME DEFAULT CURRENT_TIMESTAMP,
    status ENUM('ativo', 'inativo') DEFAULT 'ativo'
);

-- Tabela de Contatos/Mensagens
CREATE TABLE contatos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    telefone VARCHAR(20),
    assunto VARCHAR(100),
    mensagem TEXT NOT NULL,
    data_envio DATETIME DEFAULT CURRENT_TIMESTAMP,
    status ENUM('novo', 'lido', 'respondido') DEFAULT 'novo'
);

-- Tabela de Configurações do Site
CREATE TABLE configuracoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    chave VARCHAR(50) NOT NULL UNIQUE,
    valor TEXT,
    descricao VARCHAR(255)
);

-- Inserir algumas configurações iniciais
INSERT INTO configuracoes (chave, valor, descricao) VALUES
('site_nome', 'PlantaShop', 'Nome do site'),
('site_descricao', 'Marketplace de plantas online', 'Descrição do site'),
('email_contato', 'contato@plantashop.com.br', 'Email de contato'),
('telefone_contato', '(11) 99999-9999', 'Telefone de contato'),
('endereco', 'Av. das Plantas, 123 - São Paulo', 'Endereço físico'),
('redes_sociais', '{"facebook":"https://facebook.com/plantashop","instagram":"https://instagram.com/plantashop"}', 'Redes sociais em formato JSON');

-- Índices para melhorar a performance
CREATE INDEX idx_produtos_nome ON produtos(nome);
CREATE INDEX idx_produtos_preco ON produtos(preco);
CREATE INDEX idx_produtos_status ON produtos(status);
CREATE INDEX idx_pedidos_usuario ON pedidos(usuario_id);
CREATE INDEX idx_pedidos_status ON pedidos(status);
CREATE INDEX idx_avaliacoes_produto ON avaliacoes(produto_id);