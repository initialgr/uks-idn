<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Pemeriksaan</title>
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
                        LAPORAN DATA PEMERIKSAAN
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
                            <th width="3%" scope="col">Umur</th>
                            <th width="6%" scope="col">Unit</th>
                            <th scope="col">Alergi</th>
                            <th scope="col">Keluhan</th>
                            <th scope="col">Pemeriksaan Fisik</th>
                            <th scope="col">Diagnosa</th>
                            {{-- <th width="10%" scope="col">Di Uks</th> --}}
                        </tr>

                        @if ($sum_record == 0)
                            <tr>
                                <td colspan="10">
                                    <center><b> Data Tidak Ada Pada Periode Tgl
                                            {{ date('d F Y', strtotime($tgl_mulai)) }} s/d
                                            {{ date('d F Y', strtotime($tgl_selesai)) }}</b></center>
                                </td>
                            </tr>
                        @else
                            @foreach ($records as $row)
                                <tr>
                                    <th scope="row" class="text-center">
                                        {{ $loop->iteration + $records->perPage() * ($records->currentPage() - 1) }}
                                    </th>
                                    <td>{{ $row->name }}</td>
                                    <td class="text-center">{{ $row->age }}</td>
                                    <td>
                                        @if ($row->school == 'siswa-smp')
                                            <span style="font-weight:bold ;font-size: 12px" class="text-primary">Siswa
                                                SMP</span>
                                        @elseif ($row->school == 'siswa-smk')
                                            <span style="font-weight:bold ;font-size: 12px" class="text-info">Siswa
                                                SMK</span>
                                        @elseif ($row->school == 'pegawai')
                                            <span style="font-weight:bold ;font-size: 12px"
                                                class="text-secondary">Pegawai</span>
                                        @else
                                            {{ $row->school }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($row->allergy == null)
                                            -
                                        @else
                                            {{ $row->allergy }}
                                        @endif
                                    </td>
                                    <td>{{ $row->complaint }}</td>
                                    <td>
                                        @if ($row->ph_inspect == null)
                                            -
                                        @else
                                            {{ $row->ph_inspect }}
                                        @endif
                                    </td>
                                    <td>{{ $row->diagnose }}</td>
                                    {{-- <td>
                                        @if ($row->status)
                                            <span style="font-weight:bold ;font-size: 12px"
                                                class="text-warning">IYA</span>
                                        @else
                                            <span style="font-weight:bold ;font-size: 12px"
                                                class="text-secondary">TIDAK</span>
                                        @endif
                                    </td> --}}
                                    {{-- <td>
                                            <form method="post" action="{{ route('record.destroy', [$row->id]) }}">
                                                @csrf
                                                {{ method_field('DELETE') }}
                                                @if (Auth::user()->level == 'admin')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i
                                                            class="bi bi-trash2-fill me-1"></i> Hapus</button>
                                                @else
                                                @endif
                                            </form>
                                        </td> --}}
                                </tr>
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
