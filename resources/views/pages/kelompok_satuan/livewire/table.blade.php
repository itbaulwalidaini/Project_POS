<div>
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 p-17">

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
                        <th class="fw-medium" scope="col">Tipe</th>
                        <th class="fw-medium" scope="col">Kelompok Satuan</th>
                        <th class="fw-medium text-start" scope="col">Menu</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($kelompokSatuan as $baris)
                    <tr>
                        <td class="text-body">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}.</td>
                        <td class="text-body">{{ $baris->tipe->label() }}</td>
                        <td class="text-body">
                            @foreach ($baris->kelompokSatuan as $ks)
                            <span class="text-secondary bg-secondary bg-opacity-10 fs-16 fw-medium d-inline-block default-badge style-two">
                                {{ $ks->satuan->kode }}
                            </span>
                            @if (!$loop->last) @endif
                            @endforeach
                        </td>
                        <td>
                            <div class="menu d-flex justify-content-start" style="gap: 12px;">
                                <button wire:click="edit('{{ $baris->tipe->value }}')" class="bg-transparent p-0 border-0 hover-text-success">
                                    <i class="material-symbols-outlined fs-25 fw-normal text-body">drive_file_rename_outline</i>
                                </button>
                                <button class="bg-transparent p-0 border-0 hover-text-danger" onclick="confirmDelete('{{ $baris->tipe->value }}')">
                                    <i class="material-symbols-outlined fs-25 fw-normal text-body">delete</i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4">
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
        <div class="d-flex justify-content-center justify-content-sm-between align-items-center text-center flex-wrap gap-2 showing-wrap pt-15 p-17"></div>
    </div>
</div>