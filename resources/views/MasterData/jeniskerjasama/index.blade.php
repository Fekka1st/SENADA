@extends('layouts.master')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <p class="card-title">Kelola Jenis Kerja Sama</p>
                        </div>
                        <div class="pb-2">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"> Tambah Data </button>
                        </div>
                        <table id="myTable" class="table table-striped table-fluid">
                            <thead>
                              <tr >
                                <th width=3% class="text-center">No</th>
                                <th class="text-center">Nama Kerja Sama</th>
                                <th class="text-center">Keterangan</th>
                                <th class="text-center">Tanggal Pembuatan</th>
                                <th class="text-center">Aksi</th>
                              </tr>
                            </thead>
                            <tbody> @foreach ($jenis as $data => $kerjasama)
                                <tr id="index_{{ $kerjasama->id }}">
                                <td>{{$data + 1}}</td>
                                <td class="text-center">
                                    {{$kerjasama->nama}}
                                </td>
                                <td>{{$kerjasama->keterangan}}</td>
                                <td>{{$kerjasama->created_at}}</td>
                                <td class="text-center">
                                  <a href="javascript:void(0)" id="btn-edit-post" data-id="{{ $kerjasama->id }}" class="btn btn-primary "><i class="fa-regular fa-pen-to-square"></i></a>
                                  @method('DELETE')
                                  <a href="{{ route('kelola-jenis-kerjasama.destroy', $kerjasama->id) }}" class="btn btn-danger" data-confirm-delete="true"><i class="fa-solid fa-trash"></i></a>
                                </td>
                              </tr> @endforeach
                            </tbody>
                          </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('MasterData.jeniskerjasama.tambah')
    @include('MasterData.jeniskerjasama.update')
    <footer class="footer">
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2025.
                <a href="" target="_blank">LLDIKTI IV</a> All rights reserved.</span>
        </div>
    </footer>
</div>
@endsection

@section('script')
    <script>
         $(document).ready(function () {
            $('#myTable').DataTable({
                "pageLength": 5,
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
        });
        $(document).on('click', '#btn-edit-post', function () {
            var id = $(this).data('id');
            $.get('kelola-jenis-kerjasama/' + id + '/edit', function (data) {
                $('#id').val(data.id);
                $('#name_up').val(data.nama);
                $('#keterangan_up').val(data.keterangan);
                $('#updateForm').attr('action', '/kelola-jenis-kerjasama/' + data.id)
                $('#editModal').modal('show');
            });
        });
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@section('css')

@endsection
