@extends('main.app')
@section('title')
    Merge | Mapping Tool
@endsection
@section('css')
@endsection
@section('content')
    <section class="table-sec pt-3">
        <label class="form-label text-1000 fs-0 ps-0 text-capitalize lh-sm mb-2" for="mainAdminLogo">Select the headers from
            the file you uploaded.</label>
        <label class="form-label  fs-0 ps-0 text-capitalize lh-sm mb-2" for="mainAdminLogo">If you choose "Merge", it means
            these are the headers that will be used for merging. If you choose "Total", it means it will sum them up, so
            they need to be numeric columns.</label>
        <form method="POST" action="{{ route('merge.upload') }}" enctype="multipart/form-data">
            @csrf
            <div id="entrySelectContainer">
                <div class="row g-3 mb-5 select-row">
                    <x-referencemodule::merge_selector label="Merge" selectName="entry[]" :options="$headers" />
                </div>
            </div>
            <button type="button" id="addEntrySelectButton" class="btn btn-secondary">+ Add</button>
            <br><br>
            <div id="totalSelectContainer">
                <div class="row g-3 mb-5 select-row">
                    <x-referencemodule::merge_selector label="Total" selectName="total[]" :options="$headers" />
                </div>
            </div>
            <button type="button" id="addTotalSelectButton" class="btn btn-secondary">+ Add Total</button>
            <div class="text-sm-end text-center mt-3">
                <button type="submit" class="btn btn-primary px-7">Import</button>
            </div>
        </form>
    </section>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const addEntrySelectButton = document.getElementById('addEntrySelectButton');
            const addTotalSelectButton = document.getElementById('addTotalSelectButton');
            const entrySelectContainer = document.getElementById('entrySelectContainer');
            const totalSelectContainer = document.getElementById('totalSelectContainer');
            const headers = @json($headers);
            const maxHeaders = headers.length;

            function addSelect(container, label, name) {
                const selectCount = container.getElementsByClassName('select-row').length;
                const totalSelectCount = document.getElementsByClassName('select-row').length;
                if (totalSelectCount >= maxHeaders) {
                    alert("Cannot create more than " + maxHeaders + " selects in total.");
                    return;
                }
                const newSelectRow = document.createElement('div');
                newSelectRow.className = 'row g-3 mb-5 select-row';
                const availableOptions = headers.filter(header => !Array.from(document.querySelectorAll(
                    '.header-select')).map(select => select.value).includes(header));
                const defaultOption = availableOptions.length > 0 ? availableOptions[0] : '';
                newSelectRow.innerHTML = `
                <div class="col-12 col-lg-6 col-xl-4">
                    <label class="form-label text-1000 fs-0 ps-0 text-capitalize lh-sm mb-2" for="adminTitle">${label}</label>
                    <div class="form-floating">
                        <select name="${name}[]" class="form-select header-select" aria-label="Floating label select example">
                            ${availableOptions.map(header => `<option value="${header}">${header}</option>`).join('')}
                        </select>
                        <label for="floatingSelect">Headers</label>
                    </div>
                </div>
                <div class="col-12 col-lg-1 col-xl-1 d-flex align-items-center">
                    <button type="button" class="btn btn-danger btn-sm delete-row">X</button>
                </div>
            `;
                container.appendChild(newSelectRow);
                newSelectRow.querySelector('.delete-row').addEventListener('click', function() {
                    container.removeChild(newSelectRow);
                    updateOptions();
                });
                newSelectRow.querySelector('.header-select').addEventListener('change', updateOptions);
                updateOptions();
            }

            function updateOptions() {
                const selectedOptions = Array.from(document.querySelectorAll('.header-select')).map(select => select
                    .value);
                document.querySelectorAll('.header-select').forEach(select => {
                    const currentValue = select.value;
                    select.innerHTML = headers.map(header => {
                        if (selectedOptions.includes(header) && header !== currentValue) {
                            return `<option value="${header}" disabled>${header}</option>`;
                        }
                        return `<option value="${header}">${header}</option>`;
                    }).join('');
                    select.value = currentValue;
                });
            }
            addEntrySelectButton.addEventListener('click', function() {
                addSelect(entrySelectContainer, 'Merge', 'entry');
            });
            addTotalSelectButton.addEventListener('click', function() {
                addSelect(totalSelectContainer, 'Total', 'total');
            });
            document.querySelectorAll('.delete-row').forEach(function(button) {
                button.addEventListener('click', function() {
                    const row = this.closest('.select-row');
                    row.parentNode.removeChild(row);
                    updateOptions();
                });
            });
            document.querySelectorAll('.header-select').forEach(function(select) {
                select.addEventListener('change', updateOptions);
            });
        });
    </script>
@endsection
