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
}
