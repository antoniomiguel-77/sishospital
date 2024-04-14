<div>
    <div class="main-panel">
        <div class="content-wrapper pb-0">
          <div class="row ">
            <div class="card col-md-3  mt-1 mb-2 rounded " style="background:#115a79;color: #fff;">
              <div  class="font-weight-bold text-uppercase card-body d-flex justify-content-between align-items-start flex-wrap">
                <span>Médicos ({{$medicos}})</span>
                <i class="fa-solid fa-user-doctor fa-2x"></i>
              </div>
            </div>
            <div class="card col-md-3  mt-1 mb-2 rounded " style="background:#115a79;color: #fff;">
              <div  class="font-weight-bold text-uppercase card-body d-flex justify-content-between align-items-start flex-wrap">
                <span>Enfermeiros ({{$enfermeiros}})</span>
                <i class="fa-solid fa-user-doctor fa-2x"></i>
              </div>
            </div>
            <div class="card col-md-3  mt-1 mb-2 rounded " style="background:#115a79;color: #fff;">
              <div  class="font-weight-bold text-uppercase card-body d-flex justify-content-between align-items-start flex-wrap">
                <span>Atendentes ({{$atendentes}})</span>
                <i class="fa fa-clipboard-user fa-2x"></i>
              </div>
            </div>
            <div class="card col-md-3  mt-1 mb-2 rounded " style="background:#115a79;color: #fff;">
              <div  class="font-weight-bold text-uppercase card-body d-flex justify-content-between align-items-start flex-wrap">
                <span>Pacientes ({{$pacientes}})</span>
                <i class="fas fa-bed-pulse menu-icon fa-2x"></i>
              </div>
            </div>
          </div>
          <!-- first row starts here -->
          <div class="row">
            <div class="col-xl-12 stretch-card grid-margin">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex justify-content-between flex-wrap">
                    <div>
                      <div class="card-title mb-0 text-uppercase">Entradas no banco de urgência - {{date('d-m-Y')}}</div>
                      <h3 class="font-weight-bold mb-0">{{$entradas}}</h3>
                    </div>
                    <div>
                      <div class="d-flex flex-wrap pt-2 justify-content-between sales-header-right">
                        <div class="d-flex me-5">
                          <button type="button" class="btn btn-md btn-outline-primary">
                            Relatório
                            <i class="fa fa-print"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
              
                  <div class="flot-chart-wrapper">
                    <div class="flot-chart">
                      <canvas id="chart" class="flot-base"></canvas>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
          </div>
       
        </div>

        
    </div>
</div>

{{-- @push('charts') --}}
<script>
  const ctx = document.getElementById('chart');
  var dv = JSON.parse('{!! json_encode($deliveryMonth ?? '')  !!}');
  var dh = JSON.parse('{!! json_encode($deliveryMonthCount ?? '')  !!}');
  new Chart(ctx, {
      type: 'bar',
      data: {
          labels: dv,
          datasets: [{
              label: 'Estatística Mensal',
              data: dh,
              borderWidth: 1
          }]
      },
      options: {
          scales: {
              y: {
                  beginAtZero: true
              }
          }
      }
  });
  </script>



{{-- @endpush --}}