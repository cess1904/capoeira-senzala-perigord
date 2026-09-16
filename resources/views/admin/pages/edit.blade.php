<h1>Modifier la page</h1>

<form action="{{ route('admin.pages.update', $page) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <label for="title">Titre</label>
        <input
            type="text"
            id="title"
            name="title"
            value="{{ $page->title }}"
        >
    </div>

    <div>
        <label for="content">Contenu</label>
        <textarea id="content" name="content">{{ $page->content }}</textarea>
    </div>

    <div>
    <label for="seo_title">Titre SEO</label>
    <input
        type="text"
        id="seo_title"
        name="seo_title"
        maxlength="60"
        value="{{ $page->seo_title }}"
    >
</div>

<div>
    <label for="meta_description">Meta description</label>
    <textarea
        id="meta_description"
        name="meta_description"
        maxlength="160"
    >{{ $page->meta_description }}</textarea>
</div>

    <button type="submit">Enregistrer les modifications</button>
</form>