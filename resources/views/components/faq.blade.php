<style>
    /* ─────────────────────────────────────────
       FAQ SECTION
    ───────────────────────────────────────── */
    .faq-section {
        background: var(--background-color, #FAF8F8);
        padding: 42px 0 70px;
        width: 100%;
        display: block;
    }

    .faq-container {
        max-width: 1440px;
        margin: 0 auto;
        padding: 0 24px;
    }

    .faq-wrapper {
        display: grid;
        grid-template-columns: minmax(0, 42%) minmax(0, 58%);
        align-items: start;
        gap: 60px;
        width: 100%;
    }

    .faq-main-heading {
        display: none;
        margin: 0 0 24px;
        color: #000;
        font-family: 'Open Sans', sans-serif;
        font-size: 40px;
        line-height: 1.2;
        font-weight: 700;
        text-align: center;
    }

    /* Left Info Column */
    .faq-left {
        width: 100%;
        max-width: 520px;
        height: 366px;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        flex-shrink: 0;
    }

    .faq-left-heading {
        width: 100%;
        height: auto;
        font-family: 'Open Sans', sans-serif;
        font-weight: 700;
        font-size: 32px;
        line-height: 40px;
        color: var(--primary-color, #8D4445);
        margin: 0 0 19px 0;
        padding: 0;
        text-align: left;
    }

    .faq-left-paragraph {
        width: 100%;
        height: auto;
        font-family: 'DM Sans', sans-serif;
        font-weight: 400;
        font-size: 16px;
        line-height: 25.6px;
        color: var(--section-text-color);
        margin: 0 0 37px 0;
        padding: 0;
        text-align: left;
    }

    .faq-left-paragraph strong {
        font-weight: 700;
        color:var(--section-text-color);
    }

    .faq-left-image {
        width: 210px;
        height: 60px;
        border-radius: 8px;
        margin: 0 0 30px 0;
        object-fit: cover;
        display: block;
    }

    .faq-left-button {
        width: 100%;
        max-width: 435px;
        margin-top: auto;
        height: 48px;
        border-radius: 8px;
        padding: 5px 28px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        background: linear-gradient(90deg, #AB5A5B 0%, #8D4445 100%);
        border: none;
        cursor: pointer;
        color: #FFFFFF;
        font-family: 'DM Sans', sans-serif;
        font-weight: 700;
        font-size: 16px;
        text-decoration: none;
        box-sizing: border-box;
        transition: opacity 0.25s ease, transform 0.2s ease;
    }

    .faq-left-button:hover {
        opacity: 0.9;
        transform: translateY(-1px);
        color: #FFFFFF;
    }

    /* Right Accordion Column */
    .faq-right {
        width: 100%;
        max-width: none;
    }

    .faq-list {
        display: flex;
        flex-direction: column;
        gap: 16px;
        width: 100%;
    }

    .faq-item {
        background: #ffffff;
        border: 1px solid #D9D9D9;
        border-radius: 8px;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.02);
    }

    .faq-item:hover {
        border-color: #c0c0c0;
        box-shadow: 0px 6px 16px rgba(0, 0, 0, 0.04);
    }

    .faq-question {
        width: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
        min-height: 70px;
        padding: 18px 28px;
        background: none;
        border: none;
        cursor: pointer;
        text-align: left;
        gap: 16px;
    }

    .faq-question-text {
        font-family: 'DM Sans', sans-serif;
        font-size: 18px;
        font-weight: 500;
        color: var(--section-text-color);
        line-height: 1.5;
    }

    .faq-icon {
        flex-shrink: 0;
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--section-text-color);
        transition: transform 0.3s ease, color 0.3s ease;
    }

    .faq-icon svg {
        width: 14px;
        height: 14px;
        transition: transform 0.3s;
    }

    .faq-item.open .faq-icon {
        transform: none;
        color: #fff;
    }

    .faq-item.open .faq-question-text {
        color: #fff;
    }

    .faq-item.open .faq-question {
        background: var(--primary-color);
    }

    .faq-item.open .faq-icon svg line:first-child {
        display: none;
    }

    .faq-answer {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.35s ease, padding 0.35s ease;
        padding: 0 24px;
    }

    .faq-item.open .faq-answer {
        max-height: 300px;
        padding: 0 24px 20px;
    }

    .faq-answer p {
        font-family: 'DM Sans', sans-serif;
        font-size: 18px;
        color: #555555;
        line-height: 1.65;
        margin: 0;
    }

    /* Responsive Styles */
    @media (max-width: 991px) {
        .faq-section {
            padding: 40px 0;
        }

        .faq-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 40px;
        }

        .faq-left {
            width: 100%;
            max-width: 461px;
            height: auto;
        }

        .faq-left-heading {
            width: 100%;
            height: auto;
            font-size: 28px;
            line-height: 36px;
            margin-bottom: 16px;
        }

        .faq-left-paragraph {
            width: 100%;
            height: auto;
            margin-bottom: 24px;
        }

        .faq-left-image {
            margin-bottom: 24px;
        }

        .faq-left-button {
            width: 100%;
            max-width: 371px;
            margin-top: 0;
        }

        .faq-right {
            width: 100%;
        }

        .faq-main-heading {
            display: block;
            font-size: 32px;
        }

        .faq-question-text {
            font-size: 18px;
        }
    }

    @media (max-width: 576px) {
        .faq-container { padding: 0 16px; }
        .faq-main-heading { font-size: 27px; }
        .faq-question { min-height: 64px; padding: 16px; }
        .faq-question-text { font-size: 15px; }
        .faq-answer p { font-size: 14px; }
    }
