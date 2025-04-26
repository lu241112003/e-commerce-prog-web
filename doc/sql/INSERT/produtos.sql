INSERT INTO produtos (
    nome, descricao, descricao_curta, preco, preco_promocional, sku, estoque,
    peso, dimensoes, nivel_cuidado, tamanho, ambiente, luz, agua,
    slug, destaque, novo, status
) VALUES
(
    'Espada-de-São-Jorge',
    'Planta resistente ideal para ambientes internos com pouca luz.',
    'Resistente e purificadora de ar',
    39.90, NULL, 'ESJ001', 15,
    0.5, '60x10x10cm', 'facil', 'medio', 'interior', 'baixa', 'pouca',
    'espada-de-sao-jorge', TRUE, TRUE, 'ativo'
),
(
    'Cacto Bola',
    'Cacto decorativo que requer pouca água e muita luz solar.',
    'Ideal para decoração e pouca manutenção',
    19.90, 14.90, 'CACT002', 30,
    0.3, '15x10x10cm', 'facil', 'pequeno', 'interior', 'alta', 'pouca',
    'cacto-bola', FALSE, TRUE, 'ativo'
),
(
    'Samambaia',
    'Planta ornamental para ambientes com boa umidade.',
    'Verde vibrante e volumosa',
    25.00, NULL, 'SAM003', 20,
    0.6, '50x30x30cm', 'medio', 'medio', 'interior', 'media', 'media',
    'samambaia', TRUE, FALSE, 'ativo'
),
(
    'Jiboia',
    'Planta trepadeira de crescimento rápido e folhas decorativas.',
    'Fácil de cuidar e linda em vasos suspensos',
    29.90, 24.90, 'JIB004', 12,
    0.4, '70x20x20cm', 'facil', 'medio', 'ambos', 'media', 'media',
    'jiboia', TRUE, TRUE, 'ativo'
),
(
    'Ficus Lyrata',
    'Planta de folhas largas, excelente para salas amplas.',
    'Elegante e imponente',
    129.90, NULL, 'FIC005', 5,
    3.0, '150x50x50cm', 'avancado', 'grande', 'interior', 'alta', 'media',
    'ficus-lyrata', TRUE, FALSE, 'ativo'
),
(
    'Lírio da Paz',
    'Planta que floresce mesmo em ambientes com pouca luz.',
    'Flor branca e folhagem verde escura',
    45.90, 39.90, 'LIR006', 10,
    0.8, '40x20x20cm', 'facil', 'medio', 'interior', 'baixa', 'media',
    'lirio-da-paz', FALSE, TRUE, 'ativo'
),
(
    'Suculenta Mix',
    'Kit com 3 suculentas variadas, perfeitas para decorar.',
    'Práticas e fofas',
    29.90, 25.00, 'SUC007', 25,
    0.2, '10x10x10cm', 'facil', 'pequeno', 'interior', 'alta', 'pouca',
    'suculenta-mix', FALSE, TRUE, 'ativo'
),
(
    'Palmeira Ráfis',
    'Palmeira decorativa que se adapta bem a áreas internas com boa iluminação.',
    'Beleza tropical dentro de casa',
    89.90, NULL, 'PAL008', 8,
    2.5, '120x40x40cm', 'medio', 'grande', 'interior', 'media', 'media',
    'palmeira-rafis', TRUE, FALSE, 'ativo'
);
