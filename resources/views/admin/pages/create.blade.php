<h1>Ajouter une page</h1>

<form action="{{ route('admin.pages.store') }}" method="POST">
    @csrf

    <div>
        <label for="title">Titre</label>
        <input type="text" id="title" name="title">
    </div>

    

    <div>
        <label for="content">Contenu</label>
        <textarea id="content" name="content"></textarea>
    </div>

    <div>
    <label for="seo_title">Titre SEO</label>
    <input
        type="text"
        id="seo_title"
        name="seo_title"
        maxlength="60"
    >
</div>

<div>
    <label for="meta_description">Meta description</label>
    <textarea
        id="meta_description"
        name="meta_description"
        maxlength="160"
    ></textarea>
</div>

    <button type="submit">Enregistrer</button>
</form>