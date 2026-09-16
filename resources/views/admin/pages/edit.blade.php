<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Modifier la page</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            margin: 0;
            padding: 30px;
            color: #222;
        }

        .container {
            max-width: 900px;
            margin: auto;
        }

        .header {
            margin-bottom: 25px;
        }

        .header h1 {
            margin: 0 0 6px;
        }

        .header p {
            margin: 0;
            color: #666;
        }

        .form-card {
            background: white;
            border: 1px solid #ddd;
            border-radius: 14px;
            padding: 30px;
        }

        .section-title {
            font-size: 18px;
            font-weight: bold;
            margin-top: 30px;
            margin-bottom: 16px;
            padding-bottom: 8px;
            border-bottom: 1px solid #eee;
        }

        .section-title:first-child {
            margin-top: 0;
        }

        .section-help {
            margin-top: -8px;
            margin-bottom: 18px;
            color: #777;
            font-size: 14px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 7px;
            margin-bottom: 20px;
        }

        label {
            font-weight: 600;
            font-size: 14px;
        }

        input,
        textarea {
            width: 100%;
            padding: 12px 13px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 15px;
            background: white;
            font-family: inherit;
        }

        input:focus,
        textarea:focus {
            outline: none;
            border-color: #6fa8dc;
            box-shadow: 0 0 0 3px rgba(111, 168, 220, 0.15);
        }

        #content {
            min-height: 260px;
            resize: vertical;
        }

        #meta_description {
            min-height: 100px;
            resize: vertical;
        }

        .counter {
            text-align: right;
            color: #777;
            font-size: 13px;
        }

        .seo-box {
            background: #f8f9fb;
            border-radius: 10px;
            padding: 20px;
        }

        .actions {
            display: flex;
            gap: 14px;
            margin-top: 30px;
        }

        .save-button {
            background: #222;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 8px;
            font-size: 15px;
            cursor: pointer;
        }

        .save-button:hover {
            background: #3a3a3a;
        }

        .back-button {
            display: inline-block;
            background: #eeeeee;
            color: #222;
            text-decoration: none;
            padding: 12px 20px;
            border-radius: 8px;
            font-size: 15px;
        }

        .errors {
            background: #fdecec;
            color: #9f1c1c;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }

        @media (max-width: 650px) {
            body {
                padding: 18px;
            }

            .form-card {
                padding: 20px;
            }

            .actions {
                flex-direction: column;
            }

            .save-button,
            .back-button {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <div class="header">
        <h1>Modifier la page</h1>
        <p>Modifiez le contenu et les informations SEO de cette page.</p>
    </div>

    @if ($errors->any())
        <div class="errors">
            <strong>Le formulaire contient une erreur.</strong>

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form
        action="{{ route('admin.pages.update', $page) }}"
        method="POST"
        class="form-card"
    >
        @csrf
        @method('PUT')

        <div class="section-title">
            Contenu de la page
        </div>

        <div class="form-group">
            <label for="title">Titre de la page</label>

            <input
                type="text"
                id="title"
                name="title"
                value="{{ old('title', $page->title) }}"
                required
            >
        </div>

        <div class="form-group">
            <label for="content">Contenu</label>

            <textarea
                id="content"
                name="content"
            >{{ old('content', $page->content) }}</textarea>
        </div>

        <div class="section-title">
            Référencement SEO
        </div>

        <p class="section-help">
            Ces informations permettent d'améliorer la présentation de la page dans Google.
        </p>

        <div class="seo-box">

            <div class="form-group">
                <label for="seo_title">Titre SEO</label>

                <input
                    type="text"
                    id="seo_title"
                    name="seo_title"
                    maxlength="60"
                    value="{{ old('seo_title', $page->seo_title) }}"
                >

                <div class="counter">
                    Maximum 60 caractères
                </div>
            </div>

            <div class="form-group">
                <label for="meta_description">Meta description</label>

                <textarea
                    id="meta_description"
                    name="meta_description"
                    maxlength="160"
                >{{ old('meta_description', $page->meta_description) }}</textarea>

                <div class="counter">
                    Maximum 160 caractères
                </div>
            </div>

        </div>

        <div class="actions">

            <button type="submit" class="save-button">
                Enregistrer les modifications
            </button>

            <a
                href="{{ route('admin.pages.index') }}"
                class="back-button"
            >
                Annuler
            </a>

        </div>

    </form>

</div>

</body>
</html>