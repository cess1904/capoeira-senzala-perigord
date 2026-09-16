<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $page->seo_title ?: $page->title }}</title>

    @php
        $metaDescription = $page->meta_description
            ?: \Illuminate\Support\Str::limit($page->content ?? '', 155);
    @endphp

    @if ($metaDescription)
        <meta name="description" content="{{ $metaDescription }}">
    @endif

    <link rel="canonical" href="{{ url('/' . $page->slug) }}">
</head>

<body>

    <h1>{{ $page->title }}</h1>

    <div>
        {!! nl2br(e($page->content)) !!}
    </div>

</body>
</html>