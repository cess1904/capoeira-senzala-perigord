<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Gestion des pages</title>

    <style>
        * {
            box-sizing: border-box;
        }

     body {
    font-family: Arial, sans-serif;
    background: #faf6f3;
    margin: 0;
    padding: 30px;
    color: #222;
}

        .container {
            max-width: 1000px;
            margin: auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            margin-bottom: 30px;
        }

        .header h1 {
            margin: 0 0 6px;
        }

        .header p {
            margin: 0;
            color: #666;
        }

        .add-button {
            display: inline-block;
            background: #222;
            color: white;
            text-decoration: none;
            padding: 12px 18px;
            border-radius: 8px;
        }

        .success {
            background: #e8f6ec;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .page-card {
            background: white;
            border: 1px solid #ddd;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 15px;
        }

        .page-title {
            font-size: 19px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .slug {
            color: #666;
            font-size: 14px;
        }

        .slug strong {
            color: #333;
        }

        .actions {
            display: flex;
            gap: 16px;
            align-items: center;
            margin-top: 18px;
        }

        .actions form {
            margin: 0;
        }

        .edit-button {
            display: inline-block;
            background: #222;
            color: white;
            text-decoration: none;
            padding: 8px 14px;
            border-radius: 7px;
            font-size: 14px;
        }

        .delete-button {
            background: #b42318;
            color: white;
            border: none;
            padding: 8px 14px;
            border-radius: 7px;
            cursor: pointer;
            font-size: 14px;
        }

        .empty {
            background: white;
            border: 1px solid #ddd;
            border-radius: 12px;
            padding: 25px;
            text-align: center;
            color: #666;
        }

        @media (max-width: 650px) {
            body {
                padding: 18px;
            }

            .header {
                flex-direction: column;
                align-items: flex-start;
            }

            .actions {
                flex-wrap: wrap;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <div class="header">

        <div>
            <h1>Gestion des pages</h1>

            <p>
                {{ $pages->count() }}
                {{ $pages->count() > 1 ? 'pages créées' : 'page créée' }}
            </p>
        </div>

        <a
            href="{{ route('admin.pages.create') }}"
            class="add-button"
        >
            + Ajouter une page
        </a>

    </div>

    @if (session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    @if ($pages->isEmpty())

        <div class="empty">
            Aucune page pour le moment.
        </div>

    @else

        @foreach ($pages as $page)

            <div class="page-card">

                <div class="page-title">
                    {{ $page->title }}
                </div>

                <div class="slug">
                    <strong>Adresse :</strong>
                    /{{ $page->slug }}
                </div>

                <div class="actions">

                    <a
                        href="{{ route('admin.pages.edit', $page) }}"
                        class="edit-button"
                    >
                        Modifier
                    </a>

                    <form
                        action="{{ route('admin.pages.destroy', $page) }}"
                        method="POST"
                        onsubmit="return confirm('Supprimer cette page ?');"
                    >
                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="delete-button"
                        >
                            Supprimer
                        </button>

                    </form>

                </div>

            </div>

        @endforeach

    @endif

</div>

</body>
</html>