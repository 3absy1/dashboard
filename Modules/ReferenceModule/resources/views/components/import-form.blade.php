@props(['action', 'method' => 'POST'])
@props(['action', 'method' => 'POST'])

<form action="{{ $action }}" method="{{ $method }}" enctype="multipart/form-data">
    @csrf
    <div class="col-12 col-lg-12 col-xl-4">
        <label class="form-label text-1000 fs-0 ps-0 text-capitalize lh-sm mb-2" for="mainAdminLogo">Import Excel</label>
        {{ $slot }}
        <input class="form-control" name="file" id="mainAdminLogo" type="file" />
        <div class="text-sm-end text-center">
            <button type="submit" class="btn btn-primary px-7">Import</button>
        </div>
    </div>
</form>
