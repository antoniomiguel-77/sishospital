@section('titulo','Lista de Exames')
<div>
    <div class="main-panel">
        <div class="content-wrapper pb-0">
          <div class="page-header flex-wrap">
            <div class="header-left">
                <h4 class="text-muted text-uppercase"><i class="fa fa-search"></i> Lista de Exames</h4>
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
                  
                    <div class="form-group col-md-12">
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
                    <div class="form-group col-md-3">
                        <select style="height: 1px !important;" class="form-control form-control-sm" name="estado" id="estado" wire:model.live='estado'>
                            <option value="" selected>--Estado--</option>
                            <option value="1">Realizado</option>
                            <option value="0">Não realizado</option>
                        </select>
                      </div>
                    <div class="form-group col-md-3">
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
                            <th>Paciente</th>
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
                                <td>{{$item->triagens->paciente->nomeCompleto}}</td>
                                <td>{{$item->laboratorio}}</td>
                                {{-- <td>{{$item->paciente->nomeCompleto}}</td> --}}
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
                                  
                                    @if ($item->estado == 1)
                                    <span class="badge badge-success p-2 text-uppercase text-sm">Realizado</span>
                                    @else
                                        <button type="button" wire:click="editar({{$item->id}})" data-bs-toggle="modal" data-bs-target="#pedidoExame" class="btn btn-sm btn-outline-primary"> <i class="fa fa-edit"></i></button>
                                        <button type="button" title="Marcar como realizada" wire:click="confirmar({{$item->id}})" class="btn btn-sm btn-outline-success"> <i class="fa fa-check-circle"></i></button>
                                    @endif
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
     @include('livewire.medico.modal.pedidoDeExame')
</div>
<script>
    document.addEventListener('fecharModal', () => {
     $('.btn-close').trigger('click');
    }) 
</script>

@push('select2-lab')
    <script>
         $(document).ready(function() {
           
            $('#exame').select2({
            theme: "bootstrap",
            width:"100%",
            dropdownParent: $('#pedidoExame')
            });   
        
            $('#exame').change(function (e) { 
            e.preventDefault();
            @this.set('exame', $('#exame').val());
            });
        });
    </script>
@endpush
