<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'The Rigid Boxes' }}</title>
    @if(!empty($metaDescription))
        <meta name="description" content="{{ $metaDescription }}">
    @endif
    @if(!empty($metaKeywords))
        <meta name="keywords" content="{{ $metaKeywords }}">
    @endif
    @if(!empty($robots))
        <meta name="robots" content="{{ $robots }}">
    @endif
    @if(!empty($schema))
        <script type="application/ld+json">{!! $schema !!}</script>
    @endif
    <!-- Import Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Open+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            overflow-x: hidden;
            width: 100%;
        }

        body {
            font-family: 'Open Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background-color: var(--background-color);
            color: #000000;
            line-height: 1.6;
        }

        p {
            font-family: 'DM Sans', sans-serif;
            color: #000;
            font-size: 16px;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Open Sans', sans-serif;
            color: var(--section-text-color);
            font-size: 24px;
        }

        /* Shared content boundary: keep every page section aligned to header. */
        main > section > [class*="container"],
        main > section > [class*="inner"] {
            width: 100% !important;
            max-width: 1280px !important;
            margin-left: auto !important;
            margin-right: auto !important;
            padding-left: 55px !important;
            padding-right: 55px !important;
            box-sizing: border-box !important;
            min-width: 0;
        }

        @media (max-width: 768px) {
            main > section > [class*="container"],
            main > section > [class*="inner"] {
                padding-left: 20px !important;
                padding-right: 20px !important;
            }
        }

        @media (max-width: 480px) {
            main > section > [class*="container"],
            main > section > [class*="inner"] {
                padding-left: 16px !important;
                padding-right: 16px !important;
            }
        }
    </style>
</head>
<body>
