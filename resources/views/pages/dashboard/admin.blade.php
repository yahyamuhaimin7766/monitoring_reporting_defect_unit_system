
<section id="card-style-variation">
    <div class="row">
        <div class="col-md-6 col-xl-6">
            <div class="card bg-secondary text-white">
                <div class="card-body d-flex align-items-center">
                    <i data-feather='users' class="mr-1" style="width: 70px; height: 70px;"></i>
                    <div>
                        <h4 class="card-title text-white"><span class="user-count"></span> Jumlah User</h4>
                        <p class="card-text">Yang terdaftar</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-6">
            <div class="card bg-success text-white">
                <div class="card-body d-flex align-items-center">
                    <i data-feather='heart' class="mr-1" style="width: 70px; height: 70px;"></i>
                    <div>
                        <h4 class="card-title text-white"><span class="pemasangan-count"></span> Pemasangan</h4>
                        <p class="card-text">Yang terdaftar</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-baseline flex-sm-row flex-column">
                <h4 class="card-title">Grafik Monitoring Mobil</h4>
                <div class="header-right d-flex align-items-center mt-sm-0 mt-1">
                        {!! Form::open(['id' => 'monthForm']) !!}
                        {!! Form::label('bulan', 'Pilih Bulan:') !!}
                        {!! Form::select(
                            'bulan',
                            [
                                '01' => 'Januari',
                                '02' => 'Februari',
                                '03' => 'Maret',
                                '04' => 'April',
                                '05' => 'Mei',
                                '06' => 'Juni',
                                '07' => 'Juli',
                                '08' => 'Agustus',
                                '09' => 'September',
                                '10' => 'Oktober',
                                '11' => 'November',
                                '12' => 'Desember',
                            ],
                            date('m'),
                            ['id' => 'bulan','class' => 'form-control mb-2'],
                        ) !!}
                        {!! Form::close() !!}
                </div>
            </div>
            <div class="card-body">
                <canvas class="chartjs" id="lineAreaChartEx" data-height="450"></canvas>
            </div>
        </div>
    </div>
</div>
