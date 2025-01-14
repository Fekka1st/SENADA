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
                            <h2 class="card-title"><u>Form Tambah Data </u></h2>
                        </div>
                        <form action="{{route('kerjasama-lldikti.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="inputNamaMitra" class="form-label"><strong>Nama Mitra</strong></label>
                                <input
                                    type="text"
                                    name="nama_mitra"
                                    class="form-control @error('nama_mitra') is-invalid @enderror"
                                    id="inputNamaMitra"
                                    placeholder="Nama Mitra">
                                @error('nama_mitra')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="inputPerihal" class="form-label"><strong>Perihal:</strong></label>
                                <textarea
                                    class="form-control @error('perihal') is-invalid @enderror"
                                    style="height:150px"
                                    name="perihal"
                                    id="inputPerihal"
                                    placeholder="Perihal"></textarea>
                                @error('perihal')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="inputTahun" class="form-label"><strong>Tahun:</strong></label>
                                <input
                                    type="number"
                                    name="tahun"
                                    class="form-control @error('tahun') is-invalid @enderror"
                                    id="inputTahun"
                                    placeholder="Tahun">
                                @error('tahun')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="inputJenisMitra" class="form-label"><strong>Jenis Mitra:</strong></label>
                                <input
                                    type="text"
                                    name="jenis_mitra"
                                    class="form-control @error('jenis_mitra') is-invalid @enderror"
                                    id="inputJenisMitra"
                                    placeholder="Jenis Mitra">
                                @error('jenis_mitra')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="inputJenisKerjasama" class="form-label"><strong>Jenis Kerjasama:</strong></label>
                                <input
                                    type="text"
                                    name="jenis_kerjasama"
                                    class="form-control @error('jenis_kerjasama') is-invalid @enderror"
                                    id="inputJenisKerjasama"
                                    placeholder="Jenis Kerjasama">
                                @error('jenis_kerjasama')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="inputMasaBerlaku" class="form-label"><strong>Masa Berlaku:</strong></label>
                                <div class="input-group">
                                    <input
                                        type="number"
                                        name="masa_berlaku_mou_tahun"
                                        class="form-control @error('masa_berlaku_mou_tahun') is-invalid @enderror"
                                        id="inputMasaBerlaku"
                                        placeholder="Masa Berlaku"
                                        aria-label="Masa Berlaku">
                                    <span class="input-group-text">Tahun</span>
                                </div>
                                @error('masa_berlaku_mou_tahun')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="inputMulaiBerlaku" class="form-label"><strong>Mulai Berlaku:</strong></label>
                                <input
                                    type="date"
                                    name="mulai_berlaku"
                                    class="form-control @error('mulai_berlaku') is-invalid @enderror"
                                    id="inputMulaiBerlaku">
                                @error('mulai_berlaku')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="inputKadaluarsa" class="form-label"><strong>Kadaluarsa:</strong></label>
                                <input
                                    type="date"
                                    name="tanggal_kadaluarsa"
                                    class="form-control @error('tanggal_kadaluarsa') is-invalid @enderror"
                                    id="inputKadaluarsa">
                                @error('tanggal_kadaluarsa')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="inputNomorAgendaMitra" class="form-label"><strong>Nomor Agenda Mitra:</strong></label>
                                <input
                                    type="text"
                                    name="nomor_agenda_mitra"
                                    class="form-control @error('nomor_agenda_mitra') is-invalid @enderror"
                                    id="inputNomorAgendaMitra"
                                    placeholder="Nomor Agenda Mitra">
                                @error('nomor_agenda_mitra')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="inputNomorAgendaLldikti" class="form-label"><strong>Nomor Agenda LLDikti:</strong></label>
                                <input
                                    type="text"
                                    name="nomor_agenda_lldikti"
                                    class="form-control @error('nomor_agenda_lldikti') is-invalid @enderror"
                                    id="inputNomorAgendaLldikti"
                                    placeholder="Nomor Agenda LLDikti">
                                @error('nomor_agenda_lldikti')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="inputStatusDokumen" class="form-label"><strong>Status Dokumen:</strong></label>
                                <select
                                    name="status_dokumen"
                                    class="form-select @error('status_dokumen') is-invalid @enderror"
                                    id="inputStatusDokumen">
                                    <option value="">Pilih Status</option>
                                    <option value="Lengkap">Lengkap</option>
                                    <option value="Tidak Lengkap">Tidak Lengkap</option>
                                </select>
                                @error('status_dokumen')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="inputKeteranganDokumen" class="form-label"><strong>Keterangan Dokumen:</strong></label>
                                <textarea
                                    class="form-control @error('keterangan_dokumen') is-invalid @enderror"
                                    style="height:150px"
                                    name="keterangan_dokumen"
                                    id="inputKeteranganDokumen"
                                    placeholder="Keterangan Dokumen"></textarea>
                                @error('keterangan_dokumen')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="inputFile" class="form-label"><strong>File (Link Google Drive):</strong></label>
                                <textarea
                                    name="link_dokumen"
                                    class="form-control @error('link_dokumen') is-invalid @enderror"
                                    id="inputFile"
                                    placeholder="Masukkan link Google Drive di sini..."
                                    rows="3"></textarea>
                                @error('link_dokumen')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="inputBentukTindakLanjut" class="form-label"><strong>Bentuk Tindak Lanjut:</strong></label>
                                <textarea
                                    class="form-control @error('bentuk_tindak_lanjut') is-invalid @enderror"
                                    style="height:150px"
                                    name="bentuk_tindak_lanjut"
                                    id="inputBentukTindakLanjut"
                                    placeholder="Bentuk Tindak Lanjut"></textarea>
                                @error('bentuk_tindak_lanjut')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 d-flex justify-content-between">
                                {{-- <a class="btn btn-primary" href="{{ route('datamou.index') }}"> --}}
                                    <i class="fa fa-arrow-left"></i> Kembali
                                </a>
                                <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer">
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2025.
                <a href="" target="_blank">LLDIKTI IV</a> All rights reserved.</span>
        </div>
    </footer>
    <!-- partial -->
</div>
@endsection


@section('script')
    <script>
    $(document).ready(function () {
        $('#mytable').DataTable();
    });
    </script>
@endsection