</style>

<section class="faq-section">
    @php
        $displayFaqs = !empty($faqs) && is_array($faqs)
            ? $faqs
            : ((($settings ?? [])['faqs'] ?? []) ?: []);
    @endphp
    <div class="faq-container">
        <div class="faq-wrapper">
            <div class="faq-left">
                <span class="faq-left-heading" style="display: block;">Don't see the answer to your question? Ask the packaging expert directly.</span>
                <p class="faq-left-paragraph">Check out the most common questions our customers asked. Still have questions ? <strong>Contact our customer support</strong>.</p>
                <img src="{{ asset('uploads/faq-frequently-asked-questions.png') }}" alt="Frequently Asked Questions" class="faq-left-image">
                <a href="/contact" class="faq-left-button">Ask a Question</a>
            </div>
            <div class="faq-right">
                <span class="faq-main-heading" style="display: block;">Frequently Asked Questions</span>
                <div class="faq-list">
                    @if(count($displayFaqs) > 0)
                        @foreach($displayFaqs as $faq)
                            <div class="faq-item">
                                <button class="faq-question" onclick="toggleFaq(this)" aria-expanded="false">
                                    <span class="faq-question-text">{{ $faq['question'] ?? '' }}</span>
                                    <span class="faq-icon">
                                        <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="6" y1="1" x2="6" y2="11"/><line x1="1" y1="6" x2="11" y2="6"/></svg>
                                    </span>
                                </button>
                                <div class="faq-answer">
                                    <p>{{ $faq['answer'] ?? '' }}</p>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="faq-item">
                            <button class="faq-question" onclick="toggleFaq(this)" aria-expanded="false">
                                <span class="faq-question-text">What type of retail boxes are best for luxury product packaging?</span>
                                <span class="faq-icon">
                                    <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="6" y1="1" x2="6" y2="11"/><line x1="1" y1="6" x2="11" y2="6"/></svg>
                                </span>
                            </button>
                            <div class="faq-answer">
                                <p>Rigid boxes with premium finishes such as soft-touch lamination, foil stamping, or embossing are ideal for luxury product packaging. They offer structural strength and an elevated unboxing experience that reinforces brand prestige.</p>
                            </div>
                        </div>

                        <div class="faq-item">
                            <button class="faq-question" onclick="toggleFaq(this)" aria-expanded="false">
                                <span class="faq-question-text">Which retail boxes offer the most protection for fragile items?</span>
                                <span class="faq-icon">
                                    <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="6" y1="1" x2="6" y2="11"/><line x1="1" y1="6" x2="11" y2="6"/></svg>
                                </span>
                            </button>
                            <div class="faq-answer">
                                <p>Rigid set-up boxes with custom foam or cardboard inserts provide the highest level of protection for fragile items. The thick chipboard walls absorb impact while inserts keep products from shifting during transit.</p>
                            </div>
                        </div>

                        <div class="faq-item">
                            <button class="faq-question" onclick="toggleFaq(this)" aria-expanded="false">
                                <span class="faq-question-text">Do retail boxes have customizable shapes and structures?</span>
                                <span class="faq-icon">
                                    <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="6" y1="1" x2="6" y2="11"/><line x1="1" y1="6" x2="11" y2="6"/></svg>
                                </span>
                            </button>
                            <div class="faq-answer">
                                <p>Yes, retail boxes can be fully customized in shape, size, and structure. Options include tuck-end, sleeve, magnetic closure, drawer, and die-cut window styles, each tailored to your product dimensions and branding.</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    window.toggleFaq = function (button) {
        const item = button.closest('.faq-item');
        const wasOpen = item.classList.contains('open');
        document.querySelectorAll('.faq-item.open').forEach(function (openItem) {
            openItem.classList.remove('open');
            const openButton = openItem.querySelector('.faq-question');
            if (openButton) openButton.setAttribute('aria-expanded', 'false');
        });
        if (!wasOpen) {
            item.classList.add('open');
            button.setAttribute('aria-expanded', 'true');
        }
    };
</script>
