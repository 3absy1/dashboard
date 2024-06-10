@extends('main.app')
@section('title')
    Check | Mapping Tool
@endsection
@section('css')
@endsection
@section('content')
    <div class="container">
        <label class="form-label text-1000 fs-0 ps-0 text-capitalize lh-sm mb-2 my-3" for="mainAdminLogo">Select the headers from
            the file you uploaded.</label>
        <form method="POST" action="{{ route('check.import') }}" enctype="multipart/form-data">
            @csrf
            <br>
            <div class="tab-pane fade active show my-3" id="tab-tab1" role="tabpanel" aria-labelledby="Main-tab">
                <div class="row g-3 mb-5">
                    <div class="col-3">
                        <x-referencemodule::selector label="Name" selectName="name" :options="$headers" />
                    </div>
                    <div class="col-3">
                        <x-referencemodule::selector label="Code" selectName="code" :options="$headers" />
                    </div>
                    <div class="col-3">
                        <label class="form-label text-1000 fs-0 ps-0 text-capitalize lh-sm mb-2"
                            for="mainAdminLogo">Check
                            Depends Of name and code</label>
                        <div class="form-floating">
                            <select name="select" class="form-select" id="selector"
                                aria-label="Floating label select example">
                                <option value="1">name</option>
                                <option value="2">code</option>
                            </select>
                            <label for="floatingSelect">Selector</label>

                        </div>
                    </div>

                    <div class="text-center col-1">
                        <button type="submit" class="btn btn-primary w-100 mt-5">Import</button>
                    </div>
                </div>

            </div>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const nameSelect = document.getElementById('nameSelect');
            const codeSelect = document.getElementById('codeSelect');
            const headers = @json($headers);

            function updateCodeOptions(selectedName) {
                codeSelect.innerHTML = '';

                headers.forEach(header => {
                    if (header !== selectedName) {
                        const option = document.createElement('option');
                        option.value = header;
                        option.textContent = header;
                        codeSelect.appendChild(option);
                    }
                });
            }
            updateCodeOptions(nameSelect.value);
            nameSelect.addEventListener('change', function() {
                updateCodeOptions(nameSelect.value);
            });
        });
    </script>
@endsection
