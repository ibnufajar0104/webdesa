<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php if (session()->getFlashdata('success')): ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '<?= esc(session()->getFlashdata('success')) ?>',
            timer: 2200,
            showConfirmButton: false
        });
    </script>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: '<?= esc(session()->getFlashdata('error')) ?>'
        });
    </script>
<?php endif; ?>