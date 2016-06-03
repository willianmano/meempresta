<?php

Route::get('/', [
    'middleware' => 'auth',
    'uses' => 'IndexController@getIndex'
]);

Route::controllers([
    'auth' => 'Auth\AuthController',
    'contatos' => 'ContatosController',
    'emprestimos' => 'EmprestimosController',
    'emails' => 'EmailsController',
    'devedores' => 'DevedoresController'
]);
