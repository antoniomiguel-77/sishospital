@section('titulo','Hospital')
<div>
    <div class="main-panel">
        <div class="content-wrapper pb-0">
          <div class="page-header flex-wrap">
           
          </div>
          <div class="row">
            <div class="col-xl-12 stretch-card grid-margin">
              <div class="card shadow-sm">
                <div class="card-header">
                    <h4 class="text-uppercase">
                        Dados do Hospital
                    </h4>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="salvarOuActualizar" method="post">
                <div class="col-md-12 d-flex justify-content-center flex-wrap align-items-start">
                        <div class="form-group-5">
                            @if (isset($logotipo) and !is_string($logotipo))
                            <label for="logotipo">
                                <img class="img-fluid rounded shadow" 
                                src="{{$logotipo->temporaryUrl()}}" 
                                 alt="logotipo do hospital" style="object-fit: cover; width:10rem; height:10rem; cursor: pointer; border:1px solid #3943b7;">
                                </label>
                            @else
                            <label for="logotipo">
                                <img class="img-fluid rounded shadow" 
                                src="{{($logotipo != null) ? asset('/storage/logotipo/'.$logotipo) :
                                 asset('/not-found.png')}}" 
                                 alt="logotipo do hospital" style="object-fit: cover; width:10rem; height:10rem; cursor: pointer; border:1px solid #3943b7;">
                                </label>
                            @endif
                          
                            <input class="d-none" type="file" wire:model='logotipo' name="logotipo" id="logotipo">
                        </div>
                </div>
                <div class="col-md-12 row">
                  <div class="form-group col-md-12">
                    <label for="descricao">Hospital</label>
                    <input placeholder="Nome do Hospital" type="text" wire:model='descricao' name="descricao" id="descricao" class="form-control">
                    @error('descricao') <span class="text-danger">{{$message}}</span> @enderror
                  </div>
                  
                </div>
                <div class="col-md-12 row">
                  <div class="form-group col-md-4">
                    <label for="telefone">Telefone</label>
                    <input placeholder="999-999-999" type="tel" wire:model='telefone' name="telefone" id="telefone" class="form-control">
                    @error('telefone') <span class="text-danger">{{$message}}</span> @enderror
                  </div>
                  <div class="form-group col-md-4">
                    <label for="email">E-mail</label>
                    <input placeholder="exemplo@gmail.com" type="email" wire:model='email' name="email" id="email" class="form-control">
                    @error('email') <span class="text-danger">{{$message}}</span> @enderror
                  </div>
                  <div class="form-group col-md-4">
                    <label for="pais">País</label>
                    <input placeholder="Informe" type="tel" wire:model='pais' name="pais" id="pais" class="form-control">
                    @error('pais') <span class="text-danger">{{$message}}</span> @enderror
                  </div>
                  <div class="form-group col-md-4">
                    <label for="provincia">Provincia</label>
                    <input placeholder="Informe" type="tel" wire:model='provincia' name="provincia" id="provincia" class="form-control">
                    @error('provincia') <span class="text-danger">{{$message}}</span> @enderror
                  </div>
                  <div class="form-group col-md-4">
                    <label for="municipio">Município</label>
                    <input placeholder="Informe" type="tel" wire:model='municipio' name="municipio" id="municipio" class="form-control">
                    @error('municipio') <span class="text-danger">{{$message}}</span> @enderror
                  </div>
                  <div class="form-group col-md-4">
                    <label for="endereco">Endereço</label>
                    <input placeholder="Informe" type="tel" wire:model='endereco' name="endereco" id="endereco" class="form-control">
                    @error('endereco') <span class="text-danger">{{$message}}</span> @enderror
                  </div>
                  <div class="form-group col-md-12 d-flex justify-content-end flex-wrap">
                    <button type="submit" class="btn btn-outline-primary">
                        Salvar
                    </button>
                  </div>
                  
                </div>
            </form>
                </div>
              </div>
            </div>
            
          </div>
       
        </div>

        
    </div>
</div>

