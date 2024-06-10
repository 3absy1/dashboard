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
                <x-referencemodule::first-head label="Reference Tabel" icon="database" />

                <button class="btn-primary btn  border" type="button" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">Create</button>
                <x-referencemodule::modal buttonText="Create" modalId="exampleModal"
                    formAction="{{ route('reference.create') }}" formMethod="GET" modalTitle="Create Name">
                    <label class="form-label text-1000 fs-0 ps-0 text-capitalize lh-sm mb-2" for="code"> Code </label>
                    <input class="form-control" id="code" type="text" name="code" placeholder="1234" required />

                    <label class="form-label text-1000 fs-0 ps-0 text-capitalize lh-sm mb-2" for="adminTitle"> Name </label>
                    <input class="form-control" id="adminTitle" name="name" type="text" placeholder="Ahmed"
                        required />
                </x-referencemodule::modal>
                <br>
            </div>

            <x-referencemodule::import-form action="{{ route('reference.import-File') }}" method="POST">
                (name , code)
            </x-referencemodule::import-form>

            <div class="card">
                <div class="container">
                    <div class="card-body">

                        @foreach ($references as $reference)
                            <x-referencemodule::modal modalId="editModal{{ $reference->id }}"
                                formAction="{{ route('reference.update', ['reference' => $reference->id]) }}"
                                formMethod="POST" modalTitle="Edit Name">
                                @method('PUT')
                                <label class="form-label text-1000 fs-0 ps-0 text-capitalize lh-sm mb-2" for="code">Code </label>
                                <input class="form-control" id="code{{ $reference->id }}" type="text" name="code" value="{{ $reference->code }}" />
                                <input type="hidden" class="form-control" name="id" value="{{ $reference->id }}">

                                <label class="form-label text-1000 fs-0 ps-0 text-capitalize lh-sm mb-2" for="adminTitle">
                                    Name </label>
                                    <input class="form-control" id="adminTitle{{ $reference->id }}" name="name" type="text" value="{{ $reference->name }}" />
                                </x-referencemodule::modal>
                            <x-referencemodule::modal modalId="deleteModal{{ $reference->id }}"
                                formAction="{{ route('reference.delete', $reference->id) }}" formMethod="POST"
                                modalTitle="Delete {{$reference->name}}">
                                @method('DELETE')
                                <label class="form-label text-1000 fs-0 ps-0 text-capitalize lh-sm mb-2" for="adminTitle">
                                    Are You Sure ? </label>

                            </x-referencemodule::modal>
                        @endforeach
                        {{ $dataTable->table(['class' => 'table  table-striped table-bordered table-sm fs--1 mb-0']) }}
                    </div>
                </div>
            </div>
    </section>

    <script>
        $(document).on('click', '.editReference', function() {
            var id = $(this).data('id');
            $.ajax({
                url: '/reference/' + id + '/edit',
                method: 'GET',
                success: function(response) {
                    // Populate the modal fields with the response data
                    $('#code' + id).val(response.code);
                    $('#adminTitle' + id).val(response.name);
                    $('#editModal' + id).modal('show');
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                }
            });
        });
    </script>

@endsection

@section('js')


<script>
    var columnTitleArr = window.columnTitleArr = [];

    window.createExportModalElements = function() {
        const exportModal = document.querySelector('.export-modal');

        columnTitleArr.forEach(element => {
            const div = document.createElement('div');
            div.classList.add('form-check');
            div.classList.add('col-5');

            const input = document.createElement('input');
            input.classList.add('form-check-input');
            input.type = 'checkbox';
            input.id = element;
            input.value = element;

            const label = document.createElement('label');
            label.classList.add('form-check-label');
            label.setAttribute('for', element);
            label.textContent = element;

            div.appendChild(input);
            div.appendChild(label);

            exportModal.appendChild(div);
        });
    }
    $('#related_table').on('page.dt', function() {
        $('.selected-item').text(window.LaravelDataTables['related_table'].rows({
            selected: true
        }).count());
        $('.selected-badge').text(window.LaravelDataTables['related_table'].rows({
            selected: true
        }).count());
    });

    var arrOfFilterBtn = [];
    var searchValues = [];


    // Select all th elements inside the thead of the table and skip the first two
    $('.useDataTable thead tr th').slice(1, -1).each(function(index) {
        var id = 'checkbox_' + index;
        // Get the inner text of the th element and push it to thTextArray
        arrOfFilterBtn.push({
            text: () => {
                return `<div class="d-flex align-items-center"> <input class="me-2" id="${id}" type="checkbox">
        <label for=""${id}"">  ${$(this).text()}  <label>

        </div>`
            },
            action: function(e, dt, node, config, cb) {
                var buttonElement = $(this.node());
                $('#' + id).prop('checked', function(_, oldProp) {
                    if (oldProp) {
                        window.LaravelDataTables['related_table'].columns(index +
                            2).search(
                            "").draw();
                        searchValues = searchValues.filter(item => item.Column_No !==
                            index + 2);
                    }
                    return !oldProp;
                });
            }
        });
    });
    function getCheckedCheckboxes() {
            const exportModal = document.querySelector('.export-modal');
            const checkboxes = exportModal.querySelectorAll('.form-check-input');
            const checkedCheckboxes = [];
            checkboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    checkedCheckboxes.push(checkbox.value);
                }
            });
            return checkedCheckboxes;
        }

        let exportFormat;
        $(document).on("click", "#excelModalBtn", function() {
            exportFormat = $(this).data("exportformat");
        });

        $(document).on("click", "#pdfModalBtn", function() {
            exportFormat = $(this).data("exportformat");
        });

        $(document).on("click", "#csvModalBtn", function() {
            exportFormat = $(this).data("exportformat");
        });

        $(document).on('click','.exportSelected',function() {
            let SelectedRows = JSON.parse(localStorage.getItem('related_checkBoxIdsArray'));
            $("#SelectedRows").val(SelectedRows);
        });
        $(document).on("click", "#sendRequestBtn", function() {
            let selectedColumns = getCheckedCheckboxes();
            $("#exportFormatInput").val(exportFormat);
            $("#selectedColumnsInput").val(selectedColumns);
            $("#exportModalForm").submit();
        });


</script>
{!! str_replace(
    '"DataTable.render.select()"',
    'DataTable.render.select()',
    $dataTable->scripts(attributes: ['type' => 'module']),
) !!}

    {{-- Generating Link Request --}}
@endsection
