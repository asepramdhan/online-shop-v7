<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  {{-- Bootstrap Icons --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <!-- Custom styles for this template -->
  <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
  <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
  <style>
    trix-toolbar [data-trix-button-group="file-tools"] {
      display: none;
    }

  </style>
  <title>{{ $title }}</title>
</head>
<body>
  <x-dashboard.header />
  <div class="container-fluid">
    <div class="row">
      <x-dashboard.sidebar />
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        {{ $slot }}
      </main>
    </div>
  </div>

  <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('js/dashboard.js') }}"></script>
</body>
</html>
