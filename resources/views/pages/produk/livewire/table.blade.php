<div>
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 p-17">

        <!-- select bar -->
        <div class="table-select-form d-flex justify-content-start align-items-center gap-3">
            <select class="form-select form-control custom" wire:model.live="perPage">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>

            <!-- button delete all -->
            @if(count($selected) > 0)
            <button type="button" onclick="confirmDeleteSelected()" class="btn-delete-selected position-relative">
                <i class="material-symbols-outlined fs-23 fw-normal">delete</i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    {{ count($selected) }}
                </span>
            </button>
            @endif
        </div>

        <!-- search bar -->
        <div class="table-src-form position-relative m-0">
            <input class="form-control custom" placeholder="Cari apa ?" type="text" wire:model.live.debounce.300ms="search" />
            <div class="src-btn position-absolute top-50 start-0 translate-middle-y bg-transparent p-0 border-0">
                <span class="material-symbols-outlined">search</span>
            </div>
        </div>
    </div>
    <div class="default-table-area mx-minus-1">

        <!-- table area -->
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th class="fw-medium">
                            <div class="form-check">
                                <input class="form-check-input" wire:model.live="selectAll" type="checkbox" />
                            </div>
                        </th>
                        <th class="fw-medium" scope="col">No.</th>
                        <th class="fw-medium" scope="col">Tipe</th>
                        <th class="fw-medium" scope="col">Nama Produk</th>
                        <th class="fw-medium" scope="col">SKU</th>
                        
                        <th class="fw-medium" scope="col">HPP</th>
                        <th class="fw-medium" scope="col">Harga Retail</th>
                        <th class="fw-medium" scope="col">Harga Member</th>
                        <th class="fw-medium" scope="col">Harga Grosir</th>
                        <th class="fw-medium" scope="col">Satuan</th>
                        <th class="fw-medium" scope="col">Stok</th>
                        <th class="fw-medium" scope="col">Status</th>
                        <th class="fw-medium text-start" scope="col">Menu</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($produk as $baris)
                    <tr>
                        <td class="text-body" style="width: 62px;">
                            <div class="form-check">
                                <input class="form-check-input" wire:model.live="selected" value="{{ $baris->id }}" type="checkbox" />
                            </div>
                        </td>
                        <td class="text-body">{{ str_pad($produk->firstItem() + $loop->index, 2, '0', STR_PAD_LEFT) }}.</td>

                        <td class="text-body">{{ $baris->tipe->label() ?? '-' }}</td>
                        <td class="text-body">
                            <a class="d-flex align-items-center text-decoration-none" href="{{ route('produk.show', $baris->id) }}">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img src="{{ asset('assets/images/empty-image.png') }}" style="width: 50px; height: 50px;" />
                                    </div>
                                    <div class="flex-grow-1 ms-10">
                                        <h3 class="fw-medium mb-0 fs-17">{{ $baris->nama }}
                                            <span class="fs-15 text-body"><i>{{ $baris->caption ? ' (' . $baris->caption . ')' : '' }}</i></span>
                                        </h3>
                                        <span class="fs-15 text-body fw-medium">{{ $baris->kategori 
                                            ? ($baris->kategori->parent 
                                            ? $baris->kategori->parent->nama. ' / ' .$baris->kategori->nama 
                                            : $baris->kategori->nama) 
                                            : '-' }}
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </td>
                        <td class="text-body">{{ $baris->sku }}</td>
                        
                        <td class="text-body">
                            @if ($baris->hpp > 0)
                            {{ number_format($baris->hpp, 0, ',', '.') }}
                            @else
                            <i class="fs-14">tidak tersedia</i>
                            @endif
                        </td>
                        <td class="text-body">
                            @if ($baris->hjretail > 0)
                            {{ number_format($baris->hjretail, 0, ',', '.') }}
                            @else
                            <i class="fs-14">tidak tersedia</i>
                            @endif
                        </td>
                        <td class="text-body">
                            @if ($baris->hjmember > 0)
                            {{ number_format($baris->hjmember, 0, ',', '.') }}
                            @else
                            <i class="fs-14">tidak tersedia</i>
                            @endif
                        </td>
                        <td class="text-body">
                            @if($baris->harga_grosir_count > 0)
                            <span wire:click="viewGrosir({{ $baris->id }})" class="text-primary fw-medium" style="cursor:pointer;">
                                {{ number_format($baris->hargaGrosir->first()->hjgrosir, 0, ',', '.') }}
                                @if($baris->harga_grosir_count > 1)
                                <span>(+{{ $baris->harga_grosir_count - 1 }})</span>
                                @endif
                            </span>
                            @else
                            <i class="fs-14">tidak tersedia</i>
                            @endif
                        </td>
                        <td class="text-body">{{ $baris->satuan->kode ?? '-' }}</td>
                        <td class="text-body fw-bold" style="font-size: 17px;">{{ (float) $baris->stok }}</td>
                        <td class="text-body">
                            <div class="form-switch position-relative">
                                <input wire:key="switch-{{ $baris->id }}-{{ $baris->is_active }}" wire:change="toggleSwitch({{ $baris->id }})"
                                    class="form-check-input custom-switch-2" type="checkbox" role="switch" @checked($baris->is_active)>
                                <label class="switch-label"></label>
                            </div>
                        </td>
                        <td>
                            <div class="menu d-flex justify-content-start" style="gap: 12px;">
                                <button wire:click="edit({{ $baris->id }})" class="bg-transparent p-0 border-0 hover-text-success" data-bs-placement="top" data-bs-title="Edit Data" data-bs-toggle="tooltip">
                                    <i class="material-symbols-outlined fs-25 fw-normal text-body">drive_file_rename_outline</i>
                                </button>
                                <button class="bg-transparent p-0 border-0 hover-text-danger" data-bs-placement="top" data-bs-title="Hapus Data" data-bs-toggle="tooltip" onclick="confirmDelete('{{ $baris->id }}')">
                                    <i class="material-symbols-outlined fs-25 fw-normal text-body">delete</i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="13">
                            <div class="text-center">
                                @if ($search)
                                <h4 class="custom-h4">Maaf, Data Tidak Ditemukan</h4>
                                <p class="text-muted mb-0">Tidak ada hasil untuk pencarian '<b>{{ $search }}</b>'.</p>
                                @else
                                <h4 class="custom-h4">Data Masih Kosong !</h4>
                                <p class="text-muted mb-0">Belum ada data yang tersedia.</p>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- footer area -->
        <div class="d-flex justify-content-center justify-content-sm-between align-items-center text-center flex-wrap gap-2 showing-wrap pt-15 p-17">
            {{ $produk->links('vendor.pagination.custom') }}
        </div>
    </div>
</div>