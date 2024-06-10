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

            <h5 class="mb-2 me-2 lh-sm"><span class="fa-solid fa-calculator me-2 fs-0"></span> the Total of the Rows
                Before Merge Is {{ $totalRows }} </h5>
            <div class="card">
                <div class="container">
                    <div class="card-body">
                        {{ $dataTable->table(['class' => 'table  table-striped table-bordered table-sm fs--1 mb-0']) }}

                    </div>
                </div>
            </div>
            <!-- modal for export-->
            <div class="modal fade " id="exportModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title " id="exampleModalLabel">Export All Data</h2>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="exportModalForm" method="GET" action="{{ route('merge.export') }}">
                            @csrf
                            {{--  <div class="modal-body export-modal row justify-content-around">
                        <!-- Hidden input fields for additional data -->
                        <input type="hidden" id="exportFormatInput" name="exportFormat">
                        <input type="hidden" id="selectedColumnsInput" name="selectedColumns">
                        <input type="hidden" id="SelectedRows" name="SelectedRows">

                    </div> --}}
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-sm"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary btn-sm" data-bs-dismiss="modal"
                                    id="sendRequestBtn">Export</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--end modal -->
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

            $(document).on('click', '.exportSelected', function() {
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
