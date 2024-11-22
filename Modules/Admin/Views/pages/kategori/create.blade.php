<form method="post" id="formAddKategori">
    @csrf
    <div class="modal-body">
        <div class="row">
            <div class="col-12">
                <div class="form-groupp">
                    <label for="name">Nama Kategori</label>
                    <input type="text" name="name" id="name" class="form-control rounded-10"
                        placeholder="Masukan Nama Kategori" />
                    <span class="text-danger name"></span>
                </div>
            </div>
            <div class="col-12 mt-3 float-right">
                <x-admin-component::mediapicker id="selectedMedia" name="media" />
                <span class="text-danger">*Hanya bisa memilih satu gambar</span>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary rounded-10">
            <i data-feather="send"></i> Tambah</button>
    </div>
</form>
