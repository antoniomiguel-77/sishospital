@section('titulo','Entradas')
<div>
    <div class="main-panel">
        <div class="content-wrapper pb-0">
          <div class="page-header flex-wrap">
            <div class="header-left">
                PACIENTES AGUARDANDO ATENDIMENTO
            </div>

            <div  class="header-right d-flex flex-wrap mt-md-2 mt-lg-0">
             
            </div>
          </div>
  
        
          <div class="row">
            <div class="col-xl-12 stretch-card grid-margin">
              <div class="card shadow-sm">
                <div class="card-header">
                  <div class="row">
                    <div class="form-group col-md-8">
                        <input style="height: 1px !important;" wire:model.live='pesquisar' type="search" name="pesquisar" id="pesquisar" class="form-control form-control-sm" placeholder="Pesquisar...">
                    </div>
                    <div class="form-group col-md-4">
                        <select style="height: 1px !important;" class="form-control form-control-sm" name="mostrar" id="mostrar" wire:model.live='mostrar'>
                          <option value="5">5 Registros</option>
                          <option value="10">10 Registros</option>
                          <option value="25">25 Registros</option>
                          <option value="50">50 Registros</option>
                          <option value="100">100 Registros</option>
                          <option value="250">250 Registros</option>
                        </select>
                      </div>
                  </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive ">
                    <table class="table table-bordered table-hover text-center">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Idade</th>
                                <th>Data</th>
                                <th>Hora</th>
                                <th>Proveniência</th>
                                <th>Acompanhante</th>
                                <th>Telefone</th>
                                <th>Situação</th>
                              
                            </tr>
                        </thead>
                        <tbody>
                      
                            @if (isset($atendimentoPendentes) and $atendimentoPendentes->count() > 0)
                            @foreach ($atendimentoPendentes as $item)
                            <tr style="cursor: pointer" data-bs-toggle="modal" data-bs-target="#menu">
                                <td>{{$item->nomeCompleto}}</td>
                                <td>{{$item->idade}}</td>
                                <td>{{$item->dataEntrada}}</td>
                                <td>{{$item->horaEntrada}}</td>
                                <td>{{$item->proveniencia}}</td>
                                <td>{{$item->acompanhante}}</td>
                                <td>{{$item->telefone}}</td>
                              
                                @if ($escalaDeManchester == 'Emergência (Emediata)')
                                    <td><span style="background:#e5241d;color:#fff" class="custom-badge  font-weight-bold">{{$item->escalaDeManchester }}</span></td>
                                @elseif($item->escalaDeManchester == 'Urgente')
                                    <td><span style="background:#f49826;color:#fff" class="custom-badge  font-weight-bold">{{$item->escalaDeManchester }}</span></td>
                                @elseif($item->escalaDeManchester == 'Emergência')
                                    <td><span style="background:#4cae3f;color:#fff" class="custom-badge  font-weight-bold">{{$item->escalaDeManchester }}</span></td>
                                @elseif($item->escalaDeManchester == 'Pouco Urgente')
                                    <td><span style="background:#fecc37;color:#fff" class="custom-badge  font-weight-bold">{{$item->escalaDeManchester }}</span></td>
                                @elseif($item->escalaDeManchester == 'Não Urgente')
                                    <td><span style="background:#3e4999;color:#fff" class="custom-badge  font-weight-bold">{{$item->escalaDeManchester }}</span></td>
                                @endif
                                
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="10" class="text-uppercase text-center">Nenhum registro Hoje</td>
                            </tr>
                        @endif
                       
                        </tbody>
                    </table>
                    </div>
                </div>
              </div>
            </div>
            
          </div>
       
        </div>

        
    </div>
 @include('livewire.medico.modal.menu')
</div>
<script>
    document.addEventListener('fecharModal', () => {
     $('#atendimento').modal('hide');
    }) 
</script>
