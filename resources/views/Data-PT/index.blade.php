@extends('layouts.master')

@section('breadcum', 'Dashboard')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <p class="card-title">Data Kerja Sama LLDIKTI IV</p>

                        </div>
                        <div class="pb-2">
                            <Button class="btn btn-primary">Tambah Data</Button>
                            <Button class="btn btn-success">Import Excel</Button>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped" id="mytable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>MoU</th>
                                        <th>MoA</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>18/08/2022</td>
                                        <td class="font-weight-bold">362</td>
                                        <td>Universitas ibn Khaldun Bogor</td>
                                        <td class="font-weight-medium">
                                            <div class="badge badge-success">Aktif</div>
                                        </td>
                                        <td>
                                        <div>
                                            <button class="btn btn-warning"><i class="fa-solid fa-file-pen"></i></button>
                                            <button class="btn btn-info"><i class="fa-solid fa-info"></i></button>
                                            <button class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                                        </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>18/08/2022</td>
                                        <td class="font-weight-bold">116</td>
                                        <td>Universitas Islam Bandung</td>
                                        <td class="font-weight-medium">
                                            <div class="badge badge-success">Aktif</div>
                                        </td>
                                        <td>
                                        <div>
                                            <button class="btn btn-warning"><i class="fa-solid fa-file-pen"></i></button>
                                            <button class="btn btn-info"><i class="fa-solid fa-info"></i></button>
                                            <button class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                                        </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>18/08/2022</td>
                                        <td class="font-weight-bold">551</td>
                                        <td>Universitas Suryakancana</td>
                                        <td class="font-weight-medium">
                                            <div class="badge badge-warning">Mencurigakan</div>
                                        </td>
                                        <td>
                                        <div>
                                            <button class="btn btn-warning"><i class="fa-solid fa-file-pen"></i></button>
                                            <button class="btn btn-info"><i class="fa-solid fa-info"></i></button>
                                            <button class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                                        </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>18/08/2022</td>
                                        <td class="font-weight-bold">523</td>
                                        <td>Universitas Pendidikan Indonesia</td>
                                        <td class="font-weight-medium">
                                            <div class="badge badge-warning">Mencurigakan</div>
                                        </td>
                                        <td>
                                        <div>
                                            <button class="btn btn-warning"><i class="fa-solid fa-file-pen"></i></button>
                                            <button class="btn btn-info"><i class="fa-solid fa-info"></i></button>
                                            <button class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                                        </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>18/08/2022</td>
                                        <td class="font-weight-bold">781</td>
                                        <td>Universitas Fakuan</td>
                                        <td class="font-weight-medium">
                                            <div class="badge badge-success">Aktif</div>
                                        </td>
                                        <td>
                                        <div>
                                            <button class="btn btn-warning"><i class="fa-solid fa-file-pen"></i></button>
                                            <button class="btn btn-info"><i class="fa-solid fa-info"></i></button>
                                            <button class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                                        </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>18/08/2022</td>
                                        <td class="font-weight-bold">283</td>
                                        <td>Universitas Pasundan</td>
                                        <td class="font-weight-medium">
                                            <div class="badge badge-warning">No Aktif</div>
                                        </td>
                                        <td>
                                        <div>
                                            <button class="btn btn-warning"><i class="fa-solid fa-file-pen"></i></button>
                                            <button class="btn btn-info"><i class="fa-solid fa-info"></i></button>
                                            <button class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                                        </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>7</td>
                                        <td>18/08/2022</td>
                                        <td class="font-weight-bold">897</td>
                                        <td>Universitas Kristen Maranata</td>
                                        <td class="font-weight-medium">
                                            <div class="badge badge-success">Aktif</div>
                                        </td>
                                        <td>
                                        <div>
                                            <button class="btn btn-warning"><i class="fa-solid fa-file-pen"></i></button>
                                            <button class="btn btn-info"><i class="fa-solid fa-info"></i></button>
                                            <button class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                                        </div>
                                        </td>
                                    </tr>
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
