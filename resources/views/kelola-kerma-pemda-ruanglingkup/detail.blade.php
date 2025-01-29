@extends('layouts.master')

@section('breadcum', 'Dashboard')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title text-center text-uppercase"><u>Detail Data Kerma Pemda</u></h2>
                        <hr class="my-4">

                        <!-- Informasi Utama -->
                        <h4 class="text-primary mt-3">Informasi Utama</h4>
                        <table class="table table-bordered mt-3">
                            <tbody>
                                <tr>
                                    <th class="bg-light" width="30%">Nama Pemda</th>
                                    <td>{{ $data->pemda->nama_pemda }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Ruang Lingkup</th>
                                    <td>{{ $data->ruanglingkup->nama_ruanglingkup }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Tanggal Mulai Pelaksanaan</th>
                                    <td>{{ \Carbon\Carbon::parse($data->tgl_pelaksanaan_start)->format('d M Y') }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Tanggal Berakhir Pelaksanaan</th>
                                    <td>{{ \Carbon\Carbon::parse($data->tgl_pelaksanaan_end)->format('d M Y') }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Durasi Berakhir Pelaksanaan</th>
                                    <td>
                                        @php
                                            \Carbon\Carbon::setLocale('id');
                                            $now = \Carbon\Carbon::now();
                                            $endDate = \Carbon\Carbon::parse($data->tgl_pelaksanaan_end);
                                            if ($endDate->isPast()) {
                                                $duration = '<span class="text-danger fw-bold">Kadaluarsa</span>';
                                            } else {
                                                $diff = $now->diffForHumans($endDate, ['parts' => 2, 'syntax' => \Carbon\CarbonInterface::DIFF_RELATIVE_TO_NOW]);
                                                $diff = str_replace(['lalu', 'ago','yang'], '', $diff);
                                                $duration = "<span class='text-success fw-bold'>{$diff}</span>";
                                            }
                                        @endphp
                                        {!! $duration !!}
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- Informasi Program -->
                        <h4 class="text-primary mt-5">Informasi Program</h4>
                        <table class="table table-bordered mt-3">
                            <tbody>
                                <tr>
                                    <th class="bg-light" width="30%">Nama Program</th>
                                    <td>{{ $data->nama_program }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light">KPI Program</th>
                                    <td>{{ $data->kpi_program }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Pencapaian Program</th>
                                    <td>{{ $data->pencapaian_program }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Evaluasi Program</th>
                                    <td>{{ $data->evaluasi_program }}</td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- Dukungan Pihak Lain -->
                        <h4 class="text-primary mt-5">Dukungan Pihak Lain</h4>
                        <div class="mt-3">
                            <ol class="list-group">
                                @foreach (explode('.,', $data->dukungan_pihak_lain) as $dukungan)
                                    <li class="list-group-item">
                                        {{ $loop->iteration }}. {{ trim($dukungan) }}
                                    </li>
                                @endforeach
                            </ol>
                        </div>


                        <!-- Tombol Kembali -->
                        <div class="text-end mt-5">
                            <a href="{{ route('kerma-pemda-ruanglingkup.index') }}" class="btn btn-secondary btn-lg">
                                Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection
