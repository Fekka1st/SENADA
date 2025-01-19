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
                        <div class="pb-2">
                        <a href="{{route('kerjasama-lldikti.sinkron')}}">Sinkron Data</a>
                        </div>

                        <div class="table-responsive">
                            <table id="myTable" class="table table-striped table-fluid">
                                <thead>
                                    <tr>
                                        <th width=3% class="text-center">No</th>
                                        <th class="text-center">Nama Perguruan Tinggi</th>
                                        <th class="text-center">MoU</th>
                                        <th class="text-center">MoA</th>
                                        <th class="text-center">IA</th>
                                        <th class="text-center">Jumlah</th>
                                        <th class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody> @foreach ($data_pt as $data => $datas)
                                    <tr id="index_{{ $datas->id }}">
                                        <td>{{$data + 1}}</td>
                                        <td>
                                            {{$datas->kode_pt}}-{{$datas->nama_pt}}
                                        </td>
                                        <td class="text-center">{{$datas->jumlah_mou}}</td>
                                        <td class="text-center"> {{$datas->jumlah_moa}}</td>
                                        <td class="text-center">{{$datas->jumlah_ia}}</td>
                                        <td class="text-center">
                                            {{$datas->jumlah_mou+$datas->jumlah_moa+$datas->jumlah_ia}}
                                        </td>
                                        <td class="text-center">
                                            @if($datas->status == 'Aktif'||$datas->status == 'aktif'||$datas->status ==
                                            1)
                                            <span class="badge badge-success">{{$datas->status}}</span>
                                            @else
                                            <span class="badge badge-danger">{{$datas->status}}</span>
                                            @endif</td>
                                        {{-- <td class="text-center">
                                  <a href="javascript:void(0)" id="btn-edit-post" data-id="{{ $data_pt->id }}"
                                        class="btn btn-primary "><i class="fa-regular fa-pen-to-square"></i></a>
                                        @method('DELETE')
                                        <a href="{{ route('kelola-jenis-mitra.destroy', $data_pt->id) }}"
                                            class="btn btn-danger" data-confirm-delete="true"><i
                                                class="fa-solid fa-trash"></i></a>
                                        </td> --}}
                                    </tr> @endforeach
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
                    <form action="{{ route('kerjasama-pts.import') }}" method="POST" enctype="multipart/form-data">
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
                    title: 'Data Kerja Sama PTS',
                    messageTop: 'Tanggal dibuat: ' + new Date().toLocaleDateString(),
                },{
                    extend: 'pdf',
                    text: 'Cetak PDF',
                    className: 'btn btn-info',
                    title: 'Data Directory PT',
                    messageTop: 'Tanggal dibuat: ' + new Date().toLocaleDateString(),
                }
            ],
            "pageLength": 10,
            "lengthMenu": [10, 25, 50], // Opsi filtering
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
<script src="https://cdn.datatables.net/buttons/3.2.0/js/dataTables.buttons.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.bootstrap5.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.print.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@section('css')
<style>
    .dt-length {
        margin-top: 20px;
    }
</style>
@endsection

