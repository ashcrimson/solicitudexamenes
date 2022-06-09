<?php

Route::group(['as'=>'api.','namespace' => 'API'], function () {

    Route::resource('options', 'OptionAPIController');



    Route::group(['middleware' => 'auth:api'], function () {

        Route::resource('permissions', 'PermissionAPIController');

        Route::resource('roles', 'RoleAPIController');

        Route::resource('users', 'UserAPIController');
        Route::get('user/add/shortcut/{user}', 'UserAPIController@addShortcut')->name('users.add_shortcut');
        Route::get('user/remove/shortcut/{user}', 'UserAPIController@removeShortcut')->name('users.remove_shortcut');


        Route::resource('examen_grupos', 'ExamenGrupoAPIController');

        Route::resource('examen_tipos', 'ExamenTipoAPIController');

        Route::resource('pacientes', 'PacienteAPIController');

        Route::resource('diagnosticos', 'DiagnosticoAPIController');

        Route::resource('examen_estados', 'ExamenEstadosAPIController');

        Route::resource('examenes', 'ExamenAPIController');

        Route::resource('muestras', 'MuestraAPIController');

        Route::resource('documento_tipos', 'DocumentoTipoAPIController');
    });


});
