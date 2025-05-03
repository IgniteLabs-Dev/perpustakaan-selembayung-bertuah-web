<h2>Hai {{ $dataPeminjaman->nama }}!</h2>
<p>Ini cuma pengingat kecil kalau buku <strong>"{{ $dataPeminjaman->book }}"</strong> yang kamu pinjam akan jatuh tempo
    besok ({{ $dataPeminjaman->due_date }}).</p>
<p>Jangan lupa dikembalikan yaaa biar nggak kena denda 😄</p>
