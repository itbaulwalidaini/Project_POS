<div>
    <div wire:ignore.self class="modal fade" id="tambahData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalCreate" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-white">
                <div class="modal-header">
                    <h1 class="modal-title fs-4" id="modalCreate">Tambah Data</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form autocomplete="off">
                        <div class="mb-20">
                            <label class="label fs-16 mb-2" for="cnama">Nama</label>
                            <div class="form-group">
                                <input type="text" wire:model.lazy="nama" class="form-control @error('nama') is-invalid @enderror" id="cnama">
                                @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-20">
                            <label class="label fs-16 mb-2" for="ckat">Kategori Induk</label>
                            <div class="form-group">
                                <select wire:model.lazy="parent_id" class="form-select form-control @error('parent_id') is-invalid @enderror" id="ckat">
                                    <option value="" class="fw-bold">Jadikan Parent</option>
                                    @foreach ($kategori as $tampilkan)
                                    <option value="{{ $tampilkan->id }}">{{ $tampilkan->nama }}</option>
                                    @endforeach
                                </select>
                                @error('parent_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-0">
                            <label class="label fs-16 mb-2" for="cstatus">Status</label>
                            <div class="form-group col-6">
                                <select wire:model.lazy="is_active" class="form-select form-control" id="cstatus">
                                    <option value="1">Aktif</option>
                                    <option value="0">Nonaktif</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button wire:click="store" type="button" class="btn btn-primary fw-normal text-white w-100 py-3" wire:loading.attr="disabled" wire:target="store">
                        <span wire:loading.remove wire:target="store">Simpan</span>
                        <span wire:loading wire:target="store"><span class="spinner-border spinner-border-sm" aria-hidden="true"></span> Menyimpan...</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@script
<script>
    const modalTambah = document.getElementById('tambahData');

    $wire.on('tutupModalTambah', () => {
        bootstrap.Modal.getOrCreateInstance(document.getElementById('tambahData')).hide();
    });

    modalTambah.addEventListener('hidden.bs.modal', () => {
        $wire.dispatch('resetModal');
    });
</script>
@endscript