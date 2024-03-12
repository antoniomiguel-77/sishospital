<?php


use App\Livewire\Administrador\{
    AtendenteComponent as Atendent,
    HomeComponent,DepartamentoComponent, 
    EspecialidadeComponent, InstituicaoComponent, 
    UtilizadorComponent,MedicoComponent,
    EnfermeiroComponent,
    ExameComponent,
    PacienteComponent as Pacientes,
    LaboratorioComponent
};
use App\Livewire\Atendente\{
    AtendenteComponent,
    EntradaBancoUrgenciaComponent,
    PacienteComponent,
};
use App\Livewire\Enfermeiro\{
    PacienteAguardandoTriagem,
};
use App\Livewire\Login\LoginComponent;
use App\Livewire\Medico\{
    AguardandoDecisaoMedica,
    ObservacaoMedica,
    PacienteAguardandoAtendimento,
};
use App\Models\Atendente;
use App\Models\Triagem;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

#Administrador
    Route::get('/painel', HomeComponent::class)->name('sis.admin.home');
    Route::get('/painel/admin/departamentos', DepartamentoComponent::class)->name('sis.admin.departamento')->middleware(['auth']);;
    Route::get('/painel/admin/especialidades', EspecialidadeComponent::class)->name('sis.admin.especialidade')->middleware(['auth']);;
    Route::get('/painel/admin/utilizadores', UtilizadorComponent::class)->name('sis.admin.utilizador')->middleware(['auth']);;
    Route::get('/painel/admin/Instituicao', InstituicaoComponent::class)->name('sis.admin.instituicao')->middleware(['auth']);;
    Route::get('/painel/admin/medicos', MedicoComponent::class)->name('sis.admin.medico')->middleware(['auth']);;
    Route::get('/painel/admin/enfermeiros', EnfermeiroComponent::class)->name('sis.admin.enfermeiro')->middleware(['auth']);;
    Route::get('/painel/admin/pacientes', Pacientes::class)->name('sis.admin.pacientes')->middleware(['auth']);;
    Route::get('/painel/admin/laboratorios', LaboratorioComponent::class)->name('sis.admin.laboratorio')->middleware(['auth']);;
    Route::get('/painel/admin/exames', ExameComponent::class)->name('sis.admin.exames')->middleware(['auth']);;
    Route::get('/painel/admin/atendentes', Atendent::class)->name('sis.admin.atendentes')->middleware(['auth']);;
#Administrador

#Medicos
    Route::get('/painel/medico/paciente-aguardando-atendimento', PacienteAguardandoAtendimento::class)->name('sis.medico.paciente-atendimento')->middleware(['auth']);
    Route::get('/painel/medico/aguardando-decisao-medica', AguardandoDecisaoMedica::class)->name('sis.medico.aguardando.decisao.medica')->middleware(['auth']);
#Medicos

#enfermeiros
    Route::get('/painel/enfermeiro/pacientes-aguardando-triagem', PacienteAguardandoTriagem::class)->name('sis.enferm.triagem')->middleware(['auth']);;
#enfermeiros

#Atendente
    Route::get('/painel/atendente/banco-de-urgencia', EntradaBancoUrgenciaComponent::class)->name('sis.atend.banco-de-urgencia')->middleware(['auth']);
    Route::get('/painel/atendente/pacientes', PacienteComponent::class)->name('sis.atend.paciente')->middleware(['auth']);
#Atendente

#Autenticacao
Route::get('/',LoginComponent::class)->name('login');
Route::get('/test',function(){dd(\Hash::make('123456789'));});
#Autenticacao
