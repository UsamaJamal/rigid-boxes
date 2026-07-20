<style>
    .brand-logos-section {
        background: #fff;
        overflow: hidden;
    }

    .brand-logos-container {
        max-width: 1440px;
        margin: 0 auto;
        padding: 0 5%;
        overflow: hidden;
    }

    .brand-logos-marquee {
        width: 100%;
        overflow: hidden;
    }

    .brand-logos-track {
        display: flex;
        width: max-content;
        animation: brand-logos-scroll 24s linear infinite;
        will-change: transform;
    }

    .brand-logos-set {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 40px;
        padding: 20px 20px;
        min-height: 108px;
    }

    .brand-logo-item {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .brand-logo-item img {
        display: block;
        width: 100%;
        max-width: 150px;
        max-height: 50px;
        object-fit: contain;
    }

    @keyframes brand-logos-scroll {
        to { transform: translateX(-50%); }
    }

    .brand-logos-marquee:hover .brand-logos-track {
        animation-play-state: paused;
    }

    @media (max-width: 576px) {
        .brand-logos-set {
            gap: 20px;
            padding: 14px 10px;
            min-height: 76px;
        }

        .brand-logo-item {
            padding: 0;
        }

        .brand-logo-item img {
            max-width: 100px;
            max-height: 32px;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .brand-logos-track {
            animation-play-state: paused;
        }
    }
</style>

@php
    $brandLogos = [
        ['file' => 'true-girl.svg', 'alt' => 'TrueGirl'],
        ['file' => 'jeeter-mart.svg', 'alt' => 'Jester Mart'],
        ['file' => 'bass-pro-shop.svg', 'alt' => 'Bass Pro Shops'],
        ['file' => 'hulu-motor.svg', 'alt' => 'The Hulu Motel'],
        ['file' => 'red-bull-logo.png', 'alt' => 'Red Bull'],
        ['file' => 'kinky.webp', 'alt' => 'Kinky'],
        ['file' => 'voli-logo.webp', 'alt' => 'Voli'],
        ['file' => 'burger-bar.svg', 'alt' => 'Burger Bar'],
        ['file' => 'flowgardens-logo.webp', 'alt' => 'Flowgardens'],
        ['file' => 'her-piece-peace-logo.webp', 'alt' => 'Her Piece Peace'],
        ['file' => 'neat-logo.webp', 'alt' => 'Neat'],
        ['file' => 'springtastic-logo.webp', 'alt' => 'Springtastic'],
    ];
@endphp

<section class="brand-logos-section" aria-label="Our clients">
    <div class="brand-logos-container">
        <div class="brand-logos-marquee">
            <div class="brand-logos-track">
                @foreach ([false, true] as $isDuplicate)
                    <div class="brand-logos-set" @if ($isDuplicate) aria-hidden="true" @endif>
                        @foreach ($brandLogos as $brandLogo)
                            <div class="brand-logo-item">
                                <img src="{{ asset('uploads/' . $brandLogo['file']) }}" alt="{{ $isDuplicate ? '' : $brandLogo['alt'] }}">
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
