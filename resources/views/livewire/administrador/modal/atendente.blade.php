  <!-- Modal -->
  <div  wire:ignore.self data-bs-backdrop='static' class="modal fade" id="atendente" tabindex="-1" aria-labelledby="medicos" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-uppercase" id="staticBackdropLabel">
            
            {{($atendenteId != null) ? 'Actualizar':'Atendente'}}
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click='limparCampos'></button>

        </div>
        <div class="modal-body">
          <form wire:submit.prevent = "{{($atendenteId != null) ? 'actualizar':'salvar'}}">
            <div class="row">
              <div class="col-sm-12">
                  <div class="form-group">
                      <label for="nomeCompleto">Nome Completo <span class="text-danger">*</span></label>
                      <input class="form-control" type="text" name="nomeCompleto" id="nomeCompleto" wire:model='nomeCompleto' placeholder="Informe o nome do Médico">
                      @error('nomeCompleto') <span class="text-danger">{{$message}}</span> @enderror
                  </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="contribuente">Nº BI <span class="text-danger">*</span></label>
                  <input class="form-control" type="text" id="contribuente" name="contribuente" wire:model='contribuente' placeholder="Informe o Nº BI ">
                  @error('contribuente') <span class="text-danger">{{$message}}</span> @enderror
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
                    <label for="nacionalidade">Nacionalidade <span class="text-danger">*</span></label>
                    <select class="form-select" name="nacionalidade" id="nacionalidade"  wire:model='nacionalidade' style="height: 3rem">
                      <option value="">--Selecionar--</option>
                      @if (isset($nacionalidades))
                      @foreach ($nacionalidades as $item)
                          <option value="{{$item->descricao}}">{{$item->descricao}}</option>
                      @endforeach
                          
                      @endif
                    </select>
                    @error('nacionalidade') <span class="text-danger">{{$message}}</span> @enderror
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="genero">Gênero <span class="text-danger">*</span></label>
                    <select class="form-select" name="genero" id="genero"  wire:model='genero' style="height: 3rem">
                      <option value="">--Selecionar--</option>
                      <option value="Masculino">Masculino</option>
                      <option value="Femenino">Femenino</option>
                     
                    </select>
                    @error('genero') <span class="text-danger">{{$message}}</span> @enderror
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="provincia">Provincia de Residência <span class="text-danger">*</span></label>
                    <select class="form-select" wire:change='filtrarMunicipioPorProvincia' name="provincia" id="provincia"  wire:model.live='provincia' style="height: 3rem">
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
                  <select class="form-select" name="municipio" id="municipio"  wire:model='municipio' style="height: 3rem">
                    <option value="">--Selecionar--</option>
                    @foreach ($todosMunicipios as $item)
                        <option value="{{$item->descricao}}">{{$item->descricao}}</option>
                    @endforeach
                  </select>
                  @error('municipio') <span class="text-danger">{{$message}}</span> @enderror
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="telefone">Telefone <span class="text-danger">*</span></label>
                  <input class="form-control" type="tel" wire:model='telefone' name="telefone" id="telefone" placeholder="999-999-999">
                  @error('telefone') <span class="text-danger">{{$message}}</span> @enderror
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="email">E-mail <span class="text-danger">*</span></label>
                  <input class="form-control" type="email" wire:model='email' name="email" id="email" placeholder="exemplo@gmail.com">
                  @error('email') <span class="text-danger">{{$message}}</span> @enderror
                  </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Estado <span class="text-danger">*</span></label>
                  <select class="form-select" name="municipio" id="municipio"  wire:model='municipio' style="height: 3rem">
                    <option value="Activo" selected>Activo</option>
                    <option value="Inactivo">Inactivo</option>
                  </select>
                  @error('estado') <span class="text-danger">{{$message}}</span> @enderror
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
  