<!DOCTYPE html>
<html :class="{ 'dark': dark }" x-data="data()" lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>User Manager</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script defer src="https://unpkg.com/alpinejs@3.7.1/dist/cdn.min.js"></script>
    <script src="https://kit.fontawesome.com/057fec968e.js" crossorigin="anonymous"></script>
    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>      <script src="/js/init-alpine.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    @livewireStyles
    <style>
    [x-cloak] { display: none !important; }
    </style>
  </head>
  <body>
    <div
      class="flex h-screen bg-gray-50 dark:bg-gray-900"
      :class="{ 'overflow-hidden': isSideMenuOpen }"
    >
      @include('user-manager.partials.desktop-sidebar')
      @include('user-manager.partials.mobile-sidebar')      
      <div class="flex flex-col flex-1 w-full">
        @include('user-manager.partials.header')
        <main class="h-full overflow-y-auto">
            @yield('content')
        </main>
      </div>
    </div>
  </body>
  @livewireScripts
  <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
    <script>
        var notyf = new Notyf();
        Livewire.on('successAlert', alertMessage => {
            notyf.success(alertMessage);
        });
        Livewire.on('errorAlert', alertMessage => {
            notyf.error(alertMessage);
        });
    </script>
</html>
