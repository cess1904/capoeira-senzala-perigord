<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Modifier un cours</title>

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
            max-width: 850px;
            margin: auto;
        }

        .header {
            margin-bottom: 25px;
        }

        .header h1 {
            margin-bottom: 6px;
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

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 7px;
        }

        .full-width {
            grid-column: 1 / -1;
        }

        label {
            font-weight: 600;
            font-size: 14px;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 11px 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 15px;
            background: white;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #6fa8dc;
            box-shadow: 0 0 0 3px rgba(111, 168, 220, 0.15);
        }

        textarea {
            min-height: 100px;
            resize: vertical;
        }

        .visibility {
            margin-top: 25px;
            background: #f8f8f8;
            padding: 15px;
            border-radius: 10px;
        }

        .visibility label {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
        }

        .visibility input[type="checkbox"] {
            width: auto;
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

            .form-grid {
                grid-template-columns: 1fr;
            }

            .full-width {
                grid-column: auto;
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
        <h1>Modifier un cours</h1>
        <p>Modifiez les informations de ce créneau.</p>
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
        action="{{ route('admin.courses.update', $course) }}"
        method="POST"
        class="form-card"
    >
        @csrf
        @method('PUT')

        <div class="section-title">
            Cours
        </div>

        <div class="form-grid">

            <div class="form-group">
                <label for="day">Jour</label>

                <select id="day" name="day" required>
                    <option value="lundi" {{ $course->day === 'lundi' ? 'selected' : '' }}>Lundi</option>
                    <option value="mardi" {{ $course->day === 'mardi' ? 'selected' : '' }}>Mardi</option>
                    <option value="mercredi" {{ $course->day === 'mercredi' ? 'selected' : '' }}>Mercredi</option>
                    <option value="jeudi" {{ $course->day === 'jeudi' ? 'selected' : '' }}>Jeudi</option>
                    <option value="vendredi" {{ $course->day === 'vendredi' ? 'selected' : '' }}>Vendredi</option>
                    <option value="samedi" {{ $course->day === 'samedi' ? 'selected' : '' }}>Samedi</option>
                    <option value="dimanche" {{ $course->day === 'dimanche' ? 'selected' : '' }}>Dimanche</option>
                </select>
            </div>

            <div class="form-group">
                <label for="audience">Public / âge</label>

                <select id="audience" name="audience" required>
                    <option value="Enfants 5-7 ans" {{ $course->audience === 'Enfants 5-7 ans' ? 'selected' : '' }}>
                        Enfants 5-7 ans
                    </option>

                    <option value="Enfants 8-12 ans" {{ $course->audience === 'Enfants 8-12 ans' ? 'selected' : '' }}>
                        Enfants 8-12 ans
                    </option>

                    <option value="Enfants 12-14 ans" {{ $course->audience === 'Enfants 12-14 ans' ? 'selected' : '' }}>
                        Enfants 12-14 ans
                    </option>

                    <option value="Ados 12-16 ans" {{ $course->audience === 'Ados 12-16 ans' ? 'selected' : '' }}>
                        Ados 12-16 ans
                    </option>

                    <option value="Adultes" {{ $course->audience === 'Adultes' ? 'selected' : '' }}>
                        Adultes
                    </option>

                    <option value="Tous âges" {{ $course->audience === 'Tous âges' ? 'selected' : '' }}>
                        Tous âges
                    </option>
                </select>
            </div>

            <div class="form-group">
                <label for="category">Niveau</label>

                <select id="category" name="category" required>
                    <option value="Tous niveaux" {{ $course->category === 'Tous niveaux' ? 'selected' : '' }}>
                        Tous niveaux
                    </option>

                    <option value="Débutants" {{ $course->category === 'Débutants' ? 'selected' : '' }}>
                        Débutants
                    </option>

                    <option value="Intermédiaires" {{ $course->category === 'Intermédiaires' ? 'selected' : '' }}>
                        Intermédiaires
                    </option>

                    <option value="Avancés" {{ $course->category === 'Avancés' ? 'selected' : '' }}>
                        Avancés
                    </option>

                    <option value="Débutants et intermédiaires" {{ $course->category === 'Débutants et intermédiaires' ? 'selected' : '' }}>
                        Débutants et intermédiaires
                    </option>

                    <option value="Intermédiaires et avancés" {{ $course->category === 'Intermédiaires et avancés' ? 'selected' : '' }}>
                        Intermédiaires et avancés
                    </option>
                </select>
            </div>

        </div>

        <div class="section-title">
            Horaires
        </div>

        <div class="form-grid">

            <div class="form-group">
                <label for="start_time">Heure de début</label>

                <input
                    type="time"
                    id="start_time"
                    name="start_time"
                    value="{{ substr($course->start_time, 0, 5) }}"
                    required
                >
            </div>

            <div class="form-group">
                <label for="end_time">Heure de fin</label>

                <input
                    type="time"
                    id="end_time"
                    name="end_time"
                    value="{{ substr($course->end_time, 0, 5) }}"
                    required
                >
            </div>

        </div>

        <div class="section-title">
            Lieu
        </div>

        <div class="form-grid">

            <div class="form-group">
                <label for="city">Ville</label>

                <input
                    type="text"
                    id="city"
                    name="city"
                    value="{{ $course->city }}"
                    required
                >
            </div>

            <div class="form-group">
                <label for="venue">Lieu / complexe</label>

                <input
                    type="text"
                    id="venue"
                    name="venue"
                    value="{{ $course->venue }}"
                    required
                >
            </div>

            <div class="form-group">
                <label for="room">Salle</label>

                <input
                    type="text"
                    id="room"
                    name="room"
                    value="{{ $course->room }}"
                >
            </div>

            <div class="form-group full-width">
                <label for="notes">
                    Informations complémentaires
                </label>

                <textarea
                    id="notes"
                    name="notes"
                >{{ $course->notes }}</textarea>
            </div>

        </div>

        <div class="visibility">
            <input type="hidden" name="is_active" value="0">

            <label>
                <input
                    type="checkbox"
                    name="is_active"
                    value="1"
                    {{ $course->is_active ? 'checked' : '' }}
                >

                Afficher ce cours dans le planning public
            </label>
        </div>

        <div class="actions">

            <button type="submit" class="save-button">
                Enregistrer les modifications
            </button>

            <a
                href="{{ route('admin.courses.index') }}"
                class="back-button"
            >
                Annuler
            </a>

        </div>

    </form>

</div>

</body>
</html>