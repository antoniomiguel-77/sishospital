@section('titulo','Departamento')
<div>
    <div class="main-panel">
        <div class="content-wrapper pb-0">
          <div class="page-header flex-wrap">
            <div class="header-left">
                LISTA DE PEDIDOS DE EXAMES
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
                            <th>Data</th>
                            <th>Laboratório</th>
                            <th>Exames</th>
                            <th>Descrição</th>
                            <th>Ação</th>
                        </tr>
                        </thead>
                        <tbody>
                            @if (isset($dados) and $dados->count() > 0)
                                @foreach ($dados as $item)
                            <tr>
                                <td>{{$item->created_at->format('d-m-Y H:i')}}</td>
                                <td>{{$item->laboratorio}}</td>
                                <td>{{$item->paciente->nomeCompleto}}</td>
                                <td>
                                    @if (isset($item->exames) and count($item->exames))
                                    @foreach ($item->exames as $i)
                                       <ul>
                                           <li>{{$i}}</li>
                                       </ul>
                                   @endforeach 
                                        
                                    @endif
                                </td>
                                <td>{{$item->descricao}}</td>
                                <td>
                                    <button type="button" wire:click="editar({{$item->id}})" data-bs-toggle="modal" data-bs-target="#departamento" class="btn btn-sm btn-outline-primary"> <i class="fa fa-print"></i></button>
                                    <button type="button" wire:click="confirmarExclusao({{$item->id}})" class="btn btn-sm btn-outline-danger"> <i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="text-uppercase text-center">A consulta não retorno valor</td>
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
    {{-- @include('livewire.administrador.modal.departamento') --}}
</div>
<script>
    document.addEventListener('fecharModal', () => {
     $('#departamento').modal('hide');
    }) 
</script>
