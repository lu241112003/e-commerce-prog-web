<?php

class ProdutosController extends Controller
{
  public function index()
  {
    $produtoModel = $this->model('Produto');
    $produtos = $produtoModel->getProdutosDestaque(4);

    $this->view('produtos', ['produtos' => $produtos]);
  }
}
