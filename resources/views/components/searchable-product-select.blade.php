@php
    $pickerId = $id ?? ('product-picker-' . uniqid());
    $pickerName = $name ?? 'box_style';
    $pickerSelected = $selected ?? '';
    $pickerPlaceholder = $placeholder ?? 'Select Box Style';
    $pickerOptions = app(\App\Support\QuoteProductOptions::class)->all();
@endphp

<div class="product-picker" data-product-picker>
    <input type="hidden" name="{{ $pickerName }}" value="{{ $pickerSelected }}" class="product-picker-value">
    <button type="button" class="product-picker-trigger" aria-expanded="false" aria-controls="{{ $pickerId }}">
        <span class="product-picker-label">{{ $pickerSelected ?: $pickerPlaceholder }}</span>
        <span class="product-picker-chevron" aria-hidden="true"></span>
    </button>
    <div class="product-picker-menu" id="{{ $pickerId }}" hidden>
        <input type="search" class="product-picker-search" placeholder="Search product..." autocomplete="off" aria-label="Search product">
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
    .product-picker-trigger { display: flex; align-items: center; justify-content: space-between; gap: 12px; width: 100%; min-height: 54px; padding: 12px 16px; border: 1px solid #8d4445; border-radius: 8px; background: #fff; color: #222; font: inherit; text-align: left; cursor: pointer; }
    .product-picker-chevron { width: 9px; height: 9px; flex: 0 0 9px; border-right: 2px solid currentColor; border-bottom: 2px solid currentColor; transform: rotate(45deg) translateY(-3px); transition: transform .18s ease; }
    .product-picker.is-open .product-picker-chevron { transform: rotate(225deg) translate(-2px, -1px); }
    .product-picker-menu { position: absolute; z-index: 1000; top: calc(100% + 5px); left: 0; width: 100%; min-width: 260px; padding: 8px; border: 1px solid #8d4445; border-radius: 8px; background: #fff; box-shadow: 0 12px 24px rgba(0,0,0,.13); }
    .product-picker-search { width: 100%; height: 42px; padding: 8px 11px; border: 1px solid #d6c0c0; border-radius: 5px; font: inherit; outline: none; box-sizing: border-box; }
    .product-picker-search:focus { border-color: #8d4445; }
    .product-picker-options { max-height: 250px; margin-top: 7px; overflow-y: auto; }
    .product-picker-option { display: block; width: 100%; padding: 10px 12px; border: 0; border-radius: 4px; background: transparent; color: #222; font: inherit; text-align: left; cursor: pointer; }
    .product-picker-option:hover, .product-picker-option:focus, .product-picker-option.is-selected { background: #8d4445; color: #fff; outline: none; }
    .product-picker-empty { margin: 0; padding: 12px; color: #666; font-size: 14px; }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('[data-product-picker]').forEach(function (picker) {
            const trigger = picker.querySelector('.product-picker-trigger');
            const label = picker.querySelector('.product-picker-label');
            const menu = picker.querySelector('.product-picker-menu');
            const search = picker.querySelector('.product-picker-search');
            const value = picker.querySelector('.product-picker-value');
            const options = Array.from(picker.querySelectorAll('.product-picker-option'));
            const empty = picker.querySelector('.product-picker-empty');

            const close = function () {
                picker.classList.remove('is-open');
                menu.hidden = true;
                trigger.setAttribute('aria-expanded', 'false');
            };
            const filter = function () {
                const term = search.value.trim().toLowerCase();
                let visible = 0;
                options.forEach(function (option) {
                    const show = option.textContent.toLowerCase().includes(term);
                    option.hidden = !show;
                    if (show) visible++;
                });
                empty.hidden = visible !== 0;
            };
            trigger.addEventListener('click', function () {
                const opening = menu.hidden;
                document.querySelectorAll('[data-product-picker]').forEach(function (other) {
                    if (other !== picker) {
                        other.classList.remove('is-open');
                        const otherMenu = other.querySelector('.product-picker-menu');
                        if (otherMenu) otherMenu.hidden = true;
                    }
                });
                menu.hidden = !opening;
                picker.classList.toggle('is-open', opening);
                trigger.setAttribute('aria-expanded', String(opening));
                if (opening) {
                    search.value = '';
                    filter();
                    search.focus();
                }
            });
            search.addEventListener('input', filter);
            options.forEach(function (option) {
                option.addEventListener('click', function () {
                    value.value = option.dataset.value;
                    label.textContent = option.dataset.value;
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
