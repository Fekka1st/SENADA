@extends('layouts.master')

@section('breadcum', 'Dashboard')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <p class="card-title">Data Kerja Sama LLDIKTI IV</p>
                        </div>
                        <div class="collapse mt-3" id="filterCollapse">
                            <div class="card card-body">
                                <form id="filterForm">
                                    <div class="row">
                                        <!-- Tahun -->
                                        <div class="col-md-3">
                                            <label for="filterTahun">Tahun</label>
                                            <input type="number" class="form-control" id="filterTahun" placeholder="Masukkan Tahun">
                                        </div>
                                        <!-- Jenis Kerjasama -->
                                        <div class="col-md-3">
                                            <label for="filterJenisKerjasama">Jenis Kerjasama</label>
                                            <select class="form-control" id="filterJenisKerjasama">
                                                <option value="">Pilih Jenis Kerjasama</option>
                                                @foreach($jeniskerjasama as $kerjasama)
                                                    <option value="{{ $kerjasama->nama }}">{{ $kerjasama->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <!-- Jenis Mitra -->
                                        <div class="col-md-3">
                                            <label for="filterJenisMitra">Jenis Mitra</label>
                                            <select class="form-control" id="filterJenisMitra">
                                                <option value="">Pilih Jenis Mitra</option>
                                                @foreach($jenismitra as $mitra)
                                                    <option value="{{ $mitra->nama }}">{{ $mitra->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <!-- Status -->
                                        <div class="col-md-3">
                                            <label for="filterStatus">Status</label>
                                            <select class="form-control" id="filterStatus">
                                                <option value="">Pilih Status</option>
                                                @foreach($status as $statuse)
                                                    <option value="{{ $statuse->nama }}">{{ $statuse->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-12">
                                            <button type="button" class="btn btn-success" id="filterButton">Cari</button>
                                            <button type="button" class="btn btn-secondary" id="resetButton">Reset</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="table-responsive mt-3">
                            <table class="table table-striped" id="myTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Mitra</th>
                                        <th>Perihal</th>
                                        <th>Jenis Mitra</th>
                                        <th>Jenis Kerjaan</th>
                                        <th>Tanggal</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($datamou)
                                    @foreach ($datamou as $item => $data)
                                    <tr>
                                        <td>{{$item+1}}</td>

                                        <td class="font-weight-bold"
                                            style="max-width: 150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"
                                            title="{{$data->nama_mitra}}">
                                            {{$data->nama_mitra}}
                                        </td>
                                        <td class="font-weight-bold"
                                            style="max-width: 150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"
                                            title="    {{$data->perihal}}">
                                            {{$data->perihal}}
                                        </td>
                                        <td> {{$data->jenis_mitra_nama}}</td>
                                        <td> {{$data->jenis_kerjasama_nama}}</td>
                                        <td>{{ $data->mulai_berlaku }}</td>
                                        <td class="font-weight-medium">
                                            @if($data->status_nama=="LENGKAP")
                                            <span class="badge badge-success">{{$data->status_nama}}</span>
                                            @else
                                            <span class="badge badge-danger">{{$data->status_nama}}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div>
                                                <a href="{{ route('kerjasama-lldikti.detail', $data->id) }}"
                                                    class="btn btn-info">
                                                    <i class="fa-solid fa-info"></i>
                                                </a>
                                                <a href="{{ route('kerjasama-lldikti.edit', $data->id) }}"
                                                    class="btn btn-warning">
                                                    <i class="fa-solid fa-file-pen"></i>
                                                </a>
                                                @method('DELETE')
                                  <a href="{{ route('kerjasama-lldikti.destroy',$data->id) }}" class="btn btn-danger" data-confirm-delete="true"><i class="fa-solid fa-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal  --}}
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
                    <form action="{{ route('kerjasama-lldikti.import') }}" method="POST" enctype="multipart/form-data">
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
        var table =  $('#myTable').DataTable({
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
            "lengthMenu": [10, 25, 50, 100],
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
        console.log('test');
        var tahun = $('#filterTahun').val();
        var jenisKerjasama = $('#filterJenisKerjasama').val();
        var jenisMitra = $('#filterJenisMitra').val();
        var status = $('#filterStatus').val();

        table.columns().search('');
        if (tahun) {
            table.columns(1).search(tahun, true, false);
        }
        if (jenisKerjasama) {
            table.columns(5).search(jenisKerjasama, true, false);
        }
        if (jenisMitra) {
            table.columns(4).search(jenisMitra, true, false);
        }
        if (status) {
            table.columns(6).search(status, true, false);
        }

        table.draw();
    });


    $('#resetButton').on('click', function () {
        $('#filterForm')[0].reset();
        table.columns().search('').draw();
    });

        $("div.top-toolbar").prepend(`
        <div class="btn-group" role="group" aria-label="Basic example">
            <a href={{route('kerjasama-lldikti.create')}} class="btn btn-primary">Tambah Data</a>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#importModal">
                            Import Data Excel
            </button>
            <a href="{{route('kerjasama-lldikti.exportCustom')}}" class="btn btn-info">Export Data Excel</a>
            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#filterCollapse" aria-expanded="false" aria-controls="filterCollapse">
                Filter Data
            </button>
        </div>
            `);
    });
</script>
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
