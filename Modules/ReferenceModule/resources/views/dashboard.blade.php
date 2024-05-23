<!DOCTYPE html>
<html lang="en-US" dir="ltr">


<!-- Mirrored from prium.github.io/phoenix/v1.6.0/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 12 Dec 2022 09:35:07 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title> Dashboard | Mapping Tool </title>
    @include('main.head-css')

</head>
    <body>
        <!-- ===============================================-->
        <!--    Main Content-->
        <!-- ===============================================-->
        <main class="main" id="top">
        <div class="container-fluid px-0" data-layout="container">
            @include('main.sidebar')

        @include('main.topbar')
        @include('main.head')


            <div class="content">
            <!-- add your content here -->
            <div class="px-2 px-md-5"> <div class="align-items-start border-bottom">
                <div class="pt-1 w-100 mb-3 d-flex justify-content-between align-items-start">
                <div>
                    <h5 class="mb-2 me-2 lh-sm"><span class="fa-solid fa-display me-2 fs-0"></span>Dashboard</h5>
                </div>
                </div>
            </div>


            <form action="{{ route('upload.file') }}" method="POST" enctype="multipart/form-data">
                @csrf
                {{-- <input type="file" name="file"> --}}
                <div class="col-12 col-lg-12 col-xl-4">
                    <label class="form-label text-1000 fs-0 ps-0 text-capitalize lh-sm mb-2" for="mainAdminLogo">Import Excel</label>
                    <input class="form-control" name="file" id="mainAdminLogo" type="file" />
                    <div class="text-sm-end text-center"><button type="submit" class="btn btn-primary px-7">Import</button></div>

                </div>
                {{-- <div class="form-floating">
                    <select name="select" class="form-select" id="floatingSelect" aria-label="Floating label select example">
                    <option  value="1">name</option>
                    <option  value="2">code</option>


                    </select>
                    <label for="floatingSelect">Selector</label>
                </div> --}}
            </form>

                <!-- data table -->
    <form action="{{ route('related.create') }}" method="POST">
    @csrf
    <table id="userAccessTable" class="responsive table fs--1 mb-0 bg-white my-3 rounded-2 shadow" style="width:100%">
        <thead>
            <tr class="px-2 py-2 text-head">
                <th class="text-start text-nowrap">ID</th>
                <th class="align-middle text-nowrap">Select</th>
                <th class="align-middle text-nowrap">Enter Name</th>
                <th class="align-middle text-nowrap">Enter Code</th>
                <th class="align-middle text-nowrap">Reference Name</th>
                <th class="align-middle text-nowrap">Code</th>
                <th class="align-middle text-nowrap">Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($exceldata as $index => $data)
                <tr>
                    <td>{{ $data->id }}</td>
                    <td></td>
                    <td>{{ $data->name }}</td>
                    <td>{{ $data->code }}</td>
                    @if ($data->reference_name == null)
                        <td class="text-start">
                            <select name="data[{{ $index }}][reference_id]" class="form-select" aria-label="Select reference">
                                <option selected>Not Found</option>
                                @foreach ($references as $reference)
                                    <option value="{{ $reference->id }}">{{ $reference->name }}</option>
                                @endforeach
                            </select>
                        </td>
                    @else
                        <td class="text-start">{{ $data->reference_name }}</td>
                    @endif
                    @if ($data->code2 == null)
                        <td>Not Found ({{ $data->code }})
                            <input type="hidden" class="form-control" name="data[{{ $index }}][code]" value="{{ $data->code }}">
                            <input type="hidden" class="form-control" name="data[{{ $index }}][name]" value="{{ $data->name }}">
                        </td>
                    @else
                        <td>{{ $data->code2 }}</td>
                    @endif
                    <td>{{ $data->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <button type="submit" class="btn btn-success px-7">Create</button>
</form>


            <form action="{{ route('export.data') }}" method="GET">

            <div class="text-sm-end text-center"><button type="submit" class="btn btn-primary px-7">Export Table</button></div>

        </form>





            @include('main.footer')

            </div>
            </div>

        </main><!-- ===============================================-->
        <!--    End of Main Content-->
        <!-- ===============================================-->

        @include('main.vendor-scripts')

    </body>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>

    <!-- Mirrored from prium.github.io/phoenix/v1.6.0/apps/e-commerce/admin/customers.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 12 Dec 2022 09:36:51 GMT -->
    </html>
