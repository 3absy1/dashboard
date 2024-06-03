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
                    <h5 class="mb-2 me-2 lh-sm"><span class="fa-solid fa-display me-2 fs-0"></span>Merged Table  </h5>

                </div>
                </div>
            </div>

                <!-- data table -->
    <table id="userAccessTable" class="useDataTable responsive table fs--1 mb-0 bg-white my-3 rounded-2 shadow" style="width:100%">
        <thead>

            <tr class="px-2 py-2 text-head">
                <th class="dtr-control"></th>
                <th ></th>
                <th class="align-middle text-nowrap">#</th>
                <th class="align-middle text-nowrap">Count of Merge</th>
                @foreach ($entrys as $entry )
                <th class="align-middle text-nowrap">{{$entry}}</th>
                @endforeach
                @foreach ($total as $tot )
                <th class="align-middle text-nowrap">{{$tot}}</th>
                @endforeach
            </tr>

        </thead>
        <tbody>
            <br>
            <h5 class="mb-2 me-2 lh-sm"><span class="fa-solid fa-calculator me-2 fs-0"></span> the Total of the Rows Before Merge Is {{$totalRows}} </h5>

            @php
    $count = 1; // Initialize the count variable outside of the loop
@endphp

            @foreach ($merges as $index => $data)
                <tr>
                    <td></td>
                    <td></td>
                    <td>{{ $count++ }}</td>
                    <td>{{$data->count}}</td>
                    @foreach ($entrys as $entry )
                    <td>  &nbsp;&nbsp;&nbsp;  {{ $data->$entry }}</td>
                    @endforeach
                    @foreach ($total as $tot )
                    <td>  &nbsp;&nbsp;&nbsp;  {{ $data->$tot }}</td>

                    @endforeach
                    {{-- <td>{{ $data->entry_number }}</td>
                        <td>{{ $data->total }}</td>
                    <td>{{ $data->created_at }}</td> --}}
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>

<form action="{{ route('export.merge') }}" method="GET">

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
