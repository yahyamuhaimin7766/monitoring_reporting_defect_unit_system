@extends('layouts.app')

@section('title', 'Dashboard')
@section('breadcrumb')
    @parent
@endsection
@section('content')
    <section id="card-style-variation">
        <div class="row">
            <div class="col-md-3 col-xl-3">
                <div class="card bg-warning text-white">
                    <div class="card-body d-flex align-items-center">
                        <i data-feather='pocket' class="mr-1" style="width: 70px; height: 70px;"></i>
                        <div>
                            <h4 class="card-title text-white"><span class="user-count">{{ $totalRefair }}</span> Jumlah
                                Laporan Repair</h4>
                            <p class="card-text">Yang terdaftar</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-6 col-9">
                <div class="card card-transaction">
                    <div class="card-header">
                        <h4 class="card-title">History Data Repair</h4>
                    </div>
                    <div class="card-body">
                        @foreach ($recentRefair as $refair)
                            <div class="transaction-item">
                                <div class="media">
                                    <div class="avatar bg-light-warning rounded">
                                        <div class="avatar-content">
                                            <i data-feather="pocket" class="avatar-icon font-medium-3"></i>
                                        </div>
                                    </div>
                                    <div class="media-body">
                                       <a href="{{route('defect.view', $refair->id)}}"><h6 class="transaction-title">{{$refair->refair_number}}</h6></a>
                                        <small>{{ $refair->solusi }}</small>
                                    </div>
                                </div>
                                <div class="font-weight-bolder text-danger">{{$refair->created_at->diffForHumans()}}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection

