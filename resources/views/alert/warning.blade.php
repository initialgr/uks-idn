@if ($kosong->count() > 0)
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-circle me-1"></i>
        Stok obat kosong :
        @foreach ($kosong as $key => $drug)
            @if ($key > 0)
                @if ($key < $kosong->count() - 1)
                    {{ ',' }} <!-- Tambahkan koma jika bukan obat terakhir dalam loop -->
                @elseif ($key == $kosong->count() - 1)
                    {{ 'dan' }} <!-- Tambahkan "dan" sebelum obat terakhir dalam loop -->
                @endif
            @endif
            {{ $drug->name }}
        @endforeach
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
