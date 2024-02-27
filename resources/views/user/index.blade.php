@extends('layouts.template')

@section('title')
    Data User
@endsection

@section('content')
    @include('alert.success')
    @include('alert.error')
    <div class="row">
        <div class="col-md-12">
            <div class="card recent-sales overflow-auto">
                @if (Auth::check())
                    @if (Auth::user()->level == 'admin')
                        <div class="filter">
                            <div class="icon">
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#addModalUser"><i class="bi bi-pencil-square me-1"></i> Tambah</button>
                            </div>
                        </div>
                    @endif
                @else
                @endif
                <div class="card-body">
                    <h5 class="card-title">List Data User</h5>

                    <!-- Table with stripped rows -->
                    <div class="table-responsive">
                        <table class="table datatable table-bordered">
                            <thead>
                                <tr>
                                    <th width="5%" scope="col">No</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Level</th>
                                    <th width="10%" scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user as $row)
                                    <tr>
                                        <th scope="row">
                                            {{ $loop->iteration + $user->perpage() * ($user->currentPage() - 1) }}
                                        </th>
                                        <td>{{ $row->name }}</td>
                                        <td>{{ $row->username }}</td>
                                        <td class="text-uppercase">{{ $row->level }}</td>
                                        <td>
                                            @if (Auth::check() && Auth::user()->level == 'admin' && $row->level != 'admin')
                                                <form method="post" action="{{ route('user.destroy', [$row->id]) }}">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="bi bi-trash2-fill me-1"></i> Hapus
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- Jika tidak pakai data-table gunakan ini -->
                        {{ $user->appends(Request::all())->links('pagination::bootstrap-4') }}
                        <!-- End Table with stripped rows -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addModalUser" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><strong>Tambah User</strong></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3" method="post" action="{{ route('user.store') }}">
                        {{ csrf_field() }}
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input name="name" type="text" class="form-control" id="floatingName"
                                    placeholder="Nama" value="{{ old('name') }}">
                                <label for="floatingName">Nama</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input name="username" type="text" class="form-control" id="floatingUsername"
                                    placeholder="Username">
                                <label for="floatingUsername">Username</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input name="password" type="password" class="form-control" id="floatingPassword"
                                    placeholder="Password">
                                <label for="floatingPassword">Password</label>
                                <div style="font-size: 12px" id="passwordAlert" class="text-danger d-none">*Password minimal
                                    6 karakter</div>
                            </div>
                        </div>

                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                document.getElementById("floatingPassword").addEventListener("keyup", function() {
                                    var password = this.value;
                                    var alertDiv = document.getElementById("passwordAlert");
                                    if (password.length < 6) {
                                        alertDiv.classList.remove("d-none");
                                    } else {
                                        alertDiv.classList.add("d-none");
                                    }
                                });
                            });
                        </script>

                        <div class="col-md-12">
                            <div class="form-floating">
                                <select name="level" class="form-select" id="floatingLevel" aria-label="State">
                                    <option value="staff">Staff</option>
                                    {{-- <option value="admin">Admin</option> --}}
                                </select>
                                <label for="floatingLevel">Level</label>
                            </div>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection
