@extends('layout.index')
@section('tabs', 'Perencanaan')
@section('menu-opened', 'Perencanaan')
@section('menu', 'Pembelian')
@section('submenu', 'Perencanaan')
@section('content')
<div class="row">
    <div class="col-xxl-8">
        <div class="card bg-white rounded-10 border border-white mb-4">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 p-17-custom">
                <h3>Data Perencanaan</h3>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-primary fs-16 fw-normal text-white" data-bs-toggle="modal" data-bs-target="#tambahData">Tambah</button>
                    <button type="button" onclick="window.location.href='{{ url()->current() }}'" class="btn btn-info fs-16 fw-normal text-white">Reload</button>
                </div>
            </div>

            <!-- panggil komponen tabel -->
            <livewire:perencanaan.table />
        </div>
    </div>
</div>

<!-- panggil komponen modal -->
<livewire:perencanaan.create />
<livewire:perencanaan.edit />
<livewire:perencanaan.show />
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

        Livewire.on('validasiSimpanLolos', () => {
            konfirmasiSimpanPerencanaan();
        });

        Livewire.on('validasiUpdateLolos', () => {
            konfirmasiUpdatePerencanaan();
        });
    });

    window.confirmDelete = async function(id) {
        const result = await Swal.fire({
            title: "Hapus data ini?",
            text: "Data akan dihapus permanen!",
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
        Livewire.dispatch("hapusData", id);
    }

    window.konfirmasiSimpanPerencanaan = async function() {
        const result = await Swal.fire({
            title: "Simpan nota pembelian?",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Simpan",
            cancelButtonText: "Kembali",
            scrollbarPadding: true,
            allowOutsideClick: false,
            allowEscapeKey: false,
        });

        if (!result.isConfirmed) return;
        Livewire.dispatch("simpanData");
    }

    window.konfirmasiUpdatePerencanaan = async function() {
        const result = await Swal.fire({
            title: "Update nota pembelian?",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Update",
            cancelButtonText: "Kembali",
            scrollbarPadding: true,
            allowOutsideClick: false,
            allowEscapeKey: false,
        });

        if (!result.isConfirmed) return;
        Livewire.dispatch("updateData");
    }
</script>
@endsection