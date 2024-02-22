<?php

use App\Livewire\Admin\LaboratorioComponent;
use App\Livewire\Administrador\{
    HomeComponent,DepartamentoComponent, 
    EspecialidadeComponent, InstituicaoComponent, 
    UtilizadorComponent,MedicoComponent,
    EnfermeiroComponent,
    PacienteComponent as Pacientes,
};
use App\Livewire\Atendente\{
    EntradaBancoUrgenciaComponent,
    PacienteComponent,
};
use App\Livewire\Enfermeiro\{
    PacienteAguardandoTriagem,
};
use App\Livewire\Medico\{
    AguardandoDecisaoMedica,
    ObservacaoMedica,
    PacienteAguardandoAtendimento,
};
use App\Models\Triagem;
use Illuminate\Support\Facades\Route;

#Administrador
    Route::get('/', HomeComponent::class)->name('sis.admin.home');
    Route::get('/painel/admin/departamentos', DepartamentoComponent::class)->name('sis.admin.departamento');
    Route::get('/painel/admin/especialidades', EspecialidadeComponent::class)->name('sis.admin.especialidade');
    Route::get('/painel/admin/utilizadores', UtilizadorComponent::class)->name('sis.admin.utilizador');
    Route::get('/painel/admin/Instituicao', InstituicaoComponent::class)->name('sis.admin.instituicao');
    Route::get('/painel/admin/medicos', MedicoComponent::class)->name('sis.admin.medico');
    Route::get('/painel/admin/enfermeiros', EnfermeiroComponent::class)->name('sis.admin.enfermeiro');
    Route::get('/painel/admin/pacientes', Pacientes::class)->name('sis.admin.pacientes');
    Route::get('/painel/admin/laboratorios', LaboratorioComponent::class)->name('sis.admin.laboratorio');
#Administrador

#Medicos
    Route::get('/painel/medico/paciente-aguardando-atendimento', PacienteAguardandoAtendimento::class)->name('sis.medico.paciente-atendimento');
    Route::get('/painel/medico/aguardando-decisao-medica', AguardandoDecisaoMedica::class)->name('sis.medico.aguardando.decisao.medica');
#Medicos

#enfermeiros
    Route::get('/painel/enfermeiro/pacientes-aguardando-triagem', PacienteAguardandoTriagem::class)->name('sis.enferm.triagem');
#enfermeiros

#Atendente
    Route::get('/painel/atendente/banco-de-urgencia', EntradaBancoUrgenciaComponent::class)->name('sis.atend.banco-de-urgencia');
    Route::get('/painel/atendente/pacientes', PacienteComponent::class)->name('sis.atend.paciente');
#Atendente

Route::get('/test', function(){
    dd(Triagem::with('paciente')->whereDate('created_at',today())->get());
});