@extends('layouts.app')
@section('title', 'Cetak Pemasangan')
@section('breadcrumb')
    @parent
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Cetak Data</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('pemasangan.cetakget') }}" method="GET" class="form-inline my-2 my-lg-0">
                <div class="form-group">
                    <label for="start_date" class="mr-2">Start Date:</label>
                    <input type="date" id="start_date" name="start_date" class="form-control mr-2">
                </div>
                <div class="form-group">
                    <label for="end_date" class="mr-2">End Date:</label>
                    <input type="date" id="end_date" name="end_date" class="form-control mr-2">
                </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Cetak</button>
            </form>
        </div>
    </div>
@endsection
