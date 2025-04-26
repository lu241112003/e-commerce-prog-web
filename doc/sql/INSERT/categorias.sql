-- 1. Categoria principal: Plantas de Interior (com destaque TRUE)
INSERT INTO categorias (nome, descricao, slug, imagem, destaque, status)
VALUES (
  'Plantas de Interior',
  'Plantas ideais para ambientes internos, como salas e escritórios.',
  'plantas-de-interior',
  'https://images.unsplash.com/photo-1583753075968-1236ccb83c66?q=80&w=1354&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
  TRUE,
  'ativo'
);

-- 2. Subcategoria: Suculentas (associada à "Plantas de Interior" via categoria_pai_id, com destaque TRUE)
INSERT INTO categorias (nome, descricao, slug, imagem, categoria_pai_id, destaque, status)
VALUES (
  'Suculentas',
  'Pequenas plantas com grande capacidade de armazenar água, perfeitas para decoração interna.',
  'suculentas',
  'https://images.unsplash.com/photo-1475541148680-00e4fb86ee25?q=80&w=1349&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
  1,
  TRUE,
  'ativo'
);

-- 3. Categoria principal: Plantas para Jardim (com destaque TRUE)
INSERT INTO categorias (nome, descricao, slug, imagem, destaque, status)
VALUES (
  'Plantas para Jardim',
  'Plantas apropriadas para áreas externas e jardins residenciais.',
  'plantas-para-jardim',
  'https://images.unsplash.com/photo-1690253780091-e3f26d09202a?q=80&w=1394&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
  TRUE,
  'ativo'
);

-- 4. Categoria principal: Vasos e Acessórios (com destaque TRUE)
INSERT INTO categorias (nome, descricao, slug, imagem, destaque, status)
VALUES (
  'Vasos e Acessórios',
  'Vasos decorativos, ferramentas e acessórios para cuidar das suas plantas.',
  'vasos-e-acessorios',
  'https://plus.unsplash.com/premium_photo-1678836292812-8053f9f34be7?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8dmFzb3MlMjBlJTIwYWNlc3NvcmlvcyUyMGRlJTIwamFyZGluYWdlbXN8ZW58MHx8MHx8fDA%3D',
  TRUE,
  'ativo'
);
