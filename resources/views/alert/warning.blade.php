@if ($kosong->count() > 0)
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-circle me-1"></i>
        Stok obat kosong untuk obat:
        @foreach ($kosong as $drug)
            {{ $drug->name }},
        @endforeach
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
