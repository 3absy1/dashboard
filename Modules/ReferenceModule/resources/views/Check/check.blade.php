@extends('main.app')
@section('title')
    Check | Mapping Tool
@endsection
@section('css')
@endsection
@section('content')
    <div class="container ">
        <div class="align-items-start border-bottom">
            <x-referencemodule::first-head label="Check" icon="file-import" />
        </div>
        <x-referencemodule::import-form action="{{ route('check.matchColumns') }}" method="POST">
            <br>
            <label class="form-label  fs--1 ps-0 text-capitalize  mb-2" for="mainAdminLogo">
                Here you will upload the file to
                check if it has a reference or is related or not.</label>
        </x-referencemodule::import-form>
    </div>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
@endsection
