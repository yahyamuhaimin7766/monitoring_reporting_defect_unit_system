@push('css_vendor')
<link rel="stylesheet" type="text/css" href="{{ asset('template/app-assets/vendors/css/forms/select/select2.min.css')}}">
@endpush
@extends('layouts.app')
@section('title', 'Create Defect')
@section('breadcrumb')
    @parent
@endsection
@section('content')
{!! Form::open(['route' => 'defect.create', 'method' => 'PUT', 'enctype' => 'multipart/form-data', 'id' => 'form-defect']) !!}
@includeIf('pages.defect.form')
<div class="card-footer">
    <button type="submit" class="btn btn-info">Simpan</button>
    {!! Form::close() !!}
</div>
</div>
</div>
</div>
@endsection
@push('script_vendor')
<script src="{{asset('template/app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
@endpush
@push('script')
<script src="{{asset('template/app-assets/js/scripts/forms/form-select2.js')}}"></script>
<script src="{{asset('template/assets/js/asset.js')}}"></script>
<script src="{{asset('template/assets/js/asset-defect.js')}}"></script>
<script type="text/javascript">
    $(document).ready(() => Asset.initSelect2());
    $(document).ready(function() {
        Defect.initForm();
        Defect.initSelect();
    });
</script>
<script>
    document.getElementById('action-select').addEventListener('change', function () {
        var otherActionDiv = document.getElementById('other-action-div');
        if (this.value === '5') {
            otherActionDiv.style.display = 'block';
        } else {
            otherActionDiv.style.display = 'none';
        }
    });
</script>
@endpush
