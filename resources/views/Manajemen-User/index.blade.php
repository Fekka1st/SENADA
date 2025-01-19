@extends('layouts.master')


@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <p class="card-title">Kelola User</p>
                        </div>
                        <div class="pb-2">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"> Tambah Data </button>
                        </div>
                        <table id="myTable" class="table table-striped table-fluid">
                            <thead>
                              <tr>
                                <th width=3%>No</th>
                                <th>Photo</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Aksi</th>
                              </tr>
                            </thead>
                            <tbody> @foreach ($user as $data => $users)
                                <tr id="index_{{ $users->id }}">
                                <td>{{$data + 1}}</td>
                                <td class="text-center">
                                  <img src="{{$users->foto_url}}" class="img rounded foto-profile" alt="foto_profile">
                                </td>
                                <td>{{$users->name}}</td>
                                <td>{{$users->email}}</td>
                                <td>
                                    @if($users->role == 1)
                                    <span class="badge badge-primary"><b>Admin</b></span>
                                    @elseif($users->role == 2)
                                    <span class="badge badge-primary"><b>User</b></span>
                                    @else
                                    <span class="badge badge-primary">Tidak Diketahui</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                  <a href="javascript:void(0)" id="btn-edit-post" data-id="{{ $users->id }}" class="btn btn-primary "><i class="fa-regular fa-pen-to-square"></i></a>
                                  @method('DELETE')
                                  <a href="{{ route('manajemen-user.destroy', $users->id) }}" class="btn btn-danger" data-confirm-delete="true"><i class="fa-solid fa-trash"></i></a>
                                </td>
                              </tr> @endforeach
                            </tbody>
                          </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('Manajemen-User.tambah')
    @include('Manajemen-User.update')
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
            $.get('manajemen-user/' + id + '/edit', function (data) {
                $('#user_id').val(data.id);
                $('#name_up').val(data.name);
                $('#email_up').val(data.email);
                $('#password_up').val(data.password);
                $('#role_up').val(data.role);
                $('#updateForm').attr('action', '{{ route('manajemen-user.update', '') }}'.replace(' ', '') + '/' + data.id);
                $('#editModal').modal('show');
            });
        });
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection


@section('css')
    <style>
        .table td img, .jsgrid .jsgrid-table td img {
        width: 100px; /* Atur lebar gambar */
        height: 100px; /* Atur tinggi gambar */

    }
    </style>
@endsection
