<!-- Modal Update -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Jenis Mitra</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
            </div>
            <div class="modal-body">
                <form action="" id="updateForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="id" name="user_id">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Pemda</label>
                        <select name="nama_pemda" id="namapemda" class="form-select @error('nama_pemda') is-invalid @enderror" >
                            <option value="" disabled selected>Pilih Nama Pemda</option>
                            @if($mitra)
                                @foreach ($mitra as $pemda)
                                    <option value="{{ $pemda->id }}" {{ old('nama_pemda') == $pemda->id ? 'selected' : '' }}>
                                        {{ $pemda->nama_pemda }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="namapt" class="form-label">Nama Perguruan Tinggi</label>
                        <input type="text" class="form-control" id="namapt" name="namapt" required>
                    </div>
                    <div class="mb-3">
                        <label for="tahunkerjasama" class="form-label">Tahun Kerja Sama</label>
                        <input type="number" class="form-control" id="tahunkerjasama" name="tahunkerjasama" required>
                    </div>
                    <div class="mb-3">
                        <label for="jangkawaktu" class="form-label">Jangka Waktu</label>
                        <input type="text" class="form-control" id="jangkawaktu" name="jangkawaktu" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Upadate</button>
                      </div>
                </form>
            </div>
        </div>
    </div>
</div>
