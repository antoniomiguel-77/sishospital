
  <!-- Modal -->
  <div  wire:ignore.self data-bs-backdrop='static' class="modal fade" id="registro-de-alta" tabindex="-1" aria-labelledby="triagem" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-uppercase" id="exampleModalLabel"><i class="fa fa-edit"></i> REGISTRAR ALTA</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
        </div>
        <div class="modal-body">
            <form wire:submit.prevent="{{(isset($registro_id) and $registro_id != null) ? 'actualizar':'registrarAltaDoPaciente'}}" >
                @csrf
                @method('POST')
            <div class="form-group col-md-12">
                <label for="paciente">Paciente</label>
                <input type="text" name="paciente" id="paciente" wire:model='paciente' readonly class="form-control">
                @error('paciente')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group col-md-12">
                <label for="estadoDeSaude">Estado de Saúde</label>
                <select name="estadoDeSaude" wire:model='estadoDeSaude' id="estadoDeSaude" class="form-select">
                    <option value="" selected>--Estado de Saúde--</option>
                    <option value="Curado">Curado</option>
                    <option value="Melhorado">Melhorado</option>
                    <option value="Mesmo Estado">Mesmo Estado</option>
                    <option value="Piorado">Piorado</option>
                </select>
                @error('estadoDeSaude')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="condicaoDeSaudo">Condição de Saúde</label>
                <textarea placeholder="Qual a condição de saúde do paciente?" name="condicaoDeSaudo" id="condicaoDeSaudo" wire:model='condicaoDeSaudo' cols="30" rows="5" style="resize: none" class="form-control"></textarea>
                @error('condicaoDeSaudo')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="recomendacao">Recomendações</label>
                <textarea placeholder="Qual recomendação deixa para o paciente?"  name="recomendacao" id="recomendacao" wire:model='recomendacao' cols="30" rows="5" style="resize: none" class="form-control"></textarea>
                @error('recomendacao')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="orientacao">Orientação</label>
                <textarea placeholder="Qual orientação deixa para o paciente ?" name="orientacao" id="orientacao" wire:model='orientacao' cols="30" rows="5" style="resize: none" class="form-control"></textarea>
                @error('orientacao')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="diagnosticoDeEntrada">Diagnóstico de Entrada</label>
                <textarea placeholder="Informe o Diagnóstico de Saída do entrada" name="diagnosticoDeEntrada" id="diagnosticoDeEntrada" wire:model='diagnosticoDeEntrada' cols="30" rows="5" style="resize: none" class="form-control"></textarea>
                @error('diagnosticoDeEntrada')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="diagnosticoDeSaida">Diagnóstico de Saída</label>
                <textarea placeholder="Informe o Diagnóstico de Saída do paciente" name="diagnosticoDeSaida" id="diagnosticoDeSaida" wire:model='diagnosticoDeSaida' cols="30" rows="5" style="resize: none" class="form-control"></textarea>
                @error('diagnosticoDeSaida')
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
  