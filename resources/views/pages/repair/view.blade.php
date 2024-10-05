@extends('layouts.app')
@section('title', 'View Repair')
@section('breadcrumb')
    @parent
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Form Laporan Repair</h4>
                </div>
                <div class="card-body">
                    <div style="display: block" id="detail_defect">
                        <div class="divider divider-left">
                            <div class="divider-text">Detail Form</div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    {!! Form::label('jam_temuan', 'Tanggal ', []) !!}
                                    {!! Form::date('jam_temuan', $model->created_at ?? 'NA', ['class' => 'form-control', 'readonly']) !!}
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    {!! Form::label('', 'Nomor Mesin', []) !!}
                                    {!! Form::text('nomor_mesin', $model->defect->pemasangan->no_mesin ?? 'NA', [
                                        'class' => 'form-control no_mesin',
                                        'readonly',
                                    ]) !!}
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    {!! Form::label('', 'Nomor Sasis', []) !!}
                                    {!! Form::text('nomor_sasis', $model->defect->pemasangan->no_sasis ?? 'NA', [
                                        'class' => 'form-control no_sasis',
                                        'readonly',
                                    ]) !!}
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    {!! Form::label('', 'Type', []) !!}
                                    {!! Form::text('type', $model->defect->pemasangan->type ?? 'NA', ['class' => 'form-control type', 'readonly']) !!}
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    {!! Form::label('', 'Varian', []) !!}
                                    {!! Form::text('varian', $model->defect->pemasangan->varian ?? 'NA', ['class' => 'form-control varian', 'readonly']) !!}

                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    {!! Form::label('', 'Warna', []) !!}
                                    {!! Form::text('warna', $model->defect->pemasangan->warna ?? 'NA', ['class' => 'form-control warna', 'readonly']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="divider divider-left">
                        <div class="divider-text">Tanggapan</div>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Defect</th>
                                <th>Penyebab</th>
                                <th>Solusi</th>
                            </tr>
                        </thead>
                        <tbody>
                                <tr>
                                    <td>{{ $model->defect->problem ?? 'NA' }}</td>
                                    <td>{{ $model->defect->analisa ?? 'NA' }}</td>
                                    <td>{{$model->solusi ?? 'NA'}}</td>
                                </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    @if (\Route::current()->named('repair.view'))
                    {!! Form::open([
                        'method' => 'DELETE',
                        'route' => ['repair.destroy', $model->id],
                        'style' => 'display:inline',
                        'onsubmit' => 'return confirm("Apakah Anda yakin ingin menghapus data ini?");'
                    ]) !!}
                        {!! Form::button(__('Delete'), ['class' => 'btn btn-danger', 'type' => 'submit']) !!}
                    {!! Form::close() !!}
                @endif
                </div>
            </div>
        </div>
    </div>
@endsection
