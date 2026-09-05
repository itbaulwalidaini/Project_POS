<div>
    <div wire:ignore.self class="modal fade" id="tambahData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalCreate" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content bg-white">
                <div class="modal-header">
                    <h1 class="modal-title fs-4" id="modalCreate">Tambah Data</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form autocomplete="off">
                        <div class="form-group row mb-3">
                            <label class="label label-khusus fs-16 mb-2 col-lg-2" for="ctipe">Tipe</label>
                            <div class="col-lg-7">
                                <div class="form-group">
                                    <select wire:model.lazy="tipe" wire:key="select-tipe-{{ $selectTipe->pluck('value')->implode('-') }}"
                                        class="form-select form-control @error('tipe') is-invalid @enderror"
                                        id="ctipe" {{ $selectTipe->isEmpty() ? 'disabled' : '' }}>
                                        <option value="" @selected(empty($tipe))>{{ $selectTipe->isEmpty() ? 'tipe telah didaftarkan' : '...' }}</option>
                                        @foreach ($selectTipe as $dataTipe)
                                        <option value="{{ $dataTipe->value }}" wire:key="tipe-option-{{ $dataTipe->value }}"
                                            @selected($tipe==$dataTipe->value)>{{ $dataTipe->label() }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('tipe')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        @php $dipilih = collect($baris)->pluck('satuan_id')->filter()->toArray(); @endphp
                        @foreach ($baris as $rowId => $row)
                        @php
                        $barisTerpilih = $row['satuan_id'] ?? null;
                        $isLast = $rowId === array_key_last($baris);
                        $isFirst = $rowId === array_key_first($baris);
                        @endphp
                        <div class="form-group row {{ $isLast ? 'mb-0' : 'mb-3' }}" wire:key="cbaris-{{ $rowId }}">
                            <label class="label label-khusus fs-16 mb-2 col-lg-2 {{ !$isFirst ? 'invisible' : '' }}" for="csatuan-{{ $rowId }}">Satuan</label>
                            <div class="col-lg-7">
                                <select wire:model.lazy="baris.{{ $rowId }}.satuan_id" class="form-select form-control @error('baris.'.$rowId.'.satuan_id') is-invalid @enderror" id="csatuan-{{ $rowId }}">
                                    <option value="">...</option>
                                    @foreach ($satuan as $dataSatuan)
                                    @if (!in_array($dataSatuan->id, $dipilih) || $dataSatuan->id == $barisTerpilih)
                                    <option value="{{ $dataSatuan->id }}">{{ $dataSatuan->kode }}</option>
                                    @endif
                                    @endforeach
                                </select>
                                @error('baris.'.$rowId.'.satuan_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-2 d-flex align-items-start gap-3 mt-custom">
                                @if (count($baris) > 1)
                                <button type="button" wire:click="hapusBaris('{{ $rowId }}')" class="btn btn-danger p-1 border-0 text-white hover-white">
                                    <i class="material-symbols-outlined fs-23 fw-normal">remove_circle</i>
                                </button>
                                @endif
                                @if ($isLast)
                                <button type="button" wire:click="tambahBaris" class="btn btn-primary p-1 border-0 text-white hover-white">
                                    <i class="material-symbols-outlined fs-23 fw-normal">exposure_plus_1</i>
                                </button>
                                @endif
                            </div>
                        </div>
                        @endforeach
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

    modalTambah.addEventListener('show.bs.modal', () => {
        $wire.dispatch('bukaModalTambah');
    });

    modalTambah.addEventListener('hidden.bs.modal', () => {
        $wire.dispatch('resetModal');
    });
</script>
@endscript