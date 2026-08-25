<footer class="main-footer">
    <!-- Newsletter Section -->
    <div class="newsletter-section">
        <div class="container">
            <div class="newsletter-content">
                <div class="newsletter-text">
                    <span class="newsletter-heading">Sign Up For Exclusive Offers<br>And Updates!</span>
                </div>
                <form class="newsletter-form" action="{{ url('/submit-newsletter') }}" method="POST">
                    @csrf
                    <input type="email" name="email" placeholder="Email" class="newsletter-input" required>
                    <button type="submit" class="newsletter-button">Subscribe</button>
                </form>
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
                        <img src="{{ asset('uploads/logo-rigid-boxes.svg') }}" alt="The Rigid Boxes Logo" class="logo-image">
                    </div>
                    <p class="brand-description">
                        The Rigid Boxes is a leading custom packaging manufacturer, delivering premium boxes and packaging solutions tailored to your brand. From design to delivery, we ensure unmatched quality, style, and customer service.
                    </p>
                    <div class="social-links">
                        @if(!empty($siteSettings['social_facebook']))
                        <a href="{{ $siteSettings['social_facebook'] }}" target="_blank" rel="noopener" class="social-icon" aria-label="Facebook">
                            <img src="{{ asset('images/social-facebook.png') }}" alt="Facebook" class="social-icon-img" loading="lazy">
                        </a>
                        @endif
                        
                        @if(!empty($siteSettings['social_twitter']))
                        <a href="{{ $siteSettings['social_twitter'] }}" target="_blank" rel="noopener" class="social-icon" aria-label="Twitter">
                            <i class="fa-brands fa-x-twitter" style="color: white; font-size: 20px;"></i>
                        </a>
                        @endif
                        
                        @if(!empty($siteSettings['social_instagram']))
                        <a href="{{ $siteSettings['social_instagram'] }}" target="_blank" rel="noopener" class="social-icon" aria-label="Instagram">
                            <img src="{{ asset('images/social-instagram.png') }}" alt="Instagram" class="social-icon-img" loading="lazy">
                        </a>
                        @endif
                        
                        @if(!empty($siteSettings['social_linkedin']))
                        <a href="{{ $siteSettings['social_linkedin'] }}" target="_blank" rel="noopener" class="social-icon" aria-label="LinkedIn">
                            <img src="{{ asset('images/social-linkedin.png') }}" alt="LinkedIn" class="social-icon-img" loading="lazy">
                        </a>
                        @endif
                        
                        @if(!empty($siteSettings['social_pinterest']))
                        <a href="{{ $siteSettings['social_pinterest'] }}" target="_blank" rel="noopener" class="social-icon" aria-label="Pinterest">
                            <img src="{{ asset('images/bi_pinterest.png') }}" alt="Pinterest" class="social-icon-img" loading="lazy">
                        </a>
                        @endif
                        
                        @if(!empty($siteSettings['social_youtube']))
                        <a href="{{ $siteSettings['social_youtube'] }}" target="_blank" rel="noopener" class="social-icon" aria-label="YouTube">
                            <img src="{{ asset('images/social-youtube.png') }}" alt="YouTube" class="social-icon-img" loading="lazy">
                        </a>
                        @endif
                    </div>
                </div>

                <!-- Categories Column -->
                <div class="footer-column">
                    <span class="footer-heading" style="display: block;">Categories</span>
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
                            <li><a href="/super-boxes">Super Boxes</a></li>
                            <li><a href="/rigid-boxes">Rigid Boxes</a></li>
                            <li><a href="/mailer-boxes">Mailer Boxes</a></li>
                            <li><a href="/jewelry-boxes">Jewelry Boxes</a></li>
                            <li><a href="/hang-tags">Hang Tags</a></li>
                        @else
                            @foreach($footerCats as $cat)
                                <li><a href="{{ url('/' . $cat->slug) }}">{{ $cat->title ?? $cat->name }}</a></li>
                            @endforeach
                        @endif
                    </ul>
                </div>

                <!-- Quick Links Column -->
                <div class="footer-column">
                    <span class="footer-heading" style="display: block;">Quick Links</span>
                    <ul class="footer-links">
                        @php
                            $quickLinks = $siteSettings['footer_quick_links'] ?? [];
                        @endphp
                        @if(empty($quickLinks))
                            <li><a href="/about-us">About Us</a></li>
                            <li><a href="/contact-us">Contact Us</a></li>
                            <li><a href="/request-quote">Get A Free Quote</a></li>
                            <li><a href="/contact-us">Refund & Exchange Policy</a></li>
                            <li><a href="/blog">Blog</a></li>
                        @else
                            @foreach($quickLinks as $link)
                                <li><a href="{{ $link['url'] }}">{{ $link['name'] }}</a></li>
                            @endforeach
                        @endif
                    </ul>
                </div>

                <!-- Company Info Column -->
                <div class="footer-column">
                    <span class="footer-heading" style="display: block;">Company Info</span>
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
                <p class="copyright">© 2026 The Rigid Boxes. All rights reserved.</p>
                <div class="payment-methods">
                    <img src="{{ asset('images/Group 1000006247.png') }}" alt="Payment Methods" class="payment-group">
                </div>
            </div>
        </div>
    </div>
