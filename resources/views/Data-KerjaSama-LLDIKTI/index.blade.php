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
                        <div class="pb-2">
                            <a href={{route('kerjasama-lldikti.create')}} class="btn btn-primary">Tambah Data</a>
                            <a href={{route('kerjasama-lldikti.import')}} class="btn btn-success">Import Excel</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped" id="mytable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Nama Mitra</th>
                                        <th>Perihal</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($datamou)
                                    @foreach ($datamou as $item => $data)
                                    <tr>
                                        <td>{{$item+1}}</td>
                                        <td>{{$data->created_at}}</td>
                                        <td class="font-weight-bold">{{$data->nama_mitra}}</td>
                                        <td>{{$data->perihal}}</td>
                                        <td class="font-weight-medium">
                                            <div class="badge badge-success">{{$data->status? 'aktif':'tidak aktif'}}</div>
                                        </td>
                                        <td>
                                        <div>
                                            <button class="btn btn-warning"><i class="fa-solid fa-file-pen"></i>{{$data->id}}</button>
                                            <button class="btn btn-info"><i class="fa-solid fa-info"></i></button>
                                            <button class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
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
        $('#mytable').DataTable();
    });
    </script>
@endsection
