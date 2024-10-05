@extends('layouts.app')

@section('title', 'Dashboard')
@section('breadcrumb')
    @parent
@endsection
@section('content')

<section id="card-style-variation">
    <div class="row">
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
        <div class="col-md-6 col-xl-6">
            <div class="card bg-warning text-white">
                <div class="card-body d-flex align-items-center">
                    <i data-feather='alert-circle' class="mr-1" style="width: 70px; height: 70px;"></i>
                    <div>
                        <h4 class="card-title text-white"><span class="defect-count"></span> Defect</h4>
                        <p class="card-text">Jumlah defect</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-6">
            <div class="card bg-danger text-white">
                <div class="card-body d-flex align-items-center">
                    <i data-feather='airplay' class="mr-1" style="width: 70px; height: 70px;"></i>
                    <div>
                        <h4 class="card-title text-white"><span class="repair-count"></span> Repair</h4>
                        <p class="card-text">Jumlah repair</p>
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
                    <div class="d-flex align-items-center">
                        {!! Form::label('bulan', 'Pilih Bulan:', ['class' => 'mr-2']) !!}
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
                            ['id' => 'bulan', 'class' => 'form-control mr-2']
                        ) !!}
                        {!! Form::label('tahun', 'Pilih Tahun:', ['class' => 'mr-2']) !!}
                        {!! Form::select(
                            'tahun',
                            array_combine(range(date('Y') - 10, date('Y') + 10), range(date('Y') - 10, date('Y') + 10)),
                            date('Y'),
                            ['id' => 'tahun', 'class' => 'form-control']
                        ) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="card-body">
                <canvas class="chartjs" id="myChart" data-height="450"></canvas>
            </div>
        </div>
    </div>
</div>

@endsection

@push('script_vendor')
<script src="{{ asset('template/app-assets/vendors/js/charts/chart.min.js')}}"></script>
@endpush

@push('script')
<script>
   $(document).ready(function() {
    var myChart;

    function updateChart(bulan, tahun) {
        $.ajax({
            url: '/data-leader',
            method: 'POST',
            data: {
                bulan: bulan,
                tahun: tahun
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            success: function(response) {
                // Extract data from response
                var labels = response.labels;
                var pemasanganData = response.pemasanganData;
                var defectData = response.defectData;
                var repairData = response.repairData;

                console.log(repairData);

                // Ensure labels is an array
                if (!Array.isArray(labels)) {
                    labels = [];
                }

                // Update card values
                $('.pemasangan-count').text(response.pemasangan);
                $('.defect-count').text(response.defects);
                $('.repair-count').text(response.repairs);

                // Create chart
                var ctx = document.getElementById('myChart').getContext('2d');

                // Destroy previous chart instance if it exists
                if (myChart instanceof Chart) {
                    myChart.destroy();
                }

                // Create new chart instance
                myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [
                            {
                                label: 'Pemasangan',
                                data: labels.map(day => pemasanganData[day] || 0),
                                borderColor: 'rgba(75, 192, 192, 1)',
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                borderWidth: 1
                            },
                            {
                                label: 'Defect',
                                data: labels.map(day => defectData[day] || 0),
                                borderColor: 'rgba(255, 99, 132, 1)',
                                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                borderWidth: 1
                            },
                            {
                                label: 'Repair',
                                data: labels.map(day => repairData[day] || 0),
                                borderColor: 'rgba(153, 102, 255, 1)',
                                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                                borderWidth: 1
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            x: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Tanggal'
                                }
                            },
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Jumlah'
                                }
                            }
                        }
                    }
                });
            },
            error: function(xhr) {
                console.error('Terjadi kesalahan saat mengambil data:', xhr);
            }
        });
    }

    function getCurrentMonthAndYear() {
        var today = new Date();
        return {
            bulan: String(today.getMonth() + 1).padStart(2, '0'),
            tahun: today.getFullYear()
        };
    }

    // Get default bulan and tahun if not selected
    var defaultValues = getCurrentMonthAndYear();
    var selectedBulan = $('#bulan').val() || defaultValues.bulan;
    var selectedTahun = $('#tahun').val() || defaultValues.tahun;

    // Initial chart load
    updateChart(selectedBulan, selectedTahun);

    // Handle change events for month and year
    $('#bulan, #tahun').change(function() {
        var bulan = $('#bulan').val() || defaultValues.bulan;
        var tahun = $('#tahun').val() || defaultValues.tahun;
        updateChart(bulan, tahun);
    });
});

</script>
@endpush
