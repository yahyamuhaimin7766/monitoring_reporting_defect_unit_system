@extends('layouts.app')
@section('title', 'Laporan')
@section('breadcrumb')
    @parent
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>List Laporan</h4>

                </div>
                <div class="card-body">
                    {!! Form::open(['route' => 'laporan.cetak', 'method' => 'POST', 'id' => 'cetak-laporan']) !!}
                        <select name="type_laporan" class="custom-select" id="laporan">
                            <option value="1">Defect</option>
                            <option value="2">Repair</option>
                        </select>
                    {!! Form::button(__('Cetak'), ['class' => 'btn btn-sm btn-info mt-2', 'type' => 'submit']) !!}
                    {!! Form::close() !!}
                </div>
                <div class="card-footer">

                </div>
            </div>
        </div>
    </div>
@endsection
