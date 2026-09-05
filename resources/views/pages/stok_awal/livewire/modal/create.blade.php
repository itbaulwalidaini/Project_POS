<div>
    <div wire:ignore.self class="modal fade" id="tambahData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalTambah" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen modal-dialog-scrollable">
            <div class="modal-content bg-white">
                <div class="modal-header">
                    <h1 class="modal-title fs-4" id="modalTambah">Stok Awal</h1>
                    <button type="button" class="btn-close" @if($this->adaDataInput()) onclick="tutupModal()" @else data-bs-dismiss="modal" @endif></button>
                </div>
                <div class="modal-body">
                    <form autocomplete="off">
                        <div class="col-lg-12">
                            <div class="form-group row mb-3">
                                <label class="label label-khusus fs-16 mb-2 col-lg-1" for="batch">No Batch</label>
                                <div class="col-lg-2">
                                    <input type="text" wire:model="batch" class="form-control" id="batch" readonly>
                                </div>
                                <label class="label label-khusus fs-16 mb-2 col-lg-1" for="tanggal">Per Tanggal</label>
                                <div class="col-lg-2">
                                    <input type="date" wire:model.lazy="per_tanggal" max="{{ now()->format('Y-m-d') }}" class="form-control @error('per_tanggal') is-invalid @enderror" id="tanggal">
                                    @error('per_tanggal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <button type="button" wire:click="tambahBaris" class="btn btn-outline-primary p-2 fs-15 fw-normal hover-white">
                                        Tambah <i class="ri-add-circle-line"></i>
                                    </button>
                                    <button type="button" wire:click="tambahSemuaProduk" class="btn btn-outline-success p-2 fs-15 fw-normal hover-white ms-2">
                                        Generate <i class="ri-list-check-3"></i>
                                    </button>
                                </div>
                                @if(!empty($baris))
                                <button type="button" onclick="hapusSemuaData()" class="btn btn-outline-danger p-2 fs-15 fw-normal hover-white">
                                    Hapus Semua <i class="ri-delete-bin-5-line"></i>
                                </button>
                                @endif
                            </div>
                            <div class="default-table-area mx-minus-1">
                                <div class="table-responsive">
                                    <table class="table align-middle">
                                        <thead>
                                            <tr>
                                                <th class="fw-medium" scope="col" style="width: 70px;">No.</th>
                                                <th class="fw-medium" scope="col" style="width: 270px;">SKU / Barcode</th>
                                                <th class="fw-medium" scope="col" style="width: 335px;">Nama</th>
                                                <th class="fw-medium" scope="col" style="width: 180px;">Tipe</th>
                                                <th class="fw-medium" scope="col" style="width: 200px;">Total Beli (Rp)</th>
                                                <th class="fw-medium" scope="col" style="width: 165px;">Qty</th>
                                                <th class="fw-medium" scope="col" style="width: 155px;">Satuan</th>
                                                <th class="fw-medium" scope="col" style="width: 180px;">HPP</th>
                                                <th class="fw-medium" scope="col">Opsi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($baris as $uid => $item)
                                            <tr wire:key="baris-{{ $uid }}">
                                                <td>{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}.</td>
                                                <td>
                                                    <div class="position-relative">
                                                        <input type="text" wire:model.lazy="baris.{{ $uid }}.sku" wire:keydown.enter="setKode('{{ $uid }}')" wire:change="setKode('{{ $uid }}')"
                                                            class="form-control @error('baris.'.$uid.'.sku') is-invalid @enderror" placeholder="Masukkan SKU / Barcode">
                                                    </div>
                                                </td>
                                                <td>
                                                    <select wire:model.lazy="baris.{{ $uid }}.produk_id" wire:change="setData('{{ $uid }}')"
                                                        class="form-select form-control @error('baris.'.$uid.'.produk_id') is-invalid @enderror">
                                                        <option value="">...</option>
                                                        @php
                                                        $dipilih = collect($baris)->pluck('produk_id')->filter()->toArray();
                                                        $dipilihBaris = $item['produk_id'] ?? null;
                                                        @endphp
                                                        @foreach($produk as $dataProduk)
                                                        @if(!in_array($dataProduk->id, $dipilih) || $dataProduk->id == $dipilihBaris)
                                                        <option value="{{ $dataProduk->id }}">{{ $dataProduk->nama }}</option>
                                                        @endif
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" value="{{ $item['tipe'] ?? '' }}" class="form-control" @if(empty($item['produk_id'])) disabled @else readonly @endif>
                                                </td>
                                                <td>
                                                    <input type="number" wire:model.lazy="baris.{{ $uid }}.total_beli" wire:change="hitungHpp('{{ $uid }}')"
                                                        class="form-control @if(!empty($item['produk_id'])) @error('baris.'.$uid.'.total_beli') is-invalid @enderror @endif"
                                                        min="1" @if(empty($item['produk_id'])) disabled @else placeholder="Lihat di nota" @endif>
                                                </td>
                                                <td>
                                                    <input type="number" wire:model.lazy="baris.{{ $uid }}.qty" wire:change="hitungHpp('{{ $uid }}')"
                                                        class="form-control @if(!empty($item['produk_id'])) @error('baris.'.$uid.'.qty') is-invalid @enderror @endif"
                                                        min="0.001" step="0.001"
                                                        @if(empty($item['produk_id'])) disabled @else placeholder="Jumlah" @endif>
                                                </td>
                                                <td>
                                                    @if(!empty($item['opsi_satuan']) && count($item['opsi_satuan']) > 1)
                                                    <select wire:model.lazy="baris.{{ $uid }}.satuan_id" wire:change="setSatuan('{{ $uid }}')" class="form-select form-control"
                                                        @if(empty($item['produk_id'])) disabled @endif>
                                                        @foreach($item['opsi_satuan'] as $opsi)
                                                        <option value="{{ $opsi['satuan_id'] }}"
                                                            @selected(($item['satuan_id'] ?? null)==$opsi['satuan_id'])>
                                                            {{ $opsi['kode'] }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    @else
                                                    <input type="text" value="{{ $item['opsi_satuan'][0]['kode'] ?? '' }}" class="form-control" readonly>
                                                    @endif
                                                </td>
                                                <td>
                                                    <input type="text" value="{{ !empty($item['hpp']) ? number_format($item['hpp'], 0, ',', '.') : '' }}"
                                                        class="form-control" @if(empty($item['produk_id'])) disabled @else readonly @endif>
                                                </td>
                                                <td class="text-end">
                                                    <button type="button" wire:click="hapusBaris('{{ $uid }}')" class="btn btn-danger p-1 border-0 text-white hover-white">
                                                        <i class="material-symbols-outlined fs-22 fw-normal">close</i>
                                                    </button>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="9" class="text-center">
                                                    @if($tersimpan && empty($baris))
                                                    <div class="alert fs-16 alert-danger text-danger mb-0" role="alert">
                                                        <i class="ri-alert-line fs-19 me-1"></i>
                                                        Belum ada item yang dipilih. Klik "<b>Tambah / Generate</b>".
                                                    </div>
                                                    @else
                                                    <p class="h4">Data masih kosong!</p>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @if(!empty($baris))
                            <div class="mt-3 mb-0">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <label class="label fs-16 mb-2" for="note">Keterangan</label>
                                        <div class="form-group">
                                            <textarea wire:model.lazy="note" class="form-control @error('note') is-invalid @enderror" id="note"
                                                placeholder="(Opsional diisi)" style="height: 80px"></textarea>
                                            @error('note')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <label class="label fs-16 mb-2" for="note">Total Belanja (Rp)</label>
                                        <div class="form-group">
                                            <input type="text" value="{{ number_format(collect($baris)->sum('sub_total'), 0, ',', '.') }}" class="form-control" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </form>
                </div>
                <button wire:click="validasiSebelumKonfirmasi" type="button" class="btn btn-primary fw-normal text-white w-100 py-3" wire:loading.attr="disabled" wire:target="validasiSebelumKonfirmasi">
                    <span wire:loading.remove wire:target="validasiSebelumKonfirmasi">Simpan</span>
                    <span wire:loading wire:target="validasiSebelumKonfirmasi"><span class="spinner-border spinner-border-sm" aria-hidden="true"></span> Menyimpan...</span>
                </button>
            </div>
        </div>
    </div>
</div>

@script
<script>
    const modalTambah = document.getElementById('tambahData');

    modalTambah.addEventListener('show.bs.modal', () => {
        $wire.dispatch('bukaModalTambah');
    });

    $wire.on('tutupModalTambah', () => {
        bootstrap.Modal.getOrCreateInstance(document.getElementById('tambahData')).hide();
    });

    modalTambah.addEventListener('hidden.bs.modal', () => {
        $wire.dispatch('resetModal');
    });

    window.tutupModal = async function() {
        const result = await Swal.fire({
            title: "Keluar dari form?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Oke, Keluar",
            cancelButtonText: "Batal",
            scrollbarPadding: true,
            allowOutsideClick: false,
            allowEscapeKey: false,
        });

        if (!result.isConfirmed) return;
        Livewire.dispatch("resetModal");

        const modalEl = document.getElementById("tambahData");
        const modalInstance = bootstrap.Modal.getInstance(modalEl);
        modalInstance.hide();
    }

    window.hapusSemuaData = async function() {
        const result = await Swal.fire({
            title: "Hapus semua data?",
            text: "Data yang diinput akan hilang!", 
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Oke, Hapus",
            cancelButtonText: "Batal",
            scrollbarPadding: true,
            allowOutsideClick: false,
            allowEscapeKey: false,
        });

        if (!result.isConfirmed) return;
        Livewire.dispatch("resetSemuaBaris");
    }
</script>
@endscript