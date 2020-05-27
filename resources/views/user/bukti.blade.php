<div class="container">
  <div class="row justify-content-center">
    <div class="col-4">
      <div class="card">
        <div class="card-body">
          <h5>Bukti Peminjaman</h5>
          <p>Peminjam : {{ $data->user->name }}</p>
          <p>Buku : {{ $data->buku->name }}</p>
          <p>Kode Buku : {{ $data->kode_buku }}</p>
          <p>Tanggal Pinjam : {{ $data->tgl_pinjam }}</p>
          <p>Maksimal Tanggal Pengembalian : <br>{{ $data->max_kembali }}</p>
        </div>
      </div>
    </div>
  </div>
</div>
