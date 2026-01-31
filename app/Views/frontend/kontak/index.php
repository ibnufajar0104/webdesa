<?= $this->extend('layout/default') ?>

<?= $this->section('meta') ?>
<title><?= $title ?? 'Kontak' ?> - Desa Batilai</title>
<meta name="description" content="Hubungi Pemerintah Desa Batilai, sampaikan aspirasi, aduan, atau pertanyaan Anda.">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Hero Section -->
<section class="relative pt-12 pb-24 overflow-hidden bg-gradient-to-br from-emerald-600 to-teal-900 dark:from-slate-900 dark:to-slate-900">
    <!-- Background Patterns -->
    <div class="absolute inset-0 pointer-events-none">
        <!-- Light Mode Accents -->
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-white/10 rounded-full blur-3xl -mr-20 -mt-20 mix-blend-overlay dark:hidden"></div>
        <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-teal-400/20 rounded-full blur-3xl -ml-20 dark:hidden"></div>
        
        <!-- Dark Mode Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-br from-transparent to-black/20 dark:from-slate-900 dark:via-slate-900 dark:to-emerald-950/40"></div>
    </div>
    
    <!-- Abstract Pattern Overlay -->
    <div class="absolute inset-0 opacity-[0.05] pointer-events-none bg-[url('https://grainy-gradients.vercel.app/noise.svg')] bg-cover"></div>
    
    <div class="container mx-auto px-4 relative z-10">
        <div class="flex flex-col md:flex-row items-center justify-between gap-8">
            <!-- Left: Text Content -->
            <div class="w-full md:w-2/3 text-left space-y-4">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 border border-white/20 backdrop-blur-sm self-start shadow-sm shadow-emerald-900/10">
                    <span class="flex h-1.5 w-1.5 relative">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-200 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-1.5 w-1.5 bg-emerald-300"></span>
                    </span>
                    <span class="text-[10px] font-bold tracking-wide text-emerald-100 uppercase">Layanan Pengaduan</span>
                </div>

                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold tracking-tight text-white leading-tight drop-shadow-sm">
                    Kontak & Aspirasi <br>
                    <span class="text-emerald-100">Masyarakat</span>
                </h1>

                <p class="text-sm md:text-base text-emerald-100/90 leading-relaxed max-w-lg border-l-2 border-emerald-400/30 pl-4 font-medium">
                    Kami siap mendengar aspirasi dan melayani kebutuhan informasi Anda demi kemajuan Desa Batilai.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Content Section -->
