{{--
    Reusable "Watch Video Guide" modal.

    Include the styles in the page <head> so the buttons are styled from the
    first paint:
        @include('components.video-guide-styles')

    Include the modal once per page that has video-guide buttons:
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
@include('components.video-guide-styles')

@once
<div class="video-guide-modal" id="videoGuideModal" role="dialog" aria-modal="true" aria-hidden="true">
    <div class="video-guide-modal-dialog">
        <span class="video-guide-modal-title" data-video-title></span>
        <button type="button" class="video-guide-modal-close" aria-label="Close video">&times;</button>
        {{-- No download button in the player menu and no "Save video as" on right-click. --}}
        <video controls controlslist="nodownload" preload="none" playsinline oncontextmenu="return false;"></video>
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
        // Show the first frame immediately while the video starts buffering.
        video.poster = src.replace(/\.mp4(\?.*)?$/, '-poster.jpg');
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
        video.removeAttribute('poster');
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
