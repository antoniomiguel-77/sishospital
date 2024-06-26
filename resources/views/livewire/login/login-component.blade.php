@section('title','Login')
<section class="form-01-main">
    <div class="form-cover">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="form-sub-main">
            <div class="_main_head_as">
              <a href="#">
                <img src="{{asset('/assets/login/images/vector.png')}}">
              </a>
            </div>
            <form wire:submit.prevent="entrar">
              @csrf
            <div class="form-group">
                <input wire:model='email' id="email" name="email" class="form-control _ge_de_ol @error('email') is-invalid @enderror" type="text" placeholder="E-mail"  >
                @error('email')
                <div class="" style="text-align: start;margin-top:-2rem">
                  <span  class="text-danger">{{$message}}</span>
                </div>
                @enderror
            </div>

            <div class="form-group">                                              
              <input wire:model='password' id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="********" >
              @error('password')
              <div class="" style="text-align: start;margin-top:-2rem">
                <span  class="text-danger">{{$message}}</span>
              </div>
              @enderror
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

 
