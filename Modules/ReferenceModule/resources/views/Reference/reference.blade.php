@extends('main.app')
@section('title')
Reference | Mapping Tool
@endsection
@section('css')
@endsection
@section('content')
            <section class="table-sec pt-3">
                <div class="container px-2 px-md-5">
                <div class="align-items-start border-bottom flex-column">
                    <x-referencemodule::first-head label="Reference Tabel" />

                <x-referencemodule::modal
                buttonText="Create"
                modalId="exampleModal"
                formAction="{{ route('reference.create') }}"
                formMethod="GET"
                modalTitle="Create Name"
                    >
                <label class="form-label text-1000 fs-0 ps-0 text-capitalize lh-sm mb-2" for="code"> Code </label>
                <input class="form-control" id="code" type="text" name="code" placeholder="1234" required />

                <label class="form-label text-1000 fs-0 ps-0 text-capitalize lh-sm mb-2" for="adminTitle"> Name </label>
                <input class="form-control" id="adminTitle" name="name" type="text" placeholder="Ahmed" required />
            </x-referencemodule::modal>
                </div>

                <x-referencemodule::import-form action="{{ route('upload-file-reference') }}" method="POST">
                    (name , code)
                </x-referencemodule::import-form>
                <!-- data table -->
                <table id="userAccessTable" class="useDataTable responsive table fs--1 mb-0 bg-white my-3 rounded-2 shadow" style="width:100%">
                    <thead class="">
                    <tr class="px-2 py-2  text-head">
                        <th class="dtr-control"></th>
                        <th ></th>
                        <th> #</th>
                        <th class="text-start  text-nowrap"><span class="prevent-sort"><i  class="fa-solid fa-circle-info fs-0 px-1  prevent-sort border-0 outline-none" data-bs-placement="top" tabindex="0"  data-bs-toggle="popover" data-bs-trigger="focus" title="" data-bs-content="Staff .No info"></i> </span><span  class="prevent-sort">ID</span></th>
                        <th class=" align-middle text-nowrap"><span class="prevent-sort "><i  class="fa-solid fa-circle-info fs-0 px-1  prevent-sort border-0 outline-none" data-bs-placement="top" tabindex="0"  data-bs-toggle="popover" data-bs-trigger="focus" title="" data-bs-content="Email Address info"></i></span> <span  class="prevent-sort">Reference Name</span> </th>
                        <th class=" align-middle text-nowrap"><span class="prevent-sort "><i  class="fa-solid fa-circle-info fs-0 px-1  prevent-sort border-0 outline-none" data-bs-placement="top" tabindex="0"  data-bs-toggle="popover" data-bs-trigger="focus" title="" data-bs-content="Email Address info"></i></span> <span  class="prevent-sort">Code</span> </th>
                        <th class=" align-middle text-nowrap"><span class="prevent-sort "><i  class="fa-solid fa-circle-info fs-0 px-1  prevent-sort border-0 outline-none" data-bs-placement="top" tabindex="0"  data-bs-toggle="popover" data-bs-trigger="focus" title="" data-bs-content="Created At info"></i></span><span  class="prevent-sort">Created At</span> </th>
                        <th class=" align-middle text-nowrap"><span class="prevent-sort "><i  class="fa-solid fa-circle-info fs-0 px-1  prevent-sort border-0 outline-none" data-bs-placement="top" tabindex="0"  data-bs-toggle="popover" data-bs-trigger="focus" title="" data-bs-content="Created At info"></i></span><span  class="prevent-sort">Edit</span> </th>
                        <th class=" align-middle text-nowrap"><span class="prevent-sort "><i  class="fa-solid fa-circle-info fs-0 px-1  prevent-sort border-0 outline-none" data-bs-placement="top" tabindex="0"  data-bs-toggle="popover" data-bs-trigger="focus" title="" data-bs-content="Created At info"></i></span><span  class="prevent-sort">Delete</span> </th>

                    </tr>
                </thead>
                @php $count = 1; @endphp
                <tbody>
                        @foreach ( $references as $reference )
                    <tr>
                        <td></td>
                        <td></td>
                        <td>&nbsp;&nbsp;{{ $count++ }}</td>
                        <td>{{$reference->id}}</td>
                        <td class="text-start">{{$reference->name}}</td>
                        <td>{{$reference->code}}</td>
                        <td>{{$reference->created_at}}</td>
                        <td class="align-middle text-start white-space-nowrap pe-0 action py-2">
                            <x-referencemodule::modal
                            buttonText="Edit"
                            modalId="editModal{{$reference->id}}"
                            formAction="{{ route('reference.update','test') }}"
                            formMethod="POST"
                            modalTitle="Edit Name"
                                >
                                @method('PUT')
                            <label class="form-label text-1000 fs-0 ps-0 text-capitalize lh-sm mb-2" for="code"> Code </label>
                            <input class="form-control" id="code" type="text" name="code" value="{{$reference->code}}" />
                            <input type="hidden" class="form-control" name="id" value="{{$reference->id}}">

                            <label class="form-label text-1000 fs-0 ps-0 text-capitalize lh-sm mb-2" for="adminTitle"> Name </label>
                            <input class="form-control" id="adminTitle" name="name" type="text" value="{{$reference->name}}" />
                        </x-referencemodule::modal>
                            </td>
                            <td>
                                <x-referencemodule::modal
                                buttonText="Delete"
                                modalId="deleteModal{{$reference->id}}"
                                formAction="{{ route('reference.delete', $reference->id) }}"
                                formMethod="POST"
                                modalTitle="Delete Name"
                                    >
                                    @method('DELETE')
                                    <label class="form-label text-1000 fs-0 ps-0 text-capitalize lh-sm mb-2" for="adminTitle"> Are You Sure ? </label>

                            </x-referencemodule::modal>
                            </td>
                    </tr>
                        @endforeach
                    </tbody>
                </table>
            </section>
@endsection


