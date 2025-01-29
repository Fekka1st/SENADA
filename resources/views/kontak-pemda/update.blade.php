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
                        <label for="nama_up">Nama</label>
                        <input type="text" class="form-control" id="nama_up" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label for="jabatan_up">Jabatan</label>
                        <input type="text" class="form-control" id="jabatan_up" name="jabatan" required>
                    </div>
                    <div class="form-group">
                        <label for="nohp_up">No HP</label>
                        <input type="number" class="form-control" id="nohp_up" name="no_hp" required>
                    </div>
                    <div class="form-group">
                        <label for="email_up">Email</label>
                        <input type="email" class="form-control" id="email_up" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat_up">Alamat</label>
                        <textarea class="form-control" name="alamat" id="alamat_up" cols="20" rows="5"></textarea>
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
