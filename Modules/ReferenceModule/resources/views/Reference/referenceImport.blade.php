@extends('main.app')
@section('title')
    Reference | Mapping Tool
@endsection
@section('css')
@endsection
@section('content')
    <section class="table-sec pt-3">
        <label class="form-label text-1000 fs-0 ps-0 text-capitalize lh-sm mb-2" for="mainAdminLogo">Select the headers from
            the file you uploaded.</label>
        <form method="POST" action="{{ route('upload.reference') }}" enctype="multipart/form-data">
            @csrf
            <div class="tab-pane fade active show" id="tab-tab1" role="tabpanel" aria-labelledby="Main-tab">
                <div class="row g-3 mb-5">
                    <x-referencemodule::selector label="Name" selectName="name" :options="$headers" />
                    <x-referencemodule::selector label="Code" selectName="code" :options="$headers" />
                </div>
                <div class="text-sm-end text-center"><button type="submit" class="btn btn-primary px-7">Save</button></div>

            </div>
        </form>
    </section>
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
