@extends('layouts.base')

@section('head')
    @yield('head_includes')
    <script src="{{ asset('js/manifest.js') }}"></script>
    <script src="{{ asset('js/vendor.js') }}"></script> 
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/other.js') }}"></script>
@endsection
@section('body')
    @component('layouts.main_nav')
    @endcomponent
    @yield('content')

   
    @push('bottom-scripts')
    <script>
        $('document').ready(function() {
            $('[data-toggle="tooltip"]').tooltip();

            $("#error-alert").fadeTo(8000, 600).slideUp(600, function(){
                $("#error-alert").slideUp(600);
            });
            $("#success-alert").fadeTo(5000, 600).slideUp(600, function(){
                $("#success-alert").slideUp(600);
            });
        });
    </script>
    @endpush

@stack('bottom-scripts')
@endsection