@extends('layouts.master')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-lg border-0">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h2 class="card-title text-primary fw-bold"><u>Form Tambah Data</u></h2>
                        </div>
                        <form action="{{ route('kerma-pemda-pts.store') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="nama_pemda" class="form-label fw-bold">Nama Pemda</label>
                                <select name="nama_pemda" class="form-select @error('nama_pemda') is-invalid @enderror" id="inputNamaPemda">
                                    <option value="" disabled selected>Pilih Nama Pemda</option>
                                    @if($datapemda)
                                        @foreach ($datapemda as $pemda)
                                            <option value="{{ $pemda->id }}" {{ old('nama_pemda') == $pemda->id ? 'selected' : '' }}>
                                                {{ $pemda->nama_pemda }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('nama_pemda')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <h4 for="data_mitra" class="form-label fw-bold">Data Akselerasi Kerja Sama dengan Perguruan Tinggi</h4>
                                <label for="data_mitra" class="form-label fw-bold">*Untuk Nama PerguruanTinggi Wajib sama dengan PPDIKTI berikut link: <a href="">LINK</a></label>
                                <table class="table table-bordered align-middle" id="dynamicTable">
                                    <thead class="table-primary text-center">
                                        <tr>
                                            <th>Nama Perguruan Tinggi</th>
                                            <th width="20%">Tahun Kerjasama</th>
                                            <th width="25%">Jangka Waktu</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <input type="text" name="data_mitra[0][nama_pt]" class="form-control autocomplete-nama-univ" placeholder="Nama PT sesuai PPDIKTI">
                                            </td>
                                            <td>
                                                <input type="number" name="data_mitra[0][tahun]" class="form-control" placeholder="Tahun (2024)">
                                            </td>
                                            <td>
                                                <input type="text" name="data_mitra[0][jangka_waktu]" class="form-control" placeholder="Jangka Waktu (2 Tahun)">
                                            </td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-success add-row">Tambah</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-primary px-4">Simpan</button>
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
        let i = 0;
        $('.add-row').click(function () {
            i++;
            $('#dynamicTable tbody').append(`
                <tr>
                    <td>
                        <input type="text" name="data_mitra[${i}][nama_pt]" class="form-control autocomplete-nama-univ" placeholder="Nama PT sesuai PPDIKTI">
                    </td>
                    <td>
                        <input type="number" name="data_mitra[${i}][tahun]" class="form-control" placeholder="Tahun (2024)">
                    </td>
                    <td>
                        <input type="text" name="data_mitra[${i}][jangka_waktu]" class="form-control" placeholder="Jangka Waktu (2 Tahun)Uni">
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-danger remove-row">Hapus</button>
                    </td>
                </tr>
            `);
            initAutocomplete();
        });
        $(document).on('click', '.remove-row', function () {
            $(this).closest('tr').remove();
        });
        initAutocomplete();

        function initAutocomplete() {
            $(".autocomplete-nama-univ").autocomplete({
                source: function (request, response) {
                    $.ajax({
                        url: '{{ route('kerma-pemda-pts.namauniv') }}',
                        dataType: 'json',
                        data: {
                            term: request.term
                        },
                        success: function (data) {
                            response(data.map(item => ({
                                label: item.nama_pt,
                                value: item.nama_pt
                            })));
                        }
                    });
                },
                minLength: 2,
                select: function (event, ui) {
                    $(this).val(ui.item.value);
                }
            });
        }
    });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
@endsection

@section('css')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
@endsection

