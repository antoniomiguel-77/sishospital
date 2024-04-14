@section('titulo','Entradas')
<div>
    <div class="main-panel">
        <div class="content-wrapper pb-0">
          <div class="page-header flex-wrap">
            <div  class="header-left">
              <h4 class="text-muted text-uppercase"><i class="fa-solid fa-arrow-right"></i> Entrada Banco de Urgência</h4>
            </div>

            <div  class="header-right d-flex flex-wrap mt-md-2 mt-lg-0">
              <button data-bs-toggle="modal" data-bs-target="#entradas" type="button" class="btn btn-primary mt-2 mt-sm-0 btn-icon-text">
                <i class="mdi mdi-plus-circle"></i>Entrada
            </button>
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
                            <th>Data de Entrada</th>
                            <th>Nome Completo</th>
                            <th>Telefone</th>
                            <th>Área</th>
                            <th>Proveniência</th>
                            <th>Acompanhante</th>
                            <th>Situação</th>
                        </tr>
                        </thead>
                        <tbody>
                          @if (isset($pacientes) and $pacientes->count() > 0)
                          @foreach ($pacientes as $item)
                          <tr data-toggle="modal" data-target="#entradaUrgencia">
                            <td class="text-end">{{\Carbon\Carbon::parse($item->created_at)->format('d-m-Y H:i')}}</td>
                              <td>{{$item->nomeCompleto ?? 'NÃO INFORMADO'}}</td>
                              <td>{{$item->telefone ?? 'NÃO INFORMADO'}}</td>
                              <td>{{$item->area ?? 'NÃO INFORMADO'}}</td>
                              <td>{{$item->proveniencia ?? 'NÃO INFORMADO'}}</td>
                              <td>{{$item->acompanhante ?? 'NÃO INFORMADO'}}</td>
                              <td>
                                <span class="badge badge-warning">{{$item->situacao}}</span>
                              </td>
                          </tr>
                          @endforeach
                      @else
                          <tr>
                              <td colspan="6" class="text-uppercase text-center">
                                <span>A consulta não retorno valor </span><br>
                              </td>
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
    @include('livewire.atendente.modal.entradaBancoUrgencia')
</div>
<script>
    document.addEventListener('fecharModal', () => {
     $('#entradas').modal('hide');
    }) 
</script>
