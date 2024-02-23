
  <!-- Modal -->
  <div  wire:ignore.self data-bs-backdrop='static' class="modal fade" id="pedidoExame" tabindex="-1" aria-labelledby="pedidoExame" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-uppercase" id="exampleModalLabel">Adicionar departamento</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click='limparCampos'></button>
        </div>
        <div class="modal-body">
            <form wire:submit=" {{($pedidoExameId != null) ? 'actualizar':'salvar'}}">
                <div class="row">
                  <div class="col-sm-12">
                      <div class="form-group" wire:ignore>
                          <label for="descricao">Laboratório<span class="text-danger">*</span></label>
                         
                         <select name="laboratorio" id="laboratorio" class="form-select">
                            <option value="">Seleciomar</option>
                            @if (isset($laboratorios) and $laboratorios->count() > 0)
                                @foreach ($laboratorios as $item)
                                    <option value="{{$item->descricao}}">{{$item->descricao}}</option>
                                @endforeach
                            @endif
                         </select>
                          @error('descricao') <span style="font-size: 10px; font-weight:bold"  class="text-danger text-sm mx-1">{{$message}}</span>@enderror  
                        </div>
                      <div class="form-group" wire:ignore>
                          <label for="descricao">Tipo de Exame<span class="text-danger">*</span></label>
                         
                         <select name="exame" id="exame" class="form-select" multiple>
                            <option value="">Seleciomar</option>
                            @if (isset($exames) and $exames->count() > 0)
                                @foreach ($exames as $item)
                                    <option value="{{$item->descricao}}">{{$item->descricao}}</option>
                                @endforeach
                            @endif
                         </select>
                          @error('exame') <span style="font-size: 10px; font-weight:bold"  class="text-danger text-sm mx-1">{{$message}}</span>@enderror  
                        </div>
                
                      <div class="form-group">
                          <label for="descricao">Tipo de Exame<span class="text-danger">*</span></label>
                         <textarea class="form-control" name="descricao" placeholder="Informe  a descrição de pedido de exmae" id="descricao" cols="30" rows="10"></textarea>
                          @error('descricao') <span style="font-size: 10px; font-weight:bold"  class="text-danger text-sm mx-1">{{$message}}</span>@enderror  
                        </div>
                  </div>
              </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Registrar</button>
     </form>
      </div>
    </div>
  </div>
  