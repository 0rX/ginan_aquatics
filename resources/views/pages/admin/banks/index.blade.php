@extends('layouts.admin')

@section('content')
    <section class="py-5">
        <div class="container">
            <div class="d-flex flex-wrap gap-2 align-items-center justify-content-between mb-5">
                <h4 class="text-dark fw-semibold">Manajemen Akun Bank</h4>
                <button type="button" data-bs-toggle="modal" data-bs-target="#addModal"
                    class="btn btn-primary d-flex align-items-center gap-2">
                    <i class="bx bx-plus"></i> Tambah Akun Bank
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
                                        <th class="fs-7 text-uppercase">atas nama</th>
                                        <th class="fs-7 text-uppercase">nomor rekening</th>
                                        <th class="fs-7 text-uppercase"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $item)
                                        <tr style="vertical-align: middle">
                                            <td>
                                                @if ($item->bank_name == 'Mandiri')
                                                    <img src="{{ url('assets/images/bank-logo/mandiri-logo.png') }}"
                                                        alt="Logo Bank Mandiri" style="width: 100px">
                                                @elseif($item->bank_name == 'BNI')
                                                    <img src="{{ url('assets/images/bank-logo/bni-logo.png') }}"
                                                        alt="Logo Bank BNI" style="width: 100px">
                                                @elseif($item->bank_name == 'BCA')
                                                    <img src="{{ url('assets/images/bank-logo/bca-logo.png') }}"
                                                        alt="Logo Bank BCA" style="width: 100px">
                                                @elseif($item->bank_name == 'BRI')
                                                    <img src="{{ url('assets/images/bank-logo/bri-logo.png') }}"
                                                        alt="Logo Bank BRI" style="width: 100px">
                                                @elseif($item->bank_name == 'DANA')
                                                    <img src="{{ url('assets/images/bank-logo/dana-logo.png') }}"
                                                        alt="Logo DANA" style="width: 100px">
                                                @elseif($item->bank_name == 'Gopay')
                                                    <img src="{{ url('assets/images/bank-logo/gopay-logo.png') }}"
                                                        alt="Logo Gopay" style="width: 100px">
                                                @endif
                                            </td>
                                            <td>{{ $item->account_name }}</td>
                                            <td>{{ $item->account_number }}</td>
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <button type="button" data-bs-toggle="modal"
                                                        data-bs-target="#editUser{{ $item->id }}"
                                                        class="btn btn-sm py-2 btn-warning d-flex align-items-center justify-content-center">
                                                        <i class='bx bx-edit'></i>
                                                    </button>
                                                    <form action="{{ route('bank.destroy', $item->id) }}" method="post"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-danger btn-sm py-2 d-flex align-items-center justify-content-center"
                                                            onclick="return confirm('Are you sure to deleted this?')">
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
                                                        <form action="{{ route('bank.update', $item->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="mb-3">
                                                                <label for="bank_name">Bank</label>
                                                                <select class="form-control" name="bank_name"
                                                                    id="bank_name">
                                                                    <option value="Mandiri"
                                                                        {{ $item->bank_name == 'Mandiri' ? 'selected' : '' }}>
                                                                        Mandiri
                                                                    </option>
                                                                    <option value="BNI"
                                                                        {{ $item->bank_name == 'BNI' ? 'selected' : '' }}>
                                                                        BNI
                                                                    </option>
                                                                    <option value="BCA"
                                                                        {{ $item->bank_name == 'BCA' ? 'selected' : '' }}>
                                                                        BCA
                                                                    </option>
                                                                    <option value="BRI"
                                                                        {{ $item->bank_name == 'BRI' ? 'selected' : '' }}>
                                                                        BRI
                                                                    </option>
                                                                    <option value="DANA"
                                                                        {{ $item->bank_name == 'DANA' ? 'selected' : '' }}>
                                                                        DANA
                                                                    </option>
                                                                    <option value="Gopay"
                                                                        {{ $item->bank_name == 'Gopay' ? 'selected' : '' }}>
                                                                        Gopay
                                                                    </option>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="account_name">Nama Akun</label>
                                                                <input type="text" name="account_name" id="account_name"
                                                                    class="form-control" value="{{ $item->account_name }}"
                                                                    required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="account_number">Nomor Rekening</label>
                                                                <input type="text" name="account_number"
                                                                    id="account_number" class="form-control"
                                                                    value="{{ $item->account_number }}" required>
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
                        <p class="mb-0 text-danger text-center">Belum ada akun bank</p>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Tambah Bank Baru</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('bank.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="bank_name">Bank</label>
                            <select class="form-control" name="bank_name" id="bank_name">
                                <option value="Mandiri">Mandiri</option>
                                <option value="BNI">BNI</option>
                                <option value="BCA">BCA</option>
                                <option value="BRI">BRI</option>
                                <option value="DANA">DANA</option>
                                <option value="Gopay">Gopay</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="account_name">Nama Akun</label>
                            <input type="text" name="account_name" id="account_name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="account_number">Nomor Rekening</label>
                            <input type="text" name="account_number" id="account_number" class="form-control"
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
