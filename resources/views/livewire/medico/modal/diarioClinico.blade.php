
  <!-- Modal -->
  <div  wire:ignore.self data-bs-backdrop='static' class="modal fade" id="diario-clinico" tabindex="-1" aria-labelledby="triagem" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-uppercase" id="exampleModalLabel"><i class="fa fa-book"></i> DIÁRIO CLÍNICO</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
        </div>
        <div class="modal-body">
            <form wire:submit.prevent='{{(isset($diario_id) and $diario_id != null) ? 'update':'registrarDiarioClinico'}}' >
                @csrf
                @method('POST')
            <div class="form-group col-md-12">
                <label for="paciente">Paciente</label>
                <input type="text" name="paciente" id="paciente" wire:model='paciente' readonly class="form-control">
                @error('paciente')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="descricao">Diário Clinico</label>
                <textarea name="descricaoDiarioClinico" id="descricaoDiarioClinico" wire:model='descricaoDiarioClinico' cols="30" rows="10" style="resize: none" class="form-control"></textarea>
                @error('descricaoDiarioClinico')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Registrar</button>
           </form>
            </div>
        </div>
    </div>
  </div>
  </div>
  