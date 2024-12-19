<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    {{-- Base Meta Tags --}}
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Custom Meta Tags --}}
    @yield('meta_tags')

    {{-- Title --}}
    <title>
        @yield('title_prefix', config('adminlte.title_prefix', ''))
        @yield('title', config('adminlte.title', 'AdminLTE 3'))
        @yield('title_postfix', config('adminlte.title_postfix', ''))
    </title>

    {{-- Custom stylesheets (pre AdminLTE) --}}
    @yield('adminlte_css_pre')

    {{-- Base Stylesheets --}}
    @if(!config('adminlte.enabled_laravel_mix'))
    <link rel="stylesheet" href="{{ asset('vendor/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">

    @if(config('adminlte.google_fonts.allowed', true))
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Poppins:300,400,600,700,300italic,400italic,600italic">
    @endif
    @else
    <link rel="stylesheet" href="{{ mix(config('adminlte.laravel_mix_css_path', 'css/app.css')) }}">
    @endif

    {{-- Customizations --}}
    <link rel="stylesheet" href="{{ asset('css/backend/custom.css') }}">

    {{-- Favicons --}}
    <link rel="shortcut icon" href="{{ asset('favicons/favicon.png') }}" />
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('favicons/favicon.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('favicons/favicon.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('favicons/favicon.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicons/favicon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicons/favicon.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicons/favicon.png') }}">

    {{-- Extra Configured Plugins Stylesheets --}}
    @include('adminlte::plugins', ['type' => 'css'])

    {{-- Livewire Styles --}}
    @if(config('adminlte.livewire'))
    @if(intval(app()->version()) >= 7)
    @livewireStyles
    @else
    <livewire:styles />
    @endif
    @endif

    {{-- Custom Stylesheets (post AdminLTE) --}}
    @yield('adminlte_css')

    {{-- Favicon --}}
    @if(config('adminlte.use_ico_only'))
    <link rel="shortcut icon" href="{{ asset('favicons/favicon.ico') }}" />
    @elseif(config('adminlte.use_full_favicon'))
    <link rel="shortcut icon" href="{{ asset('favicons/favicon.ico') }}" />
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('favicons/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('favicons/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('favicons/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicons/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('favicons/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('favicons/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('favicons/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('favicons/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicons/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicons/favicon-16x16.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicons/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('favicons/android-icon-192x192.png') }}">
    <link rel="manifest" crossorigin="use-credentials" href="{{ asset('favicons/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('favicon/ms-icon-144x144.png') }}">
    @endif

</head>

<body class="@yield('classes_body')" @yield('body_data')>

    {{-- Body Content --}}
    @yield('body')

    <!-- media-manager -->
    @include('backend.mediamanager.partials.media-manager')

    <!-- delete modal -->
    @include('backend.modals.deleteModal')

    <!-- delete modal -->
    @include('backend.modals.deleteAllModal')

    <!-- hide modal -->
    @include('backend.modals.hideModal')

    <!-- approve modal -->
    @include('backend.modals.approveModal')

    <!-- reject modal -->
    @include('backend.modals.rejectModal')

    <!-- reSubmit modal -->
    @include('backend.modals.reSubmitModal')

    {{-- Custom JS --}}
    <script src="{{ asset('js/backend/custom.js') }}"></script>

    {{-- Base Scripts --}}
    @if(!config('adminlte.enabled_laravel_mix'))
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    @else
    <script src="{{ mix(config('adminlte.laravel_mix_js_path', 'js/app.js')) }}"></script>
    @endif

    {{-- Extra Configured Plugins Scripts --}}
    @include('adminlte::plugins', ['type' => 'js'])

    {{-- Livewire Script --}}
    @if(config('adminlte.livewire'))
    @if(intval(app()->version()) >= 7)
    @livewireScripts
    @else
    <livewire:scripts />
    @endif
    @endif

    <script>
        Dropzone.autoDiscover = false;
    
        /**
         * Setup dropzone
         */
        
        $('#formDropzone').dropzone({
            previewTemplate: $('#dzPreviewContainer').html(),
            url: '/media-manager/add-files',
            addRemoveLinks: true,
            autoProcessQueue: false,       
            uploadMultiple: false,
            parallelUploads: 1,
            maxFiles: 1,
            acceptedFiles: '.jpeg, .jpg, .png, .gif',
            thumbnailWidth: 900,
            thumbnailHeight: 600,
            previewsContainer: "#previews",
            timeout: 0,
            init: function() 
            {
                myDropzone = this;
    
                // when file is dragged in
                this.on('addedfile', function(file) { 
                    $('.dropzone-drag-area').removeClass('is-invalid').next('.invalid-feedback').hide();
    
                    setTimeout(function() {
                      myDropzone.removeAllFiles();
                    }, 5000);

                    $('#uploadMediaFile').prop("disabled",false);
                });
            },
            removedfile: function (file) {
                $('#uploadMediaFile').prop("disabled",true);
                    // file.previewElement.innerHTML = "";
                    file.previewElement.parentNode.removeChild(file.previewElement);
            },
            success: function(file, response) 
            {
                // hide form and show success message
                $('#formDropzone').fadeOut(600);
                setTimeout(function() {
                    $('#successMessage').removeClass('d-none');
                    getMediaFiles();
                }, 600);
                myDropzone.removeFile(file);
                $('.spinner-border').addClass('d-none');
                $('#formDropzone').fadeIn(600);
            }
        });
    
        /**
         * Upload Form on submit
         */
        $('#uploadMediaFile').on('click', function(event) {
            event.preventDefault();
            var $this = $(this);
            
            // show submit button spinner
            $this.children('.spinner-border').removeClass('d-none');
            
            // validate form & submit if valid
            if ($('#formDropzone')[0].checkValidity() === false) {
                event.stopPropagation();
    
                // show error messages & hide button spinner    
                $('#formDropzone').addClass('was-validated'); 
                $this.children('.spinner-border').addClass('d-none');
    
                // if dropzone is empty show error message
                if (!myDropzone.getQueuedFiles().length > 0) {                        
                    $('.dropzone-drag-area').addClass('is-invalid').next('.invalid-feedback').show();
                }
            } else {
    
                // if everything is ok, submit the form
                myDropzone.processQueue();
            }
        });    
    </script>
    {{-- Custom Scripts --}}
    @yield('adminlte_js')
</body>

</html>