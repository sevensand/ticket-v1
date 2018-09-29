<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        @include('layout/app')
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      </ul>
    <form class="form-inline my-2 my-lg-0">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="{{ route('login') }}">Login <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('register') }}">Register <span class="sr-only">(current)</span></a>
        </li>
        </ul>

    </form>
  </div>
</nav>
    </head>
    <body>
      <div id="app">
        <div class="container">
          <div class="row">
              <h3>WELCOME EMPLOYEE</h3>
          </div>
        </div>

      </div>
        @include('layout/footer')
    </body>
</html>
