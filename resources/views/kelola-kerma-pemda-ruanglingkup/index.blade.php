@extends('layouts.master')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <p class="card-title">Data Kerja Sama PEMDA Ruang Lingkup</p>
                        </div>
                        <div class="collapse mt-3" id="filterCollapse">
                            <div class="card card-body">
                                <form id="filterForm">
                                    <div class="row">
                                        <!-- Jenis Kerjasama -->
                                        <div class="col-md-3">
                                            <label for="filterNamaProgram">Nama Program</label>
                                            <select class="form-control" id="filterNamaProgram">
                                                <option value="">Pilih Nama Program</option>
                                                @foreach($datas as $data)
                                                    <option value="{{ $data->nama_program }}">{{ $data->nama_program }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <!-- Jenis Mitra -->
                                        <div class="col-md-3">
                                            <label for="filterRuangLingkup">Ruang Lingkup</label>
                                            <select class="form-control" id="filterRuangLingkup">
                                                <option value="">Pilih Jenis Ruang Lingkup</option>
                                                @foreach($dataruanglingkup as $data)
                                                    <option value="{{ $data->nama_ruanglingkup }}">{{ $data->nama_ruanglingkup }}</option>
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
                                        <th>Nama Mitra</th>
                                        <th>Nama Program</th>
                                        <th>Ruang Lingkup</th>
                                        <th>Pencapaian Program</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datas as $data => $ruanglingkup)
                                    <tr id="index_{{ $ruanglingkup->id }}">
                                        <td>{{$data + 1}}</td>
                                        <td>
                                            {{$ruanglingkup->pemda->nama_pemda}}
                                        </td>
                                        <td>{{$ruanglingkup->nama_program}}</td>
                                        <td>
                                            {{$ruanglingkup->ruanglingkup->nama_ruanglingkup}}
                                        </td>
                                        <td>
                                            {{ $ruanglingkup->pencapaian_program }}
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('kerma-pemda-ruanglingkup.detail', $ruanglingkup->id) }}"
                                                class="btn btn-info"><i class="fa-solid fa-id-card"></i></a>
                                            <a href="{{ route('kerma-pemda-ruanglingkup.edit', $ruanglingkup->id) }}"
                                                class="btn btn-warning"><i
                                                    class="fa-regular fa-pen-to-square"></i></a>
                                            @method('DELETE')
                                            <a href="{{ route('kerma-pemda-ruanglingkup.destroy', $ruanglingkup->id) }}"
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
    </div>
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
            "lengthMenu": [10, 20, 50],
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
        $('#filterButton').on('click', function () {
            var namaprogram = $('#filterNamaProgram').val();
            var ruanglingkup = $('#filterRuangLingkup').val();
            console.log(ruanglingkup);
            table.columns().search('');
            if (namaprogram) {
                table.columns(2).search(namaprogram, true, false);
            }
            if (ruanglingkup) {
                table.columns(3).search(ruanglingkup, true, false);
            }
            table.draw();
        });


        $('#resetButton').on('click', function () {
            $('#filterForm')[0].reset();
            table.columns().search('').draw();
        });

        $("div.top-toolbar").prepend(`
        <div class="btn-group" role="group" aria-label="Basic example">
            <a href="{{route('kerma-pemda-ruanglingkup.create')}}" class="btn btn-primary">Tambah Data</a>
            <a href="{{route('kerma-pemda-ruanglingkup.export')}}" class="btn btn-success">Export Data Excel</a>
            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#filterCollapse" aria-expanded="false" aria-controls="filterCollapse">
                Filter Data
            </button>
        </div>
            `);
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
