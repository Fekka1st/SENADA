<!-- Modal Update -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="updateForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="user_id" name="user_id">
                    <div class="form-group">
                        <label for="">Nama Pemerintahan</label>
                        <input type="text" class="form-control" id="nama_pemda_up" name="nama_pemda"
                            aria-describedby="name" required>
                    </div>
                    <div class="form-group">
                        <label for="provinsi">Provinsi</label>
                        <select class="form-control" id="provinsi_up" name="provinsi" required>
                            <option value="" disabled selected>Pilih Provinsi</option>
                            <option value="1">Provinsi Jawa Barat</option>
                            <option value="0">Provinsi Banten</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status_up" name="status" required>
                            <option value="" disabled selected>Pilih Status</option>
                            <option value="1">Sudah MoU</option>
                            <option value="0">Belum MoU</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="join_grup">Join Grup</label>
                        <select class="form-control" id="join_grup_up" name="join_grup">
                            <option value="" disabled selected>Pilih</option>
                            <option value="1">Sudah</option>
                            <option value="0">Belum</option>
                        </select>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