<section class="py-12 bg-slate-50 dark:bg-slate-950 -mt-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-20 relative z-20">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
            
            <!-- Left: Form Aduan (2 Columns) -->
            <div class="lg:col-span-2">
                <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-xl border border-slate-200 dark:border-slate-800 p-8 md:p-10 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-500/5 rounded-full -mr-16 -mt-16 pointer-events-none"></div>

                    <div class="mb-8">
                        <h2 class="text-2xl font-bold text-slate-900 dark:text-white font-serif mb-2">Formulir Aduan & Aspirasi</h2>
                        <p class="text-slate-500 dark:text-slate-400 text-sm">Silakan isi formulir di bawah ini. Identitas Anda (Nama) bersifat opsional jika ingin anonim, namun kontak (Email/WA) diperlukan untuk tindak lanjut.</p>
                    </div>

                    <form id="form-aduan" class="space-y-6">
                        <!-- Nama & Email -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="nama" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Nama Lengkap <span class="text-xs text-slate-400 font-normal">(Opsional)</span></label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                    </div>
                                    <input type="text" name="nama" id="nama" class="block w-full pl-10 pr-3 py-3 border border-slate-300 dark:border-slate-700 rounded-xl leading-5 bg-white dark:bg-slate-800 text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm transition-colors" placeholder="Nama Anda">
                                </div>
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Alamat Email <span class="text-red-500">*</span></label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                                    </div>
                                    <input type="email" name="email" id="email" required class="block w-full pl-10 pr-3 py-3 border border-slate-300 dark:border-slate-700 rounded-xl leading-5 bg-white dark:bg-slate-800 text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm transition-colors" placeholder="contoh@email.com">
                                </div>
                            </div>
                        </div>

                        <!-- WA -->
                        <div>
                             <label for="wa" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">No. WhatsApp / Telepon <span class="text-red-500">*</span></label>
                             <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                                </div>
                                <input type="number" name="wa" id="wa" required class="block w-full pl-10 pr-3 py-3 border border-slate-300 dark:border-slate-700 rounded-xl leading-5 bg-white dark:bg-slate-800 text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm transition-colors" placeholder="08xxxxxxxxxx">
                            </div>
                            <p class="mt-1 text-xs text-slate-500">Nomor ini akan digunakan untuk konfirmasi tindak lanjut.</p>
                        </div>

                        <!-- Pesan -->
                        <div>
                            <label for="pesan" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Isi Pesan / Aduan <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <textarea name="pesan" id="pesan" rows="5" required class="block w-full p-4 border border-slate-300 dark:border-slate-700 rounded-xl leading-relaxed bg-white dark:bg-slate-800 text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm transition-colors" placeholder="Tuliskan detail aduan, aspirasi, atau pertanyaan Anda di sini..."></textarea>
                            </div>
                        </div>

                        <!-- Submit -->
                        <div class="pt-4">
                            <button type="submit" id="btn-submit" class="w-full flex justify-center py-4 px-6 border border-transparent rounded-xl shadow-lg text-sm font-bold text-white bg-gradient-to-r from-emerald-600 to-emerald-500 hover:from-emerald-700 hover:to-emerald-600 focus:outline-none focus:ring-4 focus:ring-emerald-500/30 transition-all transform hover:-translate-y-1">
                                Kirim Pesan
                            </button>
                        </div>

                        <!-- Alert Box -->
                        <div id="alert-box" class="hidden rounded-xl p-4 text-sm font-medium"></div>
                    </form>
                </div>
            </div>

            <!-- Right: Info Kontak (1 Column) -->
            <div class="lg:col-span-1 space-y-8">
                
                <!-- Info Card -->
                <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-lg border border-slate-200 dark:border-slate-800 p-8">
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white font-serif mb-6 border-b border-slate-200 dark:border-slate-800 pb-4">Informasi Kantor</h3>
                    
                    <ul class="space-y-6">
                        <!-- Alamat -->
                        <li class="flex items-start">
                            <div class="w-10 h-10 rounded-full bg-blue-50 dark:bg-blue-900/30 flex items-center justify-center shrink-0 text-blue-600 dark:text-blue-400 mt-1">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wide">Alamat Kantor</p>
                                <p class="text-slate-800 dark:text-white text-base mt-1 font-semibold leading-relaxed">
                                    <?= $detail_kontak['alamat'] ?? 'Jl. A. Yani KM.20, Desa Batilai, Kec. Takisung, Kab. Tanah Laut' ?>
                                </p>
                            </div>
                        </li>

                        <!-- Telepon -->
                        <li class="flex items-start">
                             <div class="w-10 h-10 rounded-full bg-emerald-50 dark:bg-emerald-900/30 flex items-center justify-center shrink-0 text-emerald-600 dark:text-emerald-400 mt-1">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wide">Telepon</p>
                                <p class="text-slate-800 dark:text-white text-base mt-1 font-semibold">
                                    <?= $detail_kontak['telepon'] ?? '-' ?>
                                </p>
                            </div>
                        </li>

                        <!-- WhatsApp -->
                         <li class="flex items-start">
                             <div class="w-10 h-10 rounded-full bg-green-50 dark:bg-green-900/30 flex items-center justify-center shrink-0 text-green-600 dark:text-green-400 mt-1">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.463 1.065 2.876 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                             </div>
                             <div class="ml-4">
                                 <p class="text-sm font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wide">WhatsApp</p>
                                 <p class="text-slate-800 dark:text-white text-base mt-1 font-semibold">
                                     <?= isset($detail_kontak['whatsapp']) && is_array($detail_kontak['whatsapp']) 
                                         ? ($detail_kontak['whatsapp']['number'] ?? '-') 
                                         : ($detail_kontak['whatsapp'] ?? '-') ?>
                                 </p>
                             </div>
                         </li>

                        <!-- Email -->
                        <li class="flex items-start">
                            <div class="w-10 h-10 rounded-full bg-violet-50 dark:bg-violet-900/30 flex items-center justify-center shrink-0 text-violet-600 dark:text-violet-400 mt-1">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wide">Email</p>
                                <p class="text-slate-800 dark:text-white text-base mt-1 font-semibold break-all">
                                    <?= $detail_kontak['email'] ?? '-' ?>
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
$(document).ready(function() {
    $('#form-aduan').on('submit', function(e) {
        e.preventDefault();
        
        const btn = $('#btn-submit');
        const alertBox = $('#alert-box');
        const originalText = btn.html();
        
        // Disable button
        btn.prop('disabled', true).html('<svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline shadow-none" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Mengirim...');
        alertBox.addClass('hidden').removeClass('bg-red-50 text-red-700 bg-emerald-50 text-emerald-700 border border-red-200 border-emerald-200');

        $.ajax({
            url: '<?= base_url('api/kontak/kirim') ?>',
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                // Success
                alertBox.removeClass('hidden').addClass('bg-emerald-50 text-emerald-700 border border-emerald-200').html(
                    '<div class="flex"><svg class="h-5 w-5 text-emerald-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>' + 
                    '<span>' + (response.message || 'Pesan berhasil dikirim!') + '</span></div>'
                );
                $('#form-aduan')[0].reset();
            },
            error: function(xhr) {
                // Error
                let msg = 'Terjadi kesalahan. Silakan coba lagi.';
                if (xhr.responseJSON && xhr.responseJSON.messages) {
                     if (typeof xhr.responseJSON.messages === 'object') {
                         msg = '<ul class="list-disc pl-5">';
                         $.each(xhr.responseJSON.messages, function(k, v) {
                             msg += '<li>' + v + '</li>';
                         });
                         msg += '</ul>';
                     } else {
                         msg = xhr.responseJSON.messages; // usually 'error' key
                         if(xhr.responseJSON.error) msg = xhr.responseJSON.error;
                     }
                }
                
                alertBox.removeClass('hidden').addClass('bg-red-50 text-red-700 border border-red-200').html(
                    '<div class="flex items-start"><svg class="h-5 w-5 text-red-400 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>' + 
                    '<div class="flex-1">' + msg + '</div></div>'
                );
            },
            complete: function() {
                // Reset button
                btn.prop('disabled', false).html(originalText);
            }
        });
    });
});
</script>
<?= $this->endSection() ?>
