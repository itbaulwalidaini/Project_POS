<div>
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 p-17">

        <!-- select bar -->
        <div class="table-select-form d-flex justify-content-start align-items-center gap-3">
            <select class="form-select form-control custom" wire:model.lazy="perPage">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
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
                        <th class="fw-medium" scope="col">No.</th>
                        <th class="fw-medium" scope="col">Nama</th>
                        <th class="fw-medium" scope="col">Level</th>
                        <th class="fw-medium" scope="col">Status</th>
                        <th class="fw-medium text-start" scope="col">Menu</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($kategori as $baris)
                    <tr>
                        <td class="text-body">{{ str_pad($kategori->firstItem() + $loop->index, 2, '0', STR_PAD_LEFT) }}.</td>
                        <td class="text-body {{ $baris->parent_id ? '' : 'fw-bold' }}">
                            {{ $baris->nama }}
                        </td>
                        <td class="text-body"><i>{{ $baris->parent_id ? 'child' : 'parent' }}</i></td>
                        <td class="text-body">
                            <div class="form-switch position-relative">
                                <input wire:key="switch-{{ $baris->id }}-{{ $baris->is_active }}"
                                    wire:change="toggleSwitch({{ $baris->id }})"
                                    class="form-check-input custom-switch-2" type="checkbox" role="switch" @checked($baris->is_active)>
                                <label class="switch-label"></label>
                            </div>
                        </td>
                        <td>
                            <div class="menu d-flex justify-content-start" style="gap: 12px;">
                                <button wire:click="edit({{ $baris->id }})" class="bg-transparent p-0 border-0 hover-text-success">
                                    <i class="material-symbols-outlined fs-25 fw-normal text-body">drive_file_rename_outline</i>
                                </button>
                                <button class="bg-transparent p-0 border-0 hover-text-danger" onclick="confirmDelete('{{ $baris->id }}', {{ $baris->parent_id ? 'false' : 'true' }})">
                                    <i class="material-symbols-outlined fs-25 fw-normal text-body">delete</i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">
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
            {{ $kategori->links('vendor.pagination.custom') }}
        </div>
    </div>
</div>