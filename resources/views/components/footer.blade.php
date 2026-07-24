<footer class="main-footer">
    <!-- Newsletter Section -->
    <div class="newsletter-section">
        <div class="container">
            <div class="newsletter-content">
                <div class="newsletter-text">
                    <h3>Sign Up For Exclusive Offers And Updates!</h3>
                </div>
                <div class="newsletter-form">
                    <input type="email" placeholder="Email" class="newsletter-input">
                    <button type="submit" class="newsletter-button">Subscribe</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Footer Content -->
    <div class="footer-content">
        <div class="container">
            <div class="footer-grid">
                <!-- Brand Column -->
                <div class="footer-column brand-column">
                    <div class="footer-logo">
                        <img src="{{ asset('images/The Rigid Boxes Logo 1.png') }}" alt="The Rigid Boxes Logo" class="logo-image">
                    </div>
                    <p class="brand-description">
                        The Rigid Boxes is a leading custom packaging manufacturer, delivering premium boxes and packaging solutions tailored to your brand. From design to delivery, we ensure unmatched quality, style, and customer service.
                    </p>
                    <div class="social-links">
                        <a href="#" class="social-icon" aria-label="Facebook">
                            <img src="{{ asset('images/social-facebook.png') }}" alt="Facebook" class="social-icon-img">
                        </a>
                        <a href="#" class="social-icon" aria-label="Instagram">
                            <img src="{{ asset('images/social-instagram.png') }}" alt="Instagram" class="social-icon-img">
                        </a>
                        <a href="#" class="social-icon" aria-label="LinkedIn">
                            <img src="{{ asset('images/social-linkedin.png') }}" alt="LinkedIn" class="social-icon-img">
                        </a>
                        <a href="#" class="social-icon" aria-label="Pinterest">
                            <img src="{{ asset('images/bi_pinterest.png') }}" alt="Pinterest" class="social-icon-img">
                        </a>
                        <a href="#" class="social-icon" aria-label="YouTube">
                            <img src="{{ asset('images/social-youtube.png') }}" alt="YouTube" class="social-icon-img">
                        </a>
                    </div>
                </div>

                <!-- Categories Column -->
                <div class="footer-column">
                    <h4 class="footer-heading">Categories</h4>
                    <ul class="footer-links">
                        @php
                            $footerCatIds = $siteSettings['footer_categories'] ?? [];
                            $footerCats = [];
                            if (!empty($footerCatIds)) {
                                $footerCats = \Illuminate\Support\Facades\DB::table('admin_categories')
                                    ->whereIn('id', $footerCatIds)
                                    ->get();
                            }
                        @endphp
                        @if(empty($footerCatIds) || count($footerCats) == 0)
                            <li><a href="#">Super Boxes</a></li>
                            <li><a href="#">Rigid Boxes</a></li>
                            <li><a href="#">Mailer Boxes</a></li>
                            <li><a href="#">Jewelry Boxes</a></li>
                            <li><a href="#">Hang Tags</a></li>
                        @else
                            @foreach($footerCats as $cat)
                                <li><a href="{{ url('/' . $cat->slug) }}">{{ $cat->title ?? $cat->name }}</a></li>
                            @endforeach
                        @endif
                    </ul>
                </div>

                <!-- Quick Links Column -->
                <div class="footer-column">
                    <h4 class="footer-heading">Quick Links</h4>
                    <ul class="footer-links">
                        @php
                            $quickLinks = $siteSettings['footer_quick_links'] ?? [];
                        @endphp
                        @if(empty($quickLinks))
                            <li><a href="/aboutUs">About Us</a></li>
                            <li><a href="/contact">Contact Us</a></li>
                            <li><a href="/request-quote">Get A Free Quote</a></li>
                            <li><a href="#">Refund & Exchange Policy</a></li>
                            <li><a href="/blog">Blogs</a></li>
                        @else
                            @foreach($quickLinks as $link)
                                <li><a href="{{ $link['url'] }}">{{ $link['name'] }}</a></li>
                            @endforeach
                        @endif
                    </ul>
                </div>

                <!-- Company Info Column -->
                <div class="footer-column">
                    <h4 class="footer-heading">Company Info</h4>
                    <ul class="footer-contact">
                        <li class="contact-item">
                            <img src="{{ asset('images/contact-email.png') }}" alt="Email" class="contact-icon">
                            <a href="mailto:{{ $siteSettings['company_email'] ?? 'example@gmail.com' }}">{{ $siteSettings['company_email'] ?? 'example@gmail.com' }}</a>
                        </li>
                        <li class="contact-item">
                            <img src="{{ asset('images/material-symbols_call-sharp.png') }}" alt="Phone" class="contact-icon">
                            <a href="tel:{{ $siteSettings['company_phone'] ?? '1800-315-8441' }}">{{ $siteSettings['company_phone'] ?? '1800-315-8441' }}</a>
                        </li>
                        <li class="contact-item">
                            <img src="{{ asset('images/contact-address.png') }}" alt="Address" class="contact-icon">
                            <span>{!! $siteSettings['company_address'] ?? '4000 N Montrose Ave<br>550 Chicago, IL 60641' !!}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Bottom -->
    <div class="footer-bottom">
        <div class="container">
            <div class="footer-bottom-content">
                <p class="copyright">© 2025 The Rigid Boxes. All rights reserved.</p>
                <div class="payment-methods">
                    <img src="{{ asset('images/group 1000006247.png') }}" alt="Payment Methods" class="payment-group">
                </div>
            </div>
        </div>
    </div>
</footer>

<link rel="stylesheet" href="{{ asset('css/footer.css') }}">
