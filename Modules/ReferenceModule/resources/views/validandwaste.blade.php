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
        <title>Phoenix</title>

        <!-- ===============================================-->
    <!--    Favicons-->
        <!-- ===============================================-->
        <link rel="apple-touch-icon" sizes="180x180" href="assets/img/favicons/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicons/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicons/favicon-16x16.png">
        <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicons/favicon.ico">
        <meta name="msapplication-TileImage" content="assets/img/favicons/mstile-150x150.png">
        <script src="assets/js/config.js"></script>

        <!-- ===============================================-->
        <!--    Stylesheets-->
        <!-- ===============================================-->

        <link href="assets/css/theme.min.css" type="text/css" rel="stylesheet" id="style-default">

        <link href="assets/css/datatable-bootstrap5.css" rel="stylesheet">
        <link rel="stylesheet" href="assets/css/responsive-datatable-bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/buttons.bootstrap5.css">
        <link href="assets/css/user.min.css" type="text/css" rel="stylesheet" id="user-style-default">
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
                <section class="table-sec pt-3">
            {{-- First Table --}}
            <div class="row">
                <div class="col">
                    <h5 class="mb-2 me-2 lh-sm"><span class="fa-solid fa-user-lock me-2 fs-0"></span>Valid Reference</h5>
                    <form action="{{ route('approve.reference') }} " method="POST">
                        @csrf
                    <table id="userAccessTable" class=" responsive table fs--1 mb-0 bg-white my-3 rounded-2 shadow" style="width:100%">
                        <thead class="">
                        <tr class="px-2 py-2  text-head">
                            <th class="text-start  text-nowrap"><span class="prevent-sort"><i  class="fa-solid fa-circle-info fs-0 px-1  prevent-sort border-0 outline-none" data-bs-placement="top" tabindex="0"  data-bs-toggle="popover" data-bs-trigger="focus" title="" data-bs-content="Staff .No info"></i> </span><span  class="prevent-sort">ID</span></th>
                            <th class=" align-middle text-nowrap"><span class="prevent-sort "><i  class="fa-solid fa-circle-info fs-0 px-1  prevent-sort border-0 outline-none" data-bs-placement="top" tabindex="0"  data-bs-toggle="popover" data-bs-trigger="focus" title="" data-bs-content="Email Address info"></i></span> <span  class="prevent-sort">Reference Name</span> </th>
                            <th class=" align-middle text-nowrap"><span class="prevent-sort "><i  class="fa-solid fa-circle-info fs-0 px-1  prevent-sort border-0 outline-none" data-bs-placement="top" tabindex="0"  data-bs-toggle="popover" data-bs-trigger="focus" title="" data-bs-content="Email Address info"></i></span> <span  class="prevent-sort">Code</span> </th>

                        </tr>
                    </thead>

                        <tbody>
                            @foreach ( $valid as $index  => $data )

                        <tr>
                            <td>&nbsp;&nbsp;{{$data->id}}
                                <input type="hidden" class="form-control" name="id" value="{{$data->id}}">

                            </td>
                            <td class="text-start">{{$data->name}}
                                <input type="hidden" class="form-control" name="data[{{ $index }}][name]" value="{{$data->name}}">

                            </td>
                            <td>{{$data->code}}
                                <input type="hidden" class="form-control" name="data[{{ $index }}][code]" value="{{$data->code}}">
                            </td>


                        </tr>

                        </tbody>
                        @endforeach

                    </table>
                    <button class="btn btn-primary" type="submit" data-bs-dismiss="modal">Import</button>

                    </form>


                </div>
                {{-- Secnd table --}}
                <div class="col">
                    <h5 class="mb-2 me-2 lh-sm"><span class="fa-solid fa-user-lock me-2 fs-0"></span>UnValid Reference</h5>

                    <table id="userAccessTable" class=" responsive table fs--1 mb-0 bg-white my-3 rounded-2 shadow" style="width:100%">
                        <thead class="">
                        <tr class="px-2 py-2  text-head">
                            <th class="text-start  text-nowrap"><span class="prevent-sort"><i  class="fa-solid fa-circle-info fs-0 px-1  prevent-sort border-0 outline-none" data-bs-placement="top" tabindex="0"  data-bs-toggle="popover" data-bs-trigger="focus" title="" data-bs-content="Staff .No info"></i> </span><span  class="prevent-sort">ID</span></th>
                            <th class=" align-middle text-nowrap"><span class="prevent-sort "><i  class="fa-solid fa-circle-info fs-0 px-1  prevent-sort border-0 outline-none" data-bs-placement="top" tabindex="0"  data-bs-toggle="popover" data-bs-trigger="focus" title="" data-bs-content="Email Address info"></i></span> <span  class="prevent-sort">Reference Name</span> </th>
                            <th class=" align-middle text-nowrap"><span class="prevent-sort "><i  class="fa-solid fa-circle-info fs-0 px-1  prevent-sort border-0 outline-none" data-bs-placement="top" tabindex="0"  data-bs-toggle="popover" data-bs-trigger="focus" title="" data-bs-content="Email Address info"></i></span> <span  class="prevent-sort">Code</span> </th>
                            <th class=" align-middle text-nowrap"><span class="prevent-sort "><i  class="fa-solid fa-circle-info fs-0 px-1  prevent-sort border-0 outline-none" data-bs-placement="top" tabindex="0"  data-bs-toggle="popover" data-bs-trigger="focus" title="" data-bs-content="Email Address info"></i></span> <span  class="prevent-sort">Reason</span> </th>

                        </tr>
                    </thead>

                        <tbody>
                            @foreach ( $waste as $data )

                        <tr>
                            <td>&nbsp;&nbsp;{{$data->id}}</td>
                            <td class="text-start">{{$data->name}}</td>
                            <td>{{$data->code}}</td>

                            <td>{{$data->reason}}</td>

                        </tr>

                        </tbody>
                        @endforeach

                    </table>
                    <form action="{{ route('export.waste') }}" method="GET">

                    <button class="btn btn-primary" type="submit" data-bs-dismiss="modal">Export</button>

                    </form>
                </div>
                <div class="w-100"></div>

            </div>

                </section>
            </div>

            </div>

        </main><!-- ===============================================-->
        <!--    End of Main Content-->
        <!-- ===============================================-->
        @include('main.vendor-scripts')

    </body>

    <!-- Mirrored from prium.github.io/phoenix/v1.6.0/apps/e-commerce/admin/customers.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 12 Dec 2022 09:36:51 GMT -->
    </html>
