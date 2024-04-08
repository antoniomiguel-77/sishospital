
  <!-- Modal -->
  <div  wire:ignore.self data-bs-backdrop='static' class="modal fade" id="triagem" tabindex="-1" aria-labelledby="triagem" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-uppercase" id="exampleModalLabel">{{($pacienteId != null) ? 'ACTUALIZAR':'ADICIONAR'}} TRIAGEM</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click='limparCampos'></button>
        </div>
        <div class="modal-body">
            <form wire:submit.prevent = "confirmarRegistro">
                <div class="row">
                  <div class="col-sm-12">
                      <div class="form-group">
                          <label for="nomeCompleto">Paciente<span class="text-danger">*</span></label>
                          <input readonly class="form-control" type="text" name="paciente" id="paciente" wire:model='paciente'>
                          @error('paciente') <span class="text-danger">{{$message}}</span> @enderror
                      </div>
                    <input type="hidden" name="pacienteId" id="pacienteId" wire:model='pacienteId'>
                  </div>
                  
                
                      <div class="col-sm-12">
                        <div class="form-group">
                          <label for="acompanhante">Acompanhante <span class="text-danger">*</span></label>
                          <input readonly class="form-control" type="text" id="acompanhante" name="acompanhante" wire:model='acompanhante'>
                          @error('acompanhante') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="acompanhante">Proveniência <span class="text-danger">*</span></label>
                          <input readonly class="form-control" type="text" id="proveniencia" name="proveniencia" wire:model='proveniencia'>
                          @error('proveniencia') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                      </div>
                  
                     
                     
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="telefone">Telefone</label>
                          <input placeholder="999-999-999" readonly class="form-control" type="tel" name="telefone" id="telefone" wire:model='telefone'>
                          @error('telefone') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="respiracao">Respiração <span class="text-danger">*</span></label>
                          <input placeholder="Informe o estado da respiração" class="form-control" type="text" id="respiracao" name="respiracao" wire:model='respiracao'>
                          @error('respiracao') <span class="text-danger">{{$message}}</span> @enderror
                       </div>
                  </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="pulso">Pulso <span class="text-danger">*</span></label>
                          <input placeholder="Informe o estado do pulso" class="form-control" type="text" id="pulso" name="pulso" wire:model='pulso'>
                          @error('pulso') <span class="text-danger">{{$message}}</span> @enderror
                       </div>
                  </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="tensaoDiastolica">Tensão Diastólica <span class="text-danger">*</span></label>
                          <input placeholder="Informe o estado da tensão Diastólica" class="form-control" type="text" id="tensaoDiastolica" name="tensaoDiastolica" wire:model='tensaoDiastolica'>
                          @error('tensaoDiastolica') <span class="text-danger">{{$message}}</span> @enderror
                       </div>
                  </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="tensaoSistolica">Tensão Sistólica <span class="text-danger">*</span></label>
                          <input placeholder="Informe o estado da tensão Sistólica" class="form-control" type="text" id="tensaoSistolica" name="tensaoSistolica" wire:model='tensaoSistolica'>
                          @error('tensaoSistolica') <span class="text-danger">{{$message}}</span> @enderror
                       </div>
                  </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="temperatura">Temperatura <span class="text-danger">*</span></label>
                          <input  placeholder="Informe o estado da temperatura corporal" class="form-control" type="text" id="temperatura" name="temperatura" wire:model='temperatura'>
                          @error('temperatura') <span class="text-danger">{{$message}}</span> @enderror
                       </div>
                  </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="peso">Peso <span class="text-danger">*</span></label>
                          <input  placeholder="Informe o peso" class="form-control" type="text" id="peso" name="peso" wire:model='peso'>
                          @error('peso') <span class="text-danger">{{$message}}</span> @enderror
                       </div>
                  </div>
    
                  
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="escalaDeManchester">Escala de Manchester <span class="text-danger">*</span></label>
                      <select class="form-select" style="height: 3rem" name="escalaDeManchester" id="escalaDeManchester"  wire:model='escalaDeManchester'>
                        <option value="" >Selecionar</option>
                        <option value="Emergência (Emediata)" style="background:#e5241d;color:#fff">Emergência (Emediata)</option>
                        <option value="Urgente" style="background:#f49826;color:#fff">Urgente </option>
                        <option value="Emergência" style="background:#fecc37;color:#fff">Emergência</option>
                        <option value="Pouco Urgente" style="background:#4cae3f;color:#fff">Pouco Urgente</option>
                        <option value="Não Urgente" style="background:#3e4999;color:#fff">Não Urgente</option>
                      </select>
                      @error('escalaDeManchester') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="encaminharPara">Encaminhar para: </label>
                      <select  class="form-select" style="height: 3rem" name="encaminharPara" id="encaminharPara" wire:model='encaminharPara'>
                        <option value="">--selecionar--</option>
                        @if (isset($areasDeAtendimento) and $areasDeAtendimento->count() > 0)
                            @foreach ($areasDeAtendimento as $item)
                                <option value="{{$item->descricao}}">{{$item->descricao}}</option>
                            @endforeach
                        @endif
                      </select>
     
                      @error('encaminharPara') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                  </div>
                
                  
                  <div class="col-sm-12">
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="form-group">
                          <label for="notaDeTriagem">Nota de Triagem <span class="text-danger">*</span></label>
                         <textarea  placeholder="Informe uma nota adicional" wire:model='notaDeTriagem' name="notaDeTriagem" id="notaDeTriagem" cols="30" rows="10" class="form-control "></textarea>
                          @error('notaDeTriagem') <span class="text-danger">{{$message}}</span> @enderror
                      </div>
                    </div>
                  
    
                  </div>
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
  