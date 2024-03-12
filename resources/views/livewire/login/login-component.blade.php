@section('title','Login')
<section class="form-01-main">
    <div class="form-cover">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
            @if (session('message'))
            <div class="col-md-12 d-flex justify-content-center flex-wrap  alertMessage">
                <div class="mt-2 col-md-5 alert alert-danger alert-dismissible fade show" role="alert" style="margin-bottom: -3rem;">
                    <strong>Erro!</strong> {{session('message')}}.
                    <button wire:click='session()->forget("message")' type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            @endif
          <div class="form-sub-main">
            <div class="_main_head_as">
              <a href="#">
                <img src="{{asset('/assets/login/images/vector.png')}}">
              </a>
            </div>
            <form wire:submit.prevent="entrar">
            <div class="form-group">
                <input wire:model='email' id="email" name="email" class="form-control _ge_de_ol @error('email') is-invalid @enderror" type="text" placeholder="E-mail"  >
            </div>

            <div class="form-group">                                              
              <input wire:model='password' id="password" type="password" class="form-control" name="password" placeholder="********" >
              <i style="cursor: pointer" id="#password" toggle="#password" class="fa fa-fw fa-eye toggle-password field-icon @error('password') is-invalid @enderror"></i>
            </div>

            <div class="form-group">
              <div class="check_box_main">
                <a href="#" class="pas-text">Esqueceu sua senha?</a>
              </div>
            </div>

            <div class="form-group">
              <div class="btn_uy">
                <button type="submit" class="btn btn-md btn_uy">Entrar</button>
              </div>
            </div>
        </form>
          </div>
        </div>
      </div>
    </div>
    </div>
  </section>

  @push('boxMessage')
    
  @endpush
 
