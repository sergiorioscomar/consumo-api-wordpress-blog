<div class="container py-5">
    <h1 class="text-center mb-4">Últimas Publicaciones de Mi Blog</h1>

    @if(isset($publicaciones) && count($publicaciones) > 0)
        <div class="row">
            @foreach($publicaciones as $publicacion)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm h-100">
                        <a href="{{ $publicacion['link'] }}" target="_blank">
                            <img src="{{ $publicacion['featured_image_url'] ?? '/ruta/a/imagen/por_defecto.jpg' }}"
                                class="card-img-top img-fluid"
                                alt="Imagen destacada"
                                style="max-height: 200px; object-fit: cover;">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="{{ $publicacion['link'] }}" target="_blank" class="text-dark text-decoration-none">{{ $publicacion['title']['rendered'] }}</a>
                            </h5>
                            <p class="card-text">{{ Str::limit(strip_tags($publicacion['excerpt']['rendered']), 150) }}</p>
                        </div>
                        <div class="card-footer bg-transparent text-end">
                            <a href="{{ $publicacion['link'] }}" class="btn btn-primary btn-sm" target="_blank">Leer más</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-center">No se encontraron publicaciones.</p>
    @endif
</div>
