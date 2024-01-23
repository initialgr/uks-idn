<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Pengambilan Obat</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body style="background-color:white;" onload="window.print()">
    <style>
        .line-title {
            border: 0;
            border-style: inset;
            border-top: 1px solid #000;
        }

        @media print {
            /* @page {
                size: landscape;
            } */
        }
    </style>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table style="width:100%;">
                        <tr>
                            <td align="center">
                                <span style="line-height:1.6; font-weight:bold;">
                                    UKS IDN
                                </span>
                            </td>
                        </tr>
                    </table>

                    <hr class="line-title">
                    <p align="center">
                        LAPORAN DATA PENGAMBILAN OBAT
                    </p>
                    <p align="center">
                        Periode Tanggal {{ date('d F Y', strtotime($tgl_mulai)) }} s/d
                        {{ date('d F Y', strtotime($tgl_selesai)) }}
                    </p>

                    </hr>

                    <table class="table table-bordered">
                        <tr>
                            <th width="3%" scope="col">No</th>
                            <th width="15%" scope="col">Nama</th>
                            <th width="10%" scope="col">Umur</th>
                            <th width="10%" scope="col">Unit</th>
                            <th width="10%" scope="col">Diagnonsa</th>
                            <th width="15%" scope="col">Keterangan</th>
                            <th width="10%" scope="col">Tanggal</th>
                        </tr>

                        @if ($sum_retrieval == 0)
                            <tr>
                                <td colspan="10">
                                    <center><b> Data Tidak Ada Pada Periode Tgl
                                            {{ date('d F Y', strtotime($tgl_mulai)) }} s/d
                                            {{ date('d F Y', strtotime($tgl_selesai)) }}</b></center>
                                </td>
                            </tr>
                        @else
                            @foreach ($retrievals as $row)
                                <tr>
                                    <th scope="row" class="text-center">
                                        {{ $loop->iteration + $retrievals->perPage() * ($retrievals->currentPage() - 1) }}
                                    </th>
                                    <td>{{ $row->record->name }}</td>
                                    <td>{{ $row->record->age }}</td>
                                    <td>
                                        @if ($row->record->school == 'siswa-smp')
                                            <span style="font-weight:bold ;font-size: 12px" class="text-primary">Siswa
                                                SMP</span>
                                        @elseif ($row->record->school == 'siswa-smk')
                                            <span style="font-weight:bold ;font-size: 12px" class="text-info">Siswa
                                                SMK</span>
                                        @elseif ($row->record->school == 'pegawai')
                                            <span style="font-weight:bold ;font-size: 12px"
                                                class="text-secondary">Pegawai</span>
                                        @else
                                            {{ $row->record->school }}
                                        @endif
                                    </td>
                                    <td>{{ $row->record->diagnose }}</td>
                                    <td>{{ $row->drug->name }}&nbsp;{{ $row->keterangan }}
                                    </td>
                                    <td>
                                        {{ date('d F Y', strtotime($row->created_at)) }}
                                    </td>
                            @endforeach
                        @endif
                    </table>
                </div>
                <div class="align-right mr-4">
                    <p class="text-right">Mengetahui,</p>
                    <br>
                    <br>
                    <br>
                    <p class="text-right">(.........................) </p>
                    <p class="text-right">Staff UKS</p>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
