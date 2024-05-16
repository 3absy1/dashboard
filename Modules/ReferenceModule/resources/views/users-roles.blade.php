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

                <!-- end modal for filter Search-->

                        <div class="container px-2 px-md-5"> <div class="align-items-start border-bottom flex-column">
                        <div class="pt-1 w-100 mb-3 d-flex justify-content-between align-items-start">
                            <div>
                            <h5 class="mb-2 me-2 lh-sm"><span class="fa-solid fa-user-pen fs-0"></span> Related Names</h5>
                            <div class="font-sans-serif btn-reveal-trigger position-static"><button class="success btn btn-md border bg-light dropdown-toggle dropdown-caret-none transition-none btn-reveal" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">Create</button>
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form action="{{ route('related.create') }} " method="GET">
                                            @csrf
                                    <div class="modal-content">
                                        <div class="modal-header">

                                        <h5 class="modal-title" id="exampleModalLabel">Create Name</h5><button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><span class="fas fa-times fs-9"></span></button>
                                        </div>
                                        <div class="modal-body">
                                        <label class="form-label text-1000 fs-0 ps-0 text-capitalize lh-sm mb-2" for="adminTitle"> Code </label>
                                        <input class="form-control" id="code" type="number" name="code" placeholder="1234"required />
                                        </div>
                                        <div class="modal-body">
                                            <label class="form-label text-1000 fs-0 ps-0 text-capitalize lh-sm mb-2" for="adminTitle"> Name </label>
                                            <input class="form-control" id="adminTitle" name="name" type="text" placeholder="Ahmed" required />
                                        </div>
                                        <div class="modal-body">
                                                <div class="form-floating">
                                                    <select name="reference_id" class="form-select" id="floatingSelect" aria-label="Floating label select example">
                                                    <option selected> select</option>
                                                    @foreach ($references as $reference)

                                                    <option value="{{$reference->id}}">{{$reference->name}}</option>
                                                    @endforeach

                                                    </select>
                                                    <label for="floatingSelect">Reference Names</label>
                                                </div>
                                        </div>

                                        <div class="modal-footer"><button class="btn btn-primary" type="submit" data-bs-dismiss="modal">Submt</button><button class="btn btn-outline-primary" type="button" data-bs-dismiss="modal">Cancel</button></div>
                                    </div>
                                        </form>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        </div>

                        <table id="userAccessTable" class="useDataTable responsive table fs--1 mb-0 bg-white my-3 rounded-2 shadow" style="width:100%">
                            <thead class="">
                            <tr class="px-2 py-2  text-head">
                                <th class="text-start  text-nowrap"><span class="prevent-sort"><i  class="fa-solid fa-circle-info fs-0 px-1  prevent-sort border-0 outline-none" data-bs-placement="top" tabindex="0"  data-bs-toggle="popover" data-bs-trigger="focus" title="" data-bs-content="Staff .No info"></i> </span><span  class="prevent-sort">ID</span></th>
                                <th class=" align-middle text-nowrap"><span class="prevent-sort "><i  class="fa-solid fa-circle-info fs-0 px-1  prevent-sort border-0 outline-none" data-bs-placement="top" tabindex="0"  data-bs-toggle="popover" data-bs-trigger="focus" title="" data-bs-content="Email Address info"></i></span> <span  class="prevent-sort">Select</span> </th>
                                <th class=" align-middle text-nowrap"><span class="prevent-sort "><i  class="fa-solid fa-circle-info fs-0 px-1  prevent-sort border-0 outline-none" data-bs-placement="top" tabindex="0"  data-bs-toggle="popover" data-bs-trigger="focus" title="" data-bs-content="Email Address info"></i></span> <span  class="prevent-sort">Reference Name</span> </th>
                                <th class=" align-middle text-nowrap"><span class="prevent-sort "><i  class="fa-solid fa-circle-info fs-0 px-1  prevent-sort border-0 outline-none" data-bs-placement="top" tabindex="0"  data-bs-toggle="popover" data-bs-trigger="focus" title="" data-bs-content="Email Address info"></i></span> <span  class="prevent-sort">Related Name</span> </th>
                                <th class=" align-middle text-nowrap"><span class="prevent-sort "><i  class="fa-solid fa-circle-info fs-0 px-1  prevent-sort border-0 outline-none" data-bs-placement="top" tabindex="0"  data-bs-toggle="popover" data-bs-trigger="focus" title="" data-bs-content="Email Address info"></i></span> <span  class="prevent-sort">Code</span> </th>
                                <th class=" align-middle text-nowrap"><span class="prevent-sort "><i  class="fa-solid fa-circle-info fs-0 px-1  prevent-sort border-0 outline-none" data-bs-placement="top" tabindex="0"  data-bs-toggle="popover" data-bs-trigger="focus" title="" data-bs-content="Created At info"></i></span><span  class="prevent-sort">Created At</span> </th>
                                <th class=" align-middle text-nowrap"><span class="prevent-sort "><i  class="fa-solid fa-circle-info fs-0 px-1  prevent-sort border-0 outline-none" data-bs-placement="top" tabindex="0"  data-bs-toggle="popover" data-bs-trigger="focus" title="" data-bs-content="Created At info"></i></span><span  class="prevent-sort">Edit</span> </th>
                                <th class=" align-middle text-nowrap"><span class="prevent-sort "><i  class="fa-solid fa-circle-info fs-0 px-1  prevent-sort border-0 outline-none" data-bs-placement="top" tabindex="0"  data-bs-toggle="popover" data-bs-trigger="focus" title="" data-bs-content="Created At info"></i></span><span  class="prevent-sort">Delete</span> </th>

                            </tr>
                        </thead>

                            <tbody>
                                @foreach ( $relateds as $related )

                            <tr>
                                <td>{{$related->id}}</td>
                                <td></td>
                                <td class="text-start">{{$related->reference->name}}</td>
                                <td class="text-start">{{$related->name}}</td>
                                <td>{{$related->code}}</td>

                                <td>{{$related->created_at}}</td>
                                <td class="align-middle text-start white-space-nowrap pe-0 action py-2">

                                    <div class="font-sans-serif btn-reveal-trigger position-static"><button class="success btn btn-md border bg-light dropdown-toggle dropdown-caret-none transition-none btn-reveal" type="button" data-bs-toggle="modal" data-bs-target="#editModal{{$related->id}}">Edit</button>
                                        <div class="modal fade" id="editModal{{$related->id}}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <form action="{{ route('related.update','test') }} " method="POST">
                                                    @csrf
                                                    @method('PUT')
                                            <div class="modal-content">
                                                <div class="modal-header">

                                                <h5 class="modal-title" id="editModal{{$related->id}}">Edit Name</h5><button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><span class="fas fa-times fs-9"></span></button>
                                                </div>
                                                <div class="modal-body">
                                                <label class="form-label text-1000 fs-0 ps-0 text-capitalize lh-sm mb-2" for="adminTitle"> Code </label>
                                                <input class="form-control" id="code" type="number" name="code" value="{{$related->code}}" />
                                                <input type="hidden" class="form-control" name="id" value="{{$related->id}}">
                                                </div>
                                                <div class="modal-body">
                                                    <label class="form-label text-1000 fs-0 ps-0 text-capitalize lh-sm mb-2" for="adminTitle"> Name </label>
                                                    <input class="form-control" id="adminTitle" name="name" type="text" value="{{$related->name}}" />

                                                </div>

                                                <div class="modal-body">
                                                    <div class="form-floating">
                                                        <select name="reference_id" class="form-select" id="floatingSelect" aria-label="Floating label select example">
                                                            <option selected value="{{$related->reference->id}}">{{$related->reference->name}}</option>
                                                        @foreach ($references as $reference)
                                                        <option  value="{{$reference->id}}">{{$reference->name}}</option>

                                                        @endforeach

                                                        </select>
                                                        <label for="floatingSelect">Reference Names</label>
                                                    </div>
                                            </div>
                                                <div class="modal-footer"><button class="btn btn-primary" type="submit" data-bs-dismiss="modal">Submt</button><button class="btn btn-outline-primary" type="button" data-bs-dismiss="modal">Cancel</button></div>
                                            </div>
                                                </form>
                                            </div>
                                        </div>
                                        </div>
                                </td>

                                <td>
                                    <div class="font-sans-serif btn-reveal-trigger position-static"><button class="success btn btn-md border bg-light dropdown-toggle dropdown-caret-none transition-none btn-reveal" type="button" data-bs-toggle="modal" data-bs-target="#deleteModal{{$related->id}}">Delete</button>
                                        <div class="modal fade" id="deleteModal{{$related->id}}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <form action="{{ route('related.delete', $related->id) }} " method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                            <div class="modal-content">
                                                <div class="modal-header">

                                                <h5 class="modal-title" id="deleteModal{{$related->id}}">Delete Name</h5><button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><span class="fas fa-times fs-9"></span></button>
                                                </div>
                                                <div class="modal-body">
                                                <label class="form-label text-1000 fs-0 ps-0 text-capitalize lh-sm mb-2" for="adminTitle"> Are You Sure ? </label>
                                                </div>

                                                <div class="modal-footer"><button class="btn btn-primary" type="submit" data-bs-dismiss="modal">Submt</button><button class="btn btn-outline-primary" type="button" data-bs-dismiss="modal">Cancel</button></div>
                                            </div>
                                                </form>
                                            </div>
                                        </div>
                                        </div>
                                </td>
                            </tr>
                                @endforeach
                            </tbody>
                        </table>
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
