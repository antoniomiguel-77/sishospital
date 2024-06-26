@section('titulo','Especialidades')
<div>
    <div class="main-panel">
        <div class="content-wrapper pb-0">
          <div class="page-header flex-wrap">
            <div  class="header-left">
              <h4 class="text-muted text-uppercase"><i class="fa fa-users"></i> Utilizadores</h4>
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
                          <option value="500">500 Registros</option>
                        </select>
                      </div>
                  </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive ">
                    <table class="table table-bordered table-hover text-center">
                        <thead>
                        <tr>
                          <th>Data Cadastro</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Acesso</th>
                            <th>Conta</th>
                            <th>Estado</th>
                        </tr>
                        </thead>
                        <tbody>
                            @if (isset($utilizadores) and $utilizadores->count() > 0)
                                @foreach ($utilizadores as $item)

                                <tr>
                                  <td>{{\Carbon\Carbon::parse($item->created_at)->format('d-m-Y H:i:s')}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>{{$item->nivel}}</td>
                                    <td>
                                        @if ($item->estado == 'Activa')
                                        <span wire:click='confirmarMudancaDeEstado({{$item->id}})' style="cursor: pointer" class="badge badge-success">Activa</span>
                                        @else
                                        <span wire:click='confirmarMudancaDeEstado({{$item->id}})' style="cursor: pointer" class="badge badge-danger">Inactiva</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->online == 'On')
                                        <span  class="badge badge-success">Online</span>
                                        @else
                                        <span  class="badge badge-danger">Offline</span>
                                        @endif
                                    </td>
                                 
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" class="text-uppercase text-center">A consulta não retorno valor</td>
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
    @include('livewire.administrador.modal.utilizador')
</div>
<script>
    document.addEventListener('fecharModal', () => {
     $('#especialidade').modal('hide');
    }) 
</script>
