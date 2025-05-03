<h2>Hai {{ $dataPeminjaman->nama }}</h2>
<p>Kami cuma mau mengingatkan bahwa buku yang kamu pinjam, <strong>"{{ $dataPeminjaman->book }}"</strong>, akan jatuh tempo besok ({{ \Carbon\Carbon::parse($dataPeminjaman->due_date)->translatedFormat('j F Y') }}).</p>

<p>Yuk, jangan lupa dikembalikan tepat waktu ya, supaya nggak kena denda keterlambatan </p>

<p>Terima kasih sudah meminjam di perpustakaan. Kalau ada pertanyaan, jangan ragu buat hubungi kami!</p>

<p>Salam hangat,<br>
Tim Perpustakaan</p>