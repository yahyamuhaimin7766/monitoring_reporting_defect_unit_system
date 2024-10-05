@extends('layouts.app')
@section('title', 'View Pemasangan')
@section('breadcrumb')
    @parent
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3">
                    <div class="input-field">
                        {!! Form::label('tanggal', 'Tanggal', ['class' => 'mt-2']) !!}
                        {!! Form::date('tanggal', $model->tanggal, ['class' => 'form-control', 'readonly', 'id' => 'name']) !!}
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="input-field">
                        {!! Form::label('type', 'Type', ['class' => 'mt-2']) !!}
                        {!! Form::text('type', $model->type, ['class' => 'form-control', 'readonly', 'id' => 'name']) !!}
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="input-field">
                        {!! Form::label('no_sasis', 'Nomor Sasis', ['class' => 'mt-2']) !!}
                        {!! Form::text('no_sasis', $model->no_sasis, ['class' => 'form-control', 'readonly', 'id' => 'name']) !!}
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="input-field">
                        {!! Form::label('no_mesin', 'Nomor Mesin', ['class' => 'mt-2']) !!}
                        {!! Form::text('no_mesin', $model->no_mesin, ['class' => 'form-control',  'readonly', 'id' => 'name']) !!}
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="input-field">
                        {!! Form::label('warna', 'Warna', ['class' => 'mt-2']) !!}
                        {!! Form::text('warna', $model->warna, ['class' => 'form-control', 'readonly', 'id' => 'name']) !!}
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="input-field">
                        {!! Form::label('Varian', 'Varian', ['class' => 'mt-2']) !!}
                        {!! Form::text('varian', $model->varian, ['class' => 'form-control', 'readonly', 'id' => 'name']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
