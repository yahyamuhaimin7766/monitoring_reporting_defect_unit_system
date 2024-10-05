@extends('layouts.app')
@section('title', 'Pemasangan')
@section('breadcrumb')
    @parent
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Form input Pemasangan</h4>
        </div>
        <div class="card-body">
            {!! Form::open(['route' => 'pemasangan.create', 'method' => 'PUT', 'id' => 'form-pemasangan', 'files' => true]) !!}
            @includeIf('pages.pemasangan.form')
        </div>
        <div class="card-footer">
            {!! Form::button(__('Save'), ['class' => 'btn btn-success', 'type' => 'submit']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection
@push('script')
    {!! Html::script('template/assets/js/asset.js') !!}
    {!! Html::script('template/assets/js/asset-pemasangan.js') !!}
    <script>
        $(document).ready(function() {
            Pemasangan.initForm();
        });
    </script>
@endpush
