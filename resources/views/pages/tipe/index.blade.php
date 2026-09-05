@extends('layout.index')
@section('tabs', 'Tipe')
@section('menu-opened', 'Tipe')
@section('menu', 'Referensi')
@section('submenu', 'Tipe')
@section('content')
<div class="row">
    <div class="col-xxl-6">
        <div class="card bg-white rounded-10 border border-white mb-4">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 p-17-custom">
                <h3>Data Tipe</h3>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-primary fs-16 fw-normal text-white" data-bs-toggle="modal" data-bs-target="#tambahData">Tambah</button>
                    <button type="button" onclick="window.location.href='{{ url()->current() }}'" class="btn btn-info fs-16 fw-normal text-white">Reload</button>
                </div>
            </div>

            <!-- panggil komponen tabel -->
            <livewire:tipe.table/>
        </div>
    </div>
</div>

<!-- panggil komponen modal -->
<livewire:tipe.create/>
<livewire:tipe.edit/>
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

    window.confirmDelete = async function(id) {
        const result = await Swal.fire({
            title: "Yakin hapus data ini ?",
            text: "Data tidak akan bisa dikembalikan !",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, hapus!",
            cancelButtonText: "Batal",
            scrollbarPadding: true,
            allowOutsideClick: false,
            allowEscapeKey: false,
        });

        if (!result.isConfirmed) return;
        Livewire.dispatch("hapusData", id);
    }

    window.confirmDeleteSelected = async function() {
        const result = await Swal.fire({
            title: "Yakin hapus data yang dipilih ?",
            text: "Data tidak akan bisa dikembalikan !",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, hapus!",
            cancelButtonText: "Batal",
            scrollbarPadding: true,
            allowOutsideClick: false,
            allowEscapeKey: false,
        });

        if (result.isConfirmed) {
            Livewire.dispatch("hapusTerpilih");
        } else {
            Livewire.dispatch("resetBoxTerpilih");
        }
    }
</script>
@endsection