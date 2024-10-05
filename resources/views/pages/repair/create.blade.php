@push('css_vendor')
    <link rel="stylesheet" type="text/css" href="{{ asset('template/app-assets/vendors/css/forms/select/select2.min.css') }}">
@endpush
@extends('layouts.app')
@section('title', 'Create Repair')
@section('breadcrumb')
    @parent
@endsection
@section('content')
    {!! Form::open([
        'route' => 'repair.create',
        'method' => 'PUT',
        'enctype' => 'multipart/form-data',
        'id' => 'form-repair',
    ]) !!}
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Form Edit Laporan Repair</h4>
                </div>
                @includeIf('pages.repair.form')
                <div class="card-footer">
                    <button type="submit" class="btn btn-info">Simpan</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script_vendor')
    <script src="{{ asset('template/app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
@endpush
@push('script')
    <script src="{{ asset('template/app-assets/js/scripts/forms/form-select2.js') }}"></script>
    <script src="{{ asset('template/assets/js/asset.js') }}"></script>
    <script src="{{ asset('template/assets/js/asset-repair.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(() => Asset.initSelect2());
        $(document).ready(function() {
            Repair.initForm();
            Repair.initSelect();
        });
    </script>
@endpush
