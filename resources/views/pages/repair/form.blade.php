<div class="card-body">
    @if (!$model)
        {!! Form::label('', 'Masukan Nomor Defect', []) !!}
        {!! Form::select('defect_id', [], null, [
            'class' => 'custom-select browser-default init-select2',
            'data-model' => 'defect',
            'data-label' => 'defect_number',
            'data-minimum-input-length' => -1,
            'id' => 'defect_id',
        ]) !!}
    @endif

    <div style="display: block" id="detail_defect">
        <div class="divider divider-left">
            <div class="divider-text">Tanggapan</div>
        </div>
        <div>
            <div class="row">
                @if (!$model)
                    <div class="col-lg-6">
                        {!! Form::label('', 'Problem / Masalah', []) !!}
                        {!! Form::text('', null, ['class' => 'form-control masalah', 'readonly']) !!}
                    </div>
                    <div class="col-lg-6">
                        {!! Form::label('', 'Analisa', []) !!}
                        {!! Form::text('', null, ['class' => 'form-control analisa', 'readonly']) !!}
                    </div>
                    <div class="col-lg-12">
                        {!! Form::label('solusi', 'Solusi', []) !!}
                        {!! Form::text('solusi', null, ['class' => 'form-control', 'id' => 'other-action-input']) !!}
                    </div>
            </div>
        @else
                <div class="col-lg-6">
                    {!! Form::label('', 'Problem / Masalah', []) !!}
                    {!! Form::text('', $model->defect->problem ?? 'NA', ['class' => 'form-control masalah', 'readonly']) !!}
                </div>
                <div class="col-lg-6">
                    {!! Form::label('', 'Analisa', []) !!}
                    {!! Form::text('', $model->defect->analisa ?? 'NA', ['class' => 'form-control analisa', 'readonly']) !!}
                </div>
                <div class="col-lg-12">
                    {!! Form::label('solusi', 'Solusi', []) !!}
                    {!! Form::text('solusi', null, ['class' => 'form-control', 'id' => 'other-action-input']) !!}
                </div>
            @endif
        </div>
    </div>
</div>
