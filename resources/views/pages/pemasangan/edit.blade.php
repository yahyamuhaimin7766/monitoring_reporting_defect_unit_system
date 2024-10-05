@extends('layouts.app')
@section('title', 'Edit Pemasangan')
@section('breadcrumb')
    @parent
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::model($model, [
                'method' => 'PATCH',
                'route' => ['pemasangan.edit', $model->id],
                'id' => 'form-pemasangan',
            ]) !!}
            
            @includeIf('pages.pemasangan.form')
        </div>
        <div class="card-footer">
            {!! Form::button(__('Save'), ['class' => 'btn btn-success', 'type' => 'submit']) !!}
            {!! Form::close() !!}

            {!! Form::open([
                'method' => 'DELETE',
                'route' => ['pemasangan.destroy', $model->id],
                'style' => 'display:inline',
                'onsubmit' => 'return confirm("Apakah Anda yakin ingin menghapus data ini?");'
            ]) !!}
                {!! Form::button(__('Delete'), ['class' => 'btn btn-danger', 'type' => 'submit']) !!}
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
