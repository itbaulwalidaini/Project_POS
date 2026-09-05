<div>
    <div wire:ignore.self class="modal fade" id="editData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalEdit" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content bg-white">
                <div class="modal-header">
                    <h1 class="modal-title fs-4" id="modalEdit">Edit Nota : {{ $kode }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form autocomplete="off">
                        <div class="col-lg-12">
                            <div class="border rounded p-2 bg-default align-items-center mb-3">
                                <div class="mb-0">
                                    <div class="mb-3">
                                        <label class="label fs-16 mb-2" for="ecar">Cari Produk</label>
                                        <div class="row g-3">
                                            <div class="col-lg-5">
                                                <input type="text" wire:model.lazy="sku" wire:keydown.enter="setKode" wire:change="setKode" id="ecar"
                                                    class="form-control @error('sku') is-invalid @enderror" placeholder="Masukkan SKU / Barcode">
                                            </div>
                                            <div class="col-lg-7">
                                                <select wire:model.lazy="produk_id" wire:change="setData" class="form-select form-control @error('produk_id') is-invalid @enderror">
                                                    <option value="">...</option>
                                                    @foreach($produk as $dataProduk)
                                                    <option value="{{ $dataProduk->id }}">{{ $dataProduk->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    @if($produkDipilih)
                                    <div class="alert fs-16 alert-warning p-2 d-flex justify-content-center align-items-center" role="alert">
                                        <div class="text-center">
                                            <p class="text-muted fs-7 mb-1">Stok Tersisa</p>
                                            <p class="fw-semibold fs-19 mb-0">{{ $stok_tersisa_dasar }}
                                                @if($stok_tersisa !== $stok_tersisa_dasar)
                                                <span class="text-muted fw-semibold">
                                                    ({{ $stok_tersisa }})
                                                </span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <label class="label fs-16 mb-2">Tipe</label>
                                                <div class="form-group">
                                                    <input type="text" value="{{ !empty($tipe) ? $tipe : '' }}" class="form-control" @if(empty($produk_id)) disabled @else readonly @endif>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <label class="label fs-16 mb-2">Satuan</label>
                                                <div class="form-group">
                                                    @if(!empty($produk_id) && count($opsiSatuan) > 1)
                                                    <select wire:model="satuan_terpilih_id" class="form-select form-control">
                                                        @foreach($opsiSatuan as $opsi)
                                                        <option value="{{ $opsi['satuan_id'] }}">{{ $opsi['kode'] }}</option>
                                                        @endforeach
                                                    </select>
                                                    @else
                                                    <input type="text" value="{{ $opsiSatuan[0]['kode'] ?? '' }}" class="form-control" @if(empty($produk_id)) disabled @else readonly @endif>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <label class="label fs-16 mb-2">Qty Rencana</label>
                                                <div class="form-group">
                                                    <input type="number" wire:model.lazy="qty_rencana" id="qty" class="form-control @error('qty_rencana') is-invalid @enderror"
                                                        min="0.001" step="0.001" @if(empty($produk_id)) disabled @else placeholder="Jumlah" @endif>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" wire:click="masukkanProduk" class="btn btn-primary fs-16 fw-normal hover-white text-white py-2 px-4 w-100 mb-0">
                                        <i class="ri-add-line"></i>Tambahkan
                                    </button>
                                </div>
                            </div>
                            <div class="judul-utama mb-custom-1">Perencanaan</div>
                            <div class="col-lg-12">
                                <div class="default-table-area mx-minus-1">
                                    <div class="table-responsive">
                                        <table class="table align-middle">
                                            <thead>
                                                <tr>
                                                    <th class="fw-medium" scope="col" style="width: 70px;">No.</th>
                                                    <th class="fw-medium" scope="col">Nama Produk</th>
                                                    <th class="fw-medium" scope="col">Tipe</th>
                                                    <th class="fw-medium" scope="col">Qty Rencana</th>
                                                    <th class="fw-medium" scope="col">Opsi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($keranjang as $uid => $item)
                                                <tr wire:key="keranjang-{{ $uid }}">
                                                    <td class="text-body">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}.</td>
                                                    <td class="text-body">{{ $item['nama'] }}</td>
                                                    <td class="text-body">{{ $item['tipe'] }}</td>
                                                    <td class="text-body">{{ $this->formatQtyRencana($item) }}</td>
                                                    <td class="text-body">
                                                        <button type="button" wire:click="ubahQty('{{ $uid }}', -1)" class="btn btn-outline-secondary p-1 hover-white">
                                                            <i class="material-symbols-outlined fs-20 fw-normal">remove</i>
                                                        </button>
                                                        <button type="button" wire:click="ubahQty('{{ $uid }}', 1)" class="btn btn-outline-secondary p-1 hover-white">
                                                            <i class="material-symbols-outlined fs-20 fw-normal">add</i>
                                                        </button>
                                                        <button type="button" wire:click="hapusKeranjang('{{ $uid }}')" class="btn btn-danger p-1 border-0 text-white hover-white ms-2">
                                                            <i class="material-symbols-outlined fs-22 fw-normal">delete</i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td colspan="7" class="text-center">
                                                        @if($keranjangError)
                                                        <div class="alert fs-16 alert-danger text-danger mb-0" role="alert">
                                                            <i class="ri-alert-line fs-19 me-1"></i>
                                                            Masukkan item terlebih dahulu!
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
                            </div>
                            @if(!empty($keranjang))
                            <div class="mt-3 mb-0">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label class="label fs-16 mb-2" for="ecat">Catatan</label>
                                        <div class="form-group">
                                            <textarea wire:model.lazy="catatan" class="form-control @error('catatan') is-invalid @enderror" id="ecat"
                                                placeholder="(Opsional diisi)" style="height: 70px"></textarea>
                                            @error('catatan')
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
            text: "Semua perubahan data item akan dihapus!",
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