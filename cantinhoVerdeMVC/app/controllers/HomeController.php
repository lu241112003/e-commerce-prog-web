<?php

class HomeController extends Controller
{
  public function index()
  {
    $categoriaModel = $this->model('Categoria');
    $categorias = $categoriaModel->getCategoriasDestaque(4);

    $produtoModel = $this->model('Produto');
    $produtos = $produtoModel->getProdutosDestaque(4);

    $this->view('home', [
      'categorias' => $categorias,
      'produtos' => $produtos
    ]);
  }
}
