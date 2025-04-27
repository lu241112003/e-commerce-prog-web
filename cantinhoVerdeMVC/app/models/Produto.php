<?php

class Produto extends Model
{
  // Função para puxar os produtos da HomePage
  public function getProdutosDestaque($limit)
  {
    try {
      $query = "SELECT p.id, p.nome, p.descricao_curta, p.preco, p.preco_promocional, 
                       p.slug, p.destaque, p.novo, pi.url as imagem_principal
              FROM produtos p
              LEFT JOIN produto_imagens pi ON (p.id = pi.produto_id AND pi.principal = TRUE)
              WHERE p.destaque = 1 AND p.status = 'ativo' AND p.estoque > 0
              LIMIT :limit";

      $stmt = $this->db->prepare($query);
      $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
      $stmt->execute();

      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

      if (DEBUG_MODE) {
        error_log('[Produtos] Dados retornados: ' . print_r($result, true));
      }

      return $result;
    } catch (PDOException $e) {
      error_log("[ERRO] Falha ao buscar produtos em destaque: " . $e->getMessage());
      return [];
    }
  }

  public function getProdutos($pagina = 1, $itensPorPagina = 12, $filtros = [])
  {
    try {
      $offset = ($pagina - 1) * $itensPorPagina;
      $params = [];

      $query = "SELECT SQL_CALC_FOUND_ROWS p.id, p.nome, p.descricao_curta, p.preco, 
                  p.preco_promocional, p.slug, p.destaque, p.novo, 
                  pi.url as imagem_principal
                FROM produtos p
                LEFT JOIN produto_imagens pi ON (p.id = pi.produto_id AND pi.principal = TRUE)";

      // Adiciona JOIN com a tabela de relacionamento se houver filtro por categoria
      if (!empty($filtros['categoria_id'])) {
        $query .= " JOIN produto_categoria pc ON (p.id = pc.produto_id)";
      }

      $query .= " WHERE p.status = 'ativo' AND p.estoque > 0";

      // Filtro por categoria
      if (!empty($filtros['categoria_id'])) {
        $query .= " AND pc.categoria_id = :categoria_id";
        $params[':categoria_id'] = $filtros['categoria_id'];
      }

      // Filtro por preço
      if (!empty($filtros['preco_max'])) {
        $query .= " AND (COALESCE(p.preco_promocional, p.preco) <= :preco_max)";
        $params[':preco_max'] = $filtros['preco_max'];
      }

      // Filtro por tamanho
      if (!empty($filtros['tamanhos']) && is_array($filtros['tamanhos'])) {
        $placeholders = [];
        foreach ($filtros['tamanhos'] as $i => $tamanho) {
          $placeholder = ":tamanho_$i";
          $placeholders[] = $placeholder;
          $params[$placeholder] = $tamanho;
        }
        $query .= " AND p.tamanho IN (" . implode(",", $placeholders) . ")";
      }

      // Filtro por nível de cuidado
      if (!empty($filtros['niveis']) && is_array($filtros['niveis'])) {
        $placeholders = [];
        foreach ($filtros['niveis'] as $i => $nivel) {
          $placeholder = ":nivel_$i";
          $placeholders[] = $placeholder;
          $params[$placeholder] = $nivel;
        }
        $query .= " AND p.nivel_cuidado IN (" . implode(",", $placeholders) . ")";
      }

      // Ordenação
      $query .= $this->getOrderBy($filtros['ordenacao'] ?? '');

      // Paginação
      $query .= " LIMIT :limit OFFSET :offset";
      $params[':limit'] = $itensPorPagina;
      $params[':offset'] = $offset;

      $stmt = $this->db->prepare($query);

      // Bind dos parâmetros
      foreach ($params as $key => $value) {
        $paramType = is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR;
        $stmt->bindValue($key, $value, $paramType);
      }

      $stmt->execute();
      $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

      // Obter o total de produtos
      $total = $this->db->query("SELECT FOUND_ROWS()")->fetchColumn();

      return [
        'produtos' => $produtos,
        'total' => $total
      ];
    } catch (PDOException $e) {
      error_log("[ERRO] Falha ao buscar produtos: " . $e->getMessage());
      return ['produtos' => [], 'total' => 0];
    }
  }

  private function getOrderBy($ordenacao)
  {
    switch ($ordenacao) {
      case 'price-low':
        return " ORDER BY COALESCE(preco_promocional, preco) ASC";
      case 'price-high':
        return " ORDER BY COALESCE(preco_promocional, preco) DESC";
      case 'newest':
        return " ORDER BY p.data_cadastro DESC";
      case 'popular':
        return " ORDER BY p.visualizacoes DESC";
      default:
        return " ORDER BY p.destaque DESC, p.data_cadastro DESC";
    }
  }

  public function getCategoriasAtivas()
  {
    try {
      $stmt = $this->db->query("SELECT id, nome, slug FROM categorias WHERE status = 'ativo'");
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log("[ERRO] Falha ao buscar categorias: " . $e->getMessage());
      return [];
    }
  }
}
