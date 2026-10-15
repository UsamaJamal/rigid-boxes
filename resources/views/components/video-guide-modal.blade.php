{{--
    Reusable "Watch Video Guide" modal.

    Include once per page that has video-guide buttons:
        @include('components.video-guide-modal')

    Then add a button next to any field:
        <button type="button" class="video-guide-btn"
                data-video="{{ asset('uploads/paper-stock.mp4') }}"
                data-video-title="Paper Stock Guide">
            <span class="vg-play"><svg viewBox="0 0 10 10" fill="currentColor"><path d="M2 1l6 4-6 4z"/></svg></span>
            Watch Video Guide
        </button>

    The CSS/JS below render only once even if the partial is included several times.
--}}
@once
<style>
    .video-guide-btn {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        margin-top: 7px;
        padding: 0;
        border: 0;
        background: none;
        color: var(--primary-color, #8D4445);
        font: 600 13px 'DM Sans', sans-serif;
        line-height: 1.2;
        cursor: pointer;
        text-decoration: underline;
        text-underline-offset: 2px;
    }
    .video-guide-btn:hover { opacity: .8; }
    .video-guide-btn .vg-play {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 18px;
        height: 18px;
        border-radius: 50%;
        background: var(--primary-color, #8D4445);
        color: #fff;
        flex-shrink: 0;
    }
    .video-guide-btn .vg-play svg { width: 8px; height: 8px; margin-left: 1px; }

    .video-guide-modal {
        position: fixed;
        inset: 0;
        z-index: 99999;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 20px;
        background: rgba(0, 0, 0, .72);
    }
    .video-guide-modal.is-open { display: flex; }
    .video-guide-modal-dialog {
        position: relative;
        width: 100%;
        max-width: 820px;
        background: #000;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0, 0, 0, .5);
    }
    .video-guide-modal-dialog video {
        display: block;
        width: 100%;
        max-height: 80vh;
        background: #000;
    }
    .video-guide-modal-title {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        padding: 12px 56px 24px 16px;
        background: linear-gradient(180deg, rgba(0, 0, 0, .65), transparent);
        color: #fff;
        font: 600 14px 'Open Sans', sans-serif;
        z-index: 1;
        pointer-events: none;
    }
    .video-guide-modal-close {
        position: absolute;
        top: 10px;
        right: 10px;
        z-index: 2;
        width: 38px;
        height: 38px;
        border: 0;
        border-radius: 50%;
        background: rgba(255, 255, 255, .92);
        color: #000;
        font-size: 24px;
        line-height: 1;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .video-guide-modal-close:hover { background: #fff; }
</style>

<div class="video-guide-modal" id="videoGuideModal" role="dialog" aria-modal="true" aria-hidden="true">
    <div class="video-guide-modal-dialog">
        <span class="video-guide-modal-title" data-video-title></span>
        <button type="button" class="video-guide-modal-close" aria-label="Close video">&times;</button>
        <video controls preload="none" playsinline></video>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var modal = document.getElementById('videoGuideModal');
    if (!modal || modal.dataset.ready) return;
    modal.dataset.ready = '1';

    var video = modal.querySelector('video');
    var titleEl = modal.querySelector('[data-video-title]');

    function openModal(src, title) {
        if (!src) return;
        video.src = src;
        titleEl.textContent = title || '';
        modal.classList.add('is-open');
        modal.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
        var played = video.play();
        if (played && played.catch) played.catch(function () {});
    }

    function closeModal() {
        video.pause();
        video.removeAttribute('src');
        video.load();
        modal.classList.remove('is-open');
        modal.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
    }

    document.addEventListener('click', function (event) {
        var trigger = event.target.closest('.video-guide-btn');
        if (trigger) {
            event.preventDefault();
            openModal(trigger.getAttribute('data-video'), trigger.getAttribute('data-video-title'));
            return;
        }
        if (event.target.closest('.video-guide-modal-close')) {
            closeModal();
            return;
        }
        if (event.target === modal) {
            closeModal();
        }
    });

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape' && modal.classList.contains('is-open')) closeModal();
    });
});
</script>
@endonce
