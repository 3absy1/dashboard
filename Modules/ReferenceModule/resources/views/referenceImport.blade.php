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
                    <!-- add your content here -->
                    <section class="table-sec pt-3">


                <!-- start modal for filter Search-->

                <div class="modal fade " id="filterModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title " id="exampleModalLabel">Filter Data</h2>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body filter-modal row justify-content-around">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Search</button>
                    </div>
                    </div>
                </div>
                </div>

                <form method="POST" action="{{ route('upload.reference') }}"  enctype="multipart/form-data">
                    @csrf
                    <div class="tab-pane fade active show" id="tab-tab1" role="tabpanel" aria-labelledby="Main-tab">
                        <div class="row g-3 mb-5">
                        <div class="col-12 col-lg-6 col-xl-4">
                            <label class="form-label text-1000 fs-0 ps-0 text-capitalize lh-sm mb-2" for="adminTitle"> Name </label>
                            <div class="form-floating">
                                <select name="name" class="form-select" id="floatingSelect" aria-label="Floating label select example">
                                @foreach ($headers as $header)

                                <option value="{{$header}}">{{$header}}</option>
                                @endforeach

                                </select>
                                <label for="floatingSelect">Headers </label>
                            </div>
                    </div>
                        <div class="col-12 col-lg-6 col-xl-4">
                            <label class="form-label text-1000 fs-0 ps-0 text-capitalize lh-sm mb-2" for="metaName">Code </label>
                            <div class="form-floating">
                                <select name="code" class="form-select" id="floatingSelect" aria-label="Floating label select example">
                                @foreach ($headers as $header)

                                <option>{{$header}}</option>
                                @endforeach

                                </select>
                                <label for="floatingSelect">Headers </label>
                            </div>
                        </div>

                    </div>

                    <div class="text-sm-end text-center"><button type="submit" class="btn btn-primary px-7">Save</button></div>

                    </div>
                </form>

                    </section>
                    @include('main.footer')

            </div>
            </div>

        </main><!-- ===============================================-->
        <!--    End of Main Content-->
        <!-- ===============================================-->
        @include('main.vendor-scripts')

    </body>

    <!-- Mirrored from prium.github.io/phoenix/v1.6.0/apps/e-commerce/admin/customers.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 12 Dec 2022 09:36:51 GMT -->
    </html>