</footer>

<div id="successPopup" class="success-popup-overlay" style="display: none;">
    <div class="success-popup-box">
        <div class="success-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>
        <span class="thank-you-title">Thank You!</span>
        <p>{{ session('success') }}</p>
        <button onclick="document.getElementById('successPopup').style.display='none'">Close</button>
    </div>
</div>
<style>
.success-popup-overlay {
    position: fixed; top: 0; left: 0; width: 100%; height: 100%;
    background: rgba(0,0,0,0.6); z-index: 9999;
    display: flex; align-items: center; justify-content: center;
}
.success-popup-box {
    background: #fff; padding: 30px; border-radius: 12px;
    text-align: center; max-width: 400px; width: 90%;
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    animation: popIn 0.4s ease;
}
.success-icon {
    width: 60px; height: 60px; border-radius: 50%;
    background: #e8f5e9; color: #4caf50;
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 15px;
}
.success-icon svg { width: 35px; height: 35px; }
.success-popup-box h2, .success-popup-box .thank-you-title { color: #333; margin-bottom: 10px; font-family: 'Open Sans', sans-serif; display: block; }
.success-popup-box p { color: #666; font-size: 16px; margin-bottom: 25px; line-height: 1.5; font-family: 'DM Sans', sans-serif; }
.success-popup-box button {
    background: #8D4445; color: #fff; border: none;
    padding: 10px 30px; border-radius: 6px; font-size: 16px;
    cursor: pointer; font-weight: 600; transition: background 0.2s;
}
.success-popup-box button:hover { background: #6b3334; }
@keyframes popIn {
    0% { transform: scale(0.8); opacity: 0; }
    100% { transform: scale(1); opacity: 1; }
}
</style>
<script>
    setTimeout(function() {
        var popup = document.getElementById('successPopup');
        if(popup) { popup.style.display = 'none'; }
    }, 6000);
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Keep meaningful image alt text consistent without changing decorative alt="" images.
    const normalizeImageAlt = function(image) {
        const alt = image.getAttribute('alt');
        if (alt === null || alt.trim() === '') return;

        image.setAttribute(
            'alt',
            alt
                .trim()
                .replace(/[-_]+/g, ' ')
                .replace(/\s+/g, ' ')
                .toLowerCase()
        );
    };

    document.querySelectorAll('img[alt]').forEach(normalizeImageAlt);

    // Normalize images added later by sliders, AJAX content, or other components.
    const imageObserver = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            mutation.addedNodes.forEach(function(node) {
                if (!(node instanceof Element)) return;
                if (node.matches('img[alt]')) normalizeImageAlt(node);
                node.querySelectorAll('img[alt]').forEach(normalizeImageAlt);
            });
        });
    });
    imageObserver.observe(document.body, { childList: true, subtree: true });

    const ajaxForms = document.querySelectorAll('form[action*="/submit-quote"], form[action*="/submit-newsletter"], form[action*="/submit-contact"]');
    
    ajaxForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const submitBtn = form.querySelector('button[type="submit"]');
            const originalBtnText = submitBtn ? submitBtn.innerHTML : '';
            if(submitBtn) submitBtn.innerHTML = 'Submitting...';
            
            const formData = new FormData(form);
            
            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if(submitBtn) submitBtn.innerHTML = originalBtnText;
                
                // Show Global Popup
                const popup = document.getElementById('successPopup');
                if(popup) {
                    popup.querySelector('p').innerText = data.success || 'Submitted successfully!';
                    popup.style.display = 'flex';
                }
                
                // Handle Inline Message
                let inlineMsg = form.querySelector('.ajax-inline-success');
                if(!inlineMsg) {
                    inlineMsg = document.createElement('div');
                    inlineMsg.className = 'ajax-inline-success';
                    inlineMsg.style.backgroundColor = '#d4edda';
                    inlineMsg.style.color = '#155724';
                    inlineMsg.style.padding = '10px';
                    inlineMsg.style.borderRadius = '5px';
                    inlineMsg.style.marginBottom = '20px';
                    inlineMsg.style.fontSize = '14px';
                    inlineMsg.style.transition = 'opacity 0.5s';
                    
                    // Insert at the top of the form
                    form.insertBefore(inlineMsg, form.firstChild);
                }
                inlineMsg.innerText = data.success || 'Submitted successfully!';
                inlineMsg.style.display = 'block';
                inlineMsg.style.opacity = '1';
                
                // Reset form
                form.reset();
                
                // Hide after 20 seconds
                setTimeout(() => {
                    if(popup) popup.style.display = 'none';
                    if(inlineMsg) {
                        inlineMsg.style.opacity = '0';
                        setTimeout(() => inlineMsg.style.display = 'none', 500);
                    }
                }, 20000);
            })
            .catch(error => {
                console.error('Error:', error);
                if(submitBtn) submitBtn.innerHTML = originalBtnText;
                alert('An error occurred. Please try again.');
            });
        });
    });
});
</script>
