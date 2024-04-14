@section('titulo','Diários Clínicos')
<div>
    <div class="main-panel">
        <div class="content-wrapper pb-0">
          <div class="page-header flex-wrap">
            <div class="header-left">
                <h4 class="text-muted text-uppercase"><i class="fa fa-edit"></i> Diários Clínicos</h4>
            </div>

            <div  class="header-right d-flex flex-wrap mt-md-2 mt-lg-0">
                <button  type="button" class="btn btn-primary mt-2 mt-sm-0 btn-icon-text">
                    <i class="mdi mdi-printer"></i>
                    Exportar PDF
                </button>
            </div>
          </div>
  
        
          <div class="row">
            <div class="col-xl-12 stretch-card grid-margin">
              <div class="card shadow-sm">
                <div class="card-header">
                  <div class="row">
                  
                    <div class="form-group col-md-4">
                        <select style="height: 1px !important;" class="form-control form-control-sm" name="triagem" id="triagem" wire:model.live='triagem'>
                            <option value="" selected>--Paciente--</option>
                         @if (isset($triagens) and $triagens->count() > 0)
                            @foreach ($triagens as $item)
                                <option value="{{$item->id}}">{{$item->paciente->nomeCompleto}}</option>
                            @endforeach
                          @endif
                        </select>
                      </div>
                  
                    <div class="form-group col-md-3">
                       <input type="date" name="startdate" wire:model.live='startdate' id="startdate" class="form-control form-control-sm">
                    </div>
                    <div class="form-group col-md-3">
                       <input type="date" name="enddate" wire:model.live='enddate' id="enddate" class="form-control form-control-sm">
                    </div>
                    <div class="form-group col-md-2">
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
                            <th>Hora</th>
                            <th>Diário</th>
                            <th>Ação</th>
                        </tr>
                        </thead>
                        <tbody>
                            @if (isset($dados) and $dados->count() > 0)
                                @foreach ($dados as $item)
                            <tr>
                                <td>{{$item->created_at->format('d-m-Y H:i')}}</td>
                                <td>{{$item->created_at->format('H:i')}}</td>
                                <td>{{$item->descricao}}</td>
                                <td>
                                    <button type="button" wire:click="editar({{$item->id}})" data-bs-toggle="modal" data-bs-target="#diario-clinico" class="btn btn-sm btn-outline-primary"> <i class="fa fa-edit"></i></button>
                                    {{-- <button type="button" wire:click="confirmarExclusao({{$item->id}})" class="btn btn-sm btn-outline-danger"> <i class="fa fa-trash"></i></button> --}}
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
     @include('livewire.medico.modal.diarioClinico') 
</div>
<script>
    document.addEventListener('fecharModal', () => {
     $('.btn-close').trigger('click');
    }) 
</script>
