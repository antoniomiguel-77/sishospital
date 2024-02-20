@section('titulo','Lista de Pacientes')
<div>
    <div class="main-panel">
        <div class="content-wrapper pb-0">
          <div class="page-header flex-wrap">
            <div style="border:1px solid red" class="header-left">
            </div>

            <div  class="header-right d-flex flex-wrap mt-md-2 mt-lg-0">
              <button data-bs-toggle="modal" data-bs-target="#paciente" type="button" class="btn btn-primary mt-2 mt-sm-0 btn-icon-text">
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
                                <th>Nome</th>
                                <th>Idade</th>
                                <th>Grupo Sanguinio</th>
                                <th>Endereço</th>
                                <th>Telefone</th>
                                <th class="text-right">Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($pacientes) and $pacientes->count() > 0)
                            @foreach ($pacientes as $item)
                            <tr>
                                <td>{{$item->nomeCompleto}}</td>
                                <td>{{$item->idade ?? 'NÃO DEFINIDO'}}</td>
                                <td>{{$item->grupoSanguinio ?? 'NÃO DEFINIDO'}}</td>
                                <td>{{$item->endereco ?? 'NÃO DEFINIDO'}}</td>
                                <td>{{$item->telefone ?? 'NÃO DEFINIDO'}}</td>
                                <td>
                                   
                                    <button type="button" wire:click="editar({{$item->id}})" data-bs-toggle="modal" data-bs-target="#paciente" class="btn btn-sm btn-outline-primary" title="Editar dados do paciente"> <i class="fa fa-edit"></i></button>
                                    <button type="button" wire:click="confirmarExclusao({{$item->id}})" class="btn btn-sm btn-outline-danger" title="Excluir dados do paciente"> <i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="text-uppercase text-center">A consulta não retorno valor</td>
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
    @include('livewire.administrador.modal.paciente')
</div>
<script>
    document.addEventListener('fecharModal', () => {
     $('#paciente').modal('hide');
    }) 
</script>
