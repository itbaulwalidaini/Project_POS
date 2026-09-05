<div>
    <div wire:ignore.self class="modal fade" id="tambahData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalTambah" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen modal-dialog-scrollable">
            <div class="modal-content bg-white">
                <div class="modal-header">
                    <h1 class="modal-title fs-4" id="modalTambah">Realisasi Pembelian</h1>
                    <button type="button" class="btn-close" @if($this->adaDataInput()) onclick="tutupModal()" @else data-bs-dismiss="modal" @endif></button>
                </div>
                <div class="modal-body">
                    <form autocomplete="off">
                        <div class="col-lg-12">
                            <div class="form-group row mb-3">
                                <label class="label label-khusus fs-16 mb-2 col-lg-1" for="kodepmb">Kode Transaksi</label>
                                <div class="col-lg-2">
                                    <input type="text" value="{{ $kode }}" class="form-control" id="kodepmb" readonly>
                                </div>
                                <label class="label label-khusus fs-16 mb-2 col-lg-1" for="tgl">Tanggal</label>
                                <div class="col-lg-2">
                                    <input type="text" value="{{ $tanggal_input }}" class="form-control" id="tgl" readonly>
                                </div>
                                <label class="label label-khusus fs-16 mb-2 col-lg-1" for="modeInput">Sumber Data</label>
                                <div class="col-lg-2">
                                    <select class="form-select form-control" id="modeInput" data-current="{{ $modeInput }}" onchange="konfirmasiUbahMode(this)">
                                        <option value="manual" @selected($modeInput==='manual' )>Input Manual</option>
                                        <option value="perencanaan" @selected($modeInput==='perencanaan' )>Perencanaan Pembelian</option>
                                    </select>
                                </div>
                                @if($modeInput === 'perencanaan')
                                <div class="col-lg-2">
                                    <div class="input-group">
                                        <select wire:model="notaPerencanaan" class="form-select form-control">
                                            <option value="">Pilih Nota</option>
                                            @foreach($daftarPerencanaan as $list)
                                            <option value="{{ $list->id }}">{{ $list->kode }}</option>
                                            @endforeach
                                        </select>
                                        <button type="button" onclick="konfirmasiAmbilData()" class="btn btn-primary p-2 text-white">
                                            Ambil Data
                                        </button>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between align-items-center {{ $modeInput == 'manual' ? 'mb-3' : 'mb-3' }}">
                                <div>
                                    @if($modeInput === 'manual')
                                    <button type="button" wire:click="tambahBaris" class="btn btn-outline-primary p-2 fs-15 fw-normal hover-white">
                                        Tambah <i class="ri-add-circle-line"></i>
                                    </button>
                                    @endif
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
                                                @if($modeInput === 'manual')
                                                <th class="fw-medium" scope="col" style="width: 270px;">SKU / Barcode</th>
                                                @endif
                                                <th class="fw-medium" scope="col" style="width: 335px;">Nama</th>
                                                <th class="fw-medium" scope="col" style="width: 180px;">Tipe</th>
                                                @if($modeInput === 'perencanaan')
                                                <th class="fw-medium" scope="col" style="width: 330px;">Qty Rencana</th>
                                                @endif
                                                <th class="fw-medium" scope="col" style="width: 200px;">Total Beli (Rp)</th>
                                                <th class="fw-medium" scope="col" style="width: {{ $modeInput === 'manual' ? '165px' : '280px' }}; ">
                                                    {{ $modeInput === 'perencanaan' ? 'Qty Realisasi' : 'Qty' }}
                                                </th>
                                                @if($modeInput === 'manual')
                                                <th class="fw-medium" scope="col" style="width: 155px;">Satuan</th>
                                                @endif
                                                @if($modeInput === 'perencanaan')
                                                <th class="fw-medium" scope="col" style="width: 165px;">Selisih</th>
                                                @endif
                                                <th class="fw-medium" scope="col" style="width: 180px;">HPP</th>
                                                <th class="fw-medium" scope="col">Opsi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($baris as $uid => $item)
                                            <tr wire:key="baris-{{ $uid }}">
                                                <td>{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}.</td>

                                                @if($modeInput === 'manual')
                                                <td>
                                                    <div class="position-relative">
                                                        <input type="text" wire:model.lazy="baris.{{ $uid }}.sku" wire:keydown.enter="setKode('{{ $uid }}')" wire:change="setKode('{{ $uid }}')"
                                                            class="form-control @error('baris.'.$uid.'.sku') is-invalid @enderror" placeholder="Masukkan SKU / Barcode">
                                                    </div>
                                                </td>
                                                @endif

                                                <td>
                                                    @if($modeInput === 'manual')
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
                                                    @else
                                                    <input type="text" value="{{ $item['nama'] ?? '' }}" class="form-control" readonly>
                                                    @endif
                                                </td>
                                                <td>
                                                    <input type="text" value="{{ $item['tipe'] ?? '' }}" class="form-control" @if(empty($item['produk_id'])) disabled @else readonly @endif>
                                                </td>
                                                @if($modeInput === 'perencanaan')
                                                <td>
                                                    <input type="text" value="{{ !empty($item['qty_rencana']) ? $item['qty_rencana'] . ' ' . 
                                                    ($item['satuan_dasar_kode'] ?? '') . (!empty($item['qty_rencana_breakdown']) ? ' (' . $item['qty_rencana_breakdown'] . ')' : '') : '' }}"
                                                        class="form-control" readonly>
                                                </td>
                                                @endif
                                                <td>
                                                    <input type="number" wire:model.lazy="baris.{{ $uid }}.total_beli" wire:change="hitungHpp('{{ $uid }}')"
                                                        class="form-control @if(!empty($item['produk_id'])) @error('baris.'.$uid.'.total_beli') is-invalid @enderror @endif"
                                                        min="1" @if(empty($item['produk_id'])) disabled @else placeholder="Lihat di nota" @endif>
                                                </td>
                                                <td>
                                                    <div class="input-group">
                                                        <input type="number" wire:model.lazy="baris.{{ $uid }}.qty" wire:change="hitungHpp('{{ $uid }}')"
                                                            class="form-control @if(!empty($item['produk_id'])) @error('baris.'.$uid.'.qty') is-invalid @enderror @endif"
                                                            min="0.001" step="0.001"
                                                            @if(empty($item['produk_id'])) disabled @endif>
                                                        @if($modeInput === 'perencanaan')
                                                        <select wire:model.lazy="baris.{{ $uid }}.satuan_id" wire:change="setSatuan('{{ $uid }}')" class="form-select form-control"
                                                            @if(empty($item['produk_id'])) disabled @endif>
                                                            @foreach($item['opsi_satuan'] as $opsi)
                                                            <option value="{{ $opsi['satuan_id'] }}"
                                                                @selected(($item['satuan_id'] ?? null)==$opsi['satuan_id'])>
                                                                {{ $opsi['kode'] }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                        @endif
                                                    </div>
                                                </td>

                                                @if($modeInput === 'manual')
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
                                                @endif

                                                @if($modeInput === 'perencanaan')
                                                <td>
                                                    @php
                                                    $sudahDiisi = !empty($item['total_beli']) && !empty($item['qty']);
                                                    $selisih = $sudahDiisi ? (($item['qty_stok'] ?? 0) - ($item['qty_rencana'] ?? 0)) : null;
                                                    $kelasSelisih = $selisih === null ? '' : ($selisih < 0 ? 'text-danger' : ($selisih> 0 ? 'text-success' : ''));
                                                        @endphp
                                                        <input type="text" value="{{ $selisih !== null ? $selisih : '' }}" class="form-control {{ $kelasSelisih }}" readonly>
                                                </td>
                                                @endif
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
                                                <td colspan="{{ $modeInput == 'manual' ? 9 : 10 }}" class="text-center">
                                                    @if($tersimpan && empty($baris))
                                                    <div class="alert fs-16 alert-danger text-danger mb-0" role="alert">
                                                        <i class="ri-alert-line fs-19 me-1"></i>
                                                        @if($modeInput === 'manual')
                                                        Belum ada item yang dipilih. Klik "<b>Tambah</b>".
                                                        @else
                                                        Belum ada item yang dipilih. <b>Pilih Nota</b> terlebih dahulu.
                                                        @endif
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
                                    <div class="col-lg-2 mb-3">
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
            title: "Hapus seluruh data?",
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

    window.konfirmasiAmbilData = async function() {
        const select = document.querySelector('select[wire\\:model="notaPerencanaan"]');

        if (!select || !select.value) {
            return;
        }

        const result = await Swal.fire({
            title: "Ambil data perencanaan ini?",
            text: "Baris perencanaan lain (jika ada) akan dihapus",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Ambil Data",
            cancelButtonText: "Batal",
            scrollbarPadding: true,
            allowOutsideClick: false,
            allowEscapeKey: false,
        });

        if (!result.isConfirmed) return;
        Livewire.dispatch("ambilDataKonfirmasi");
    }

    window.konfirmasiUbahMode = async function(select) {
        const nilaiBaru = select.value;
        const nilaiLama = select.dataset.current;

        if (nilaiBaru === nilaiLama) return;

        const result = await Swal.fire({
            title: "Ganti sumber data?",
            text: "Data yang sudah diisi akan direset",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Ganti",
            cancelButtonText: "Batal",
            scrollbarPadding: true,
            allowOutsideClick: false,
            allowEscapeKey: false,
        });

        if (!result.isConfirmed) {
            select.value = nilaiLama;
            return;
        }

        select.dataset.current = nilaiBaru;
        Livewire.dispatch('ubahModeInput', {
            mode: nilaiBaru
        });
    }
</script>
@endscript