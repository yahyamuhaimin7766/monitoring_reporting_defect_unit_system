@push('css_vendor')
<link rel="stylesheet" type="text/css" href="{{ asset('template/app-assets/vendors/css/forms/select/select2.min.css')}}">
@endpush
@extends('layouts.app')
@section('title', 'Edit Defect')
@section('breadcrumb')
    @parent
@endsection
@section('content')
{!! Form::model($model, [
    'method' => 'PATCH',
    'route' => ['defect.edit', $model->id],
    'id' => 'form-defect',
    'files' => true,
    'enctype' => 'multipart/form-data'
]) !!}
@includeIf('pages.defect.form')
<div class="card-footer">
    <button type="submit" class="btn btn-info">Simpan</button>
    {!! Form::close() !!}
    {!! Form::open([
        'method' => 'DELETE',
        'route' => ['defect.destroy', $model->id],
        'style' => 'display:inline',
        'onsubmit' => 'return confirm("Apakah Anda yakin ingin menghapus data ini?");'
    ]) !!}
        {!! Form::button(__('Delete'), ['class' => 'btn btn-danger', 'type' => 'submit']) !!}
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
<script type="text/javascript">
    $(document).ready(function(){
        var i = 0;

        var options = `
            <option value="1">Ganti Part</option>
            <option value="2">Repair Part</option>
            <option value="3">Rubbing</option>
            <option value="4">Beban Bersama</option>
            <option value="5">Lainnya</option>
        `;

        $('#add').click(function(){
            i++;
            $('#row_add').append(`
            <div>
                    <div class="row" id="row${i}">
                        <div class="col-lg-3">
                            {!! Form::label('problem', 'Problem / Masalah', []) !!}
                            {!! Form::text('problem[]', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="col-lg-3">
                                {!! Form::label('analisa', 'Analisa', []) !!}
                                {!! Form::text('analisa[]', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="col-lg-3">
                                {!! Form::label('image', 'Upload Image', []) !!}
                                {!! Form::file('image[${i}][]', ['class' => 'form-control']) !!}
                        </div>
                        <div class="col-lg-2">
                                {!! Form::label('action', 'Action', []) !!}
                                <select name="action[]" class="custom-select action-select">${options}</select>
                        </div>
                        <div class="col-lg-2 other-action-div" style="display:none;">
                                {!! Form::label('other_action', 'Specify Other', []) !!}
                                {!! Form::text('other_action[]', null, ['class' => 'form-control other-action-input']) !!}
                        </div>
                        <div class="col-lg-1">
                                {!! Form::label('remove', 'Remove', []) !!}
                                <button type="button" class="btn btn-danger remove" id="${i}"> - </button>
                        </div>
                 </div>
             </div>
            `);

            $('.action-select').last().on('change', function() {
                var otherActionDiv = $(this).closest('.row').find('.other-action-div');
                if ($(this).val() === '5') {
                    otherActionDiv.show();
                } else {
                    otherActionDiv.hide();
                }
            });
        });

        $(document).on('click', '.remove', function(){
            var button_id = $(this).attr("id");
            $('#row' + button_id).remove();
        });

        $('.action-select').on('change', function() {
            var otherActionDiv = $(this).closest('.row').find('.other-action-div');
            if ($(this).val() === '5') {
                otherActionDiv.show();
            } else {
                otherActionDiv.hide();
            }
        });
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
