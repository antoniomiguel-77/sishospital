
  <!-- Modal -->
  <div  wire:ignore.self data-bs-backdrop='static' class="modal fade" id="observacaoMedica" tabindex="-1" aria-labelledby="observacaoMedica" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-uppercase" id="exampleModalLabel">REGISTRAR OBSERVAÇÃO MÉDICA</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click='limparCampos'></button>
        </div>
        <div class="modal-body">
            <form wire:submit.prevent = "confirmarRegistro">
               <!-- Modal -->
               <div class="row">
                <div class="form-group col-md-12">
                  <label for="paciente">Paciente</label>
                  <input type="text" class="form-control" wire:model='paciente' readonly name="paciente" id="paciente">
                </div>
                <div class="form-group col-md-12">
                  <label for="acompanhante">Acompanhante</label>
                  <input type="text" class="form-control" wire:model='acompanhante' readonly name="acompanhante" id="acompanhante">
                </div>
                <div class="form-group col-md-6">
                  <label for="telefone">Telefone</label>
                  <input type="text" class="form-control" wire:model='telefone' readonly name="telefone" id="telefone">
                </div>
                <div class="form-group col-md-6">
                  <label for="idade">Idade</label>
                  <input type="text" class="form-control" wire:model='idade' readonly name="idade" id="idade">
                </div>
                <div class="form-group col-md-6">
                  <label for="genero">Gênero</label>
                  <input type="text" class="form-control" wire:model='genero' readonly name="genero" id="genero">
                </div>

                <div class="form-group col-md-6">
                  <label for="pulso">Pulso</label>
                  <input type="text" class="form-control" wire:model='pulso' readonly name="pulso" id="pulso">
                </div>
                <div class="form-group col-md-6">
                  <label for="peso">Peso</label>
                  <input type="text" class="form-control" wire:model='peso' readonly name="peso" id="peso">
                </div>
                <div class="form-group col-md-6">
                  <label for="respiracao">Respiração</label>
                  <input type="text" class="form-control" wire:model='respiracao' readonly name="respiracao" id="respiracao">
                </div>
                <div class="form-group col-md-6">
                  <label for="temperatura">Temperatura</label>
                  <input type="text" class="form-control" wire:model='temperatura' readonly name="temperatura" id="temperatura">
                </div>
                <div class="form-group col-md-6">
                  <label for="tensaoDiastolica">Tensão Disastólica</label>
                  <input type="text" class="form-control" wire:model='tensaoDiastolica' readonly name="tensaoDiastolica" id="tensaoDiastolica">
                </div>
                <div class="form-group col-md-6">
                  <label for="tensaoSistolica">Tensão Sistólica</label>
                  <input type="text" class="form-control" wire:model='tensaoSistolica' readonly name="tensaoSistolica" id="tensaoSistolica">
                </div>
                <div class="form-group col-md-4">
                    <label for="tensaoSistolica">Grau de Emergência</label>
                    @if ($escalaDeManchester == 'Emergência (Emediata)')
                      <input type="text" style="background:#e5241d;color:#fff" class="form-control" wire:model='escalaDeManchester' readonly name="tensaoSistolica" id="tensaoSistolica">
                    @elseif($escalaDeManchester == 'Urgente')
                      <input type="text" style="background:#f49826;color:#fff" class="form-control" wire:model='escalaDeManchester' readonly name="tensaoSistolica" id="tensaoSistolica">
                    @elseif($escalaDeManchester == 'Emergência')
                      <input type="text" style="background:#4cae3f;color:#fff" class="form-control" wire:model='escalaDeManchester' readonly name="tensaoSistolica" id="tensaoSistolica">
                    @elseif($escalaDeManchester == 'Pouco Urgente')
                      <input type="text" style="background:#fecc37;color:#fff" class="form-control" wire:model='escalaDeManchester' readonly name="tensaoSistolica" id="tensaoSistolica">
                    @elseif($escalaDeManchester == 'Não Urgente')
                      <input type="text" style="background:#3e4999;color:#fff" class="form-control" wire:model='escalaDeManchester' readonly name="tensaoSistolica" id="tensaoSistolica">
                    @endif
                </div>
                <div class="form-group col-md-6">
                  <label for="enfermeiro">Enfermeiro Que realizou a triagem</label>
                  <input type="text" class="form-control" wire:model='enfermeiro' readonly name="enfermeiro" id="enfermeiro">
                </div>
                <div class="form-group col-md-6">
                  <label for="queixasPrincipais">Queixas Principais</label>
                  <textarea class="form-control" wire:model='queixasPrincipais'  name="queixasPrincipais" id="queixasPrincipais" cols="30" rows="2" placeholder="Queixas Princípais"></textarea>
                  @error('queixasPrincipais') <span class="text-danger">{{$message}}</span> @enderror
    
                </div>
                <div class="form-group col-md-12">
                  <label for="assistenciaPreHospitalar">Asistência Hospitalar</label>
                  <textarea class="form-control" wire:model='assistenciaPreHospitalar'  name="assistenciaPreHospitalar" id="assistenciaPreHospitalar" cols="30" rows="2" placeholder="Observação Médica"></textarea>
                  @error('assistenciaPreHospitalar') <span class="text-danger">{{$message}}</span> @enderror
    
                </div>
                <div class="form-group col-md-12">
                  <label for="observacaoSumaria">Observação Sumária</label>
                  <textarea class="form-control" wire:model='observacaoSumaria'  name="observacaoSumaria" id="observacaoSumaria" cols="30" rows="2" placeholder="Observação Sumária"></textarea>
                  @error('observacaoSumaria') <span class="text-danger">{{$message}}</span> @enderror
    
                </div>
                <div class="form-group col-md-12">
                  <label for="diagnosticoEntrada">Diagnostico de Entrada</label>
                  <textarea class="form-control" wire:model='diagnosticoEntrada'  name="diagnosticoEntrada" id="diagnosticoEntrada" cols="30" rows="2" placeholder="Observação Sumária"></textarea>
                  @error('diagnosticoEntrada') <span class="text-danger">{{$message}}</span> @enderror
                    
                  
                </div>
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
  