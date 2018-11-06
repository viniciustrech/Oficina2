<?php

Route::get('/', 'SiteController@index');
Route::get('/home', 'SiteController@index');
Route::get('/documentos', 'SiteController@documentos');
Route::get('/contato', 'SiteController@contato');
Route::post('/contato', 'SiteController@contato2');
Route::get('/noticias', 'SiteController@noticias');
Route::get('/noticia/{id_not}', 'SiteController@noticia');
Route::get('/eventos', 'SiteController@eventos');
Route::get('/evento/{id_eve}', 'SiteController@evento');
Route::get('/sobre', 'SiteController@sobre');
Route::get('/p/{page}', 'SiteController@paginas');

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

Route::group(['prefix' => 'painel', 'middleware' => 'auth'], function () {

    Route::get('/', 'DashboardController@index');

    Route::group(['prefix' => 'contatos'], function () {
        Route::get('/', 'ContatosController@index');
        Route::get('/{id_con}/view', 'ContatosController@view');
        Route::get('/{id_con}/destroy', 'ContatosController@destroy');
    });

    Route::group(['prefix' => 'usuarios'], function () {
        Route::get('/', 'UsuariosController@index');
        Route::get('/create', 'UsuariosController@create');
        Route::post('/create', 'UsuariosController@create2');
        Route::get('/{id}/update', 'UsuariosController@update');
        Route::post('/{id}/update', 'UsuariosController@update2');
        Route::get('/{id}/destroy', 'UsuariosController@destroy');
    });

    Route::group(['prefix' => 'noticias'], function () {
        Route::get('/', 'NoticiasController@index');
        Route::get('/create', 'NoticiasController@create');
        Route::post('/create', 'NoticiasController@create2');
        Route::get('/{id_not}/update', 'NoticiasController@update');
        Route::post('/{id_not}/update', 'NoticiasController@update2');
        Route::get('/{id_not}/destroy', 'NoticiasController@destroy');
        Route::get('/{id_not}/liberado', 'NoticiasController@liberado');

        Route::group(['prefix' => '/{id_not}/fotos'], function () {
            Route::get('/', 'NoticiasFotosController@index');
            Route::post('/multiploupload', 'NoticiasFotosController@multiploupload');
            Route::get('/{id_fot}/update', 'NoticiasFotosController@update');
            Route::post('/{id_fot}/update', 'NoticiasFotosController@update2');
            Route::get('/{id_fot}/destroy', 'NoticiasFotosController@destroy');
            Route::post('/{id_fot}/upload', 'NoticiasFotosController@upload');
            Route::get('/{id_fot}/destaque', 'NoticiasFotosController@destaque');
            Route::get('/{id_fot}/legenda', 'NoticiasFotosController@legenda');
        });
    });

    Route::group(['prefix' => 'eventos'], function () {
        Route::get('/', 'EventosController@index');
        Route::get('/create', 'EventosController@create');
        Route::post('/create', 'EventosController@create2');
        Route::get('/{id_eve}/update', 'EventosController@update');
        Route::post('/{id_eve}/update', 'EventosController@update2');
        Route::get('/{id_eve}/destroy', 'EventosController@destroy');
        Route::get('/{id_eve}/liberado', 'EventosController@liberado');
        Route::post('/{id_eve}/multiploupload', 'EventosController@multiploupload');

        Route::group(['prefix' => '/{id_eve}/fotos'], function () {
            Route::get('/', 'EventosFotosController@index');
            Route::post('/multiploupload', 'EventosFotosController@multiploupload');
            Route::get('/{id_fot}/update', 'EventosFotosController@update');
            Route::post('/{id_fot}/update', 'EventosFotosController@update2');
            Route::get('/{id_fot}/destroy', 'EventosFotosController@destroy');
            Route::post('/{id_fot}/upload', 'EventosFotosController@upload');
            Route::get('/{id_fot}/destaque', 'EventosFotosController@destaque');
            Route::get('/{id_fot}/legenda', 'EventosFotosController@legenda');
        });

        Route::group(['prefix' => '/{id_eve}/documentos'], function () {
            Route::get('/', 'EventosDocumentosController@index');
            Route::get('/{id_doc}/update', 'EventosDocumentosController@update');
            Route::post('/{id_doc}/update', 'EventosDocumentosController@update2');
            Route::get('/{id_doc}/destroy', 'EventosDocumentosController@destroy');
            Route::get('/{id_doc}/legenda', 'EventosDocumentosController@legenda');
        });
    });

    Route::group(['prefix' => 'contatos'], function () {
        Route::get('/', 'ContatosController@index');
        Route::post('/', 'ContatosController@index');
        Route::get('/view/{id}', 'ContatosController@view');
        Route::get('/destroy/{id}', 'ContatosController@destroy');
    });

    Route::group(['prefix' => 'paginas'], function () {
        Route::get('/', 'PaginasController@index');
        Route::get('/create', 'PaginasController@create');
        Route::post('/create', 'PaginasController@create2');
        Route::get('/{id_pag}/update', 'PaginasController@update');
        Route::post('/{id_pag}/update', 'PaginasController@update2');
        Route::get('/{id_pag}/destroy', 'PaginasController@destroy');

        Route::group(['prefix' => '/{id_pag}/fotos'], function () {
            Route::get('/', 'PaginasFotosController@index');
            Route::post('/multiploupload', 'PaginasFotosController@multiploupload');
            Route::get('/{id_fot}/update', 'PaginasFotosController@update');
            Route::post('/{id_fot}/update', 'PaginasFotosController@update2');
            Route::get('/{id_fot}/destroy', 'PaginasFotosController@destroy');
            Route::get('/{id_fot}/destaque', 'PaginasFotosController@destaque');
            Route::get('/{id_fot}/legenda', 'PaginasFotosController@legenda');
        });
    });
});