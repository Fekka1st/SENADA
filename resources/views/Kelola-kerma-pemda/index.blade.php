@extends('layouts.master')


@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <p class="card-title">Data Kerja Sama Pemda</p>
                        </div>
                        <div class="pb-2">
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#exampleModal"> Tambah Data </button>
                        </div>
                        <table id="myTable" class="table table-striped table-fluid">
                            <thead>
                                <tr>
                                    <th width=3%>No</th>
                                    <th>Pemerintahan</th>
                                    <th>Provinsi</th>
                                    <th>Status</th>
                                    <th>Join Grup</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $data => $pemda)
                                <tr id="index_{{ $pemda->id }}">
                                    <td>{{$data + 1}}</td>
                                    <td>
                                        {{$pemda->nama_pemda}}
                                    </td>
                                    <td>{{$pemda->provinsi}}</td>
                                    <td>
                                        @if($pemda->status == 1)
                                        <span class="badge badge-primary"><b>Sudah MoU</b></span>
                                        @else
                                        <span class="badge badge-danger">Belum MoU</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($pemda->join_grup == 1)
                                        <span class="badge badge-primary"><b>Sudah MoU</b></span>
                                        @else
                                        <span class="badge badge-danger">Belum MoU</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('kerma-pemda.kontakpemda.index', $pemda->id) }}"
                                            class="btn btn-info"><i class="fa-regular fa-address-book"></i></a>
                                        <a href="javascript:void(0)" id="btn-edit-post" data-id="{{ $pemda->id }}"
                                            class="btn btn-warning "><i class="fa-regular fa-pen-to-square"></i></a>
                                            @if(Auth::user()->role == 1)
                                            @method('DELETE')
                                        <a href="{{ route('kerma-pemda.destroy', $pemda->id) }}"
                                            class="btn btn-danger" data-confirm-delete="true">
                                            <i class="fa-solid fa-trash"></i></a>
                                            @endif
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
    @include('Kelola-kerma-pemda.tambah')
    @include('Kelola-kerma-pemda.update')
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

            "pageLength": 5, // Tampilkan 5 data per halaman
            "lengthMenu": [5, 10, 20, 50], // Opsi filtering
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
        $.get('kelola-kermapemda/' + id + '/edit', function (data) {
            console.log(data.id);
            $('#user_id').val(data.id);
            $('#nama_pemda_up').val(data.nama_pemda);
            $('#provinsi_up').val(data.provinsi);
            $('#status_up').val(data.status);
            $('#join_grup_up').val(data.join_grup);
            $('#updateForm').attr('action', '{{ route('kerma-pemda.update', '') }}'.replace(' ', '') + '/' + data.id);
            $('#editModal').modal('show');
        });
    });

</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection


@section('css')
<style>
    .table td img,
    .jsgrid .jsgrid-table td img {
        width: 100px;
        /* Atur lebar gambar */
        height: 100px;
        /* Atur tinggi gambar */

    }

</style>
@endsection
