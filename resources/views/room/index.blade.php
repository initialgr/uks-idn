@extends('layouts.template')

@section('title')
    Data Pasien di Uks
@endsection

@section('content')
    @include('alert.success')
    @include('alert.error')
    <div class="row">
        <div class="col-12">
            <div class="card recent-sales overflow-auto">
                <div class="card-body">
                    <h5 class="card-title">List Data Pasien</h5>

                    <!-- Table with stripped rows -->
                    <div class="table-responsive">
                        <table class="table datatable table-bordered">
                            <thead class="text-left">
                                <tr>
                                    <th width="3%" scope="col">No</th>
                                    <th width="20%" scope="col">Nama</th>
                                    <th width="8%" scope="col">Unit</th>
                                    <th width="30%" scope="col">Diagnosa</th>
                                    <th width="5%" scope="col">Status</th>
                                    <th width="20%" scope="col">Aksi</th>
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
                                        <td>{{ $row->diagnose }}</td>
                                        <td>
                                            @if ($row->status == '1')
                                                <span class="badge bg-warning">Di UKS</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button type="submit" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#modalSehat{{ $row->id }}">Sudah Sembuh</button>
                                            <button type="submit" class="btn btn-secondary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#modalSehat{{ $row->id }}">Tidak Di UKS</button>
                                        </td>

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

    @foreach ($records as $row)
        <div class="modal fade" id="modalSehat{{ $row->id }}" tabindex="-1">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><strong>Apakah kamu yakin?</strong></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="row g-3" method="post" action="{{ route('room.store') }}"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="hidden" name="record_id" value="{{ $row->id }}">
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Yakin</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
