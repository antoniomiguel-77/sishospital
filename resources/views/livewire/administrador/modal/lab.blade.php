
  <!-- Modal -->
  <div  wire:ignore.self data-bs-backdrop='static' class="modal fade" id="lab" tabindex="-1" aria-labelledby="departamento" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-uppercase" id="exampleModalLabel">Adicionar Exame</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click='limparCampos'></button>
        </div>
        <div class="modal-body">
            <form wire:submit=" {{($exameId != null) ? 'actualizar':'salvar'}}">
                <div class="row">
                  <div class="col-sm-12">
                      <div class="form-group">
                          <label for="descricao">Descrição<span class="text-danger">*</span></label>
                          <input type="text" placeholder="Digite o Departamento" name="descricao" id="descricao" class="form-control" type="text" wire:model="descricao">
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
  