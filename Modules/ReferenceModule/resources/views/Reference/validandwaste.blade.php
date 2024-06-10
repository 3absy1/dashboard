@extends('main.app')
@section('title')
    Reference | Mapping Tool
@endsection
@section('css')
{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
@endsection
@section('content')
    <section class="table-sec pt-3">

        <div class="row">
            <div class="col">
                <form action="{{ route('reference.approve') }} " method="POST">
                    @csrf
                <h5 class="mb-2 me-2 lh-sm"><span class="fa-solid fa-vial-circle-check me-2 fs-0"></span>Valid Reference
                    @if($valid->isNotEmpty())
                    <button class="btn btn-primary" type="submit" data-bs-dismiss="modal">Import</button>
                @endif
                    </form>
                </h5>

                <form action="{{ route('reference.approve') }} " method="POST">
                    @csrf
                    <table id="userAccessTable"
                        class=" responsive table fs--1 mb-0 bg-white my-3 rounded-2 shadow" style="width:100%">
                        <thead>
                            <tr class="px-2 py-2 text-head">
                                <th></th>
                                <th></th>
                                <th> #</th>
                                <th class="text-start text-nowrap">
                                    <span class="prevent-sort">
                                        <i class="fa-solid fa-circle-info fs-0 px-1 prevent-sort border-0 outline-none"
                                            data-bs-placement="top" tabindex="0" data-bs-toggle="popover"
                                            data-bs-trigger="focus" title="" data-bs-content="ID info"></i>
                                    </span>
                                    <span class="prevent-sort">ID</span>
                                </th>
                                <th class="align-middle text-center">
                                    <span class="prevent-sort">
                                        <i class="fa-solid fa-circle-info fs-0 px-1 prevent-sort border-0 outline-none"
                                            data-bs-placement="top" tabindex="0" data-bs-toggle="popover"
                                            data-bs-trigger="focus" title="" data-bs-content="Reference Name info"></i>
                                    </span>
                                    <span class="prevent-sort">Reference Name</span>
                                </th>
                                <th class="align-middle text-nowrap">
                                    <span class="prevent-sort">
                                        <i class="fa-solid fa-circle-info fs-0 px-1 prevent-sort border-0 outline-none"
                                            data-bs-placement="top" tabindex="0" data-bs-toggle="popover"
                                            data-bs-trigger="focus" title="" data-bs-content="Code info"></i>
                                    </span>
                                    <span class="prevent-sort">Code &nbsp;&nbsp;</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $count = 1; @endphp
                            @forelse ($valid as $index => $data)
                            <tr>
                                    <td></td>
                                    <td></td>
                                    <td>{{ $count++ }}</td>
                                    <td>&nbsp;&nbsp;{{ $data->id }}
                                        <input type="hidden" class="form-control" name="id"
                                            value="{{ $data->id }}">
                                    </td>
                                    <td class=" text-center">{{ $data->name }}
                                        <input type="hidden" class="form-control" name="data[{{ $index }}][name]"
                                            value="{{ $data->name }}">
                                    </td>
                                    <td>{{ $data->code }}
                                        <input type="hidden" class="form-control" name="data[{{ $index }}][code]"
                                            value="{{ $data->code }}">&nbsp;&nbsp;
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">No data available</td>
                                </tr>
                                @endforelse

                        </tbody>

                    </table>
                    {{ $valid->links() }}
                            <br>
                            @if($valid->isNotEmpty() && $valid->count() > 25)
                            <button class="btn btn-primary" type="submit" data-bs-dismiss="modal">Import</button>
                        @endif
                </form>
            </div>

            {{-- Secnd table --}}
            <div class="col">
                <form action="{{ route('reference.export') }}" method="GET">
                <h5 class="mb-2 me-2 lh-sm"><span class="fa-solid fa-vial-virus me-2 fs-0"></span>UnValid Reference
                    @if($waste->isNotEmpty())
                    <button class="btn btn-primary" type="submit" data-bs-dismiss="modal">Export</button>
                    @endif
                    </form>
                </h5>
                <table id="wasteTable" class=" responsive table fs--1 mb-0 bg-white my-3 rounded-2 shadow"
                    style="width:100%">
                    <thead>
                        <tr class="px-2 py-2 text-head">
                            <th></th>
                            <th></th>
                            <th> #</th>
                            <th class="text-start text-nowrap"><span class="prevent-sort"><i
                                        class="fa-solid fa-circle-info fs-0 px-1 prevent-sort border-0 outline-none"
                                        data-bs-placement="top" tabindex="0" data-bs-toggle="popover"
                                        data-bs-trigger="focus" title=""
                                        data-bs-content="ID info"></i></span><span class="prevent-sort">ID</span>
                            </th>
                            <th class="align-middle text-nowrap"><span class="prevent-sort"><i
                                        class="fa-solid fa-circle-info fs-0 px-1 prevent-sort border-0 outline-none"
                                        data-bs-placement="top" tabindex="0" data-bs-toggle="popover"
                                        data-bs-trigger="focus" title=""
                                        data-bs-content="Reference Name info"></i></span><span class="prevent-sort">Reference
                                    Name</span></th>
                            <th class="align-middle text-nowrap"><span class="prevent-sort"><i
                                        class="fa-solid fa-circle-info fs-0 px-1 prevent-sort border-0 outline-none"
                                        data-bs-placement="top" tabindex="0" data-bs-toggle="popover"
                                        data-bs-trigger="focus" title=""
                                        data-bs-content="Code info"></i></span><span
                                    class="prevent-sort">Code</span></th>
                            <th class="align-middle text-nowrap"><span class="prevent-sort"><i
                                        class="fa-solid fa-circle-info fs-0 px-1 prevent-sort border-0 outline-none"
                                        data-bs-placement="top" tabindex="0" data-bs-toggle="popover"
                                        data-bs-trigger="focus" title=""
                                        data-bs-content="Reason info"></i></span><span
                                    class="prevent-sort">Reason</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $count = 1; @endphp
                        @forelse ($waste as $data)
                            <tr>
                                <td></td>
                                <td></td>
                                <td>{{ $count++ }}</td>
                                <td>&nbsp;&nbsp;{{ $data->id }}</td>
                                <td class="text-start">{{ $data->name }}</td>
                                <td>{{ $data->code }}</td>
                                <td>{{ $data->reason }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">No data available</td>
                            </tr>
                            @endforelse
                    </tbody>
                </table>
                {{ $waste->links() }}
                <br>
                <form action="{{ route('reference.export') }}" method="GET">

                @if($waste->isNotEmpty() && $waste->count() > 25)
                <button class="btn btn-primary" type="submit" data-bs-dismiss="modal">Export</button>
                @endif
                </form>
            </div>
            <div class="w-100"></div>
        </div>
    </section>
@endsection
