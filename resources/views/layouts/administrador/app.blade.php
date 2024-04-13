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
                          <img src="{{asset('profile.png')}}" alt="image" />
                        </div>
                        <div class="nav-profile-text">
                          <p class="text-black font-weight-semibold m-0">{{auth()->user()->name}}</p>
                          <span class="font-13 online-color">online <i class="mdi mdi-chevron-down"></i></span>
                        </div>
                      </a>
                      <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                        <a class="dropdown-item" href="#">
                          <i class="fa fa-cog me-2 text-primary"></i>Definições de  Conta</a>
                        <div class="dropdown-divider"></div>
                       @livewire('login.logout-component')
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
                    <a class="nav-link" href="{{route('sis.admin.home')}}">
             
                      <i class="fa-solid fa-gauge menu-icon"></i>
                      <span class="menu-title">Estastísticas</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                    
                      <i class="fa fa-gears menu-icon"></i>
                    
                      <span class="menu-title">Configurações</span>
                      <i class="menu-arrow"></i>
                    </a>
                    <div class="submenu">
                      <ul class="submenu-item">
                        <li class="nav-item">
                          <a class="nav-link" href="{{route('sis.admin.instituicao')}}">Instituição</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="{{route('sis.admin.departamento')}}">Departamentos</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="{{route('sis.admin.especialidade')}}">Especialidades</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="{{route('sis.admin.laboratorio')}}">Laboratórios</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="{{route('sis.admin.exames')}}">Exames</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="{{route('sis.admin.utilizador')}}">Utilizadores</a>
                        </li>
                      </ul>
                    </div>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{route('sis.admin.medico')}}">
           
                      <i class="fas fa-user-doctor menu-icon"></i>
                      <span class="menu-title">Médicos</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{route('sis.admin.enfermeiro')}}">
              
                      <i class="fas fa-user-nurse menu-icon"></i>
                      <span class="menu-title">Enfermeiros</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{route('sis.admin.atendentes')}}">

                      
                        <span class=""><i class="fa fa-clipboard-user"></i>  Atendentes</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{route('sis.admin.pacientes')}}">
            
                      <i class="fas fa-bed-pulse menu-icon"></i>
                      <span class="menu-title">Pacientes</span>
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
                    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © {{date('Y')}}. Todos direitos reservados.</span>
                    <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Dev-Miguel</span>
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

    {{-- <script src="{{asset('/assets/js/jquery.cookie.js" type="text/javascript')}}"></script> --}}
    {{-- <script src="{{asset('/assets/js/todolist.js')}}"></script> --}}
    {{-- <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script> --}}
    {{-- <script src="{{asset('/assets/js/jquery.mask.min.js')}}"></script> --}}

  </body>
</html>