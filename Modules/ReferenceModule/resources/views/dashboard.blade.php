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
    <title> Dashboard | Phoenix </title>
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
                <form action="{{ route('export.data') }}" method="GET">
                <table id="userAccessTable" class="useDataTable responsive table fs--1 mb-0 bg-white my-3 rounded-2 shadow" style="width:100%">
                <thead class="">
                <tr class="px-2 py-2  text-head">
                    <th class="text-start  text-nowrap"><span class="prevent-sort"><i  class="fa-solid fa-circle-info fs-0 px-1  prevent-sort border-0 outline-none" data-bs-placement="top" tabindex="0"  data-bs-toggle="popover" data-bs-trigger="focus" title="" data-bs-content="Staff .No info"></i> </span><span  class="prevent-sort">ID</span></th>
                    <th class=" align-middle text-nowrap"><span class="prevent-sort "><i  class="fa-solid fa-circle-info fs-0 px-1  prevent-sort border-0 outline-none" data-bs-placement="top" tabindex="0"  data-bs-toggle="popover" data-bs-trigger="focus" title="" data-bs-content="Email Address info"></i></span> <span  class="prevent-sort">Select</span> </th>
                    <th class=" align-middle text-nowrap"><span class="prevent-sort "><i  class="fa-solid fa-circle-info fs-0 px-1  prevent-sort border-0 outline-none" data-bs-placement="top" tabindex="0"  data-bs-toggle="popover" data-bs-trigger="focus" title="" data-bs-content="Email Address info"></i></span> <span  class="prevent-sort">Enter Name</span> </th>
                    <th class=" align-middle text-nowrap"><span class="prevent-sort "><i  class="fa-solid fa-circle-info fs-0 px-1  prevent-sort border-0 outline-none" data-bs-placement="top" tabindex="0"  data-bs-toggle="popover" data-bs-trigger="focus" title="" data-bs-content="Email Address info"></i></span> <span  class="prevent-sort">Enter Code</span> </th>
                    <th class=" align-middle text-nowrap"><span class="prevent-sort "><i  class="fa-solid fa-circle-info fs-0 px-1  prevent-sort border-0 outline-none" data-bs-placement="top" tabindex="0"  data-bs-toggle="popover" data-bs-trigger="focus" title="" data-bs-content="Email Address info"></i></span> <span  class="prevent-sort">Reference Name</span> </th>
                    <th class=" align-middle text-nowrap"><span class="prevent-sort "><i  class="fa-solid fa-circle-info fs-0 px-1  prevent-sort border-0 outline-none" data-bs-placement="top" tabindex="0"  data-bs-toggle="popover" data-bs-trigger="focus" title="" data-bs-content="Email Address info"></i></span> <span  class="prevent-sort">Code</span> </th>
                    <th class=" align-middle text-nowrap"><span class="prevent-sort "><i  class="fa-solid fa-circle-info fs-0 px-1  prevent-sort border-0 outline-none" data-bs-placement="top" tabindex="0"  data-bs-toggle="popover" data-bs-trigger="focus" title="" data-bs-content="Created At info"></i></span><span  class="prevent-sort">Created At</span> </th>
                </tr>
            </thead>

                <tbody>
                    @foreach ( $exceldata as $exceldata )

                <tr>
                    <td>{{$exceldata->id}}</td>
                    <td></td>
                    <td>{{$exceldata->name}}</td>
                    <td>{{$exceldata->code}}</td>
                    <td class="text-start">{{$exceldata->reference_name}}</td>
                    <td>{{$exceldata->code2}}</td>
                    <td>{{$exceldata->created_at}}</td>
                </tr>
                    @endforeach


                </tbody>


            </table>
            <form action="{{ route('export.data') }}" method="GET">

            <div class="text-sm-end text-center"><button type="submit" class="btn btn-primary px-7">Export</button></div>

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
