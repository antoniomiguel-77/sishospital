
  <!-- Modal -->
  <div  wire:ignore.self data-bs-backdrop='static' class="modal fade" id="menu" tabindex="-1" aria-labelledby="triagem" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-uppercase" id="exampleModalLabel"><i class="fa fa-bars"></i> MENÚ</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click='limparCampos'></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <button class="btn-hover  btn btn-md btn-outline-primary text-uppercase mb-2 p-3">
              <i class="fa fa-edit fa-1x"></i>
                Prescição Médica
            </button>
            <button class="btn-hover  btn btn-md btn-outline-primary text-uppercase mb-2 p-3">
              <i class="fa fa-book fa-1x"></i>
              Diário Clinico do Paciente
            </button>
            <button class="btn-hover  btn btn-md btn-outline-primary text-uppercase mb-2 p-3">
              <i class="fa fa-magnifying-glass"></i>
                Pedido de Exame
            </button>
            <button class="btn-hover  btn btn-md btn-outline-primary text-uppercase mb-2 p-3">
              <i class="fa fa-edit"></i>
              Receita Médica
            </button>
            <button class="btn-hover  btn btn-md btn-outline-primary text-uppercase mb-2 p-3">
              <i class="fa fa-edit"></i>
              Observação por Especialidade
            </button>
            <button class="btn-hover  btn btn-md btn-outline-primary text-uppercase mb-2 p-3">
              <i class="fa fa-edit"></i>
              Registrar Internamento
            </button>
            <button class="btn-hover  btn btn-md btn-outline-primary text-uppercase mb-2 p-3">
              <i class="fa fa-edit"></i>
              Registrar Alta
            </button>
            <button class="btn-hover   btn btn-md btn-outline-primary text-uppercase mb-2 p-3">
              <i class="fa fa-edit"></i>
              Registrar Falecimento
            </button>
          </div>
        </div>
    </div>
  </div>
  </div>
  