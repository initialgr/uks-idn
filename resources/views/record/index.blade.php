@extends('layouts.template')

@section('title')
    Data Pemeriksaan
@endsection

@section('content')
    @include('alert.success')
    @include('alert.error')
    <div class="row">
        <div class="col-md-12">
            <div class="card recent-sales overflow-auto">
                <div class="filter" id="filterContainer">
                    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <li class="dropdown-header text-start">
                            <h6>Opsi</h6>
                        </li>
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                data-bs-target="#addModalPemeriksaan">Tambah<i class="bi bi-journal-plus ms-2"></i></a></li>
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
                                    data-bs-target="#addModalPemeriksaan"><i class="bi bi-pencil-square me-1"></i>
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
                    <h5 class="card-title">List Data Pemeriksaan</h5>

                    <!-- Table with stripped rows -->
                    <div class="table-responsive">
                        <table class="table datatable table-bordered">
                            <thead class="text-left">
                                <tr>
                                    <th width="3%" scope="col">No</th>
                                    <th width="15%" scope="col">Nama</th>
                                    <th width="3%" scope="col">Umur</th>
                                    <th scope="col">Unit</th>
                                    <th scope="col">Alergi</th>
                                    <th scope="col">Keluhan</th>
                                    <th scope="col">Pemeriksaan Fisik</th>
                                    <th scope="col">Diagnosa</th>
                                    {{-- <th scope="col">Status</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($records as $row)
                                    <tr>
                                        <th scope="row" class="text-center">
                                            {{ $loop->iteration + $records->perPage() * ($records->currentPage() - 1) }}
                                        </th>
                                        <td>{{ $row->name }}</td>
                                        <td class="text-center">{{ $row->age }}</td>
                                        <td>
                                            @if ($row->school == 'siswa-smp')
                                                <span class="badge bg-primary text-white">Siswa SMP</span>
                                            @elseif ($row->school == 'siswa-smk')
                                                <span class="badge bg-info text-white">Siswa SMK</span>
                                            @elseif ($row->school == 'pegawai')
                                                <span class="badge bg-secondary text-white">Pegawai</span>
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
                                                <span class="badge bg-warning text-white">Di UKS</span>
                                            @else
                                                <span class="badge bg-secondary text-white">Tidak Di UKS</span>
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
                            </tbody>
                        </table>
                        <!-- Jika tidak pakai data-table gunakan ini -->
                        {{-- {{ $records->appends(Request::all())->links('pagination::bootstrap-4') }} --}}
                        <!-- End Table with stripped rows -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addModalPemeriksaan" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><strong>Tambah Pemeriksaan</strong></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3" method="post" action="{{ route('record.store') }}">
                        {{ csrf_field() }}
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input name="name" type="text" class="form-control" id="floatingName" required
                                    placeholder="Nama" value="{{ old('name') }}">
                                <label for="floatingName">Nama</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-floating">
                                <input name="age" type="number" class="form-control" id="floatingAge" required
                                    placeholder="Umur" value="{{ old('umur') }}" max="50">
                                <label for="floatingAge">Umur</label>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-floating">
                                <select name="school" class="form-select" id="floatingSchool" aria-label="State" required>
                                    <option value="" disabled selected hidden>Pilih Unit</option>
                                    <option value="siswa-smp">Siswa SMP</option>
                                    <option value="siswa-smk">Siswa SMK</option>
                                    <option value="pegawai">Pegawai</option>
                                </select>
                                <label for="floatingSchool">Unit</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input name="allergy" type="text" class="form-control" id="floatingAllergy"
                                    placeholder="Riwayat Alergi" value="{{ old('allergy') }}">
                                <label for="floatingAllergy">Riwayat Alergi</label>
                                <p style="font-size: 12px" class="text-danger">&nbsp;*Jika tidak ada dilewat saja</p>
                            </div>
                        </div>
                        {{-- <div class="col-md-12">
                            <div class="form-floating">
                                <select name="status" class="form-select" id="floatingStatus" aria-label="State">
                                    <option value="1">Di UKS</option>
                                    <option value="0">Tidak Di UKS</option>
                                </select>
                                <label for="floatingStatus">Status</label>
                            </div>
                        </div> --}}
                        <div class="col-md-12">
                            <div class="form-floating">
                                <textarea name="complaint" class="form-control" placeholder="Keluhan" id="floatingComplaint" required
                                    style="height: 100px">{{ old('complaint') }}</textarea>
                                <label for="floatingComplaint">Keluhan</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                                <textarea name="ph_inspect" class="form-control" placeholder="Pemeriksaan Fisik" required
                                    id="floatingPhysicalExamination" style="height: 100px">{{ old('ph_inspect') }}</textarea>
                                <label for="floatingPhysicalExamination">Pemeriksaan Fisik</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                                <textarea name="diagnose" class="form-control" placeholder="Diagnosa" required id="floatingDiagnosis"
                                    style="height: 100px">{{ old('diagnose') }}</textarea>
                                <label for="floatingDiagnosis">Diagnosa</label>
                            </div>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
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
                    <form class="row g-3" action="{{ route('record.print') }}" target="_blank" method="GET"
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
@endsection