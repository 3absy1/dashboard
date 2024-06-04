@extends('main.app')
@section('title')
Reference | Mapping Tool
@endsection
@section('css')
@endsection
@section('content')
                <section class="table-sec pt-3">
            <div class="row">
                <div class="col">
                    <h5 class="mb-2 me-2 lh-sm"><span class="fa-solid fa-user-lock me-2 fs-0"></span>Valid Reference</h5>
                    <form action="{{ route('approve.reference') }} " method="POST">
                        @csrf
                        <table id="userAccessTable" class="useDataTable responsive table fs--1 mb-0 bg-white my-3 rounded-2 shadow" style="width:100%">
                            <thead>
                                <tr class="px-2 py-2 text-head">
                                    <th ></th>
                                    <th ></th>
                                    <th> #</th>
                                    <th class="text-start text-nowrap">
                                        <span class="prevent-sort">
                                            <i class="fa-solid fa-circle-info fs-0 px-1 prevent-sort border-0 outline-none" data-bs-placement="top" tabindex="0" data-bs-toggle="popover" data-bs-trigger="focus" title="" data-bs-content="Staff .No info"></i>
                                        </span>
                                        <span class="prevent-sort">ID</span>
                                    </th>
                                    <th class="align-middle text-nowrap">
                                        <span class="prevent-sort">
                                            <i class="fa-solid fa-circle-info fs-0 px-1 prevent-sort border-0 outline-none" data-bs-placement="top" tabindex="0" data-bs-toggle="popover" data-bs-trigger="focus" title="" data-bs-content="Email Address info"></i>
                                        </span>
                                        <span class="prevent-sort">Reference Name</span>
                                    </th>
                                    <th class="align-middle text-nowrap">
                                        <span class="prevent-sort">
                                            <i class="fa-solid fa-circle-info fs-0 px-1 prevent-sort border-0 outline-none" data-bs-placement="top" tabindex="0" data-bs-toggle="popover" data-bs-trigger="focus" title="" data-bs-content="Email Address info"></i>
                                        </span>
                                        <span class="prevent-sort">Code</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $count = 1; @endphp
                                @foreach ($valid as $index => $data)
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>{{ $count++ }}</td>
                                        <td>&nbsp;&nbsp;{{$data->id}}
                                            <input type="hidden" class="form-control" name="id" value="{{$data->id}}">
                                        </td>
                                        <td class="text-start">{{$data->name}}
                                            <input type="hidden" class="form-control" name="data[{{ $index }}][name]" value="{{$data->name}}">
                                        </td>
                                        <td>{{$data->code}}
                                            <input type="hidden" class="form-control" name="data[{{ $index }}][code]" value="{{$data->code}}">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    <button class="btn btn-primary" type="submit" data-bs-dismiss="modal">Import</button>

                    </form>
                </div>

                {{-- Secnd table --}}
                <div class="col">
                    <h5 class="mb-2 me-2 lh-sm"><span class="fa-solid fa-user-lock me-2 fs-0"></span>UnValid Reference</h5>
                    <table id="wasteTable" class="useDataTable responsive table fs--1 mb-0 bg-white my-3 rounded-2 shadow" style="width:100%">
                        <thead>
                            <tr class="px-2 py-2 text-head">
                                <th ></th>
                                <th ></th>
                                <th> #</th>
                                <th class="text-start text-nowrap"><span class="prevent-sort"><i class="fa-solid fa-circle-info fs-0 px-1 prevent-sort border-0 outline-none" data-bs-placement="top" tabindex="0" data-bs-toggle="popover" data-bs-trigger="focus" title="" data-bs-content="Staff .No info"></i></span><span class="prevent-sort">ID</span></th>
                                <th class="align-middle text-nowrap"><span class="prevent-sort"><i class="fa-solid fa-circle-info fs-0 px-1 prevent-sort border-0 outline-none" data-bs-placement="top" tabindex="0" data-bs-toggle="popover" data-bs-trigger="focus" title="" data-bs-content="Email Address info"></i></span><span class="prevent-sort">Reference Name</span></th>
                                <th class="align-middle text-nowrap"><span class="prevent-sort"><i class="fa-solid fa-circle-info fs-0 px-1 prevent-sort border-0 outline-none" data-bs-placement="top" tabindex="0" data-bs-toggle="popover" data-bs-trigger="focus" title="" data-bs-content="Email Address info"></i></span><span class="prevent-sort">Code</span></th>
                                <th class="align-middle text-nowrap"><span class="prevent-sort"><i class="fa-solid fa-circle-info fs-0 px-1 prevent-sort border-0 outline-none" data-bs-placement="top" tabindex="0" data-bs-toggle="popover" data-bs-trigger="focus" title="" data-bs-content="Email Address info"></i></span><span class="prevent-sort">Reason</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $count = 1; @endphp
                            @foreach ( $waste as $data )
                            <tr>
                                <td></td>
                                <td></td>
                                <td>{{ $count++ }}</td>
                                <td>&nbsp;&nbsp;{{$data->id}}</td>
                                <td class="text-start">{{$data->name}}</td>
                                <td>{{$data->code}}</td>
                                <td>{{$data->reason}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <br>
                    <form action="{{ route('export.waste') }}" method="GET">
                    <button class="btn btn-primary" type="submit" data-bs-dismiss="modal">Export</button>
                    </form>
                </div>
                <div class="w-100"></div>
            </div>
                </section>
@endsection

