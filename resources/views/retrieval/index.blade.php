@extends('layouts.template')

@section('title')
    Data Pengambilan Obat
@endsection

@section('content')
    @include('alert.success')
    @include('alert.error')
    @include('alert.warning')
    <div class="row">
        <div class="col-12">
            <div class="card recent-sales overflow-auto">
                <div class="filter" id="filterContainer">
                    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <li class="dropdown-header text-start">
                            <h6>Opsi</h6>
                        </li>
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                data-bs-target="#addModalPengambilan">Tambah<i class="bi bi-journal-plus ms-2"></i></a></li>
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                data-bs-target="#addModalPrint">Print Laporan<i
                                    class="bi bi-file-earmark-medical ms-2"></i></a>
                        </li>
                    </ul>
                </div>
                @if (Auth::check())
                    @php $userLevel = Auth::user()->level; @endphp
                    @if ($userLevel == 'admin' || $userLevel == 'staff')
                        <div class="filter" id="buttonContainer">
                            <div class="icon">
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#addModalPengambilan"><i class="bi bi-pencil-square me-1"></i>
                                    Tambah</button>
                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#addModalPrint"><i class="bi bi-file-earmark-pdf me-1"></i>
                                    Print Laporan</button>
                            </div>
                        </div>
                    @endif
                @else
                    {{-- Handle the case when the user is not authenticated --}}
                @endif
                <div class="card-body">
                    <h5 class="card-title">List Pengambilan Obat</h5>

                    <!-- Table with stripped rows -->
                    <div class="table-responsive">
                        <table class="table datatable table-bordered">
                            <thead class="text-left">
                                <tr>
                                    <th width="3%" scope="col">No</th>
                                    <th scope="col">Nama</th>
                                    <th width="10%" scope="col">Umur</th>
                                    <th width="10%" scope="col">Unit</th>
                                    <th width="10%" scope="col">Diagnonsa</th>
                                    <th width="15%" scope="col">Keterangan</th>
                                    <th width="10%" scope="col">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($retrievals as $row)
                                    <tr>
                                        <th scope="row" class="text-center">
                                            {{ $loop->iteration + $retrievals->perPage() * ($retrievals->currentPage() - 1) }}
                                        </th>
                                        <td>{{ $row->record->name }}</td>
                                        <td>{{ $row->record->age }}</td>
                                        <td>
                                            @if ($row->record->school == 'siswa-smp')
                                                <span class="badge bg-primary text-white">Siswa SMP</span>
                                            @elseif ($row->record->school == 'siswa-smk')
                                                <span class="badge bg-info text-white">Siswa SMK</span>
                                            @elseif ($row->record->school == 'pegawai')
                                                <span class="badge bg-secondary text-white">Pegawai</span>
                                            @else
                                                {{ $row->record->school }}
                                            @endif
                                        </td>
                                        <td>{{ $row->record->diagnose }}</td>
                                        <td>{{ $row->drug->name }}&nbsp;{{ $row->keterangan }}
                                        </td>
                                        <td>
                                            {{ date('d-m-Y', strtotime($row->created_at)) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- Jika tidak pakai data-table gunakan ini -->
                        {{-- {{ $retrievals->appends(Request::all())->links('pagination::bootstrap-4') }} --}}
                        <!-- End Table with stripped rows -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addModalPrint" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><strong>Cetak Laporan Pemeriksaan</strong></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- <p>Pilih Bulan</p> --}}
                    <form class="row g-3" action="{{ route('retrieval.print') }}" target="_blank" method="GET"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="date" class="form-control" name="tgl_mulai" required>
                                <label for="floatingStatus">Dari Bulan</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="date" class="form-control" name="tgl_selesai" required>
                                <label for="floatingStatus">Sampai Bulan</label>
                            </div>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success">Cetak</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addModalPengambilan" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><strong>Tambah Pengambilan Obat</strong></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3" method="post" action="{{ route('retrieval.store') }}">
                        {{ csrf_field() }}
                        @foreach ($users as $user)
                            <input type="text" name="user_id" hidden value="{{ $user->id }}">
                        @endforeach
                        <div class="col-md-12">
                            <div class="form-floating">
                                <select name="record_id" class="form-select" id="floatingRecord" aria-label="State"
                                    required>
                                    <option value="" disabled selected hidden>Pilih Nama</option>
                                    @forelse ($records as $record)
                                        <option value="{{ $record->id }}">{{ $record->name }}&nbsp;(
                                            {{ $record->school }}
                                            )</option>
                                    @empty
                                        <option disabled selected>Data tidak ada</option>
                                    @endforelse
                                </select>
                                <label for="floatingRecord">Nama</label>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-floating">
                                <select name="drug_id" class="form-select" id="floatingDrug" aria-label="State"
                                    required>
                                    <option value="" disabled selected hidden>Pilih Obat</option>
                                    @forelse ($drugs as $drug)
                                        <option value="{{ $drug->id }}">{{ $drug->name }}&nbsp;(
                                            {{ $drug->type }}
                                            )</option>
                                    @empty
                                        <option disabled selected>Data tidak ada</option>
                                    @endforelse
                                </select>
                                <label for="floatingDrug">Nama Obat</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-floating">
                                <input name="age" type="number" class="form-control" id="floatingAge" required
                                    placeholder="Jumlah" value="{{ old('quantity') }}" min="0" max="50">
                                <label for="floatingQuantity">Jumlah</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                                <textarea style="height: 100px" name="keterangan" class="form-control" placeholder="Keterangan" required
                                    id="floatingKeterangan">{{ old('keterangan') }}</textarea>
                                <label for="floatingKeterangan">Keterangan</label>
                            </div>
                            <div class="d-grid gap-2 mt-2">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



@endsection
