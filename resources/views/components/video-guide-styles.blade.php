{{--
    Styles for the "Watch Video Guide" buttons and modal.

    Include this in the page <head> (or before the first button) so the
    buttons never render unstyled while the page loads. The modal partial
    also includes it, so it is safe to include in both places: it renders once.
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
@endonce
