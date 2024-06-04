@extends('main.app')
@section('title')
Check | Mapping Tool
@endsection
@section('css')
@endsection
@section('content')
            <div class="px-2 px-md-5">
                <div class="align-items-start border-bottom">
                <x-referencemodule::first-head label="Check" />
            </div>
            </div>
                <!-- data table -->
    <form action="{{ route('related.create') }}" method="POST">
    @csrf
    <table id="userAccessTable" class="useDataTable responsive table fs--1 mb-0 bg-white my-3 rounded-2 shadow" style="width:100%">
        <thead>
            <tr class="px-2 py-2 text-head">
                <th class="dtr-control"></th>
                <th ></th>
                <th> #</th>
                <th class="align-middle text-nowrap">ID</th>
                <th class="align-middle text-nowrap">Enter Name</th>
                <th class="align-middle text-nowrap">Enter Code</th>
                <th class="align-middle text-nowrap">Reference Name</th>
                <th class="align-middle text-nowrap">Code</th>
                <th class="align-middle text-nowrap">Created At</th>
            </tr>
        </thead>
        <tbody>
            @php $count = 1; @endphp
                @php
                $showSubmitButton = false;
                $showExportButton = false;
                @endphp
            @foreach ($exceldata as $index => $data)
                <tr>
                    @if ($index ==null)
                    @php $showExportButton = true; @endphp
                    @endif
                    <td></td>
                    <td></td>
                    <td>&nbsp;&nbsp;{{ $count++ }}</td>
                    <td>  &nbsp;&nbsp;&nbsp;  {{ $data->id }}</td>
                    <td>{{ $data->name }}</td>
                    <td>{{ $data->code }}</td>
                    @if ($data->reference_name == null)
                        <td class="text-start">
                            <select name="data[{{ $index }}][reference_id]" class="form-select" aria-label="Select reference">
                                <option selected value="null">Not Found</option>
                                @foreach ($references as $reference)
                                    <option value="{{ $reference->id }}">{{ $reference->name }}</option>
                                @endforeach
                            </select>
                            @if (count($references) == 0)
                            <a class="link-dark" href="reference">Create New Reference </a>
                            @endif
                            @if ($errors->any())
                            <div class="alert alert" role="alert">
                                        <ul class="text-danger">
                                <li>You didn't select Reference Name</li>
                        </ul>
                    </div>
                @endif
                        </td>
                        @php $showSubmitButton = true; @endphp
                    @else
                        <td class="text-start">{{ $data->reference_name }}</td>
                    @endif
                    @if ($data->code2 == null)
                        <td>Not Found ({{ $data->code }})
                            <input type="hidden" class="form-control" name="data[{{ $index }}][code]" value="{{ $data->code }}">
                            <input type="hidden" class="form-control" name="data[{{ $index }}][name]" value="{{ $data->name }}">
                        </td>
                        @php $showSubmitButton = true; @endphp
                    @else
                        <td>{{ $data->code2 }}</td>
                    @endif
                    <td>{{ $data->created_at }}&nbsp; &nbsp;</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
                @if ($showSubmitButton)
                <button type="submit" class="btn btn-success px-7">Create</button>
                @endif

                </form>
                @if ($showExportButton)
                <form action="{{ route('export.data') }}" method="GET">

                    <div class="text-sm-end text-center"><button type="submit" class="btn btn-primary px-7">Export Table</button></div>

                </form>
                    @endif
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

