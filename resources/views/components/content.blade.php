<style>
    /* ─────────────────────────────────────────
       TEXT CONTENT SECTION
    ───────────────────────────────────────── */
    .text-content-section {
        background: var(--background-color);
        padding: 25px 0;
    }

    .text-content-container {
        max-width: 1440px;
        margin: 0 auto;
        padding: 0 24px;
        box-sizing: border-box;
        display: flex;
        justify-content: center;
    }

    .text-content-card {
        width: 100%;
        max-width: 1030px;
        background: #fff;
        border-radius: 40px;
        border: 1px solid var(--section-text-color);
        padding: 48px 20px 48px 56px;
        box-sizing: border-box;
        height: 787px;
    }

    .text-content-inner {
        height: 100%;
        overflow-y: auto;
        padding-right: 26px;
        scrollbar-width: thin;
        scrollbar-color: var(--primary-color) #F0F0F0;
    }

    .text-content-inner::-webkit-scrollbar {
        width: 10px;
    }

    .text-content-inner::-webkit-scrollbar-track {
        background: #F0F0F0;
        border-radius: 20px;
    }

    .text-content-inner::-webkit-scrollbar-thumb {
        background: var(--primary-color);
        border-radius: 20px;
    }

    .text-content-inner::-webkit-scrollbar-thumb:hover {
        background: var(--footer-color);
    }

    .text-content-heading {
        font-family: 'Open Sans', sans-serif;
        font-size: 24px;
        font-weight: 700;
        color: #000000;
        margin-bottom: 20px;
        line-height: 1.4;
    }

    .text-content-body p {
        font-family: 'Open Sans', sans-serif;
        font-size: 16px;
        color: #000000;
        line-height: 1.7;
        margin-bottom: 14px;
    }

    .text-content-body p:last-child {
        margin-bottom: 0;
    }

    .text-content-body ul {
        list-style: none;
        padding: 0;
        margin: 0 0 14px 0;
    }

    .text-content-body ul li {
        font-family: 'Open Sans', sans-serif;
        font-size: 16px;
        color: #333;
        line-height: 1.7;
        padding-left: 20px;
        position: relative;
        margin-bottom: 4px;
    }

    .text-content-body ul li::before {
        content: '•';
        position: absolute;
        left: 4px;
        color: #333;
    }

    .text-content-body a {
        color: #333;
        text-decoration: underline;
    }

    @media (max-width: 992px) {
        .text-content-card {
            padding: 32px 12px 32px 24px;
            height: 460px;
        }
        .text-content-inner {
            height: 100%;
            overflow-y: auto;
            padding-right: 14px;
        }
    }

    @media (max-width: 576px) {
        .text-content-section {
            padding: 24px 0;
        }
        .text-content-container {
            padding: 0 16px;
        }
        .text-content-card {
            padding: 24px 10px 24px 18px;
            border-radius: 24px;
            border: 1.5px solid #000000;
            height: 440px;
        }
        .text-content-inner {
            height: 100%;
            overflow-y: auto;
            padding-right: 10px;
        }
        .text-content-inner::-webkit-scrollbar {
            width: 6px;
        }
        .text-content-heading {
            font-size: 18px;
            line-height: 1.35;
            margin-bottom: 14px;
        }
        .text-content-body p,
        .text-content-body ul li {
            font-size: 13.5px;
            line-height: 1.55;
            margin-bottom: 10px;
        }
    }
</style>

{{-- ═══════════════════════════════════════
     TEXT CONTENT SECTION
═══════════════════════════════════════ --}}
<section class="text-content-section">
    <div class="text-content-container">
        <div class="text-content-card">
            <div class="text-content-inner">
                <h2 class="text-content-heading">Order Custom Boxes, Custom Packaging &amp; Shipping Boxes At Wholesale Rates</h2>
                <div class="text-content-body">
                    @if(!empty($settings['content_section']))
                        {!! $settings['content_section'] !!}
                    @else
                        <p>Do You Have A Business? Big Or Small Doesn't Matter!</p>
                        <p>Want To Give Your Customers Elegance With Great Packaging And A Secure Product Within? Look No Further!</p>
                        <p>Here We Are, My Box Printing Offers Wholesale, Unbeatable Rates That Are Unbelievable For The Quality We Are Providing. We Understand Our Clients And Their Business Needs. Business Is Like A Baby That Needs To Be Taken Care Of With Great Products That Won't Get Harmed In Any Way.</p>
                        <p>In The Same Way, Your Brand Needs To Deliver With Our Custom Packaging And Material So That Your Customer Feels Luxurious With The Feel Of The Product Packaging And Printing.</p>
                        <ul>
                            <li>Custom Boxes</li>
                            <li>Custom Packaging</li>
                            <li>Custom Box Designs</li>
                            <li>Custom Mailer Boxes</li>
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
