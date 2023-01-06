<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/dashboard.css') }}">
        <link rel="stylesheet" href="https://unpkg.com/@coreui/icons@2.0.0-beta.3/css/all.min.css">
        @livewireStyles
        <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
        <script src="{{ mix('js/dashboard.js') }}" defer></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>

        <script>
            var lfm = function(id, type, options) {
                let button = document.getElementById(id);

                button.addEventListener('click', function () {
                    var route_prefix = (options && options.prefix) ? options.prefix : '/filemanager';
                    var target_input = document.getElementById(button.getAttribute('data-input'));
                    var target_preview = document.getElementById(button.getAttribute('data-preview'));

                    window.open(route_prefix + '?type=' + options.type || 'file', 'FileManager', 'width=900,height=600');
                    window.SetUrl = function (items) {
                        var file_path = items.map(function (item) {
                            return item.url;
                        }).join(',');

                        // set the value of the desired input to image url
                        target_input.value = file_path;
                        target_input.dispatchEvent(new Event('change'));

                        // clear previous preview
                        target_preview.innerHtml = '';

                        // set or change the preview image src
                        items.forEach(function (item) {
                            let img = document.createElement('img')
                            img.setAttribute('style', 'height: 5rem')
                            img.setAttribute('src', item.thumb_url)
                            target_preview.appendChild(img);
                        });

                        // trigger change event
                        target_preview.dispatchEvent(new Event('change'));
                    };
                });
            };
        </script>
    </head>
    <body class="c-app font-sans antialiased">
        <div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
            <div class="c-sidebar-brand">
                <a href="/">
                    <x-jet-application-mark class="c-sidebar-brand-minimized" width="36" />
                    <x-jet-application-mark class="c-sidebar-brand-full" width="36" />
                </a>
            </div>

            <ul class="c-sidebar-nav">
                {{ $sidebar ?? '' }}
                <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{route('dashboard')}}">
                        <i class="cil-browser c-sidebar-nav-icon"></i> Dashboard</a>
                </li>
                @can('vendors_access')
                <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{route('categories.index')}}">
                        <i class="cil-barcode c-sidebar-nav-icon"></i> Categories</a>
                </li>
                <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{route('vendors.index')}}">
                        <i class="cil-cart c-sidebar-nav-icon"></i> Vendors Suppliers</a>
                </li>
                    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{route('request_for_quotation.index')}}">
                        <i class="cil-copy c-sidebar-nav-icon"></i> Request For Quotation</a>
                </li>
                    <li class="c-sidebar-nav-item c-sidebar-nav-dropdown"><a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
                            <i class="cil-file c-sidebar-nav-icon"></i> File Manager</a>
                        <ul class="c-sidebar-nav-dropdown-items">
                            <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{route('file_manager')}}?type=Images"><span class="c-sidebar-nav-icon"></span> Images</a></li>
                            <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{route('file_manager')}}?type=Files"><span class="c-sidebar-nav-icon"></span> Files</a></li>
                        </ul>
                    </li>
{{--                    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{route('file_manager')}}">--}}
{{--                        <i class="cil-file c-sidebar-nav-icon"></i> File Manager</a>--}}
{{--                </li>--}}
                @endcan
                @can('user_access')
                <li class="c-sidebar-nav-item c-sidebar-nav-dropdown"><a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
                        <i class="cil-people c-sidebar-nav-icon"></i> Users Management</a>

                    <ul class="c-sidebar-nav-dropdown-items">
                        <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{route('users.index')}}"><span class="c-sidebar-nav-icon"></span> Users</a></li>
                        <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{route('role.index')}}"><span class="c-sidebar-nav-icon"></span> Roles</a></li>
                        <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{route('permission.index')}}"><span class="c-sidebar-nav-icon"></span> Permission</a></li>
                    </ul>
                </li>
                @endcan
            </ul>

            <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-minimized"></button>
        </div>
        <div class="c-wrapper">
            <header class="c-header c-header-light c-header-fixed c-header-with-subheader">
                <button class="c-header-toggler c-class-toggler d-lg-none mr-auto" type="button" data-target="#sidebar" data-class="c-sidebar-show">
                    <span class="c-header-toggler-icon"></span>
                </button>

                <button class="c-header-toggler c-class-toggler ml-3 d-md-down-none" type="button" data-target="#sidebar" data-class="c-sidebar-lg-show" responsive="true">
                    <span class="c-header-toggler-icon"></span>
                </button>

                <ul class="c-header-nav d-md-down-none">
                    <li class="c-header-nav-item px-3">
{{--                        <x-jet-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">--}}
{{--                            {{ __('Dashboard') }}--}}
{{--                        </x-jet-nav-link>--}}
                    </li>
                </ul>

                @livewire('navigation-menu')

                <div class="c-subheader px-3 py-3">
                    <div class="container">
                        {{ $header }}
                    </div>
                </div>
            </header>

          <div class="c-body">
            <main class="c-main">

              <div class="container">
                  <div class="row fade-in">
                      <div class="col">
                          {{ $slot }}
                      </div>

                      @if (isset($aside))
                          <div class="col-lg-3">
                              {{ $aside ?? '' }}
                          </div>
                      @endif
                  </div>
              </div>

            </main>

            <footer class="c-footer">

            </footer>
          </div>
        </div>

        @stack('modals')
        @livewireScripts
        @stack('scripts')
    </body>
</html>
