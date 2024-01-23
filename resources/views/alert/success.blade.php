@if (session('status'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="bi bi-check-circle me-1"></i>
    {{ session('status') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if (session('delete'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('delete') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if (session('kosong'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <i class="bi bi-exclamation-circle me-1"></i>
    {{ session('kosong') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if (session('kurang'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <i class="bi bi-exclamation-circle me-1"></i>
    {{ session('kurang') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif