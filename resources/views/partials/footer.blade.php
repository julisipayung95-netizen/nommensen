<footer id="kontak" class="bg-slate-900 text-slate-300 mt-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 grid grid-cols-1 md:grid-cols-4 gap-8">

        {{-- KOLOM 1: LOGO + ALAMAT --}}
        <div class="md:col-span-2">
            @isset($footer)
                <img src="{{ asset('storage/' . $footer->image) }}"
                     alt="Logo B University"
                     class="h-12 w-auto mb-4 brightness-0 invert">
            @endisset
            <h3 class="text-white text-lg font-bold mb-3">B University</h3>
            <p class="text-sm leading-relaxed">
                {{ $footer->alamat ?? 'Alamat universitas akan ditampilkan di sini.' }}
            </p>
        </div>

        {{-- KOLOM 2: NAVIGASI --}}
        <div>
            <h4 class="text-white text-sm font-semibold uppercase tracking-wider mb-4">Navigasi</h4>
            <ul class="space-y-2 text-sm">
                <li><a href="{{ route('profile') }}"       class="hover:text-white transition">Profil Universitas</a></li>
                <li><a href="{{ route('lectures') }}"      class="hover:text-white transition">Dosen</a></li>
                <li><a href="{{ route('students') }}"      class="hover:text-white transition">Mahasiswa</a></li>
                <li><a href="{{ route('announcements') }}" class="hover:text-white transition">Pengumuman</a></li>
                <li><a href="{{ route('news') }}"          class="hover:text-white transition">Berita</a></li>
            </ul>
        </div>

        {{-- KOLOM 3: KONTAK --}}
        <div>
            <h4 class="text-white text-sm font-semibold uppercase tracking-wider mb-4">Kontak</h4>
            <ul class="space-y-3 text-sm">
                @isset($footer)
                    <li class="flex items-start gap-2">
                        <span aria-hidden="true">✉️</span>
                        <a href="mailto:{{ $footer->email }}" class="hover:text-white break-all">{{ $footer->email }}</a>
                    </li>
                    <li class="flex items-start gap-2">
                        <span aria-hidden="true">💬</span>
                        <a href="https://wa.me/62{{ $footer->wa }}" target="_blank" rel="noopener" class="hover:text-white">+62 {{ $footer->wa }}</a>
                    </li>
                @endisset
            </ul>

            {{-- SOSIAL MEDIA --}}
            @isset($footer)
                <div class="flex gap-3 mt-5">
                    <a href="{{ $footer->link_instagram }}" target="_blank" rel="noopener"
                       aria-label="Instagram" class="hover:text-white transition">📷</a>
                    <a href="{{ $footer->link_youtube }}" target="_blank" rel="noopener"
                       aria-label="YouTube" class="hover:text-white transition">▶️</a>
                    <a href="{{ $footer->link_linkedin }}" target="_blank" rel="noopener"
                       aria-label="LinkedIn" class="hover:text-white transition">💼</a>
                    <a href="{{ $footer->link_facebook }}" target="_blank" rel="noopener"
                       aria-label="Facebook" class="hover:text-white transition">🌐</a>
                </div>
            @endisset
        </div>
    </div>

    {{-- COPYRIGHT --}}
    <div class="border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 text-center text-xs text-slate-400">
            © {{ date('Y') }} B University. Seluruh hak cipta dilindungi.
        </div>
    </div>
</footer>