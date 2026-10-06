@php
    $pickerId = $id ?? ('product-picker-' . uniqid());
    $pickerName = $name ?? 'box_style';
    $pickerSelected = $selected ?? '';
    $pickerPlaceholder = $placeholder ?? 'Select Box Style';
    $pickerOptions = app(\App\Support\QuoteProductOptions::class)->all();
@endphp

<div class="product-picker" data-product-picker>
    <input type="hidden" name="{{ $pickerName }}" value="{{ $pickerSelected }}" class="product-picker-value">
    <div class="product-picker-control">
        <input type="text" class="product-picker-trigger" value="{{ $pickerSelected }}" placeholder="{{ $pickerPlaceholder }}" autocomplete="off" aria-expanded="false" aria-controls="{{ $pickerId }}" aria-label="Search and select box style">
        <button type="button" class="product-picker-toggle" aria-label="Open box style options" tabindex="-1"><span class="product-picker-chevron" aria-hidden="true"></span></button>
    </div>
    <div class="product-picker-menu" id="{{ $pickerId }}" hidden>
        <div class="product-picker-options" role="listbox">
            @foreach($pickerOptions as $pickerOption)
                <button type="button" class="product-picker-option{{ $pickerOption === $pickerSelected ? ' is-selected' : '' }}" role="option" data-value="{{ $pickerOption }}">
                    {{ $pickerOption }}
                </button>
            @endforeach
            <p class="product-picker-empty" hidden>No product found</p>
        </div>
    </div>
</div>

@once
<style>
    .product-picker { position: relative; width: 100%; min-width: 0; }
    .product-picker-control { position: relative; display: flex; width: 100%; }
    .product-picker-trigger { width: 100%; min-height: 54px; padding: 12px 42px 12px 16px; border: 1px solid #8d4445; border-radius: 8px; background: #fff; color: #222; font: inherit; outline: none; }
    .product-picker-trigger:focus { border-width: 2px; }
    .product-picker-toggle { position: absolute; top: 0; right: 0; display: grid; width: 46px; height: 100%; padding: 0; border: 0; border-radius: 0 8px 8px 0; background: transparent; color: #555; place-items: center; cursor: pointer; }
    .product-picker-chevron { width: 9px; height: 9px; flex: 0 0 9px; border-right: 2px solid currentColor; border-bottom: 2px solid currentColor; transform: rotate(45deg) translateY(-3px); transition: transform .18s ease; }
    .product-picker.is-open .product-picker-chevron { transform: rotate(225deg) translate(-2px, -1px); }
    .product-picker-menu { position: absolute; z-index: 1000; top: calc(100% + 5px); left: 0; width: 100%; min-width: 260px; padding: 8px; border: 1px solid #8d4445; border-radius: 8px; background: #fff; box-shadow: 0 12px 24px rgba(0,0,0,.13); }
    .product-picker-options { max-height: 250px; overflow-y: auto; }
    .product-picker-option { display: block; width: 100%; padding: 10px 12px; border: 0; border-radius: 4px; background: transparent; color: #222; font: inherit; text-align: left; cursor: pointer; }
    .product-picker-option:hover, .product-picker-option:focus, .product-picker-option.is-selected { background: #8d4445; color: #fff; outline: none; }
    .product-picker-empty { margin: 0; padding: 12px; color: #666; font-size: 14px; }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('[data-product-picker]').forEach(function (picker) {
            const trigger = picker.querySelector('.product-picker-trigger');
            const menu = picker.querySelector('.product-picker-menu');
            const toggle = picker.querySelector('.product-picker-toggle');
            const value = picker.querySelector('.product-picker-value');
            const options = Array.from(picker.querySelectorAll('.product-picker-option'));
            const empty = picker.querySelector('.product-picker-empty');

            const close = function () {
                picker.classList.remove('is-open');
                menu.hidden = true;
                trigger.setAttribute('aria-expanded', 'false');
            };
            const filter = function () {
                const term = trigger.value.trim().toLowerCase();
                let visible = 0;
                options.forEach(function (option) {
                    const show = option.textContent.toLowerCase().includes(term);
                    option.hidden = !show;
                    if (show) visible++;
                });
                empty.hidden = visible !== 0;
            };
            const open = function () {
                const opening = menu.hidden;
                if (!opening) return;
                document.querySelectorAll('[data-product-picker]').forEach(function (other) {
                    if (other !== picker) {
                        other.classList.remove('is-open');
                        const otherMenu = other.querySelector('.product-picker-menu');
                        if (otherMenu) otherMenu.hidden = true;
                    }
                });
                menu.hidden = false;
                picker.classList.add('is-open');
                trigger.setAttribute('aria-expanded', 'true');
                filter();
            };
            toggle.addEventListener('click', function () {
                const opening = menu.hidden;
                if (opening) open(); else close();
            });
            trigger.addEventListener('focus', open);
            trigger.addEventListener('input', function () { open(); filter(); });
            options.forEach(function (option) {
                option.addEventListener('click', function () {
                    value.value = option.dataset.value;
                    trigger.value = option.dataset.value;
                    options.forEach(function (item) { item.classList.toggle('is-selected', item === option); });
                    close();
                });
            });
            document.addEventListener('click', function (event) {
                if (!picker.contains(event.target)) close();
            });
        });
    });
</script>
@endonce
