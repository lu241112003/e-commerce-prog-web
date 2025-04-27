<?php

class ProdutosController extends Controller
{
  public function index()
  {
    $pagina = max(1, $_GET['pagina'] ?? 1);
    $itensPorPagina = 12;

    // Processar os filtros recebidos
    $filtros = [
      'categoria_id' => $_GET['categoria'] ?? null,
      'preco_max' => $_GET['preco_max'] ?? null,
      'tamanhos' => isset($_GET['tamanhos']) ? (array)$_GET['tamanhos'] : [],
      'niveis' => isset($_GET['niveis']) ? (array)$_GET['niveis'] : [],
      'ordenacao' => $_GET['ordenar'] ?? null,
    ];

    $produtoModel = $this->model('Produto');
    $resultado = $produtoModel->getProdutos($pagina, $itensPorPagina, $filtros);

    $categorias = $produtoModel->getCategoriasAtivas();

    $totalProdutos = $resultado['total'] ?? 0;
    $totalPaginas = max(1, ceil($totalProdutos / $itensPorPagina));

    $this->view('produtos', [
      'produtos' => $resultado['produtos'] ?? [],
      'categorias' => $categorias,
      'paginaAtual' => $pagina,
      'totalPaginas' => $totalPaginas,
      'totalProdutos' => $totalProdutos,
      'itensPorPagina' => $itensPorPagina,
      'filtros' => $filtros
    ]);
  }
}
