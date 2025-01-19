@extends('layouts.master')
@section('title')
<title>Direktori PT | LLDIKTI</title>
@endsection
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <p class="card-title">Data Directori PT</p>
                        </div>
                        {{-- <div class="pb-2">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"> Tambah Data </button>
                        </div> --}}

                        <div class="table-responsive">
                            <table id="myTable" class="table table-striped table-fluid">
                                <thead>
                                    <tr>
                                        <th width=3% class="text-center">No</th>
                                        <th class="text-center">Nama Perguruan Tinggi</th>
                                        <th class="text-center">Akreditasi</th>
                                        <th class="text-center">Alamat</th>
                                        <th class="text-center">Jenis PT</th>
                                        <th class="text-center">Domisili</th>
                                        <th class="text-center">Provinsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data_pt as $data => $datas)
                                    <tr id="index_{{ $datas->id }}">
                                        <td>{{$data + 1}}</td>
                                        <td>
                                            {{$datas->kode_pt}} - {{$datas->nama_pt}}
                                        </td>
                                        <td>{{$datas->akreditasi}}</td>
                                        <td> {{$datas->alamat}}</td>
                                        <td>{{$datas->jenis_pt}}</td>
                                        <td>{{$datas->domisili}}</td>
                                        <td>{{$datas->provinsi}}</td>
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
    {{-- @include('MasterData.jenismitra.tambah')
    @include('MasterData.jenismitra.update') --}}

    {{-- Modal Import Excel --}}
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
                    <form action="{{ route('kelola-pt.import') }}" method="POST" enctype="multipart/form-data">
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
        $('#myTable').DataTable({
            dom: '<"top-toolbar"B>lfrtip',
            buttons: [{
                    extend: 'excel',
                    text: 'Cetak Excel',
                    className: 'btn btn-info',
                    title: 'Data Directory PT',
                    messageTop: 'Tanggal dibuat: ' + new Date().toLocaleDateString(),
                },{
                    extend: 'pdf',
                    text: 'Cetak PDF',
                    className: 'btn btn-info',
                    title: 'Data Directory PT',
                    messageTop: 'Tanggal dibuat: ' + new Date().toLocaleDateString(),
                }
            ],
            "pageLength": 10, // Tampilkan 5 data per halaman
            "lengthMenu": [10, 25, 50, 100], // Opsi filtering
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
        $("div.top-toolbar").prepend(`
                  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#importModal">
                            Import Data Excel
                        </button>
            `);
    });
    $(document).on('click', '#btn-edit-post', function () {
        var id = $(this).data('id');
        $.get('kelola-jenis-mitra/' + id + '/edit', function (data) {
            $('#id').val(data.id);
            $('#name_up').val(data.nama);
            $('#keterangan_up').val(data.keterangan);
            $('#updateForm').attr('action', '/kelola-jenis-mitra/' + data.id)
            $('#editModal').modal('show');
        });
    });

</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.datatables.net/buttons/3.2.0/js/dataTables.buttons.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.bootstrap5.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.print.min.js"></script>
@endsection


@section('css')
<style>
    .dt-length {
        margin-top: 20px;
    }
</style>
@endsection
