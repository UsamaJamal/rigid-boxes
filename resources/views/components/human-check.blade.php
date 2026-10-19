{{--
    "Are you a human?" addition check. Place it inside a form, above the
    submit button:
        @include('components.human-check')

    The form cannot be sent until the answer is verified, and the server
    checks it again on submit (App\Support\HumanCheck).
--}}
@once
<style>
    .human-check {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 12px 18px;
        width: 100%;
        margin: 18px 0 0;
        padding: 14px 18px;
        border: 1px solid #e7d3d3;
        border-radius: 12px;
        background: #fdf7f6;
        box-sizing: border-box;
        text-align: left;
    }
    .human-check-text { flex: 1 1 200px; min-width: 0; }
    .human-check .human-check-title {
        margin: 0;
        color: #111;
        font: 700 16px/1.3 'Open Sans', sans-serif;
    }
    .human-check .human-check-sub {
        margin: 3px 0 0;
        color: #666;
        font: 13px/1.4 'DM Sans', sans-serif;
    }
    .human-check-controls {
        display: flex;
        align-items: center;
        gap: 10px;
        flex: 0 1 auto;
    }
    .human-check-question {
        color: var(--primary-color, #8D4445);
        font: 700 18px 'Open Sans', sans-serif;
        white-space: nowrap;
    }
    .human-check input.human-check-answer {
        flex: none;
        width: 84px;
        height: 42px;
        margin: 0;
        padding: 0 12px;
        border: 1px solid #d9c4c4;
        border-radius: 8px;
        background: #fff;
        color: #333;
        font: 14px 'DM Sans', sans-serif;
        box-sizing: border-box;
        outline: none;
    }
    .human-check input.human-check-answer:focus { border-color: var(--primary-color, #8D4445); }
    .human-check button.human-check-verify {
        flex: none;
        width: auto;
        height: 42px;
        margin: 0;
        padding: 0 22px;
        border: 0;
        border-radius: 8px;
        background: var(--primary-color, #8D4445);
        color: #fff;
        font: 700 14px 'DM Sans', sans-serif;
        cursor: pointer;
    }
    .human-check button.human-check-verify:hover:not(:disabled) { background: #6e3031; }
    .human-check button.human-check-verify:disabled { cursor: default; opacity: .9; }
    .human-check.is-verified { border-color: #9fd3a8; background: #f2fbf3; }
    .human-check.is-verified button.human-check-verify { background: #2e7d32; }
    .human-check .human-check-status {
        flex-basis: 100%;
        margin: 0;
        font: 13px/1.4 'DM Sans', sans-serif;
    }
    .human-check .human-check-status:empty { display: none; }
    .human-check .human-check-status.is-error { color: #c62828; }
    .human-check .human-check-status.is-success { color: #2e7d32; }

    @media (max-width: 576px) {
        .human-check { padding: 12px; }
        .human-check-controls { width: 100%; }
        .human-check input.human-check-answer { flex: 1; width: auto; min-width: 0; }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('[data-human-check]').forEach(function (box) {
        var form = box.closest('form');
        var tokenInput = box.querySelector('[name="human_token"]');
        var answer = box.querySelector('[name="human_answer"]');
        var verifyBtn = box.querySelector('.human-check-verify');
        var status = box.querySelector('.human-check-status');
        var verified = false;

        function setStatus(text, kind) {
            status.textContent = text || '';
            status.className = 'human-check-status' + (kind ? ' is-' + kind : '');
        }

        function setVerified(ok) {
            verified = ok;
            box.classList.toggle('is-verified', ok);
            answer.readOnly = ok;
            verifyBtn.disabled = ok;
            verifyBtn.textContent = ok ? 'Verified' : 'Verify';
        }

        function newQuestion(message) {
            setVerified(false);
            answer.value = '';
            setStatus(message || '', message ? 'error' : '');
            return fetch(box.dataset.newUrl, { headers: { 'Accept': 'application/json' } })
                .then(function (response) { return response.json(); })
                .then(function (question) {
                    box.querySelector('[data-hc-a]').textContent = question.a;
                    box.querySelector('[data-hc-b]').textContent = question.b;
                    tokenInput.value = question.token;
                })
                .catch(function () {});
        }

        function verify() {
            if (!answer.value.trim()) {
                setStatus('Please enter the answer.', 'error');
                answer.focus();
                return Promise.resolve(false);
            }

            verifyBtn.disabled = true;
            verifyBtn.textContent = 'Checking...';

            var data = new FormData();
            data.append('human_token', tokenInput.value);
            data.append('human_answer', answer.value.trim());
            var csrf = form ? form.querySelector('[name="_token"]') : null;

            return fetch(box.dataset.verifyUrl, {
                method: 'POST',
                body: data,
                headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': csrf ? csrf.value : '' }
            })
                .then(function (response) { return response.json(); })
                .then(function (result) {
                    if (result.ok) {
                        setVerified(true);
                        setStatus('Thanks! You can submit the form now.', 'success');
                        return true;
                    }
                    setVerified(false);
                    setStatus('That answer is not right. Please try again.', 'error');
                    answer.select();
                    return false;
                })
                .catch(function () {
                    setVerified(false);
                    setStatus('Could not check the answer. Please try again.', 'error');
                    return false;
                });
        }

        answer.addEventListener('input', function () {
            answer.value = answer.value.replace(/\D/g, '');
        });
        answer.addEventListener('keydown', function (event) {
            // Enter checks the answer instead of submitting the form.
            if (event.key === 'Enter') {
                event.preventDefault();
                if (!verified) verify();
            }
        });
        verifyBtn.addEventListener('click', function () { verify(); });

        if (!form) return;

        // Runs before the footer's AJAX handler, which skips cancelled submits.
        form.addEventListener('submit', function (event) {
            if (verified) return;
            event.preventDefault();

            if (!answer.value.trim()) {
                setStatus('Please solve the addition and click Verify.', 'error');
                box.scrollIntoView({ behavior: 'smooth', block: 'center' });
                answer.focus({ preventScroll: true });
                return;
            }

            // An answer was typed but not verified yet: check it, then send.
            verify().then(function (ok) {
                if (ok && form.requestSubmit) form.requestSubmit();
            });
        });

        // After a successful submit the form resets; each question works once.
        form.addEventListener('reset', function () {
            setTimeout(function () { newQuestion(); }, 0);
        });

        // The server rejected the check (expired or already used).
        form.addEventListener('ajax-form-error', function (event) {
            var errors = event.detail || {};
            if (errors.human_answer) newQuestion(errors.human_answer[0]);
        });
    });
});
</script>
@endonce

@php($humanCheck = \App\Support\HumanCheck::issue())
<div class="human-check" data-human-check data-new-url="{{ url('/human-check/new') }}" data-verify-url="{{ url('/human-check/verify') }}">
    <input type="hidden" name="human_token" value="{{ $humanCheck['token'] }}">
    <div class="human-check-text">
        <p class="human-check-title">Are you a human?</p>
        <p class="human-check-sub">Solve this quick addition before continuing.</p>
    </div>
    <div class="human-check-controls">
        <span class="human-check-question"><span data-hc-a>{{ $humanCheck['a'] }}</span> + <span data-hc-b>{{ $humanCheck['b'] }}</span> =</span>
        <input type="text" name="human_answer" class="human-check-answer" placeholder="Answer" inputmode="numeric" maxlength="2" autocomplete="off" aria-label="Answer to the addition">
        <button type="button" class="human-check-verify">Verify</button>
    </div>
    <p class="human-check-status" aria-live="polite"></p>
</div>
