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
                            <h2 class="card-title"><u>Form Update Data</u></h2>
                        </div>
                        <form action="{{ route('kerjasama-lldikti.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <!-- Kolom Kiri -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="inputNamaMitra" class="form-label"><strong>Nama Mitra</strong></label>
                                        <input type="text" name="nama_mitra" class="form-control @error('nama_mitra') is-invalid @enderror" id="inputNamaMitra" value="{{ old('nama_mitra', $data->nama_mitra) }}" placeholder="Nama Mitra">
                                        @error('nama_mitra')
                                            <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputPerihal" class="form-label"><strong>Perihal</strong></label>
                                        <textarea class="form-control @error('perihal') is-invalid @enderror" style="height:150px" name="perihal" id="inputPerihal" placeholder="Perihal">{{ old('perihal', $data->perihal) }}</textarea>
                                        @error('perihal')
                                            <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputTahun" class="form-label"><strong>Tahun</strong></label>
                                        <input type="number" name="tahun" class="form-control @error('tahun') is-invalid @enderror" id="inputTahun" value="{{ old('tahun', $data->tahun) }}" placeholder="Tahun">
                                        @error('tahun')
                                            <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputJenisMitra" class="form-label"><strong>Jenis Mitra</strong></label>
                                        <select name="jenis_mitra" class="form-control @error('jenis_mitra') is-invalid @enderror" id="inputJenisMitra">
                                            <option value="" disabled>Pilih Jenis Mitra</option>
                                            @foreach ($jenismitra as $mitra)
                                                <option value="{{ $mitra->id }}" {{ $data->jenis_mitra == $mitra->id ? 'selected' : '' }}>{{ $mitra->nama }}</option>
                                            @endforeach
                                        </select>
                                        @error('jenis_mitra')
                                            <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputJenisKerjasama" class="form-label"><strong>Jenis Kerjasama</strong></label>
                                        <select name="jenis_kerjasama" class="form-control @error('jenis_kerjasama') is-invalid @enderror" id="inputJenisKerjasama">
                                            <option value="" disabled>Pilih Jenis Kerjasama</option>
                                            @foreach ($jeniskerjasama as $kerjasama)
                                                <option value="{{ $kerjasama->id }}" {{ $data->jenis_kerjasama == $kerjasama->id ? 'selected' : '' }}>{{ $kerjasama->nama }}</option>
                                            @endforeach
                                        </select>
                                        @error('jenis_kerjasama')
                                            <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Kolom Kanan -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="inputMasaBerlaku" class="form-label"><strong>Masa Berlaku</strong></label>
                                        <div class="input-group">
                                            <input type="number" name="masa_berlaku_mou_tahun" class="form-control @error('masa_berlaku_mou_tahun') is-invalid @enderror" id="inputMasaBerlaku" value="{{ old('masa_berlaku_mou_tahun', $data->masa_berlaku) }}" placeholder="Masa Berlaku">
                                            <span class="input-group-text">Tahun</span>
                                        </div>
                                        @error('masa_berlaku_mou_tahun')
                                            <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputMulaiBerlaku" class="form-label"><strong>Mulai Berlaku</strong></label>
                                        <input type="date" name="mulai_berlaku" class="form-control @error('mulai_berlaku') is-invalid @enderror" id="inputMulaiBerlaku" value="{{ old('mulai_berlaku', $data->mulai_berlaku) }}">
                                        @error('mulai_berlaku')
                                            <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputKadaluarsa" class="form-label"><strong>Kadaluarsa</strong></label>
                                        <input type="date" name="tanggal_kadaluarsa" class="form-control @error('tanggal_kadaluarsa') is-invalid @enderror" id="inputKadaluarsa" value="{{ old('tanggal_kadaluarsa', $data->kadaluarsa) }}">
                                        @error('tanggal_kadaluarsa')
                                            <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputNomorAgendaMitra" class="form-label"><strong>Nomor Agenda Mitra</strong></label>
                                        <input type="text" name="nomor_agenda_mitra" class="form-control @error('nomor_agenda_mitra') is-invalid @enderror" id="inputNomorAgendaMitra" value="{{ old('nomor_agenda_mitra', $data->nomor_agenda_mitra) }}" placeholder="Nomor Agenda Mitra">
                                        @error('nomor_agenda_mitra')
                                            <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputNomorAgendaLldikti" class="form-label"><strong>Nomor Agenda LLDikti</strong></label>
                                        <input type="text" name="nomor_agenda_lldikti" class="form-control @error('nomor_agenda_lldikti') is-invalid @enderror" id="inputNomorAgendaLldikti" value="{{ old('nomor_agenda_lldikti', $data->nomor_agenda_lldikti) }}" placeholder="Nomor Agenda LLDikti">
                                        @error('nomor_agenda_lldikti')
                                            <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputStatusDokumen" class="form-label"><strong>Status Dokumen:</strong></label>
                                        <select
                                            name="status_dokumen"
                                            class="form-control @error('status_dokumen') is-invalid @enderror"
                                            id="inputStatusDokumen">
                                            <option value="" disabled>Pilih Status</option>
                                            @foreach ($status as $status_dokument)
                                                <option value="{{ $status_dokument->id }}" {{ $data->status_dokumen == $status_dokument->id ? 'selected' : '' }}>{{ $status_dokument->nama }}</option>
                                            @endforeach
                                        </select>
                                        @error('status_dokumen')
                                            <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="inputKeteranganDokumen" class="form-label"><strong>Keterangan Dokumen:</strong></label>
                                <textarea
                                    class="form-control @error('keterangan_dokumen') is-invalid @enderror"
                                    style="height:150px"
                                    name="keterangan_dokumen"
                                    id="inputKeteranganDokumen"
                                    placeholder="Keterangan Dokumen">{{ old('keterangan_dokumen', $data->keterangan_dokumen) }}</textarea>
                                @error('keterangan_dokumen')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="jenisFile" class="form-label"><strong>Pilih Tipe File:</strong></label>
                                <select
                                    name="jenis_file"
                                    class="form-control @error('jenis_file') is-invalid @enderror"
                                    id="jenisFile"
                                    onchange="toggleInputField()">
                                    <option value="" disabled>Pilih tipe file</option>
                                    <option value="google_drive" {{ $data->jenis_file == 'google_drive' ? 'selected' : '' }}>Google Drive</option>
                                    <option value="file_upload" {{ $data->jenis_file == 'file_upload' ? 'selected' : '' }}>File Upload</option>
                                </select>
                                @error('jenis_file')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3" id="googleDriveField" style="display: {{ $data->jenis_file == 'google_drive' ? 'block' : 'none' }};">
                                <label for="inputGoogleDrive" class="form-label"><strong>Link Google Drive:</strong></label>
                                <textarea
                                    name="link_dokument"
                                    class="form-control @error('link_dokument') is-invalid @enderror"
                                    id="inputGoogleDrive"
                                    placeholder="Masukkan link Google Drive di sini..."
                                    rows="3">{{ old('link_dokument', $data->file) }}</textarea>
                                @error('link_dokument')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3" id="fileUploadField" style="display: {{ $data->jenis_file == 'file_upload' ? 'block' : 'none' }};">
                                <label for="inputFileUpload" class="form-label"><strong>Upload File:</strong></label>
                                <input
                                    type="file"
                                    name="file"
                                    class="form-control @error('file') is-invalid @enderror"
                                    id="inputFileUpload">
                                @error('file')
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
                                    placeholder="Bentuk Tindak Lanjut">{{ old('bentuk_tindak_lanjut', $data->bentuk_tindak_lanjut) }}</textarea>
                                @error('bentuk_tindak_lanjut')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 text-end">
                                <button type="submit" class="btn btn-primary">Update</button>
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
    <script>
    $(document).ready(function () {
        $('#mytable').DataTable();
    });
    </script>
    <script>
        function toggleInputField() {
            const selectedType = document.getElementById('jenisFile').value;
            const googleDriveField = document.getElementById('googleDriveField');
            const fileUploadField = document.getElementById('fileUploadField');

            if (selectedType === 'google_drive') {
                googleDriveField.style.display = 'block';
                fileUploadField.style.display = 'none';
            } else if (selectedType === 'file_upload') {
                googleDriveField.style.display = 'none';
                fileUploadField.style.display = 'block';
            } else {
                googleDriveField.style.display = 'none';
                fileUploadField.style.display = 'none';
            }
        }
    </script>
@endsection
