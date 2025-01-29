@extends('layouts.master')


@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <p class="card-title">Data Kerja Sama PTS</p>
                        </div>
                        <div class="collapse mt-3" id="filterCollapse">
                            <div class="card card-body">
                                <form id="filterForm">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="filterTahun">Tahun</label>
                                            <input type="number" class="form-control" id="filterTahun"
                                                placeholder="Masukkan Tahun">
                                        </div>

                                        <div class="col-md-3">
                                            <label for="filterNamaMitra">Nama Mitra</label>
                                            <select class="form-control" id="filterNamaMitra">
                                                <option value="">Pilih Nama Mitra</option>
                                                @foreach($mitra as $data)
                                                <option value="{{ $data->nama_pemda }}">{{ $data->nama_pemda }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-3">
                                            <label for="filterNamaPerguruanTinggi">Nama Perguruan Tinggi</label>
                                            <select class="form-control" id="filterNamaPerguruanTinggi">
                                                <option value="">Pilih Perguruan Tinggi</option>
                                                @foreach($datas as $data) <option value="{{ $data->nama_pt }}">
                                                    {{ $data->nama_pt }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-12">
                                            <button type="button" class="btn btn-success"
                                                id="filterButton">Cari</button>
                                            <button type="button" class="btn btn-secondary"
                                                id="resetButton">Reset</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="table-responsive mt-3">
                            <table id="myTable" class="table table-striped table-fluid">
                                <thead>
                                    <tr>
                                        <th width=3%>No</th>
                                        <th class="text-center">Nama Mitra</th>
                                        <th class="text-center">Nama Perguruan Tinggi</th>
                                        <th width="20%" class="text-center">Tahun Kerja Sama</th>
                                        <th width="25%" class="text-center">Jangka Waktu </th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datas as $index => $pemdapts)
                                    <tr id="index_{{ $pemdapts->id }}">
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $pemdapts->pemda->nama_pemda ?? '-' }}</td>
                                        <td>{{ $pemdapts->nama_pt ?? '-' }}</td>
                                        <td>{{ $pemdapts->tahun_kerjasama }}</td>
                                        <td>{{ $pemdapts->jangka_waktu }}</td>
                                        <td class="text-center">
                                            <a href="javascript:void(0)" id="btn-edit-post" data-id="{{ $pemdapts->id }}"
                                                class="btn btn-warning "><i class="fa-regular fa-pen-to-square"></i></a>
                                            @method('DELETE')
                                            <a href="{{ route('kerma-pemda-pts.destroy', $pemdapts->id ?? '') }}"
                                                class="btn btn-danger" data-confirm-delete="true">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer">
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2025. <a href=""
                    target="_blank">LLDIKTI IV</a> All rights reserved. </span>
        </div>
    </footer>
    {{-- Modal Import --}}
    @include('kelola-kerma-pemda-pts.update')

    <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="importModalLabel">Import Data Excel</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('kerma-pemda-pts.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="file">Pilih File Excel</label>
                            <input type="file" class="form-control" id="file" name="file" accept=".xlsx, .xls" required>
                            <small class="form-text text-muted">
                                Pastikan file yang diupload adalah format Excel (.xlsx atau .xls).
                            </small>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Import</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


@section('script')
<script>
    $(document).ready(function () {
        var table = $('#myTable').DataTable({
            dom: '<"top-toolbar"B>lfrtip',
            buttons: [{
                extend: 'excel',
                text: 'Cetak Excel',
                className: 'btn btn-info',
                title: 'Data Kerja Sama LLDIKTI IV',
                messageTop: 'Tanggal DiCetak: ' + new Date().toLocaleDateString(),
            }, {
                extend: 'pdf',
                text: 'Cetak PDF',
                className: 'btn btn-info',
                title: 'Data Kerja Sama LLDIKTI IV',
                messageTop: 'Tanggal DiCetak: ' + new Date().toLocaleDateString(),
            }],
            "pageLength": 10,
            "lengthMenu": [5, 10, 20, 50],
            "language": {
                "emptyTable": "Data tidak tersedia",
                "lengthMenu": "Tampilkan _MENU_ data per halaman",
                "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                "infoEmpty": "Tidak ada data yang tersedia",
                "infoFiltered": "(difilter dari total _MAX_ data)",
                "search": "Cari:",
                "zeroRecords": "Tidak ditemukan data yang sesuai",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "next": "Berikutnya",
                    "previous": "Sebelumnya"
                }
            }
        });
        function removeDuplicateOptions(selector) {
            const seenOptions = new Set();
            $(selector).each(function () {
                const value = $(this).val();
                if (seenOptions.has(value)) {
                    $(this).remove();
                } else {
                    seenOptions.add(value);
                }
            });
        }
        removeDuplicateOptions('#filterNamaMitra option');
        removeDuplicateOptions('#filterNamaPerguruanTinggi option');
        $('#filterButton').on('click', function () {
            console.log('filter');
            var tahun = $('#filterTahun').val();
            var namaMitra = $('#filterNamaMitra').val();
            var namaPT = $('#filterNamaPerguruanTinggi').val();

            table.columns().search('');
            if (tahun) {
                table.columns(3).search(tahun, true, false);
            }
            if (namaMitra) {
                table.columns(1).search(namaMitra, true, false);
            }
            if (namaPT) {
                table.columns(2).search(namaPT, true, false);
            }
            table.draw();
        });
        $('#resetButton').on('click', function () {
            $('#filterForm')[0].reset();
            table.columns().search('').draw();
        });
        $("div.top-toolbar").prepend(`
        <div class="btn-group" role="group" aria-label="Basic example">
            <a href="{{route('kerma-pemda-pts.create')}}" class="btn btn-primary">Tambah Data</a>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#importModal">
                            Import Data Excel
            </button>
            <a href="{{route('kerma-pemda-pts.export')}}" class="btn btn-info">Export Data Excel</a>
            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#filterCollapse" aria-expanded="false" aria-controls="filterCollapse">
                Filter Data
            </button>
        </div>
        `);
    });
    $(document).on('click', '#btn-edit-post', function () {
            var id = $(this).data('id');
            $.get('kelola-kerma-pemda-pts/' + id + '/edit', function (data) {
                $('#id').val(data.id);
                $('#namapemda').val(data.pemda_id);
                $('#namapt').val(data.nama_pt);
                $('#tahunkerjasama').val(data.tahun_kerjasama);
                $('#jangkawaktu').val(data.jangka_waktu);
                $('#updateForm').attr('action', '{{ route('kerma-pemda-pts.update', '') }}'.replace(' ', '') + '/' + data.id);
                $('#editModal').modal('show');
            });
    });

</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@section('css')
<style>
    .dt-length {
        margin-top: 20px;
    }

    #filterCollapse {
        position: relative;
        margin-top: 20px;
    }
</style>
@endsection
