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
                    <input type="email" name="email" placeholder="Email" class="newsletter-input" aria-label="Email address for newsletter" required>
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
                        <img src="{{ asset('uploads/logo-rigid-boxes.svg') }}" alt="The Rigid Boxes Logo" class="logo-image" width="189" height="96" loading="lazy">
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

                        @if(!empty($siteSettings['social_tiktok']))
                        <a href="{{ $siteSettings['social_tiktok'] }}" target="_blank" rel="noopener" class="social-icon" aria-label="TikTok">
                            {{-- Inline icon so it shows on every page (Font Awesome is not loaded everywhere). --}}
                            <svg class="social-icon-img" viewBox="0 0 24 24" fill="#ffffff" role="img" aria-hidden="true"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/></svg>
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
                                    ->where('status', 'published')
                                    ->get();
                            }
                        @endphp
                        @if(empty($footerCatIds) || count($footerCats) == 0)
                            <li><a href="/super-boxes/">Super Boxes</a></li>
                            <li><a href="/rigid-boxes/">Rigid Boxes</a></li>
                            <li><a href="/mailer-boxes/">Mailer Boxes</a></li>
                            <li><a href="/jewelry-boxes/">Jewelry Boxes</a></li>
                            <li><a href="/hang-tags/">Hang Tags</a></li>
                        @else
                            @foreach($footerCats as $cat)
                                <li><a href="{{ url('/' . $cat->slug) }}/">{{ $cat->title ?? $cat->name }}</a></li>
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
                            <li><a href="/about-us/">About Us</a></li>
                            <li><a href="/contact-us/">Contact Us</a></li>
                            <li><a href="/request-quote/">Get A Free Quote</a></li>
                            <li><a href="/contact-us/">Refund & Exchange Policy</a></li>
                            <li><a href="/blog/">Blog</a></li>
                        @else
                            @foreach($quickLinks as $link)
                                @php
                                    $quickLinkUrl = $link['url'] ?? '#';
                                    if (substr($quickLinkUrl, 0, 1) === '/' && $quickLinkUrl !== '/' && substr($quickLinkUrl, -1) !== '/' && !pathinfo($quickLinkUrl, PATHINFO_EXTENSION)) {
                                        $quickLinkUrl .= '/';
                                    }
                                @endphp
                                <li><a href="{{ $quickLinkUrl }}">{{ $link['name'] }}</a></li>
                            @endforeach
                        @endif
                    </ul>
                </div>

                <!-- Company Info Column -->
                <div class="footer-column">
                    <span class="footer-heading" style="display: block;">Company Info</span>
                    <ul class="footer-contact">
                        @if(!empty($siteSettings['company_email']))
                        <li class="contact-item">
                            <img src="{{ asset('images/contact-email.png') }}" alt="Email" class="contact-icon">
                            <a href="mailto:{{ $siteSettings['company_email'] }}">{{ $siteSettings['company_email'] }}</a>
                        </li>
                        @endif
                        @if(!empty($siteSettings['company_phone']))
                        <li class="contact-item">
                            <img src="{{ asset('images/material-symbols_call-sharp.png') }}" alt="Phone" class="contact-icon">
                            <a href="tel:{{ $siteSettings['company_phone'] }}">{{ $siteSettings['company_phone'] }}</a>
                        </li>
                        @endif
                        @if(!empty($siteSettings['company_address']))
                        <li class="contact-item">
                            <img src="{{ asset('images/contact-address.png') }}" alt="Address" class="contact-icon">
                            <span>{!! $siteSettings['company_address'] !!}</span>
                        </li>
                        @endif
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

    const ajaxForms = document.querySelectorAll('form[action*="/submit-quote"], form[action*="/submit-newsletter"], form[action*="/submit-contact"]');

    function clearFormErrors(form) {
        const box = form.querySelector('.ajax-inline-error');
        if (box) box.style.display = 'none';
    }

    // Shows the server's validation messages at the top of the form and
    // moves focus to the first field that failed.
    function showFormErrors(form, errors, fallbackMessage) {
        let box = form.querySelector('.ajax-inline-error');
        if (!box) {
            box = document.createElement('div');
            box.className = 'ajax-inline-error';
            box.setAttribute('role', 'alert');
            box.style.cssText = 'background:#f8d7da;color:#721c24;padding:10px 12px;border-radius:5px;margin-bottom:16px;font-size:14px;line-height:1.5;';
            form.insertBefore(box, form.firstChild);
        }

        const messages = errors
            ? Object.values(errors).map(list => list[0])
            : [fallbackMessage || 'Something went wrong. Please try again.'];
        box.innerHTML = '';
        messages.forEach(text => {
            const line = document.createElement('div');
            line.textContent = text;
            box.appendChild(line);
        });
        box.style.display = 'block';

        const firstField = errors ? form.querySelector('[name="' + Object.keys(errors)[0] + '"]') : null;
        const focusTarget = firstField && firstField.type === 'hidden'
            ? firstField.closest('[data-product-picker]')?.querySelector('.product-picker-trigger')
            : firstField;
        (focusTarget || box).scrollIntoView({ behavior: 'smooth', block: 'center' });
        if (focusTarget) focusTarget.focus({ preventScroll: true });
    }

    ajaxForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            // A form-specific validator (such as Box Style selection) may
            // already have cancelled this submission. Do not send AJAX data
            // when that validation has failed.
            if (e.defaultPrevented) return;

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
            .then(response => response.json()
                .catch(() => ({}))
                .then(data => ({ ok: response.ok, status: response.status, data })))
            .then(({ ok, status, data }) => {
                if(submitBtn) submitBtn.innerHTML = originalBtnText;

                // A rejected submission keeps the user's input and explains why.
                if (!ok) {
                    // Only validation messages are shown; server errors can
                    // contain internal details, so they get a generic message.
                    showFormErrors(form, status === 422 ? data.errors : null,
                        'Something went wrong while sending your request. Please try again, or contact us by phone or email.');
                    form.dispatchEvent(new CustomEvent('ajax-form-error', { detail: status === 422 ? data.errors : null }));
                    return;
                }
                clearFormErrors(form);

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
<script>
    (function() {
        var chatLoaded = false;
        function loadLiveChat() {
            if (chatLoaded) return;
            chatLoaded = true;
            var s = document.createElement('script');
            s.src = 'https://tcbconnect.com/widget.js';
            s.setAttribute('data-livechat-key', 'wk_a3c5abc8b9a7');
            s.async = true;
            document.body.appendChild(s);
        }
        ['scroll', 'touchstart', 'mousemove', 'click'].forEach(function(e) {
            window.addEventListener(e, loadLiveChat, { once: true, passive: true });
        });
        if ('requestIdleCallback' in window) {
            window.requestIdleCallback(function() { setTimeout(loadLiveChat, 3500); });
        } else {
            window.addEventListener('load', function() { setTimeout(loadLiveChat, 3500); });
        }
    })();
</script>
