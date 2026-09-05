@extends('layout.index')
@section('tabs', 'Kategori')
@section('menu-opened', 'Kategori')
@section('menu', 'Referensi')
@section('submenu', 'Kategori')
@section('content')
<div class="row">
    <div class="col-xxl-6">
        <div class="card bg-white rounded-10 border border-white mb-4">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 p-17-custom">
                <h3>Data Kategori</h3>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-primary fs-16 fw-normal text-white" data-bs-toggle="modal" data-bs-target="#tambahData">Tambah</button>
                    <button type="button" onclick="window.location.href='{{ url()->current() }}'" class="btn btn-info fs-16 fw-normal text-white">Reload</button>
                </div>
            </div>

            <!-- panggil komponen tabel -->
            <livewire:kategori.table />
        </div>
    </div>
</div>

<!-- panggil komponen modal -->
<livewire:kategori.create />
<livewire:kategori.edit />
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
    });

    window.confirmDelete = async function(id, isParent) {
        const result = await Swal.fire({
            title: "Hapus data ini?",
            text: isParent ? "Semua child akan ikut terhapus!" : "Data akan dihapus permanen!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, hapus",
            cancelButtonText: "Batal",
            scrollbarPadding: true,
            allowOutsideClick: false,
            allowEscapeKey: false,
        });

        if (!result.isConfirmed) return;
        Livewire.dispatch("hapusData", {
            id
        });
    }
</script>
@endsection