<?php

use App\Http\Controllers\AgendaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ConfirmAccountController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ProcedimentoControl;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RhUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ControllerReport;
use App\Http\Controllers\ListarAtender;
use Illuminate\Support\Facades\Route;


use Laravel\Fortify\Http\Controllers\ConfirmablePasswordController;

route::middleware('guest')->group(function(){
        //Email confirmation e password definition
        Route::get('/confirm-account/{token}', [ConfirmAccountController::class,'confirmAccount'])->name('confirmAccount');
        Route::post('/confirm-account', [ConfirmAccountController::class,'confirmAccountSubmit'])->name('confirmAccountsubmit');

});

Route::middleware('auth')->group(function(){
    
    Route::redirect('/', 'home');
    // Route::view('/home', 'home')->name('home');
    Route::get('/home', [DashboardController::class, 'index'])->name('home');

    // Perfil de Usuario
    Route::get('/user/profile', [ProfileController::class,'index'])->name('user.profile');
    Route::post('user/profile/update-password', [ProfileController::class,'updatePassword'])->name('user.profile.update-password');
    Route::post('user/profile/update-user-data', [ProfileController::class,'updateUserData'])->name('user.profile.update-user-data');

    // departamentos
    Route::get('/department', [DepartmentController::class, 'index'])->name('departments');
    Route::get('/department/new-department',[DepartmentController::class, 'newDepartment'])->name('departments.new-department');
    Route::post('/department/create-department',[DepartmentController::class, 'createDepartment'])->name('departments.create-department');
    Route::get('/department/edit-department/{id}',[DepartmentController::class, 'editDepartment'])->name('departments.edit-department');
    Route::post('/department/update-department',[DepartmentController::class, 'updateDepartment'])->name('departments.update-department');
    Route::get('/department/delete-department/{id}',[DepartmentController::class, 'deleteDepartment'])->name('departments.deleteDepartment');
    Route::get('/department/delete-department-confirm/{id}',[DepartmentController::class, 'deleteDepartmentConfirm'])->name('departments.delete-Department-confirm');

    // Rh Colaboradores 
    Route::get('/rh-users',[RhUserController::class, 'index'])->name('colaborators.rh-users');
    Route::get('/rh-users/new-colaborator',[RhUserController::class, 'newColaborator'])->name('colaborators.rh.new-colaborator');
    Route::post('/rh-users/create-colaborator',[RhUserController::class, 'createRhColaborator'])->name('colaborators.rh.create-colaborator');
    Route::get('/rh-users/edita-colaborator/{id}',[RhUserController::class, 'editRhColaborator'])->name('colaborators.rh.edita-colaborator');
    Route::get('/rh-users/delete/{id}',[RhUserController::class, 'deleteRhColaborator'])->name('colaborators.rh.delete-colaborator');
    Route::get('/rh-users/delete-confirm/{id}',[RhUserController::class, 'deleteRhColaboratorConfirm'])->name('colaborators.rh.delete-confirm');
    Route::post('/rh-users/edita-colaborator}',[RhUserController::class, 'updateRhColaborator'])->name('colaborators.rh.update-colaborator');

    //Procediementos
    Route::get('/procedimento', [ProcedimentoControl::class, 'index'])->name('procedimentos');
    Route::get('/procedimento/new-procedimento',[ProcedimentoControl::class, 'newProcediemento'])->name('procedimentos.new-procedimento');
    Route::post('/procedimento/create-procedimento',[ProcedimentoControl::class, 'createProcedimento'])->name('procedimentos.create-procedimento');
    Route::get('/procedimento/edit-procedimento/{id}',[ProcedimentoControl::class, 'editProcedimento'])->name('procedimentos.edit-procedimento');
    Route::post('/procedimento/update-procedimento',[ProcedimentoControl::class, 'updateProcedimento'])->name('procedimentos.update-Procedimento');
    Route::get('/procedimento/delete-procedimento/{id}',[ProcedimentoControl::class, 'deleteProcedimento'])->name('procedimentos.delete-Procedimento');
    Route::get('/procedimento/delete-procedimento-confirm/{id}',[ProcedimentoControl::class, 'deleteProcedimentoConfirm'])->name('procedimentos.delete-Procedimento-confirm');

    //clientes
    Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes');
    Route::get('/clientes/new-cliente',[ClienteController::class, 'newCliente'])->name('clientes.new-cliente');
    Route::post('/clientes/create-cliente',[ClienteController::class, 'createCliente'])->name('cliente.create-cliente');
    Route::get('/clientes/edita-cliente/{id}',[ClienteController::class, 'editCliente'])->name('cliente.edita-cliente');
    Route::post('/clientes/update-cliente/{id}',[ClienteController::class, 'updateCliente'])->name('cliente.update-cliente');
    Route::get('/clientes/delete-cliente/{id}',[ClienteController::class, 'deleteCliente'])->name('cliente.delete-cliente');
    Route::get('/clientes/delete-cliente_confirm/{id}',[ClienteController::class, 'deleteClienteConfirm'])->name('cliente.delete-cliente_confirm');
    Route::get('/clientes/restore/{id}', [ClienteController::class, 'restoreClient'])->name('cliente.restore-cliente');
    Route::get('/clientes/details/{id}',[ClienteController::class, 'showDetails'])->name('cliente.details');

    //ListarAtendimentos
    Route::get('/listar/{id}', [ListarAtender::class, 'index'])->name('atendimento.listar');
    Route::post('/eventos/update', [ListarAtender::class, 'update'])->name('eventos.update');

 
    // Calendario routes
    Route::get('agenda/index/{id}', [AgendaController::class, 'index'])->name('agenda.index');
    Route::get('/events', [AgendaController::class, 'getEvents']);
    Route::post('/salvar', [AgendaController::class, 'store'])->name('agenda.store');
    Route::post('/agenda/mover/{id}', [AgendaController::class, 'update'])->name('agenda.update');
    Route::get('/agenda/delete/{id}', [AgendaController::class, 'deleteEvent']);
    Route::post('/create-agenda', [AgendaController::class, 'create'])->name('agenda.criar');

    //Gerador de relatorio JasperReport Studio
    
    Route::get('gerador', [ControllerReport::class,'index'])->name('gerador');
    Route::post('/gerar', [ControllerReport::class,'generateReport'])->name('gerar');

});
