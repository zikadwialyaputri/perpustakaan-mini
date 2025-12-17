<div class="container mt-4">
    <h4 class="mb-4">Konfirmasi Peminjaman Buku</h4>
    
    <div class="row">
        @foreach($peminjamans as $item)
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm" style="border-radius: 15px;">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <span class="badge badge-info mb-2">{{ $item->status }}</span>
                        <small class="text-muted">ID #{{ $item->id }}</small>
                    </div>
                    <h5 class="card-title font-weight-bold">{{ $item->book->judul }}</h5>
                    <p class="card-text mb-1">Peminjam: <strong>{{ $item->user->name }}</strong></p>
                    <p class="card-text small text-secondary">Tanggal: {{ $item->tgl_pinjam }}</p>
                    
                    <hr>
                    
                    <div class="d-flex gap-2">
                        @if($item->status == 'pending')
                            <form action="{{ route('staff.validasi', $item->id) }}" method="POST" class="w-100">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm btn-block">Setujui Pinjam</button>
                            </form>
                        @elseif($item->status == 'dipinjam')
                            <form action="{{ route('staff.kembali', $item->id) }}" method="POST" class="w-100">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-sm btn-block">Proses Kembali</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>