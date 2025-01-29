@extends('layouts.master')


@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <p class="card-title">Data Kontak Pemda <u>{{ $data_pemda->nama_pemda }}</u> </p> <!-- Menampilkan nama Pemda -->
                        </div>
                        <div class="pb-2">
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#exampleModal" data-pemda-id="{{ $data_pemda->id }}"> Tambah Data </button>
                        </div>
                        <table id="myTable" class="table table-striped table-fluid">
                            <thead>
                                <tr>
                                    <th width=3%>No</th>
                                    <th>Nama</th>
                                    <th>Jabatan</th>
                                    <th>No HP</th>
                                    <th>Email</th>
                                    <th>Alamat</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kontak as $data => $pemda)
                                <tr id="index_{{ $pemda->id }}">
                                    <td>{{$data + 1}}</td>
                                    <td>
                                        {{$pemda->nama}}
                                    </td>
                                    <td>{{$pemda->jabatan}}</td>
                                    <td>
                                        {{$pemda->no_hp}}
                                    </td>
                                    <td>
                                        {{$pemda->email}}
                                    </td>
                                    <td>
                                        {{$pemda->alamat}}
                                    </td>
                                    <td class="text-center">
                                        @php
                                        $nomor_wa = $pemda->no_hp;
                                        if (str_starts_with($nomor_wa, '0')) {
                                            $nomor_wa = '62' . substr($nomor_wa, 1);
                                        }
                                    @endphp
                                        <a href=" https://wa.me/{{$nomor_wa}}"class="btn btn-success " target="_blank" ><i class="fa-brands fa-whatsapp"></i></a>
                                        <a href="javascript:void(0)" id="btn-edit-post" data-id="{{ $pemda->id }}"
                                            class="btn btn-primary "><i class="fa-regular fa-pen-to-square"></i></a>
                                        @method('DELETE')
                                        <a href="{{ route('kerma-pemda.kontakpemda.destroy', $pemda->id) }}"
                                            class="btn btn-danger" data-confirm-delete="true"><i
                                                class="fa-solid fa-trash"></i></a>
                                    </td>
                                </tr> @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('kontak-pemda.tambah')
    @include('kontak-pemda.update')
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
        $.get('' + id + '/edit', function (data) {
            $('#user_id').val(data.id);
            $('#nama_up').val(data.nama);
            $('#jabatan_up').val(data.jabatan);
            $('#nohp_up').val(data.no_hp);
            $('#email_up').val(data.email);
            $('#alamat_up').val(data.alamat);
            $('#updateForm').attr('action', '{{ route('kerma-pemda.kontakpemda.update', '') }}'.replace(' ', '') + '/' + data.id);
            $('#editModal').modal('show');
        });
    });
    $('#exampleModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var pemdaId = button.data('pemda-id')
    var modal = $(this)
    var actionUrl = modal.find('form').attr('action').replace(':pemda_id', pemdaId)
    modal.find('form').attr('action', actionUrl)
})
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
