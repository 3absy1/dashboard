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
    <title> Merge | Mapping Tool </title>
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
                    <h5 class="mb-2 me-2 lh-sm"><span class="fa-solid fa-file-import me-2 fs-0"></span>Merge</h5>
                </div>
                </div>
            </div>


            <form id="uploadForm" action="{{ route('merge.upload.file') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="col-12 col-lg-12 col-xl-4">
                    <label class="form-label text-1000 fs-0 ps-0 text-capitalize lh-sm mb-2" for="mainAdminLogo">Import Excel</label>
                    <label class="form-label  fs--1 ps-0 text-capitalize  mb-2" for="mainAdminLogo">Here you will upload the file to merge any duplicated data in one column</label>
                    <input class="form-control" name="file" id="mainAdminLogo" type="file" />
                    <div class="text-sm-end text-center">
                        <button id="importButton" type="submit" class="btn btn-primary px-7">
                            Import &nbsp;
                            <div id="spinner" class="spinner-border text-light" style="display: none;"></div>
                        </button>
                    </div>
                </div>
            </form>

                <!-- data table -->


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
<script>
    document.getElementById('uploadForm').addEventListener('submit', function(event) {
        var spinner = document.getElementById('spinner');
        spinner.style.display = 'inline-block'; // Show the spinner when form is submitted
    });
</script>
    <!-- Mirrored from prium.github.io/phoenix/v1.6.0/apps/e-commerce/admin/customers.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 12 Dec 2022 09:36:51 GMT -->
    </html>
