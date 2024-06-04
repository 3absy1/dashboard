@extends('main.app')
@section('title')
Related | Mapping Tool
@endsection
@section('css')
@endsection
@section('content')
                    <section class="table-sec pt-3">
                        <div class="container px-2 px-md-5">
                            <div class="align-items-start border-bottom flex-column">
                                <x-referencemodule::first-head label="Related table" />
                        <x-referencemodule::modal
                        buttonText="Create"
                        modalId="exampleModal"
                        formAction="{{ route('related.new') }}"
                        formMethod="POST"
                        modalTitle="Create Name"
                            >
                        <label class="form-label text-1000 fs-0 ps-0 text-capitalize lh-sm mb-2" for="code"> Code </label>
                        <input class="form-control" id="code" type="text" name="code" placeholder="1234" required />
                                            <br>
                        <label class="form-label text-1000 fs-0 ps-0 text-capitalize lh-sm mb-2" for="adminTitle"> Name </label>
                        <input class="form-control" id="adminTitle" name="name" type="text" placeholder="Ahmed" required />
                                <br>
                        <x-referencemodule::form_related-selector selectName="reference_id"
                        label="Reference Names"
                        :options="$references"
                        selectedOptionLabel="select a reference"
                        selectedOptionValue=""
                        />
                    </x-referencemodule::modal>
                    <br>
                        </div>
                        <x-referencemodule::import-form action="{{ route('uploadupload-file-related') }}" method="POST">
                            (name , code)
                        </x-referencemodule::import-form>
                        <table id="userAccessTable" class="useDataTable responsive table fs--1 mb-0 bg-white my-3 rounded-2 shadow" style="width:100%">
                            <thead class="">
                            <tr class="px-2 py-2  text-head">
                                <th class="dtr-control"></th>
                                <th ></th>
                                <th> #</th>
                                <th class="text-start  text-nowrap"><span class="prevent-sort"><i  class="fa-solid fa-circle-info fs-0 px-1  prevent-sort border-0 outline-none" data-bs-placement="top" tabindex="0"  data-bs-toggle="popover" data-bs-trigger="focus" title="" data-bs-content="Staff .No info"></i> </span><span  class="prevent-sort">ID</span></th>
                                <th class=" align-middle text-nowrap"><span class="prevent-sort "><i  class="fa-solid fa-circle-info fs-0 px-1  prevent-sort border-0 outline-none" data-bs-placement="top" tabindex="0"  data-bs-toggle="popover" data-bs-trigger="focus" title="" data-bs-content="Email Address info"></i></span> <span  class="prevent-sort">Reference Name</span> </th>
                                <th class=" align-middle text-nowrap"><span class="prevent-sort "><i  class="fa-solid fa-circle-info fs-0 px-1  prevent-sort border-0 outline-none" data-bs-placement="top" tabindex="0"  data-bs-toggle="popover" data-bs-trigger="focus" title="" data-bs-content="Email Address info"></i></span> <span  class="prevent-sort">Related Name</span> </th>
                                <th class=" align-middle text-nowrap"><span class="prevent-sort "><i  class="fa-solid fa-circle-info fs-0 px-1  prevent-sort border-0 outline-none" data-bs-placement="top" tabindex="0"  data-bs-toggle="popover" data-bs-trigger="focus" title="" data-bs-content="Email Address info"></i></span> <span  class="prevent-sort">Code</span> </th>
                                <th class=" align-middle text-nowrap"><span class="prevent-sort "><i  class="fa-solid fa-circle-info fs-0 px-1  prevent-sort border-0 outline-none" data-bs-placement="top" tabindex="0"  data-bs-toggle="popover" data-bs-trigger="focus" title="" data-bs-content="Created At info"></i></span><span  class="prevent-sort">Created At</span> </th>
                                <th class=" align-middle text-nowrap"><span class="prevent-sort "><i  class="fa-solid fa-circle-info fs-0 px-1  prevent-sort border-0 outline-none" data-bs-placement="top" tabindex="0"  data-bs-toggle="popover" data-bs-trigger="focus" title="" data-bs-content="Created At info"></i></span><span  class="prevent-sort">Edit</span> </th>
                                <th class=" align-middle text-nowrap"><span class="prevent-sort "><i  class="fa-solid fa-circle-info fs-0 px-1  prevent-sort border-0 outline-none" data-bs-placement="top" tabindex="0"  data-bs-toggle="popover" data-bs-trigger="focus" title="" data-bs-content="Created At info"></i></span><span  class="prevent-sort">Delete</span> </th>
                            </tr>
                        </thead>
                            <tbody>
                                @php $count = 1; @endphp
                                @foreach ( $relateds as $related )
                            <tr>
                                <td></td>
                                <td></td>
                                <td>&nbsp;&nbsp;{{ $count++ }}</td>
                                <td>&nbsp;&nbsp;{{$related->id}}</td>
                                <form action="{{ route('reference.insert','test') }} " method="POST">
                                    @csrf
                                    @method('PUT')
                                @if (is_null($related->reference_id))
                                <td class="text-start">
                                    <select name="reference_id" class="form-select" aria-label="Select reference">
                                        <option selected>Not Found</option>
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
                                @else
                                <td class="text-start">{{$related->reference->name}}</td>
                                @endif
                                <td class="text-start">{{$related->name}}</td>
                                <td>{{$related->code}}</td>
                                <td>{{$related->created_at}}</td>
                                <td class="align-middle text-start white-space-nowrap pe-0 action py-2">
                                    @if (is_null($related->reference_id))
                                        <input type="hidden" class="form-control" name="id" value="{{$related->id}}">
                                    <button class="success btn btn-md border bg-light dropdown-toggle dropdown-caret-none transition-none btn-reveal" type="submit" data-bs-toggle="modal" data-bs-target="#insertModal{{$related->id}}">Insert</button>
                                    </form>
                                    @endif
                                    <x-referencemodule::modal
                                    buttonText="Edit"
                                    modalId="editModal{{$related->id}}"
                                    formAction="{{ route('related.update','test') }}"
                                    formMethod="POST"
                                    modalTitle="Edit Name"
                                        >
                                        @method('PUT')
                                        <div class="modal-body">
                                        <label class="form-label text-1000 fs-0 ps-0 text-capitalize lh-sm mb-2" for="adminTitle"> Code </label>
                                        <input class="form-control" id="code" type="text" name="code" value="{{$related->code}}" />
                                        <input type="hidden" class="form-control" name="id" value="{{$related->id}}">

                                        <label class="form-label text-1000 fs-0 ps-0 text-capitalize lh-sm mb-2" for="adminTitle"> Name </label>
                                        <input class="form-control" id="adminTitle" name="name" type="text" value="{{$related->name}}" />
                                        <br>
                                        <div class="form-floating">
                                            <select name="reference_id" class="form-select" id="floatingSelect" aria-label="Floating label select example">
                                                @if (is_null($related->reference_id))
                                                <option selected >none</option>
                                                @else
                                                <option selected value="{{$related->reference->id}}">{{$related->reference->name}}</option>
                                                @endif

                                            @foreach ($references as $reference)
                                            <option  value="{{$reference->id}}">{{$reference->name}}</option>

                                            @endforeach

                                            </select>
                                            <label for="floatingSelect">Reference Names</label>
                                        </div>
                                        </div>
                                        </x-referencemodule::modal>
                                </td>
                                <td>
                                    <x-referencemodule::modal
                                    buttonText="Delete"
                                    modalId="deleteModal{{$related->id}}"
                                    formAction="{{ route('related.delete', $related->id) }}"
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
        <script>
            $(document).ready(function() {
                $('#userAccessTable').DataTable({
                    "paging": true,
                    "pageLength": 10,
                    "lengthChange": true,
                    "info": true,
                    "autoWidth": false,
                    "searching": true,
                    "ordering": true
                });
            });
        </script>
@endsection
