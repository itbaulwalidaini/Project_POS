<div>
    <div wire:ignore.self class="modal fade" id="editData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalEdit" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-white">
                <div class="modal-header">
                    <h1 class="modal-title fs-4" id="modalEdit">Edit Data : {{ $title }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form autocomplete="off">
                        <div class="mb-20">
                            <label class="label fs-16 mb-2" for="enama">Nama</label>
                            <div class="form-group">
                                <input type="text" wire:model.lazy="nama" class="form-control @error('nama') is-invalid @enderror" id="enama">
                                @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-20">
                            <label class="label fs-16 mb-2" for="ekode">Kode</label>
                            <div class="form-group">
                                <input type="text" wire:model.lazy="kode" class="form-control @error('kode') is-invalid @enderror" id="ekode" placeholder="contoh: pcs, dus, kg, dll">
                                @error('kode')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-0">
                            <label class="label fs-16 mb-2" for="edeskripsi">Deskripsi</label>
                            <div class="form-group">
                                <textarea wire:model.lazy="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" id="edeskripsi" placeholder="Deskripsi opsional diisi" style="height: 100px"></textarea>
                                @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button wire:click="update" type="button" class="btn btn-success fw-normal text-white w-100 py-3" wire:loading.attr="disabled" wire:target="update">
                        <span wire:loading.remove wire:target="update">Update</span>
                        <span wire:loading wire:target="update"><span class="spinner-border spinner-border-sm" aria-hidden="true"></span> Mengupdate...</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@script
<script>
    const modalEdit = document.getElementById('editData');

    $wire.on('bukaModalEdit', () => {
        bootstrap.Modal.getOrCreateInstance(document.getElementById('editData')).show();
    });

    $wire.on('tutupModalEdit', () => {
        bootstrap.Modal.getOrCreateInstance(document.getElementById('editData')).hide();
    });

    modalEdit.addEventListener('hidden.bs.modal', () => {
        $wire.dispatch('resetModal');
    });
</script>
@endscript