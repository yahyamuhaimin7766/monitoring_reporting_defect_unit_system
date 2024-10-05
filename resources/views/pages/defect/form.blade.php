<div class="row">
    <div class="col-lg-12">
     <div class="card">
         <div class="card-header">
             <h4>Form Laporan Defect</h4>
         </div>
         <div class="card-body">
        @if(!$model)
            {!! Form::label('', 'Masukan Nomor Mesin', []) !!}
            {!! Form::select('pemasangan_id', [], null, [
                'class' => 'custom-select browser-default init-select2',
                'data-model' => 'pemasangan',
                'data-label' => 'no_mesin',
                'data-minimum-input-length' => -1,
                'id' => 'defect_id'
            ]) !!}
        @endif
        <div style="display: block" id="detail_defect">
            <div class="divider divider-left">
                <div class="divider-text">Detail Form</div>
            </div>
            @if(!$model)
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            {!! Form::label('', 'Nomor Mesin', []) !!}
                            {!! Form::text('nomor_mesin', null, ['class' => 'form-control no_mesin']) !!}
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            {!! Form::label('', 'Nomor Sasis', []) !!}
                            {!! Form::text('nomor_sasis', null, ['class' => 'form-control no_sasis']) !!}
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            {!! Form::label('', 'Type', []) !!}
                            {!! Form::text('type', null, ['class' => 'form-control type']) !!}
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            {!! Form::label('', 'Varian', []) !!}
                            {!! Form::text('varian', null, ['class' => 'form-control varian']) !!}
                           
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            {!! Form::label('', 'Warna', []) !!}
                            {!! Form::text('warna', null, ['class' => 'form-control warna']) !!}
                        </div>
                    </div>
                </div>
            @else
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        {!! Form::label('', 'Nomor Mesin', []) !!}
                        {!! Form::text('nomor_mesin', $model->pemasangan->no_mesin ?? 'NA', [
                            'class' => 'form-control no_mesin',
                            'readonly',
                        ]) !!}
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        {!! Form::label('', 'Nomor Sasis', []) !!}
                        {!! Form::text('nomor_sasis', $model->pemasangan->no_sasis ?? 'NA', [
                            'class' => 'form-control no_sasis',
                            'readonly',
                        ]) !!}
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        {!! Form::label('', 'Type', []) !!}
                        {!! Form::text('type', $model->pemasangan->type ?? 'NA', ['class' => 'form-control type', 'readonly']) !!}
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        {!! Form::label('', 'Varian', []) !!}
                        {!! Form::text('varian', $model->pemasangan->varian ?? 'NA', ['class' => 'form-control varian', 'readonly']) !!}

                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        {!! Form::label('', 'Warna', []) !!}
                        {!! Form::text('warna', $model->pemasangan->warna ?? 'NA', ['class' => 'form-control warna', 'readonly']) !!}
                    </div>
                </div>
            </div>
            @endif
            </div>
            <div class="divider divider-left">
                <div class="divider-text">Tanggapan</div>
            </div>
            <div>
                <div class="row">
                    <div class="col-lg-3">
                        <div class="form-group">
                            {!! Form::label('jam_temuan', 'Jam Temuan', []) !!}
                            {!! Form::time('jam_temuan', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-lg-3">
                        {!! Form::label('', 'Problem / Masalah', []) !!}
                        {!! Form::text('problem', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="col-lg-3">
                        {!! Form::label('', 'Analisa', []) !!}
                        {!! Form::text('analisa', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="col-lg-3">
                        {!! Form::label('image', 'Upload Image') !!}
                        {!! Form::file('image', ['class' => 'form-control', 'multiple' => true]) !!}
                    </div>
                    <div class="col-lg-3">
                        {!! Form::label('action', 'Action', []) !!}
                        @php
                            $options = [
                                '1' => 'Ganti Part',
                                '2' => 'Repair Part',
                                '3' => 'Rubbing',
                                '4' => 'Beban Bersama',
                                '5' => 'Lainnya'
                            ];
                        @endphp
                        {!! Form::select('action', $options, null, ['class' => 'custom-select', 'id' => 'action-select']) !!}
                    </div>
                    <div class="col-lg-9" id="other-action-div" style="display:none;">
                        {!! Form::label('other_action', 'Specify Other', []) !!}
                        {!! Form::text('other_action', null, ['class' => 'form-control', 'id' => 'other-action-input']) !!}
                    </div>
                </div>
            </div>
        </div>
