@if(session('msg-danger'))
    <div class="alert alert-dismissible alert-danger">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <h4 class="alert-heading">{{ session('msg-danger') }}</h4>
    </div>
@endif

@if(session('msg-warning'))
    <div class="alert alert-dismissible alert-warning">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <h4 class="alert-heading">{{ session('msg-danger') }}</h4>
    </div>
@endif

@if(session('msg-success'))
    <div class="alert alert-dismissible alert-info">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <h4 class="alert-heading">{{ session('msg-success') }}</h4>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-dismissible alert-danger">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
