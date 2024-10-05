@extends('layouts.app')

@section('title', 'Dashboard')
@section('breadcrumb')
    @parent
@endsection
@section('content')
    <section id="card-style-variation">
        <div class="row">
            <div class="col-md-3 col-xl-3">
                <div class="card bg-secondary text-white">
                    <div class="card-body d-flex align-items-center">
                        <i data-feather='pocket' class="mr-1" style="width: 70px; height: 70px;"></i>
                        <div>
                            <h4 class="card-title text-white"><span class="user-count">{{ $totalDefects }}</span> Jumlah
                                Laporan Defect</h4>
                            <p class="card-text">Yang terdaftar</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-6 col-9">
                <div class="card card-transaction">
                    <div class="card-header">
                        <h4 class="card-title">History Data Defect</h4>
                    </div>
                    <div class="card-body">
                        @foreach ($recentDefects as $defect)
                            <div class="transaction-item">
                                <div class="media">
                                    <div class="avatar bg-light-primary rounded">
                                        <div class="avatar-content">
                                            <i data-feather="pocket" class="avatar-icon font-medium-3"></i>
                                        </div>
                                    </div>
                                    <div class="media-body">
                                       <a href="{{route('defect.view', $defect->id)}}"><h6 class="transaction-title">{{$defect->defect_number}}</h6></a>
                                        <small>{{ $defect->problem }} - {{$defect->analisa}}</small>
                                    </div>
                                </div>
                                <div class="font-weight-bolder text-danger">{{$defect->created_at->diffForHumans()}}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
@push('script_vendor')
    <script src="{{ asset('template/app-assets/vendors/js/charts/chart.min.js') }}"></script>
@endpush
@push('script')
    <script src="{{ asset('template/assets/js/asset-dashboard.js') }}"></script>
    <script src="{{ asset('template') }}/app-assets/js/scripts/charts/chart-chartjs.js"></script>
@endpush
