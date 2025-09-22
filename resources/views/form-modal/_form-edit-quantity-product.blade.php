<div class="modal fade" id="kt_modal_edit_quantity" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-500px">
        <div class="modal-content rounded">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <button type="button" class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </button>
            </div>
            <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                <form id="form-edit-quantity" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" id="quantity_id">
                    
                    <div class="mb-10 text-center">
                        <h1 class="mb-3">Edit Kuantitas</h1>
                        <div class="text-muted fw-semibold fs-5">Masukkan kuantitas sesuai kebutuhan.</div>
                    </div>

                    <div class="mb-7">
                        <label class="form-label fw-semibold">Kuantitas</label>
                        <input type="number" step="1" class="form-control form-control-solid" id="quantity_input" name="quantity">
                    </div>

                    <div class="text-center">
                        <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
