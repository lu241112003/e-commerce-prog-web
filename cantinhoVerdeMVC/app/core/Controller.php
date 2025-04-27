<?php

class Controller
{
    public function model($model)
    {
        require_once '../app/models/' . $model . '.php';
        return new $model;
    }

    public function view($view, $data = [])
    {
        $viewFile = '../app/views/' . $view . '.php';
        if (!file_exists($viewFile)) {
            throw new Exception("View {$view} não encontrada");
        }

        extract($data);
        require_once $viewFile;
    }

    protected function getQueryString($exclude = [])
    {
        $query = [];
        foreach ($_GET as $key => $value) {
            if (!in_array($key, $exclude)) {
                if (is_array($value)) {
                    foreach ($value as $item) {
                        $query[] = $key . '[]=' . urlencode($item);
                    }
                } else {
                    $query[] = $key . '=' . urlencode($value);
                }
            }
        }
        return $query ? '&' . implode('&', $query) : '';
    }
}
