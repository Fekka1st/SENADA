@extends('layouts.master')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white text-center">
            <h3 class="mb-0">Detail Data Kerjasama <br>{{ $data->nama_mitra }} </h3>
        </div>
        <div class="card-body" id="content-to-print">
            <!-- Informasi Umum -->
            <div class="row mb-3">
                <div class="col-md-12">
                    <h5 class="text-primary font-weight-bold">Informasi Umum</h5>
                    <hr>
                </div>
                <div class="col-md-6 mb-3">
                    <p class="mb-1 text-muted">Judul Kerjasama</p>
                    <h6 class="font-weight-bold">{{ $data->nama_mitra }}</h6>
                </div>
                <div class="col-md-6 mb-3">
                    <p class="mb-1 text-muted">Tahun</p>
                    <h6 class="font-weight-bold">{{ $data->tahun }}</h6>
                </div>
                <div class="col-md-6 mb-3">
                    <p class="mb-1 text-muted">Jenis Kerjasama</p>
                    <h6 class="font-weight-bold">{{ $data->jenis_kerjasama->nama }}</h6>
                </div>
                <div class="col-md-6 mb-3">
                    <p class="mb-1 text-muted">Jenis Mitra</p>
                    <h6 class="font-weight-bold">{{ $data->jenis_mitra->nama }}</h6>
                </div>
                <div class="col-md-6 mb-3">
                    <p class="mb-1 text-muted">Perihal</p>
                    <h6 class="font-weight-bold">{{ $data->perihal }}</h6>
                </div>
                <div class="col-md-6 mb-3">
                    <p class="mb-1 text-muted">Masa Berlaku</p>
                    <h6 class="font-weight-bold">{{ $data->masa_berlaku }}</h6>
                </div>
                <div class="col-md-6 mb-3">
                    <p class="mb-1 text-muted">Mulai Berlaku</p>
                    <h6 class="font-weight-bold">{{ $data->mulai_berlaku }}</h6>
                </div>
                <div class="col-md-6 mb-3">
                    <p class="mb-1 text-muted">Tanggal Kadaluarsa</p>
                    <h6 class="font-weight-bold">{{ $data->kadaluarsa }}</h6>
                </div>
                <div class="col-md-6 mb-3">
                    <p class="mb-1 text-muted">Nomor Agenda Mitra</p>
                    <h6 class="font-weight-bold">{{ $data->nomor_agenda_mitra }}</h6>
                </div>
                <div class="col-md-6 mb-3">
                    <p class="mb-1 text-muted">Nomor Agenda LLDIKTI</p>
                    <h6 class="font-weight-bold">{{ $data->nomor_agenda_lldikti }}</h6>
                </div>
            </div>

            <!-- Status dan Keterangan -->
            <div class="row mb-4">
                <div class="col-md-12">
                    <h5 class="text-primary font-weight-bold mb-3">Status dan Keterangan</h5>
                    <hr class="mb-4">
                </div>

                <!-- Status -->
                <div class="col-md-6 mb-4">
                    <p class="mb-1 text-muted">Status</p>
                    @if ($data->status->nama == "LENGKAP")
                        <h6 class="font-weight-bold text-success">{{ $data->status->nama }}</h6>
                    @elseif ($data->status->nama == "TIDAK LENGKAP")
                        <h6 class="font-weight-bold text-warning">{{ $data->status->nama }}</h6>
                    @else

                    @endif
                </div>
                <div class="col-md-6 mb-4">
                    <p class="mb-1 text-muted">Bentuk Tindak Lanjut</p>
                    <h6 class="font-weight-bold text-info">{{ $data->bentuk_tindak_lanjut }}</h6>
                </div>
                <!-- Keterangan -->
                <div class="col-md-6 mb-4">
                    <p class="mb-1 text-muted">Keterangan</p>
                    <p class="text-justify" style="line-height: 1.8;">{{ $data->keterangan_dokumen }}</p>
                </div>


                <!-- Jenis File -->
                <div class="col-md-6 mb-4">
                    <p class="mb-1 text-muted">Jenis File</p>
                    <h6 class="font-weight-bold">
                        @if ($data->jenis_file == "google_drive")
                            <span class="badge bg-success text-white py-2 px-3">Google Drive</span>
                        @elseif ($data->jenis_file == "file_upload")
                            <span class="badge bg-primary text-white py-2 px-3">Upload File</span>
                        @else
                            <span class="badge bg-danger text-white py-2 px-3">Tidak Ada File</span>
                        @endif
                    </h6>
                </div>

                <!-- File Preview -->
                @if ($data->jenis_file == "google_drive")
                    <div class="col-md-12 mb-4">
                        <p class="mb-1 text-muted">Preview File</p>
                        @if ($data->file)
                            <div class="embed-responsive" style="border: 1px solid #ddd; border-radius: 10px; overflow: hidden; box-shadow: 0px 4px 8px rgba(0,0,0,0.1);">
                                <iframe src="https://drive.google.com/file/d/{{ $data->file }}/preview" width="100%" height="600" style="border: none;"></iframe>
                            </div>
                        @else
                            <h6 class="font-weight-bold text-danger">File tidak tersedia</h6>
                        @endif
                    </div>
                @endif

                <!-- Bentuk Tindak Lanjut -->

            </div>

        </div>
        <div class="card-footer text-center bg-light">
            <a href="{{ route('kerjasama-lldikti.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            @if($data->jenis_file=="file_upload")
                @if ($data->file)
                    <a href="{{ route('kerjasama-lldikti.download', $data->id) }}" class="btn btn-primary">
                        <i class="fas fa-download"></i> Unduh File
                    </a>
                @else
                    <h6 class="font-weight-bold text-danger">File tidak tersedia</h6>
                @endif
            @endif
        </div>
    </div>
</div>


@endsection

@section('script')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

@endsection
