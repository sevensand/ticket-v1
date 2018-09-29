<!DOCTYPE html>
  <head>
    <meta charset="utf-8">
    <html lang="{{ app()->getLocale() }}">
    @include('layout/app')
  </head>
  <body>
    <div id="app">
      <v-app>
      <login></login>
      </v-app>
    </div>
    @include('layout/footer')
  </body>
</html>
