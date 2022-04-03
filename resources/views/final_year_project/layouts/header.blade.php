<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a href="/"><img class="navbar-brand ml-5 tahir-logo" src="{{asset('images/tahir-logo.png')}}" width="150"></a>
  <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
    <form class="form-inline my-2 my-lg-0 m-auto">
      <input class="mr-sm-2 input-size" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
    <div class="links ">
    <ul class="navbar-nav  mt-2 mt-lg-0">
      <li class="nav-item active">
            @if (Route::has('login'))
                <div class="links1 d-flex">
                    @auth
                        <a class="nav-link" href="{{ url('/home') }}">Home</a>
                        <a class="nav-link" href="{{ url('/home') }}">{{Auth::user()->company_name}}</a>
                        <a href='' class='nav-link'><i class='fa fa-shopping-cart fa-1x' aria-hidden='true'></i></a>
                        <span class='counter counter-lg' style="margin-left:-15px;margin-top:-7px;">
                        <span style='color:white;font-size:10px;background-color:red;border-radius:100%;padding:5px;'>
                        {{ DB::table('carts')->where('add_to_cart_id', Auth::user()->id)->count() }}
                       <!-- {{ $session_id = Session::get('id') }} -->

                      </span></span>
                        <a class="nav-link" href="{{ route('logout') }}">Logout</a>

</div>
</li>
                    @else
                    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
          Log In
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item"href="{{ route('login') }}">Login</a>
          <a class="dropdown-item" href="{{ route('register') }}">Registration</a>
        </div>
      </li>
                      

                        <!-- @if (Route::has('register'))
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        @endif -->
                    @endauth
                </div>
            @endif
      </li>
    

<!-- <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          User Login
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="login">Login</a>
          <a class="dropdown-item" href="registration">Registration</a>   
        </div>
</a> -->
    
      </li>
   
    </ul>
   </div>
  </div>
</nav>
