<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Gestion du planning</title>

    <style>
     body {
    font-family: Arial, sans-serif;
    background: #f2f7fb;
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

        .day-title {
    margin-top: 35px;
    margin-bottom: 12px;
    font-size: 24px;
}

        h1 {
            margin: 0;
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

        .course-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
        }

        .course-top {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 12px;
        }


        .time {
            font-weight: bold;
        }

        .audience {
            font-size: 18px;
            margin-bottom: 8px;
        }

        .level {
            display: inline-block;
            background: #eeeeee;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 14px;
            margin-bottom: 12px;
        }

        .location {
            margin-top: 8px;
            line-height: 1.6;
        }

        .notes {
            margin-top: 12px;
            font-style: italic;
            color: #666;
        }

        .inactive {
            margin-top: 12px;
            font-size: 14px;
            color: #999;
        }


      /* Boutons d'action */

        .actions {
            margin-top: 15px;
            display: flex;
            gap: 16px;
            align-items: center;
        }

        .actions form {
            margin: 0;
        }

        .actions button {
            background: #b42318;
            color: white;
            border: none;
            padding: 8px 14px;
            border-radius: 7px;
            cursor: pointer;
            font-size: 14px;
        }

        .actions .duplicate-button {
            background: #6fa8dc;
        }

        .actions .duplicate-button:hover {
            background: #5b97cc;
        }

        .actions a {
            display: inline-block;
            text-decoration: none;
            background: #222;
            color: white;
            padding: 8px 14px;
            border-radius: 7px;
            font-size: 14px;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="header">
        <h1>Gestion du planning</h1>

        <a href="{{ route('admin.courses.create') }}" class="add-button">
            + Ajouter un cours
        </a>
    </div>

    @if (session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    @if ($courses->isEmpty())

        <p>Aucun cours pour le moment.</p>

    @else

      @php
    $days = [
        'lundi',
        'mardi',
        'mercredi',
        'jeudi',
        'vendredi',
        'samedi',
        'dimanche'
    ];
@endphp

@foreach ($days as $day)

    @php
        $dayCourses = $courses->where('day', $day);
    @endphp

    @if ($dayCourses->isNotEmpty())

        <h2 class="day-title">
            {{ ucfirst($day) }}
        </h2>

        @foreach ($dayCourses as $course)

            <div class="course-card">

                <div class="course-top">

                    <div>
                        <div class="audience">
                            {{ $course->audience }}
                        </div>

                        <div class="level">
                            {{ $course->category }}
                        </div>
                    </div>

                    <div class="time">
                        {{ substr($course->start_time, 0, 5) }}
                        -
                        {{ substr($course->end_time, 0, 5) }}
                    </div>

                </div>

                <div class="location">
                    <strong>{{ $course->city }}</strong>
                    — {{ $course->venue }}

                    @if ($course->room)
                        — {{ $course->room }}
                    @endif
                </div>

                <div class="actions">
                <a href="{{ route('admin.courses.edit', $course) }}">
                    Modifier
                </a>

                <form
                    action="{{ route('admin.courses.duplicate', $course) }}"
                    method="POST"
                >
                    @csrf

                    <button type="submit" class="duplicate-button">
                      Dupliquer
                  </button>
                </form>

                <form
                    action="{{ route('admin.courses.destroy', $course) }}"
                    method="POST"
                    onsubmit="return confirm('Supprimer ce cours ?');"
                >
                    @csrf
                    @method('DELETE')

                    <button type="submit">
                        Supprimer
                    </button>
                </form>
            </div>

                @if ($course->notes)
                    <div class="notes">
                        {{ $course->notes }}
                    </div>
                @endif

                @if (!$course->is_active)
                    <div class="inactive">
                        Cours masqué du planning public
                    </div>
                @endif

            </div>

        @endforeach

    @endif

@endforeach

    @endif  

  

</div>

</body>
</html>