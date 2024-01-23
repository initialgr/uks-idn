@extends('layouts.template')

@section('title')
    Data Obat
@endsection

@section('content')
    @include('alert.success')
    @include('alert.error')
    <div class="row">
        <div class="col-12">
            <div class="card recent-sales overflow-auto">
                <div class="filter" id="filterContainer">
                    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <li class="dropdown-header text-start">
                            <h6>Opsi</h6>
                        </li>
                        <li><button type="submit" class="dropdown-item" data-bs-toggle="modal"
                                data-bs-target="#addModalObat">Tambah<i class="bi bi-archive ms-2"></i></button></li>
                        <li><a class="dropdown-item" href="{{ route('drug.print') }}" target="_blank">Print Laporan<i
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
                                    data-bs-target="#addModalObat"><i class="bi bi-pencil-square me-1"></i>
                                    Tambah</button>
                                <a href="{{ route('drug.print') }}" class="btn btn-success btn-sm" target="_blank"><i
                                        class="bi bi-file-earmark-pdf me-1"></i>
                                    Print Laporan</a>
                            </div>
                        </div>
                    @endif
                @else
                    {{-- Handle the case when the user is not authenticated --}}
                @endif

                <div class="card-body">
                    <h5 class="card-title">List Data Obat</h5>

                    <!-- Table with stripped rows -->
                    <div class="table-responsive">
                        <table class="table datatable table-bordered">
                            <thead class="text-left">
                                <tr>
                                    <th width="3%" scope="col">No</th>
                                    <th scope="col">Nama</th>
                                    <th width="10%" scope="col">Jenis</th>
                                    <th width="10%" scope="col">Dosis</th>
                                    <th width="10%" scope="col">Stok</th>
                                    @if (Auth::check() && (Auth::user()->level == 'admin' || Auth::user()->level == 'staff'))
                                        <th width="10%" scope="col">Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($drugs as $row)
                                    <tr>
                                        <th scope="row" class="text-center">
                                            {{ $loop->iteration + $drugs->perPage() * ($drugs->currentPage() - 1) }}
                                        </th>
                                        <td>{{ $row->name }}</td>
                                        <td>{{ $row->type }}</td>
                                        <td>{{ $row->dose }}{{ $row->unit }}</td>
                                        <td>{{ $row->stok }}&nbsp;{{ $row->satuan }}</td>
                                        @if (Auth::check() && (Auth::user()->level == 'admin' || Auth::user()->level == 'staff'))
                                            <td>
                                                <button type="submit" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#addModalStok{{ $row->id }}"><i
                                                        class="bi bi-plus-lg me-1"></i>Stok</button>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- Jika tidak pakai data-table gunakan ini -->
                        {{ $drugs->appends(Request::all())->links('pagination::bootstrap-4') }}
                        <!-- End Table with stripped rows -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addModalObat" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><strong>Tambah Obat</strong></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3" method="post" action="{{ route('drug.store') }}">
                        {{ csrf_field() }}
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input name="name" type="text" class="form-control" id="floatingName" required
                                    placeholder="Nama" value="{{ old('name') }}">
                                <label for="floatingName">Nama</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                                <select name="type" class="form-select" id="floatingType"
                                    aria-label="Floating label select example" required>
                                    <option value="" disabled selected hidden>Pilih Jenis</option>
                                    <option value="Tablet">Tablet</option>
                                    <option value="Kapsul">Kapsul</option>
                                    <option value="Sirup">Sirup</option>
                                    <option value="Salep">Salep</option>
                                    <option value="Krim">Krim</option>
                                    <option value="Injeksi">Injeksi</option>
                                    <option value="Infus">Infus</option>
                                    <option value="Tetes">Tetes</option>
                                    <option value="Inhalasi">Inhalasi</option>
                                    <option value="Suppositoria">Suppositoria</option>
                                    <option value="Emulsi">Emulsi</option>
                                    <option value="Larutan">Larutan</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                                <label for="floatingType">Jenis</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input name="dose" type="number" class="form-control" id="floatingDose" required
                                    placeholder="Dosis" value="{{ old('dose') }}">
                                <label for="floatingDose">Dosis</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-floating">
                                <select name="unit" class="form-select" id="floatingUnit" required
                                    aria-label="Floating label select example">
                                    <option value="" selected disabled hidden>Pilih</option>
                                    <option value="mg">mg</option>
                                    <option value="ml">ml</option>
                                    <option value="gram">gram</option>
                                </select>
                                <label for="floatingUnit">Satuan</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-floating">
                                <input max="100" name="stok" type="number" class="form-control" required
                                    id="floatingStok" placeholder="Stok" value="{{ old('stok') }}">
                                <label for="floatingStok">Stok</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-floating">
                                <select name="satuan" class="form-select" id="floatingSatuan" required
                                    aria-label="Floating label select example">
                                    <option value="" selected disabled hidden>Pilih</option>
                                    <option value="pack">pack</option>
                                    <option value="strip">strip</option>
                                    <option value="botol">botol</option>
                                    <option value="ampul">ampul</option>
                                    <option value="kotak">kotak</option>
                                </select>
                                <label for="floatingSatuan">Satuan</label>
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

    @foreach ($drugs as $row)
        <div class="modal fade" id="addModalStok{{ $row->id }}" tabindex="-1">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><strong>Tambah Stok Obat {{ $row->name }}</strong></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="row g-3" method="post" action="{{ route('drug.stock') }}"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="hidden" name="drug_id" value="{{ $row->id }}">
                            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input max="100" name="stock" type="number" class="form-control"
                                        id="floatingStok" placeholder="Stock" value="{{ old('stock') }}">
                                    <label for="floatingStok">Stok</label>
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
    @endforeach
@endsection
