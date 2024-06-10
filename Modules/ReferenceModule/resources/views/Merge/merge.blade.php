@extends('main.app')
@section('title')
    Merge | Mapping Tool
@endsection
@section('css')
@endsection
@section('content')
    <div class="px-2 px-md-5">
        <div class="align-items-start border-bottom">
            <x-referencemodule::first-head label="Merge" icon="file" />
        </div>
        <x-referencemodule::import-form action="{{ route('merge.import') }}" method="POST">
            <br>
            <label class="form-label  fs--1 ps-0 text-capitalize  mb-2" for="mainAdminLogo">
                Here you will upload the file to
                merge any duplicated data in one column</label>
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
