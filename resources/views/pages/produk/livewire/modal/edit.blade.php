<div>
    <div wire:ignore.self class="modal fade" id="editData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalEdit" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content bg-white">
                <div class="modal-header">
                    <h1 class="modal-title fs-4" id="modalEdit">Edit Data : {{ $title }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form autocomplete="off">
                        <div class="col-lg-12">
                            <div class="judul-utama mb-custom-1">Detail Produk</div>
                            <div class="form-group row mb-3">
                                <label class="label label-khusus fs-16 mb-2 col-lg-2" for="ekode">Kode SKU</label>
                                <div class="col-lg-10">
                                    <input type="text" wire:model="sku" class="form-control" id="ekode" readonly>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="label label-khusus fs-16 mb-2 col-lg-2" for="ebarcode">Barcode</label>
                                <div class="col-lg-10">
                                    <div class="input-group">
                                        <input type="number" wire:model.lazy="barcode" id="barcode" class="form-control @error('barcode') is-invalid @enderror" min="1"
                                            @if($barcodeMode===null || $barcodeMode==='off' ) disabled
                                            @elseif($barcodeMode==='generate' ) readonly
                                            @endif>
                                        @if($barcodeMode == 'generate' && !$barcodeIsExisting)
                                        <button type="button" wire:click="generateBarcode" class="btn btn-success hover-white fs-14 fw-normal text-white">Generate</button>
                                        @endif
                                        <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split text-white" data-bs-toggle="dropdown" aria-expanded="false">
                                            <span class="visually-hidden">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end bg-white border-1 box-shadow">
                                            @if($barcodeMode == 'generate' OR $barcodeMode == 'scanner')
                                            <li>
                                                <button type="button" class="dropdown-item text-secondary fs-16" wire:click="setBarcodeMode('off')">Disable Barcode</button>
                                            </li>
                                            @endif
                                            <li>
                                                <button type="button" class="dropdown-item text-secondary fs-16" wire:click="setBarcodeMode('generate')">Generate Manual</button>
                                            </li>
                                            <li>
                                                <button type="button" class="dropdown-item text-secondary fs-16" wire:click="setBarcodeMode('scanner')">Input Dari Scanner</button>
                                            </li>
                                        </ul>
                                        @error('barcode')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="label label-khusus fs-16 mb-2 col-lg-2" for="enama">Nama</label>
                                <div class="col-lg-10">
                                    <input type="text" wire:model.lazy="nama" class="form-control @error('nama') is-invalid @enderror" id="enama">
                                    @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="label label-khusus fs-16 mb-2 col-lg-2" for="etipe">Tipe</label>
                                <div class="col-lg-10">
                                    <select wire:model.lazy="tipe" class="form-select form-control @error('tipe') is-invalid @enderror" id="etipe">
                                        <option value="">...</option>
                                        @foreach ($arrayTipe as $value => $label)
                                        <option value="{{ $value }}">{{ $label }}</option>
                                        @endforeach
                                    </select>
                                    @error('tipe')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="label label-khusus fs-16 mb-2 col-lg-2" for="ekategori">Kategori</label>
                                <div class="col-lg-10">
                                    <select wire:model.lazy="kategori_id" class="form-select form-control @error('kategori_id') is-invalid @enderror" id="ekategori">
                                        <option value="">...</option>
                                        @foreach ($arrayKategori as $parent)
                                        <optgroup label="{{ $parent->nama }}">
                                            @foreach ($parent->child as $subparent)
                                            <option value="{{ $subparent->id }}">{{ $subparent->nama }}</option>
                                            @endforeach
                                        </optgroup>
                                        @endforeach
                                    </select>
                                    @error('kategori_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="label label-khusus fs-16 mb-2 col-lg-2" for="esatdas">Satuan Dasar</label>
                                <div class="col-lg-10">
                                    <select wire:model.lazy="satuan_id" class="form-select form-control @error('satuan_id') is-invalid @enderror" id="esatdas"
                                        {{ ((empty($satuanByTipe) && !$this->adaFallback) || ($this->adaFallback && !$this->satuanAsliDiList && empty($kodeSatuanLama))) ? 'disabled' : '' }}>
                                        <option value="">{{ empty($tipe) ? 'tipe produk belum dipilih !' : (empty($satuanByTipe) && !$this->adaFallback ? '(empty)' : '...') }}</option>
                                        @foreach ($satuanByTipe as $dataSatuan)
                                        <option value="{{ $dataSatuan['id'] }}">{{ $dataSatuan['kode'] }}</option>
                                        @endforeach
                                        @if ($this->adaFallback && !$this->satuanAsliDiList)
                                        <option value="{{ $satuan_asli }}" {{ $satuan_id == $satuan_asli ? 'selected' : '' }}>{{ $kodeSatuanLama ?? 'satuan tidak ditemukan' }}</option>
                                        @endif
                                    </select>
                                    @error('satuan_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="label label-khusus fs-16 mb-2 col-lg-2" for="ehpokok">HPP</label>
                                <div class="col-lg-10">
                                    <input type="number" value="{{ $hpp }}" class="form-control" id="ehpokok" min="1" placeholder="HPP belum tersedia" readonly>
                                </div>
                            </div>
        
                            <!-- HARGA JUAL REGULER-->
                            <div class="form-group row mb-3">
                                <label class="label label-khusus fs-16 mb-2 col-lg-2" for="ehjretail">Harga Retail</label>
                                <div class="col-lg-10">
                                    <input type="number" wire:model.lazy="hjretail" class="form-control @error('hjretail') is-invalid @enderror" id="ehjretail" placeholder="Harga jual retail / reguler" min="1">
                                    @error('hjretail')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <hr class="garis-1">

                            <!-- KONVERSI SATUAN -->
                            <div class="col-lg-12 col-md-12 mt-2">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div class="judul-utama">Konversi Satuan</div>
                                    <div class="form-switch mb-0 position-relative">
                                        <input class="form-check-input custom-switch-1" type="checkbox" id="switchKonversi" wire:model.lazy="showKonversiSatuan">
                                        <label class="switch-label" for="switchKonversi"></label>
                                    </div>
                                </div>
                                @if($showKonversiSatuan)
                                @foreach($barisKonversi as $uid => $row)
                                <div class="form-group row mb-3" wire:key="konversi-{{ $uid }}">
                                    <label class="label label-khusus fs-16 mb-2 col-lg-2">{{ $loop->first ? 'Satuan Induk' : 'Konversi '.$loop->index }}</label>
                                    <div class="col-lg-4">
                                        <select wire:model.lazy="barisKonversi.{{ $uid }}.satuan_id"
                                            class="form-select form-control @error('barisKonversi.'.$uid.'.satuan_id') is-invalid @enderror">
                                            <option value="">...</option>
                                            @foreach($arraySatuan as $dataSatuan)
                                            @php
                                            $sudahDipakai = collect($barisKonversi)->except($uid)->pluck('satuan_id')->contains($dataSatuan->id);
                                            @endphp
                                            @if($dataSatuan->id != $satuan_id && !$sudahDipakai)
                                            <option value="{{ $dataSatuan['id'] }}">{{ $dataSatuan['kode'] }}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                        @error('barisKonversi.'.$uid.'.satuan_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="input-group">
                                            <input type="number" wire:model.lazy="barisKonversi.{{ $uid }}.konversi" class="form-control @error('barisKonversi.'.$uid.'.konversi') is-invalid @enderror"
                                                placeholder="Contoh: 12, 24, ..." min="0.001" step="0.001">
                                            <span class="input-group-text fs-17">{{ $this->satuanKodeBawah($loop->index) }}</span>
                                            @error('barisKonversi.'.$uid.'.konversi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-2 d-flex align-items-start mt-custom">
                                        @if(count($barisKonversi) > 1)
                                        <button type="button" wire:click="hapusBarisKonversi('{{ $uid }}')" class="btn btn-danger p-1 border-0 text-white hover-white">
                                            <i class="material-symbols-outlined fs-22 fw-normal">delete</i>
                                        </button>
                                        @endif

                                        @if($loop->first)
                                        <button type="button" wire:click="tambahBarisKonversi" class="btn btn-primary p-1 border-0 text-white hover-white ms-auto">
                                            <i class="material-symbols-outlined fs-22 fw-normal">add</i>
                                        </button>
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                                <div class="alert fs-17 alert-primary p-2 text-primary text-center fw-bold mb-1" role="alert">
                                    {{ $this->captionKonversiSatuan() }}
                                </div>
                                @endif
                            </div>
                            <hr class="garis-1">

                            <!-- HARGA JUAL GROSIR -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="judul-utama">Harga Grosir</div>
                                <div class="form-switch mb-0 position-relative">
                                    <input wire:model.lazy="showHargaGrosir" class="form-check-input custom-switch-1" type="checkbox" id="switchHargaGrosir">
                                    <label class="switch-label" for="switchHargaGrosir"></label>
                                </div>
                            </div>
                            @if($showHargaGrosir)
                            <div class="alert alert-warning fs-16 mb-3" role="alert">
                                Harga per satuan bukan harga total keseluruhan, tapi per unit.<br>
                                Rentang qty Min Pembelian - Max Pembelian antar baris tidak boleh duplikat.<br>
                                Baris terakhir boleh dikosongkan Max Pembelian-nya agar berlaku untuk qty berapa pun ke atas.
                            </div>
                            <div class="d-flex justify-content-start mb-3">
                                <button type="button" wire:click="tambahBaris" class="btn btn-outline-primary p-2 fs-14 fw-normal hover-white">Tambah</button>
                            </div>
                            <div class="default-table-area mx-minus-1">
                                <div class="table-responsive">
                                    <table class="table align-middle">
                                        <thead>
                                            <tr>
                                                <th class="fw-medium" scope="col" style="width: 50px;">No.</th>
                                                <th class="fw-medium" scope="col" style="width: 209px;">Min Pembelian</th>
                                                <th class="fw-medium" scope="col" style="width: 209px;">Max Pembelian</th>
                                                <th class="fw-medium" scope="col">Harga Per Satuan</th>
                                                <th class="fw-medium" scope="col">Opsi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($barisHargaGrosir as $uid => $item)
                                            <tr wire:key="baris-{{ $uid }}">
                                                <td>{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}.</td>
                                                <td>
                                                    <div class="input-group">
                                                        <input type="number" wire:model.lazy="barisHargaGrosir.{{ $uid }}.qty_min"
                                                            class="form-control @error('barisHargaGrosir.'.$uid.'.qty_min') is-invalid @enderror" min="0.001" step="0.001">
                                                        <span class="input-group-text fs-17">{{ $satuan_id ? $arraySatuan->firstWhere('id', $satuan_id) ?->kode : '...' }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="input-group">
                                                        <input type="number" wire:model.lazy="barisHargaGrosir.{{ $uid }}.qty_max"
                                                            class="form-control @error('barisHargaGrosir.'.$uid.'.qty_max') is-invalid @enderror" min="0.001" step="0.001">
                                                        <span class="input-group-text fs-17">{{ $satuan_id ? $arraySatuan->firstWhere('id', $satuan_id) ?->kode : '...' }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <input type="number" wire:model.lazy="barisHargaGrosir.{{ $uid }}.hjgrosir" 
                                                    class="form-control @error('barisHargaGrosir.'.$uid.'.hjgrosir') is-invalid @enderror" min="1">
                                                </td>
                                                <td class="text-end">
                                                    @if(count($barisHargaGrosir) > 1)
                                                    <button type="button" wire:click="hapusBaris('{{ $uid }}')" class="btn btn-danger p-1 border-0 text-white hover-white">
                                                        <i class="material-symbols-outlined fs-22 fw-normal">delete</i>
                                                    </button>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @endif
                            <hr class="garis-1">

                            <!-- HARGA JUAL MEMBER -->
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div class="judul-utama">Harga Member</div>
                                <div class="form-switch mb-0 position-relative">
                                    <input wire:model.lazy="showHargaMember" class="form-check-input custom-switch-1" type="checkbox" id="switchHargaMember">
                                    <label class="switch-label" for="switchHargaMember"></label>
                                </div>
                            </div>
                            @if($showHargaMember)
                            <div class="form-group row mb-3">
                                <label class="label label-khusus fs-16 mb-2 col-lg-2" for="ehjmember">Member VIP</label>
                                <div class="col-lg-10">
                                    <input type="number" wire:model.lazy="hjmember" class="form-control @error('hjmember') is-invalid @enderror" placeholder="Harga jual keanggotaan" id="ehjmember" min="1">
                                    @error('hjmember')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            @endif
                            <hr class="garis-1">

                            <!-- INFORMASI -->
                            <div class="judul-utama mb-custom-1">Informasi</div>
                            <div class="form-group row mb-3">
                                <label class="label label-khusus fs-16 mb-2 col-lg-2" for="estokmin">Stok Minimal</label>
                                <div class="col-lg-5">
                                    <div class="input-group">
                                        <input type="number" wire:model.lazy="stok_min" class="form-control @error('stok_min') is-invalid @enderror" id="estokmin" min="0.001" step="0.001">
                                        <span class="input-group-text fs-17">{{ $satuan_id ? $arraySatuan->firstWhere('id', $satuan_id) ?->kode : '...' }}</span>
                                        @error('stok_min')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <label class="label label-khusus fs-16 mb-2 col-lg-2" for="estts">Status Produk</label>
                                <div class="col-lg-5">
                                    <div class="form-group">
                                        <select wire:model.lazy="is_active" class="form-select form-control" id="estts">
                                            <option value="1">Aktif</option>
                                            <option value="0">Nonaktif</option>
                                        </select>
                                    </div>
                                </div>
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