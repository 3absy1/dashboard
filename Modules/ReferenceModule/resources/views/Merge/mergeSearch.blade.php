@extends('main.app')
@section('title')
Merge | Mapping Tool
@endsection
@section('css')
@endsection
@section('content')
            <div class="px-2 px-md-5"> <div class="align-items-start border-bottom">
                <x-referencemodule::first-head label="Merge" />
                <form action="{{ route('export.merge') }}" method="GET">
                    <div class="text-sm-end"><button type="submit" class="btn btn-primary px-7 float-end  my-3">Export Table</button></div>
                </form>
            </div>
                <!-- data table -->
    <table id="userAccessTable" class="useDataTable responsive table fs--1 mb-0 bg-white my-3 rounded-2 shadow" style="width:100%">
        <thead>
            <tr class="px-2 py-2 text-head">
                <th class="dtr-control"></th>
                <th ></th>
                <th class="align-middle text-nowrap">#</th>
                <th class="align-middle text-nowrap">Count of Merge</th>
                @foreach ($entrys as $entry )
                <th class="align-middle text-nowrap">{{$entry}}</th>
                @endforeach
                @foreach ($total as $tot )
                <th class="align-middle text-nowrap">{{$tot}}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            <br>
            <h5 class="mb-2 me-2 lh-sm"><span class="fa-solid fa-calculator me-2 fs-0"></span> the Total of the Rows Before Merge Is {{$totalRows}} </h5>
            @php $count = 1; @endphp
            @foreach ($merges as $index => $data)
                <tr>
                    <td></td>
                    <td></td>
                    <td>{{ $count++ }}</td>
                    <td>{{$data->count}}</td>
                    @foreach ($entrys as $entry )
                    <td>  &nbsp;&nbsp;&nbsp;  {{ $data->$entry }}</td>
                    @endforeach
                    @foreach ($total as $tot )
                    <td>  &nbsp;&nbsp;&nbsp;  {{ $data->$tot }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
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
