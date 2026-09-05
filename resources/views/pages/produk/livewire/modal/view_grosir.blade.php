<div>
    <div wire:ignore.self class="modal fade" id="viewData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalView" aria-hidden="true">
        <div class="modal-dialog modal-medium modal-dialog-centered">
            <div class="modal-content bg-white">
                <div class="modal-header">
                    <h1 class="modal-title fs-4" id="modalView">Harga Grosir : {{ $title }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="default-table-area mx-minus-1 table-bordered">
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th class="fw-medium" scope="col">Tier</th>
                                        <th class="fw-medium" scope="col">Range Pembelian</th>
                                        <th class="fw-medium text-start" scope="col">Harga Grosir</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($listGrosir as $detail)
                                    <tr>
                                        <td class="text-body">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}.</td>
                                        <td class="text-body fw-bold">
                                            {{ rtrim(rtrim(number_format($detail['min_pembelian'], 3, ',', '.'), '0'), ',') }} -
                                            {{ rtrim(rtrim(number_format($detail['max_pembelian'], 3, ',', '.'), '0'), ',') }}
                                            {{ $detail['satuan'] }}
                                        </td>
                                        <td class="text-body text-start">{{ $detail['harga_grosir'] }} </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@script
<script>
    const modalEdit = document.getElementById('viewData');

    $wire.on('bukaModalView', () => {
        bootstrap.Modal.getOrCreateInstance(document.getElementById('viewData')).show();
    });

    $wire.on('tutupModalView', () => {
        bootstrap.Modal.getOrCreateInstance(document.getElementById('viewData')).hide();
    });

    modalEdit.addEventListener('hidden.bs.modal', () => {
        $wire.dispatch('resetModal');
    });
</script>
@endscript