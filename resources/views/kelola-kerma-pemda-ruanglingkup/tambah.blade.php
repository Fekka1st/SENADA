@extends('layouts.master')

@section('breadcum', 'Dashboard')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h2 class="card-title text-primary"><u>Form Tambah Data</u></h2>
                        </div>
                        <form action="{{ route('kerma-pemda-ruanglingkup.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <!-- Left Column -->
                                <div class="col-md-6">
                                    <!-- Nama Pemda -->
                                    <div class="mb-3">
                                        <label for="nama_pemda" class="form-label"><strong>Nama Pemda</strong></label>
                                        <select name="nama_pemda"
                                            class="form-control @error('nama_pemda') is-invalid @enderror"
                                            id="inputNamaPemda">
                                            <option value="" disabled selected>Pilih Nama Pemda</option>
                                            @if($datapemda)

                                            @foreach ($datapemda as $pemda)
                                            <option value="{{ $pemda->id }}"
                                                {{ old('nama_pemda') == $pemda->id ? 'selected' : '' }}>
                                                {{ $pemda->nama_pemda }}
                                            </option>
                                            @endforeach

                                            @endif

                                        </select>
                                        @error('nama_pemda')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Ruang Lingkup -->
                                    <div class="mb-3">
                                        <label for="ruang_lingkup" class="form-label"><strong>Ruang
                                                Lingkup</strong></label>
                                        <select name="ruang_lingkup"
                                            class="form-control @error('ruang_lingkup') is-invalid @enderror"
                                            id="inputRuangLingkup">
                                            <option value="" disabled selected>Pilih Ruang Lingkup</option>
                                            @if($datapemda)
                                            @foreach ($dataruanglingkup as $ruanglingkup)
                                            <option value="{{ $ruanglingkup->id }}"
                                                {{ old('ruang_lingkup') == $ruanglingkup->id ? 'selected' : '' }}>
                                                {{ $ruanglingkup->nama_ruanglingkup }}
                                            </option>
                                            @endforeach
                                            @endif
                                        </select>
                                        @error('ruang_lingkup')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Tanggal Mulai Pelaksanaan -->
                                    <div class="mb-3">
                                        <label for="tgl_mulai" class="form-label"><strong>Tanggal Mulai
                                                Pelaksanaan</strong></label>
                                        <input type="date" name="tgl_mulai"
                                            class="form-control @error('tgl_mulai') is-invalid @enderror"
                                            id="inputTglMulai" value="{{ old('tgl_mulai') }}">
                                        @error('tgl_mulai')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Tanggal Berakhir Pelaksanaan -->
                                    <div class="mb-3">
                                        <label for="tgl_berakhir" class="form-label"><strong>Tanggal Berakhir
                                                Pelaksanaan</strong></label>
                                        <input type="date" name="tgl_berakhir"
                                            class="form-control @error('tgl_berakhir') is-invalid @enderror"
                                            id="inputTglBerakhir" value="{{ old('tgl_berakhir') }}">
                                        @error('tgl_berakhir')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Right Column -->
                                <div class="col-md-6">
                                    <!-- KPI Program -->
                                    <div class="mb-3">
                                        <label for="nama_program" class="form-label"><strong>Nama Program</strong></label>
                                        <input type="text" name="nama_program"
                                            class="form-control @error('nama_program') is-invalid @enderror"
                                            id="inputNamaprogram" placeholder="Masukkan Nama Program"
                                            value="{{ old('nama_program') }}">
                                        @error('nama_program')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="kpi_program" class="form-label"><strong>KPI Program</strong></label>
                                        <input type="text" name="kpi_program"
                                            class="form-control @error('kpi_program') is-invalid @enderror"
                                            id="inputKpiProgram" placeholder="Masukkan KPI Program"
                                            value="{{ old('kpi_program') }}">
                                        @error('kpi_program')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Pencapaian Program -->
                                    <div class="mb-3">
                                        <label for="pencapaian_program" class="form-label"><strong>Pencapaian
                                                Program</strong></label>
                                        <input type="text" name="pencapaian_program"
                                            class="form-control @error('pencapaian_program') is-invalid @enderror"
                                            id="inputPencapaianProgram" placeholder="Masukkan Pencapaian Program"
                                            value="{{ old('pencapaian_program') }}">
                                        @error('pencapaian_program')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Evaluasi Program -->
                                    <div class="mb-3">
                                        <label for="evaluasi_program" class="form-label"><strong>Evaluasi
                                                Program</strong></label>
                                        <input type="text" name="evaluasi_program"
                                            class="form-control @error('evaluasi_program') is-invalid @enderror"
                                            id="inputEvaluasiProgram" placeholder="Masukkan Evaluasi Program"
                                            value="{{ old('evaluasi_program') }}">
                                        @error('evaluasi_program')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="dukungan_pihak_lain" class="form-label"><strong>Dukungan Pihak Lain</strong></label>
                                        <textarea name="dukungan_pihak_lain"
                                            class="form-control @error('dukungan_pihak_lain') is-invalid @enderror"
                                            id="dukunganPihakLain"
                                            placeholder="Masukkan dukungan pihak lain, pisahkan setiap dukungan dengan tanda (,) (contoh: dukungan1, dukungan2 dst)">{{ old('dukungan_pihak_lain') }}</textarea>
                                        @error('dukungan_pihak_lain')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- Submit Button -->
                            <div class="mb-3 text-end">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


@section('script')

@endsection
