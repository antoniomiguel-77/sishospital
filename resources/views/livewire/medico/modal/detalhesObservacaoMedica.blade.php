
  <!-- Modal -->
  <div  wire:ignore.self data-bs-backdrop='static' class="modal fade" id="detalhesObservacaoMedica" tabindex="-1" aria-labelledby="observacaoMedica" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-uppercase" id="exampleModalLabel">DETALHES DA  OBSERVAÇÃO MÉDICA</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click='limparCampos'></button>
        </div>
        <div class="modal-body">
            <h6 class="text-center text-primary fw-bold">DATA:  {{$dataObservacao ?? ''}} {{$horaObservacao ?? ''}}</h6>
            <hr>
            <span>Queixas Princípais</span>
            <hr>
            <p class="text-muted mt-2" style="text-align: justify">{{$queixasPrincipais ?? ''}}</p>
            <hr>
            <span>Assistência Hospitalar</span>
            <hr>
            <p class="text-muted mt-2" style="text-align: justify">{{$assistenciaPreHospitalar ?? ''}}</p>
            <hr>
            <span>Diagnostico de Entrada</span>
            <hr>
            <p class="text-muted mt-2" style="text-align: justify">{{$diagnosticoDeEntrada ?? ''}}</p>
            <hr>
            <span>Observação Sumária</span>
            <hr>
            <p class="text-muted mt-2" style="text-align: justify">{{$observacaoSumaria ?? ''}}</p>
        </div>
    </div>
  </div>
  </div>
  