<!DOCTYPE html>
<html lang="pt">
  <head>
 
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>@yield('titulo')</title>
 
    <link rel="stylesheet" href="{{asset('/assets/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/vendors/flag-icon-css/css/flag-icon.min.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/vendors/css/vendor.bundle.base.css')}}">
 
    <link rel="stylesheet" href="{{asset('/assets/vendors/jquery-bar-rating/css-stars.css')}}" />
    <link rel="stylesheet" href="{{asset('/assets/vendors/font-awesome/css/font-awesome.min.css')}}" />
 
    <link rel="stylesheet" href="{{asset('/assets/css/demo_2/style.css')}}" />
 
    {{-- FONTAWESOEM --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/fontawesome.min.css" integrity="sha512-d0olNN35C6VLiulAobxYHZiXJmq+vl+BGIgAxQtD5+kqudro/xNMvv2yIHAciGHpExsIbKX3iLg+0B6d0k4+ZA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js" integrity="sha512-GWzVrcGlo0TxTRvz9ttioyYJ+Wwk9Ck0G81D+eO63BaqHaJ3YZX9wuqjwgfcV/MrB2PhaVX9DkYVhbFpStnqpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/fontawesome.min.js" integrity="sha512-C8qHv0HOaf4yoA7ISuuCTrsPX8qjolYTZyoFRKNA9dFKnxgzIHnYTOJhXQIt6zwpIFzCrRzUBuVgtC4e5K1nhA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  </head>
  <body>
    <div class="container-scroller">
        <div class="horizontal-menu">
            <nav class="navbar top-navbar col-lg-12 col-12 p-0">
              <div class="container">
                <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                  <a class="navbar-brand brand-logo text-center" href="{{route('sis.admin.home')}}">
                     <i class="fas fa-hospital fa-2x"></i>
                    <span class="font-12 d-block font-weight-bold text-uppercase">Sistema Hospitalar</span> 
                  </a>
                  <a class="navbar-brand brand-logo-mini" href="index.html"><img src="../assets/images/logo-mini.svg" alt="logo" /></a>
                </div>
                <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
               
                  <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item nav-profile dropdown">
                      <a class="nav-link" id="profileDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="nav-profile-img">
                          <img src="../assets/images/faces/face1.jpg" alt="image" />
                        </div>
                        <div class="nav-profile-text">
                          <p class="text-black font-weight-semibold m-0"> Olson jass </p>
                          <span class="font-13 online-color">online <i class="mdi mdi-chevron-down"></i></span>
                        </div>
                      </a>
                      <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                        <a class="dropdown-item" href="#">
                          <i class="mdi mdi-cached me-2 text-success"></i> Activity Log </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">
                          <i class="mdi mdi-logout me-2 text-primary"></i> Signout </a>
                      </div>
                    </li>
                  </ul>
                  <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="horizontal-menu-toggle">
                    <span class="mdi mdi-menu"></span>
                  </button>
                </div>
              </div>
            </nav>
            <nav class="bottom-navbar">
              <div class="container">
                <ul class="nav page-navigation">
                 
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                    
                      <i class="fa fa-cog menu-icon"></i>
                      <span class="menu-title">Decisões Médicas</span>
                      <i class="menu-arrow"></i>
                    </a>
                    <div class="submenu">
                      <ul class="submenu-item">
                        <li class="nav-item">
                          <a class="nav-link" href="{{route('sis.medico.observacao.medica')}}">Observação Médica</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="{{route('sis.admin.instituicao')}}"> Prescição Médica</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="{{route('sis.admin.instituicao')}}">Pedido de Exame</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="{{route('sis.admin.instituicao')}}">Diário Clinico do Paciente</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="{{route('sis.admin.instituicao')}}">Receita Médica</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="{{route('sis.admin.instituicao')}}">Observação por Especialidade</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="{{route('sis.admin.instituicao')}}">Registrar Internamento</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="{{route('sis.admin.instituicao')}}">Registrar Alta</a>
                        </li>
                      
                        <li class="nav-item">
                          <a class="nav-link" href="{{route('sis.admin.instituicao')}}">Registrar Falecimento</a>
                        </li>
 
                      
                      </ul>
                    </div>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{route('sis.medico.paciente-atendimento')}}">
             
                      <i class="fa fa-gauge menu-icon"></i>
                      <span class="menu-title">
                        Atendimentos Pendentes
                        <span class="badge badge-danger">0</span>
                      </span>
                    </a>
                  </li>
                </ul>
              </div>
            </nav>
          </div>
          <div class="container-fluid page-body-wrapper">
          
            {{$slot}}
 
              <footer class="footer">
                <div class="container">
                  <div class="d-sm-flex justify-content-center justify-content-sm-between">
                    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © {{date('Y')}}. All rights reserved.</span>
                    <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Dev-Miguel<i class="mdi mdi-heart text-danger"></i></span>
                  </div>
                </div>
              </footer>
            
            </div>
       
          </div>
    </div>

 
  
   
    <script src="{{asset('/assets/vendors/js/vendor.bundle.base.js')}}"></script>
    <script src="{{asset('/assets/vendors/jquery-bar-rating/jquery.barrating.min.js')}}"></script>
    <script src="{{asset('/assets/vendors/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('/assets/vendors/flot/jquery.flot.js')}}"></script>
    <script src="{{asset('/assets/vendors/flot/jquery.flot.resize.js')}}"></script>
    <script src="{{asset('/assets/vendors/flot/jquery.flot.categories.js')}}"></script>
    <script src="{{asset('/assets/vendors/flot/jquery.flot.fillbetween.js')}}"></script>
    <script src="{{asset('/assets/vendors/flot/jquery.flot.stack.js')}}"></script>
    <script src="{{asset('/assets/js/off-canvas.js')}}"></script>
    <script src="{{asset('/assets/js/hoverable-collapse.js')}}"></script>
    <script src="{{asset('/assets/js/misc.js')}}"></script>
    <script src="{{asset('/assets/js/settings.js')}}"></script>
    <script src="{{asset('/assets/js/dashboard.js')}}"></script>

    <x-livewire-alert::scripts />
    <script src="{{asset('/assets/js/sweetalert2.all.min.js')}}"></script>

  </body>
</html>