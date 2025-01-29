<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('kerma-pemda.kontakpemda.store',':pemda_id') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">Nama </label>
                        <input type="text" class="form-control" id="nama" name="nama"
                            aria-describedby="name" required>
                    </div>
                    <div class="form-group">
                        <label for="">Jabatan </label>
                        <input type="text" class="form-control" id="Jabatan" name="Jabatan"
                            aria-describedby="name" required>
                    </div>
                    <div class="form-group">
                        <label for="">No HP </label>
                        <input type="number" class="form-control" id="no_hp" name="no_hp"
                            aria-describedby="name" required>
                    </div>
                    <div class="form-group">
                        <label for="">Email </label>
                        <input type="email" class="form-control" id="email" name="email"
                            aria-describedby="name" required>
                    </div>
                    <div class="form-group">
                        <label for="">Alamat </label>
                        <textarea class="form-control" name="alamat" id="" cols="20" rows="5"></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>
