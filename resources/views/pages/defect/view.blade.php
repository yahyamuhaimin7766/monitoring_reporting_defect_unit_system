@extends('layouts.app')
@section('title', 'View Defect')
@section('breadcrumb')
    @parent
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Form Laporan Defect</h4>
                </div>
                <div class="card-body">
                    <div style="display: block" id="detail_defect">
                        <div class="divider divider-left">
                            <div class="divider-text">Detail Form</div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    {!! Form::label('jam_temuan', 'Jam Temuan', []) !!}
                                    {!! Form::time('jam_temuan', $model->jam_temuan ?? 'NA', ['class' => 'form-control', 'readonly']) !!}
                                </div>
                            </div>
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
                    </div>
                    <div class="divider divider-left">
                        <div class="divider-text">Tanggapan</div>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Problem / Masalah</th>
                                <th>Analisa</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                                <tr>
                                    <td>{{ $model->problem }}</td>
                                    <td>{{ $model->analisa }}</td>
                                    <td>
                                        @if ($model->image)
                                            <img src="{{ asset('storage/' . $model->image) }}" alt="Image"
                                                class="img-thumbnail" style="max-width: 330px; margin: 5px;">
                                        @else
                                            No images available.
                                        @endif
                                    </td>
                                    <td>
                                        @if ($model->action == 5)
                                            {{ $model->other_action }}
                                        @else
                                            {{ $actionOptions[$model->action] ?? 'Unknown' }}
                                        @endif
                                    </td>
                                </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    @if (\Route::current()->named('defect.view'))
                    {!! Form::open([
                        'method' => 'DELETE',
                        'route' => ['defect.destroy', $model->id],
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
