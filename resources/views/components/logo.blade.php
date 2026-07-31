<style>
    .brand-logos-section {
        background: #FAF8F8;
        overflow: hidden;
    }

    .brand-logos-container {
        max-width: 1440px;
        margin: 0 auto;
        padding: 0 24px;
        box-sizing: border-box;
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
        padding: 5px 20px 20px 20px; /* Reduced top padding to move logos up */
        min-height: 80px;
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
        ['file' => 'trusted-true-girl.svg', 'alt' => 'TrueGirl'],
        ['file' => 'trusted-jeeter-mart.svg', 'alt' => 'Jester Mart'],
        ['file' => 'trusted-bass-pro-shop.svg', 'alt' => 'Bass Pro Shops'],
        ['file' => 'trusted-hulu-motor.svg', 'alt' => 'The Hulu Motel'],
        ['file' => 'trusted-red-bull-logo.png', 'alt' => 'Red Bull'],
        ['file' => 'trusted-kinky.webp', 'alt' => 'Kinky'],
        ['file' => 'trusted-voli-logo.webp', 'alt' => 'Voli'],
        ['file' => 'trusted-burger-bar.svg', 'alt' => 'Burger Bar'],
        ['file' => 'trusted-flowgardens-logo.webp', 'alt' => 'Flowgardens'],
        ['file' => 'trusted-her-piece-peace-logo.webp', 'alt' => 'Her Piece Peace'],
        ['file' => 'trusted-neat-logo.webp', 'alt' => 'Neat'],
        ['file' => 'trusted-springtastic-logo.webp', 'alt' => 'Springtastic'],
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
