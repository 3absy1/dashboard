<!DOCTYPE html>
<html lang="en-US" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Phoenix</title>
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicons/favicon-16x16.png">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicons/favicon.ico">
    <meta name="msapplication-TileImage" content="assets/img/favicons/mstile-150x150.png">
    <script src="assets/js/config.js"></script>
    <link href="assets/css/theme.min.css" type="text/css" rel="stylesheet" id="style-default">
    <link href="assets/css/datatable-bootstrap5.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/responsive-datatable-bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/buttons.bootstrap5.css">
    <link href="assets/css/user.min.css" type="text/css" rel="stylesheet" id="user-style-default">
</head>
<body>
<main class="main" id="top">
    <div class="container-fluid px-0" data-layout="container">
        @include('main.sidebar')
        @include('main.topbar')
        @include('main.head')
        <div class="content">
            <section class="table-sec pt-3">
                <label class="form-label text-1000 fs-0 ps-0 text-capitalize lh-sm mb-2" for="mainAdminLogo">Select the headers from the file you uploaded.</label>
                 <label class="form-label  fs-0 ps-0 text-capitalize lh-sm mb-2" for="mainAdminLogo">If you choose "Merge", it means these are the headers that will be used for merging. If you choose "Total", it means it will sum them up, so they need to be numeric columns.</label>

                <form method="POST" action="{{ route('merge.file') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="tableName" value="{{ $tableName }}">
                    <div id="entrySelectContainer">
                        <div class="row g-3 mb-5 select-row">
                            <div class="col-12 col-lg-6 col-xl-4">
                                <label class="form-label text-1000 fs-0 ps-0 text-capitalize lh-sm mb-2" for="adminTitle">Merge</label>
                                <div class="form-floating">
                                    <select name="entry[]" class="form-select header-select" aria-label="Floating label select example">
                                        @foreach ($headers as $header)
                                            <option value="{{$header}}">{{$header}}</option>
                                        @endforeach
                                    </select>
                                    <label for="floatingSelect">Headers</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" id="addEntrySelectButton" class="btn btn-secondary">+ Add Entry</button>
                    <br><br>
                    <div id="totalSelectContainer">
                        <div class="row g-3 mb-5 select-row">
                            <div class="col-12 col-lg-6 col-xl-4">
                                <label class="form-label text-1000 fs-0 ps-0 text-capitalize lh-sm mb-2" for="adminTitle">Total</label>
                                <div class="form-floating">
                                    <select name="total[]" class="form-select header-select" aria-label="Floating label select example">
                                        @foreach ($headers as $header)
                                            <option value="{{$header}}">{{$header}}</option>
                                        @endforeach
                                    </select>
                                    <label for="floatingSelect">Headers</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" id="addTotalSelectButton" class="btn btn-secondary">+ Add Total</button>
                    <div class="text-sm-end text-center mt-3">
                        <button type="submit" class="btn btn-primary px-7">Import</button>
                    </div>
                </form>
            </section>
            @include('main.footer')
        </div>
    </div>
</main>
@include('main.vendor-scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
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
            newSelectRow.innerHTML = `
                <div class="col-12 col-lg-6 col-xl-4">
                    <label class="form-label text-1000 fs-0 ps-0 text-capitalize lh-sm mb-2" for="adminTitle">${label}</label>
                    <div class="form-floating">
                        <select name="${name}[]" class="form-select header-select" aria-label="Floating label select example">
                            ${headers.map(header => `<option value="${header}">${header}</option>`).join('')}
                        </select>
                        <label for="floatingSelect">Headers</label>
                    </div>
                </div>
                <div class="col-12 col-lg-1 col-xl-1 d-flex align-items-center">
                    <button type="button" class="btn btn-danger btn-sm delete-row">X</button>
                </div>
            `;
            container.appendChild(newSelectRow);

            // Add event listener to the delete button
            newSelectRow.querySelector('.delete-row').addEventListener('click', function () {
                container.removeChild(newSelectRow);
            });
        }

        addEntrySelectButton.addEventListener('click', function () {
            addSelect(entrySelectContainer, 'Merge', 'entry');
        });

        addTotalSelectButton.addEventListener('click', function () {
            addSelect(totalSelectContainer, 'Total', 'total');
        });

        // Add event listener to the existing delete buttons
        document.querySelectorAll('.delete-row').forEach(function(button) {
            button.addEventListener('click', function() {
                const row = this.closest('.select-row');
                row.parentNode.removeChild(row);
            });
        });
    });
</script>
</body>
</html>
