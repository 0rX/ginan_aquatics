@extends('layouts.admin')

@section('content')
    <section class="py-5">
        <div class="container">
            <div class="d-flex flex-wrap gap-2 align-items-center justify-content-between mb-5">
                <h4 class="text-dark fw-semibold">Manajemen User Admin</h4>
                <button type="button" data-bs-toggle="modal" data-bs-target="#addModal"
                    class="btn btn-primary d-flex align-items-center gap-2">
                    <i class="bx bx-plus"></i> Tambah User Admin
                </button>
            </div>

            <div class="card border-light rounded-0">
                <div class="card-body">
                    @if ($items->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="fs-7 text-uppercase">#</th>
                                        <th class="fs-7 text-uppercase">nama</th>
                                        <th class="fs-7 text-uppercase">email</th>
                                        <th class="fs-7 text-uppercase"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $key => $item)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <button type="button" data-bs-toggle="modal"
                                                        data-bs-target="#editUser{{ $item->id }}"
                                                        class="btn btn-sm py-2 btn-warning d-flex align-items-center justify-content-center">
                                                        <i class='bx bx-edit'></i>
                                                    </button>
                                                    <form action="{{ route('user.destroy', $item->id) }}" method="post"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-danger btn-sm py-2 d-flex align-items-center justify-content-center"
                                                            onclick="return confirm('Are you sure to deleted this?')"
                                                            {{ $item->id == 1 ? 'disabled' : '' }}>
                                                            <i class="bx bx-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="editUser{{ $item->id }}" tabindex="-1"
                                            aria-labelledby="editUserLabel{{ $item->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="editUserLabel{{ $item->id }}">
                                                            Edit User {{ $item->name }}
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('user.update', $item->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="mb-3">
                                                                <label for="name">Nama</label>
                                                                <input type="text" name="name" id="name"
                                                                    value="{{ $item->name }}" class="form-control"
                                                                    required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="email">Alamat Email</label>
                                                                <input type="email" name="email" id="email"
                                                                    value="{{ $item->email }}" class="form-control"
                                                                    required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="password">Password</label>
                                                                <input type="password" minlength="8" name="password"
                                                                    id="password" class="form-control">
                                                                <span class="text-secondary fs-7">
                                                                    Jangan diisi jika tidak ingin mengganti password
                                                                </span>
                                                            </div>
                                                            <button class="btn btn-primary px-4" type="submit">
                                                                Simpan Perubahan
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="mb-0 text-danger text-center">Belum ada user</p>
                    @endif
                </div>
            </div>
    </section>

    <div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Tambah User Baru</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('user.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="name">Nama</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="email">Alamat Email</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="password">Password</label>
                            <input type="password" minlength="8" name="password" id="password" class="form-control"
                                required>
                        </div>
                        <button class="btn btn-primary px-4" type="submit">
                            Simpan Baru
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
