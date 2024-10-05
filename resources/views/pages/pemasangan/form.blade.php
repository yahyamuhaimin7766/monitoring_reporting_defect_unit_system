<div class="row">
    <div class="col-lg-3">
        <div class="input-field">
            {!! Form::label('tanggal', 'Tanggal', ['class' => 'mt-2']) !!}
            {!! Form::date('tanggal', $model->tanggal ?? null, ['class' => 'form-control', 'id' => 'name']) !!}
        </div>
    </div>
    <div class="col-lg-3">
        <div class="input-field">
            {!! Form::label('type', 'Type', ['class' => 'mt-2']) !!}
            {!! Form::text('type', null, ['class' => 'form-control', 'id' => 'name']) !!}
        </div>
    </div>
    <div class="col-lg-3">
        <div class="input-field">
            {!! Form::label('no_sasis', 'Nomor Sasis', ['class' => 'mt-2']) !!}
            {!! Form::text('no_sasis', null, ['class' => 'form-control', 'id' => 'name']) !!}
        </div>
    </div>
    <div class="col-lg-3">
        <div class="input-field">
            {!! Form::label('no_mesin', 'Nomor Mesin', ['class' => 'mt-2']) !!}
            {!! Form::text('no_mesin', null, ['class' => 'form-control', 'id' => 'name']) !!}
        </div>
    </div>
    <div class="col-lg-3">
        <div class="input-field">
            {!! Form::label('warna', 'Warna', ['class' => 'mt-2']) !!}
            {!! Form::text('warna', null, ['class' => 'form-control', 'id' => 'name']) !!}
        </div>
    </div>
    <div class="col-lg-3">
        <div class="input-field">
            {!! Form::label('Varian', 'Varian', ['class' => 'mt-2']) !!}
            {!! Form::text('varian', null, ['class' => 'form-control', 'id' => 'name']) !!}
        </div>
    </div>
</div>