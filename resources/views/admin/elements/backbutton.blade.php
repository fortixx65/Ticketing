@section('backButton')
<div class="col-12 col-md-auto">
    <div class="d-flex flex-column flex-sm-row gap-3">
        <a href="{{ $route }}" class="btn btn-raised-primary" type="button">
            revenir sur la page de {{ $name }}
            <i class="trailing-icon material-icons">arrow_back</i>
        </a>
    </div>
</div>
@endsection