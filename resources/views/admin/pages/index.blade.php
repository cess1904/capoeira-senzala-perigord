<h1>Gestion des pages</h1>

<a href="{{ route('admin.pages.create') }}">
    Ajouter une page
</a>

<p>Nombre de pages : {{ $pages->count() }}</p>

@foreach ($pages as $page)
    <div>
        <strong>{{ $page->title }}</strong>

        <p>Slug : {{ $page->slug }}</p>

        <a href="{{ route('admin.pages.edit', $page) }}">
            Modifier
        </a>

        <form action="{{ route('admin.pages.destroy', $page) }}" method="POST">
            @csrf
            @method('DELETE')

            <button type="submit">Supprimer</button>
        </form>
    </div>
@endforeach
