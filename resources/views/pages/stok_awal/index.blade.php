@extends('layout.index')
@section('tabs', 'Stok Awal')
@section('menu-opened', 'Stok Awal')
@section('menu', 'Manajemen Stok')
@section('submenu', 'Stok Awal')
@section('content')
<div class="row">
    <div class="col-xxl-10">
        <div class="card bg-white rounded-10 border border-white mb-4">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 p-17-custom">
                <h3>Data Stok Awal</h3>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-primary fs-16 fw-normal text-white" data-bs-toggle="modal" data-bs-target="#tambahData">Tambah</button>
                    <button type="button" onclick="window.location.href='{{ url()->current() }}'" class="btn btn-info fs-16 fw-normal text-white">Reload</button>
                </div>
            </div>

            <!-- panggil komponen tabel -->
            <livewire:stok-awal.table />
        </div>
    </div>
</div>

<!-- panggil komponen modal -->
<livewire:stok-awal.create />
<livewire:stok-awal.show />
@endsection

@section('script')
<script src="{{ asset('assets/js/helpers/toast.js') }}"></script>
<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('showToast', (event) => {
            showToast(
                event.type,
                event.message
            );
        });

        Livewire.on('validasiLolos', () => {
            confirmSimpanStokAwal();
        });
    });

    window.confirmSimpanStokAwal = async function() {
        const result = await Swal.fire({
            title: "Yakin data sudah benar?",
            text: "Data akan disimpan permanen!",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Benar",
            cancelButtonText: "Periksa Lagi",
            scrollbarPadding: true,
            allowOutsideClick: false,
            allowEscapeKey: false,
        });

        if (!result.isConfirmed) return;
        Livewire.dispatch("simpanStokAwal");
    }
</script>
@endsection