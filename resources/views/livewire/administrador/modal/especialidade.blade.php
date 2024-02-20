
  <!-- Modal -->
  <div  wire:ignore.self data-bs-backdrop='static' class="modal fade" id="especialidade" tabindex="-1" aria-labelledby="departamento" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-uppercase" id="exampleModalLabel">{{($especialidadeId == null)? 'Adicionar':'Actualizar'}} Especialidade</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click='limparCampos'></button>
        </div>
        <div class="modal-body">
            <form wire:submit=" {{($especialidadeId != null) ? 'actualizar':'salvar'}}">
              @if ($especialidadeId != null)
              <div class="input-group mb-3">
                <input type="text" name="descricao" wire:model='descricao' id="descricao" class="form-control" placeholder="Especialidade" aria-label="Username" aria-describedby="basic-addon1">
              </div>
              <span class="text-danger">@error('descricao'){{$message}}@enderror</span>
              @else
            
              <div class="mb-3  d-flex justify-content-end ">
                <span wire:click='add({{$i}})' class=" text-uppercase col-md-1  btn btn-outline-primary d-flex justify-content-center align-items-center" style="cursor: pointer" id="basic-addon1">
                  <i class="fa fa-plus"></i>
                </span>
              </div>


              @if (isset($inputs))
                @foreach ($inputs as $key => $item)
                <div class="input-group mb-3">
                  <input type="text" name="descricao.{{$key}}" wire:model='descricao.{{$key}}' id="descricao.{{$key}}" class="form-control" placeholder="Especialidade" aria-label="Username" aria-describedby="basic-addon1">
                  <span wire:click='remove({{$key}})' class="input-group-text btn btn-outline-danger d-flex justify-content-center align-items-center" style="cursor: pointer" id="basic-addon1">
                    <i class="fa fa-times"></i>
                  </span>
                </div>
                <span class="text-danger">@error('descricao.'.$key){{$message}}@enderror</span>
                @endforeach
              @endif
              @endif
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
      </div>
    </div>
  </div>
  