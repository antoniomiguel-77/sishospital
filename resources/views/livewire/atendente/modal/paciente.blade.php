
  <!-- Modal -->
  <div  wire:ignore.self data-bs-backdrop='static' class="modal fade" id="paciente" tabindex="-1" aria-labelledby="departamento" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-uppercase" id="exampleModalLabel">{{($pacienteId != null) ? 'ACTUALIZAR':'ADICIONAR'}} PACIENTE</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click='limparCampos'></button>
        </div>
        <div class="modal-body">
            <form wire:submit.prevent = "{{($pacienteId != null) ? 'actualizar':'salvar'}}">
                <div class="row">
                  <div class="col-sm-12">
                      <div class="form-group">
                          <label for="nomeCompleto">Nome Completo <span class="text-danger">*</span></label>
                          <input placeholder="Informe o nome do paciente" class="form-control" type="text" name="nomeCompleto" id="nomeCompleto" wire:model='nomeCompleto'>
                          @error('nomeCompleto') <span class="text-danger">{{$message}}</span> @enderror
                      </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="nomeDoPai">Nome do Pai <span class="text-danger">*</span></label>
                      <input placeholder="Informe o nome do pai" class="form-control" type="text" id="nomeDoPai" name="nomeDoPai" wire:model='nomeDoPai'>
                      @error('nomeDoPai') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="nomeDaMae">Nome da Mãe <span class="text-danger">*</span></label>
                      <input placeholder="Informe o nome da mãe" class="form-control" type="text" name="nomeDaMae" id="nomeDaMae" wire:model='nomeDaMae'>
                      @error('nomeDaMae') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label for="dataDeNascimento">Data de Nascimento <span class="text-danger">*</span></label>
                          <input type="date" class="form-control" type="text" name="dataDeNascimento" id="dataDeNascimento" wire:model='dataDeNascimento'>
                          @error('dataDeNascimento') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                    </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="grupoSanguinio">Grupo Sanguinio <span class="text-danger">*</span></label>
                          <select style="height: 3rem" class="form-select" name="grupoSanguinio" id="grupoSanguinio"  wire:model='grupoSanguinio'>
                            <option value="" >Selecionar</option>
                            <option value="A+">A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B-">B-</option>
                            <option value="AB+">AB+</option>
                            <option value="AB-">AB-</option>
                            <option value="O+">O+</option>
                            <option value="O-">O-</option>
                            <option value="RH+">RH+</option>
                            <option value="RH-">RH-</option>
                          </select>
                          @error('grupoSanguinio') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="genero">Gênero <span class="text-danger">*</span></label>
                          <select style="height: 3rem" class="form-select" name="genero" id="genero"  wire:model='genero'>
                            <option value="">--Selecionar--</option>
                            <option value="Masculino">Masculino</option>
                            <option value="Femenino">Femenino</option>
                           
                          </select>
                          @error('genero') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="nacionalidade">Nacionalidade <span class="text-danger">*</span></label>
                          <select style="height: 3rem" class="form-select" name="nacionalidade" id="nacionalidade"  wire:model='nacionalidade'>
                            <option value="">--Selecionar--</option>
                            @foreach ($nacionalidades as $item)
                                <option value="{{$item->descricao}}">{{$item->descricao}}</option>
                            @endforeach
                          </select>
                          @error('nacionalidade') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                      </div>
                    
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="contribuente">Nº BI <span class="text-danger">*</span></label>
                          <input placeholder="Informe o nº do BI" class="form-control" type="text" id="contribuente" name="contribuente" wire:model='contribuente'>
                          @error('contribuente') <span class="text-danger">{{$message}}</span> @enderror
                      </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="provincia">Provincia <span class="text-danger">*</span></label>
                      <select wire:change='filtrarMunicipioPorProvincia' style="height: 3rem" class="form-select" name="provincia" id="provincia"  wire:model.live='provincia'>
                        <option value="">--Selecionar--</option>
                        @foreach ($provincias as $item)
                            <option value="{{$item->id}}">{{$item->descricao}}</option>
                        @endforeach
                      </select>
                      @error('provincia') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="municipio">Município <span class="text-danger">*</span></label>
                      <select style="height: 3rem" class="form-select" name="municipio" id="municipio"  wire:model='municipio'>
                        <option value="">--Selecionar--</option>
                        @if (isset($todosMunicipios))
                          @foreach ($todosMunicipios as $item)
                              <option value="{{$item->descricao}}">{{$item->descricao}}</option>
                          @endforeach
                        @endif
                      </select>
                      @error('municipio') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="bairro">Bairro <span class="text-danger">*</span></label>
                      <input placeholder="Informe o bairro" class="form-control" type="text" wire:model='bairro' name="bairro" id="bairro">
                      @error('bairro') <span class="text-danger">{{$message}}</span> @enderror
                      </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="email">E-mail <span class="text-danger">*</span></label>
                      <input placeholder="Informe o e-mail" class="form-control" type="email" wire:model='email' name="email" id="email">
                      @error('email') <span class="text-danger">{{$message}}</span> @enderror
                      </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="telefone">Telefone <span class="text-danger">*</span></label>
                      <input placeholder="999-999-999" class="form-control" type="tel" wire:model='telefone' name="telefone" id="telefone">
                      @error('telefone') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                  </div>
                  
                  <div class="col-sm-12">
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="form-group">
                          <label for="endereco">Endereço <span class="text-danger">*</span></label>
                          <input placeholder="Informe o endereço do paciente" wire:model='endereco' name="endereco" id="endereco" type="text" class="form-control ">
                          @error('endereco') <span class="text-danger">{{$message}}</span> @enderror
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
  