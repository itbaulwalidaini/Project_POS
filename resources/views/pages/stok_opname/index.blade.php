@extends('layout.index')
@section('tabs', 'Stok Opname')
@section('menu-opened', 'Stok Opname')
@section('menu', 'Manajemen Stok')
@section('submenu', 'Stok Opname')
@section('content')
<div class="row">
    <div class="col-xxl-10">
        <div class="card bg-white rounded-10 border border-white mb-4">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 p-17-custom">
                <h3>Data Stok Opname</h3>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-primary fs-16 fw-normal text-white" data-bs-toggle="modal" data-bs-target="#tambahData">Tambah</button>
                    <button type="button" onclick="window.location.href='{{ url()->current() }}'" class="btn btn-info fs-16 fw-normal text-white">Reload</button>
                </div>
            </div>

            <!-- panggil komponen tabel -->
            <livewire:stok-opname.table />
        </div>
    </div>
</div>

<!-- panggil komponen modal -->
<livewire:stok-opname.create />
<livewire:stok-opname.edit />
<livewire:stok-opname.show />
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

        Livewire.on('showSwal', (event) => {
            showSwal(
                event.type,
                event.title,
                event.message,
            );
        });

        Livewire.on('validasiSimpanLolos', () => {
            confirmSimpanStokOpname();
        });

        Livewire.on('validasiUpdateLolos', () => {
            confirmUpdateStokOpname();
        });
    });

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

    window.confirmSimpanStokOpname = async function() {
        const result = await Swal.fire({
            title: "Yakin data sudah benar?",
            text: "Data akan disimpan sebagai draft",
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
        Livewire.dispatch("simpanData");
    }

    window.confirmUpdateStokOpname = async function() {
        const statusOpname = document.getElementById('status').value;
        const isApproved = statusOpname === 'approved';
        const result = await Swal.fire({
            title: isApproved ? "Update perubahan?" : "Simpan perubahan?",
            text: isApproved ? "Data akan disimpan permanen!" : "",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: isApproved ? "#d33" : "#3085d6",
            cancelButtonColor: "#3085d6",
            confirmButtonText: isApproved ? "Oke, Update" : "Oke",
            cancelButtonText: isApproved ? "Periksa Lagi" :"Batal",
            scrollbarPadding: true,
            allowOutsideClick: false,
            allowEscapeKey: false,
        });

        if (!result.isConfirmed) return;
        Livewire.dispatch("updateData");
    }
</script>
@endsection