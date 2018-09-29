<!DOCTYPE html>
  <head>
    <meta charset="utf-8">
    <html lang="{{ app()->getLocale() }}">
    @include('layout/app')
    @include('nav/navigation')
  </head>
  <body>
    <div id="app">
      <H3>TEST</H3>
        <dashboard></dashboard>
    </div>
    @include('layout/footer')
  </body>
</html>
