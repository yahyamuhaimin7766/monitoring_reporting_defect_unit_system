@extends('layouts.app')
@section('title', 'Lihat Repair')
@section('breadcrumb')
    @parent
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Lihat Data</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('repair.cetakget') }}" method="GET" class="form-inline my-2 my-lg-0">
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
            <button type="submit" class="btn btn-primary">Lihat</button>
            </form>
        </div>
    </div>
@endsection