@extends('layouts.template')
@section('title')
    Dashboard
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="row">

                <!-- Santri di UKS Card -->
                <div class="col-xxl-3 col-md-6">
                    <div class="card info-card">

                        <div class="card-body">
                            <h5 class="card-title">Santri di UKS <span>| Hari ini</span></h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"
                                    style="background-color: #ffffcfe5;">
                                    <i class="bi bi-clipboard text-warning"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>{{ $uksToday }} Santri</h6>

                                    <span class="text-muted small pt-2 ps-1">
                                        @if ($uksYesterday > 0)
                                            meningkat
                                        @elseif($uksYesterday < 0)
                                            menurun
                                        @else
                                            stabil
                                        @endif
                                    </span>
                                    <span class="text-warning small pt-1 fw-bold" data-bs-toggle="tooltip"
                                        data-bs-placement="bottom"
                                        data-bs-original-title="Dari data kemarin">{{ $uksYesterday }} Santri</span>

                                </div>
                            </div>
                        </div>

                    </div>
                </div><!-- End di Santri UKS Card -->

                <!-- Pemeriksaan Terkini Card -->
                <div class="col-xxl-3 col-md-6">
                    <div class="card info-card">

                        <div class="card-body">
                            <h5 class="card-title">Pemeriksaan <span>| Hari ini</span></h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"
                                    style="background-color: #c8fdd7">
                                    <i class="bi bi-person-check" style="color: #009124"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>{{ $recordToday }} Santri</h6>

                                    <span class="text-muted small pt-2 ps-1">
                                        @if ($recordYesterday > 0)
                                            meningkat
                                        @elseif($recordYesterday < 0)
                                            menurun
                                        @else
                                            stabil
                                        @endif
                                    </span>
                                    <span class="text-success small pt-1 fw-bold" data-bs-toggle="tooltip"
                                        data-bs-placement="bottom"
                                        data-bs-original-title="Dari data kemarin">{{ $recordYesterday }} Santri</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div><!-- End Pemeriksaan Terkini Card -->

                <!-- Pemeriksaan Santri SMP Card -->
                <div class="col-xxl-3 col-md-6">
                    <div class="card info-card">

                        <div class="card-body">
                            <h5 class="card-title">Siswa SMP <span>| Diperiksa</span></h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"
                                    style="background-color: #EEF5FF">
                                    <i class="bi bi-person-bounding-box" style="color: #525CEB"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>{{ $recordTotalSMP }} Santri</h6>
                                    <span class="text-success small pt-1 fw-bold">Telah</span><span
                                        class="text-muted small pt-2 ps-1">Diperiksa</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div><!-- End Santri Pemeriksaan SMP Card -->

                <!-- Pemeriksaan Santri SMK Card -->
                <div class="col-xxl-3 col-md-6">
                    <div class="card info-card">

                        <div class="card-body">
                            <h5 class="card-title">Siswa SMK <span>| Diperiksa</span></h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"
                                    style="background-color: #EEF5FF">
                                    <i class="bi bi-person-bounding-box" style="color: #86B6F6"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>{{ $recordTotalSMK }} Santri</h6>
                                    <span class="text-success small pt-1 fw-bold">Telah</span><span
                                        class="text-muted small pt-2 ps-1">Diperiksa</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div><!-- End Santri Pemeriksaan SMP Card -->

                <!-- Recent Pemeriksaan -->
                <div class="col-md-8">
                    <div class="card overflow-auto">

                        <div class="card-body">
                            <h5 class="card-title">Pemeriksaan <span>| Terkini</span></h5>

                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th width="3%" scope="col">No</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Santri</th>
                                        <th scope="col">Diagnosa</th>
                                        <th scope="col">Waktu</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @php $no=1; @endphp
                                    @if ($recordRecent->count() > 0)
                                        @foreach ($recordRecent as $row)
                                            @if ($row->school !== 'pegawai')
                                                <tr>
                                                    <th scope="row" class="text-center">
                                                        {{ $no++ }}
                                                    </th>
                                                    <td>{{ $row->name }}</td>
                                                    <td>
                                                        @if ($row->school == 'siswa-smp')
                                                            <span class="badge bg-primary text-white">SMP</span>
                                                        @elseif ($row->school == 'siswa-smk')
                                                            <span class="badge bg-info text-white">SMK</span>
                                                        @else
                                                            {{ $row->school }}
                                                        @endif
                                                    </td>
                                                    <td>{{ $row->diagnose }}</td>
                                                    <td>{{ $row->formattedDate }}{{ date('H:i', strtotime($row->created_at)) }}
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="text-center" colspan="5">
                                                Belum ada data pemeriksaan terkini
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>

                        </div>

                    </div>
                </div><!-- End Recent Pemeriksaan -->

                <!-- Recent Status -->
                <div class="col-md-4">
                    <div class="card overflow-auto">

                        <div class="card-body">
                            <h5 class="card-title">Santri di UKS <span>| Terkini</span></h5>

                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th width="3%" scope="col">No</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Santri</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no=1; @endphp
                                    @if ($diUksCount > 0)
                                        @foreach ($diUks as $row)
                                            @if ($row->school !== 'pegawai' && $row->status !== 0)
                                                <tr>
                                                    <th scope="row" class="text-center">
                                                        {{ $no++ }}
                                                    </th>
                                                    <td>{{ $row->name }}</td>
                                                    <td>
                                                        @if ($row->school == 'siswa-smp')
                                                            <span class="badge bg-primary text-white">SMP</span>
                                                        @elseif ($row->school == 'siswa-smk')
                                                            <span class="badge bg-info text-white">SMK</span>
                                                        @else
                                                            {{ $row->school }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($row->status)
                                                            <span class="badge bg-warning text-white hidden">Di UKS</span>
                                                        @else
                                                            <span class="badge bg-secondary text-white hidden">Tidak Di
                                                                UKS</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="text-center" colspan="5">
                                                Belum ada data santri terkini
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div><!-- End Recent Status -->

            </div>
        </div>
    </div>
@endsection
