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
                                    UKS IDN IKHWAN JONGGOL
                                </span>
                            </td>
                        </tr>
                    </table>

                    <hr class="line-title">
                    <p align="center">
                        LAPORAN DATA OBAT
                    </p>

                    </hr>

                    <table class="table table-bordered">
                        <tr>
                            <th width="3%" scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th width="10%" scope="col">Jenis</th>
                            <th width="10%" scope="col">Dosis</th>
                            <th width="10%" scope="col">Stok</th>
                        </tr>
                        @foreach ($drugs as $row)
                            <tr>
                                <th scope="row" class="text-center">
                                    {{ $loop->iteration + $drugs->perPage() * ($drugs->currentPage() - 1) }}
                                </th>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->type }}</td>
                                <td>{{ $row->dose }}{{ $row->unit }}</td>
                                <td>{{ $row->stok }}&nbsp;{{ $row->satuan }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div class="align-right mr-4">
                    <p class="text-right">{{ now()->isoFormat('dddd, D MMMM Y') }} <br>Mengetahui,</p>
                    <br>
                    <br>
                    <br>
                    <p class="text-right">( {{ auth()->user()->name }} ) <br>Staff UKS</p>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
