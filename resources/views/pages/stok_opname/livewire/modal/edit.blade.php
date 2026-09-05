<div>
    <div wire:ignore.self class="modal fade" id="editData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalEdit" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen modal-dialog-scrollable">
            <div class="modal-content bg-white">
                <div class="modal-header">
                    <h1 class="modal-title fs-4" id="modalEdit">Edit Opname Batch : {{ $title }}</h1>
                    <button type="button" class="btn-close" @if($this->adaDataInput()) onclick="tutupModalEdt()" @else data-bs-dismiss="modal" @endif></button>
                </div>
                @if($adaPerubahanStok)
                <div class="alert alert-warning d-flex justify-content-between align-items-center mb-0">
                    <div>
                        <strong class="fs-18">Perhatian!</strong><br>
                        Terdapat {{ count($produkBerubah) }} produk yang datanya telah berubah sejak status opname ini {{ $sttsalert }}.
                        <ul class="mb-0 mt-1 fs-15">
                            @foreach($produkBerubah as $item)
                            @if($item['stok_berubah'])
                            <li>Stok {{ $item['nama'] }} [{{ $item['stok_lama'] }} → {{ $item['stok_sekarang'] }}]</li>
                            @endif
                            @if($item['hpp_berubah'])
                            <li>HPP {{ $item['nama'] }} [{{ $item['hpp_lama'] }} → {{ $item['hpp_sekarang'] }}]</li>
                            @endif
                            @endforeach
                        </ul>
                    </div>
                    <button type="button" class="btn btn-warning p-2 fs-15 fw-normal text-white" wire:click="refreshData"> Perbarui Sekarang!</button>
                </div>
                @endif
                <div class="modal-body">
                    <form autocomplete="off">
                        <div class="col-lg-12">
                            <div class="form-group row mb-3">
                                <label class="label label-khusus fs-16 mb-2 col-lg-1" for="etanggal">Per Tanggal</label>
                                <div class="col-lg-2">
                                    <input type="date" wire:model.lazy="per_tanggal" max="{{ now()->format('Y-m-d') }}" class="form-control @error('per_tanggal') is-invalid @enderror" id="etanggal">
                                    @error('per_tanggal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <label class="label label-khusus fs-16 mb-2 col-lg-1" for="status">Status Opname</label>
                                <div class="col-lg-2">
                                    <select wire:model.lazy="status_opname" class="form-select form-control @error('status_opname') is-invalid @enderror" id="status">
                                        <option value="pending" selected>Masih Dikoreksi</option>
                                        <option value="approved">Disetujui</option>
                                    </select>
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
                                                <th class="fw-medium" scope="col" style="width: 155px;">Satuan</th>
                                                <th class="fw-medium" scope="col" style="width: 165px;">Stok Sistem</th>
                                                <th class="fw-medium" scope="col" style="width: 165px;">Stok Fisik</th>
                                                <th class="fw-medium" scope="col" style="width: 165px;">Selisih Stok</th>
                                                <th class="fw-medium" scope="col" style="width: 180px;">Selisih HPP</th>
                                                <th class="fw-medium" scope="col" style="width: 285px;">Keterangan Selisih</th>
                                                <th class="fw-medium" scope="col">Opsi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($baris as $uid => $item)
                                            <tr wire:key="baris-{{ $uid }}">
                                                <td>{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}.</td>
                                                <td>
                                                    <div class="position-relative">
                                                        <input type="text" wire:model.lazy="baris.{{ $uid }}.sku" wire:keydown.enter="setKode('{{ $uid }}')"
                                                            wire:change="setKode('{{ $uid }}')"
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
                                                    <input type="text" value="{{ !empty($item['satuan_id']) ? $item['satuan_id'] : '' }}"
                                                        class="form-control" @if(empty($item['produk_id'])) disabled @else readonly @endif>
                                                </td>
                                                <td>
                                                    <input type="text" value="{{ !empty($item['stok']) ? rtrim(rtrim(number_format($item['stok'], 3, '.', ''), '0'), '.') : '' }}"
                                                        class="form-control" @if(empty($item['produk_id'])) disabled @else readonly @endif>
                                                </td>
                                                <td>
                                                    <input type="number" wire:model.lazy="baris.{{ $uid }}.stok_fisik" wire:change="hitungSelisihStok('{{ $uid }}')"
                                                        class="form-control @if(!empty($item['produk_id'])) @error('baris.'.$uid.'.stok_fisik') is-invalid @enderror @endif"
                                                        min="0.001" step="0.001"
                                                        @if(empty($item['produk_id'])) disabled @else placeholder="Jumlah" @endif>
                                                </td>
                                                <td>
                                                    <input type="text" value="{{ $item['selisih_stok'] > 0 ? '+' . $item['selisih_stok'] : $item['selisih_stok'] }}"
                                                        class="form-control" @if(empty($item['produk_id'])) disabled @else readonly @endif>
                                                </td>
                                                <td>
                                                    <input type="text" value="{{ $item['selisih_hpp'] > 0 ? '+' . $item['selisih_hpp'] : $item['selisih_hpp'] }}"
                                                        class="form-control" @if(empty($item['produk_id'])) disabled @else readonly @endif>
                                                </td>
                                                <td>
                                                    @if(empty($item['produk_id']))
                                                    <input type="text" class="form-control" disabled>
                                                    @else
                                                    <select wire:model.lazy="baris.{{ $uid }}.ket_id" class="form-select form-control"
                                                        @if(empty($item['produk_id'])) disabled @endif>
                                                        <option value="">...</option>
                                                        @foreach($ket_id as $dataAlasan)
                                                        <option value="{{ $dataAlasan->id }}">{{ $dataAlasan->caption }}</option>
                                                        @endforeach
                                                    </select>
                                                    @endif
                                                </td>
                                                <td class="text-end">
                                                    <button type="button" wire:click="hapusBaris('{{ $uid }}')" class="btn btn-danger p-1 border-0 text-white hover-white">
                                                        <i class="material-symbols-outlined fs-22 fw-normal">close</i>
                                                    </button>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="10" class="text-center">
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
                                        <label class="label fs-16 mb-2" for="enote">Keterangan</label>
                                        <div class="form-group">
                                            <textarea wire:model.lazy="keterangan" class="form-control @error('keterangan') is-invalid @enderror" id="enote"
                                                placeholder="(Opsional diisi)" style="height: 80px"></textarea>
                                            @error('keterangan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button wire:click="validasiUpdate" type="button" class="btn btn-success fw-normal text-white w-100 py-3" wire:loading.attr="disabled" wire:target="validasiUpdate">
                        <span wire:loading.remove wire:target="validasiUpdate">Update</span>
                        <span wire:loading wire:target="validasiUpdate"><span class="spinner-border spinner-border-sm" aria-hidden="true"></span> Mengupdate...</span>
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

    window.tutupModalEdt = async function() {
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

        const modalEl = document.getElementById("editData");
        const modalInstance = bootstrap.Modal.getInstance(modalEl);
        modalInstance.hide();
    }
</script>
@endscript