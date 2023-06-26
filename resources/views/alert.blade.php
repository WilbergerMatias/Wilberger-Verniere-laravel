@if ($message = Session::get('Success'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert">
            <i class="fa fas-times"></i>
        </button>
        <p>{{ $message }}</p>
    </div>
@endif
@if ($message = Session::has('Error'))
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert">
            <i class="fa fas-times"></i>
        </button>
        <p>{{ $message }}</p>
    </div>
@endif