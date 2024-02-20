
  <!-- Modal -->
  <div  wire:ignore.self data-bs-backdrop='static' class="modal fade" id="entradas" tabindex="-1" aria-labelledby="departamento" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-uppercase" id="exampleModalLabel">DAR ENTRADA DO PACIENTE</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click='limparCampos'></button>
        </div>
        <div class="modal-body">
            <form wire:submit.prevent="confirmarRegistro">
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="paciente">Paciente</label>
                        <input placeholder="Informe o nome do Paciente" type="text" name="paciente" id="paciente" wire:model="paciente" class="form-control">
                        @error('paciente') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="telefone">Telefone</label>
                        <input placeholder="999-999-999"   type="text" name="telefone" id="telefone" wire:model="telefone" class="form-control">
                        @error('telefone') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="areaDeBancoDeUrgencia">Àrea de Banco de Urgência</label>
                        <select name="areaDeBancoDeUrgencia" id="areaDeBancoDeUrgencia" wire:model="areaDeBancoDeUrgencia" class="form-select" style="height: 3rem">
                            <option value="">--Selecionar--</option>
                            @foreach ($areas as $item)
                                <option value="{{$item->descricao}}">{{$item->descricao}}</option>
                            @endforeach
                        </select>
                        @error('areaDeBancoDeUrgencia') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
               
                    <div class="form-group col-md-6">
                        <label for="acompanhante">Proveniência</label>
                        <input placeholder="De onde vem o paciente ?"  type="text" name="proveniencia" id="proveniencia" wire:model="proveniencia" class="form-control">
                        @error('proveniencia') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="acompanhante">Acompanhante</label>
                        <input placeholder="Quem o Acompanha no momento ?"  type="text" name="acompanhante" id="acompanhante" wire:model="acompanhante" class="form-control">
                        @error('acompanhante') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group col-md-12 d-flex justify-content-end flex-wrap">
                        <button type="submit" class="btn btn-md btn-outline-primary">
                            Salvar
                        </button>
                      </div>
              </form>
        </div>
         
    </div>
  </div>
  </div>
  