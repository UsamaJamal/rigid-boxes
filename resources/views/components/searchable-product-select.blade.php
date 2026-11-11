<?php
    $pickerId = $id ?? ('product-picker-' . uniqid());
    $pickerName = $name ?? 'box_style';
    $pickerSelected = $selected ?? '';
    $pickerPlaceholder = $placeholder ?? 'Select Box Style';
    $pickerOptions = app(\App\Support\QuoteProductOptions::class)->all();
?>

<div class="product-picker" data-product-picker>
    <input type="hidden" name="{{ $pickerName }}" value="{{ $pickerSelected }}" class="product-picker-value">
    <button type="button" class="product-picker-trigger" aria-expanded="false" aria-controls="{{ $pickerId }}">
        <span class="product-picker-label">{{ $pickerSelected ?: $pickerPlaceholder }}</span>
        <span class="product-picker-chevron" aria-hidden="true"></span>
    </button>
    <div class="product-picker-menu" id="{{ $pickerId }}" hidden>
        <input type="search" class="product-picker-search" placeholder="Search product..." autocomplete="off" aria-label="Search product">
        <div class="product-picker-options" role="listbox">
            @if($pickerSelected)
                <button type="button" class="product-picker-option is-selected" role="option" data-value="{{ $pickerSelected }}">{{ $pickerSelected }}</button>
            @endif
            <p class="product-picker-empty" hidden>No product found</p>
        </div>
        <script type="application/json" class="product-picker-data">@json($pickerOptions)</script>
    </div>
</div>

@once
<style>
    .product-picker { position: relative; width: 100%; min-width: 0; }
    .product-picker-trigger { display: flex; align-items: center; justify-content: space-between; gap: 12px; width: 100%; height: 44px; min-height: 0; padding: 10px 14px; border: 1px solid #8d4445; border-radius: 6px; background: #fafafa; color: #333; font-family: 'DM Sans', sans-serif; font-size: 14px; line-height: 1.2; text-align: left; cursor: pointer; box-sizing: border-box; }
    .product-picker-label { min-width: 0; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
    .product-picker-chevron { width: 9px; height: 9px; flex: 0 0 9px; border-right: 2px solid currentColor; border-bottom: 2px solid currentColor; transform: rotate(45deg) translateY(-3px); }
    .product-picker-menu { position: absolute; z-index: 1000; top: calc(100% + 5px); left: 0; width: 100%; min-width: 260px; padding: 8px; border: 1px solid #8d4445; border-radius: 8px; background: #fff; box-shadow: 0 12px 24px rgba(0,0,0,.13); box-sizing: border-box; }
    .product-picker-search { width: 100%; height: 42px; padding: 8px 11px; border: 1px solid #d6c0c0; border-radius: 5px; font: inherit; outline: none; box-sizing: border-box; }
    .product-picker-search:focus { border-color: #8d4445; }
    .product-picker-options { max-height: 250px; margin-top: 7px; overflow-y: auto; }
    .product-picker-option { display: block; width: 100%; padding: 10px 12px; border: 0; border-radius: 4px; background: transparent; color: #222; font: inherit; text-align: left; cursor: pointer; }
    .product-picker-option[hidden] { display: none; }
    .product-picker-option:hover, .product-picker-option:focus, .product-picker-option.is-selected { background: #8d4445; color: #fff; outline: none; }
    .product-picker-empty { margin: 0; padding: 12px; color: #666; font-size: 14px; }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('[data-product-picker]').forEach(function (picker) {
            if (picker.dataset.ready) return;
            picker.dataset.ready = 'true';
            const trigger = picker.querySelector('.product-picker-trigger');
            const label = picker.querySelector('.product-picker-label');
            const menu = picker.querySelector('.product-picker-menu');
            const search = picker.querySelector('.product-picker-search');
            const value = picker.querySelector('.product-picker-value');
            const optionsContainer = picker.querySelector('.product-picker-options');
            const empty = picker.querySelector('.product-picker-empty');
            const form = picker.closest('form');

            let rawOptions = [];
            const dataScript = picker.querySelector('.product-picker-data');
            if (dataScript) {
                try {
                    rawOptions = JSON.parse(dataScript.textContent || '[]');
                } catch(e) {
                    rawOptions = [];
                }
            }

            const renderOptions = function (filterTerm) {
                const term = (filterTerm || '').trim().toLowerCase();
                const selectedVal = (value.value || '').trim();
                optionsContainer.innerHTML = '';
                let count = 0;

                if (selectedVal && (!term || selectedVal.toLowerCase().includes(term))) {
                    const btn = document.createElement('button');
                    btn.type = 'button';
                    btn.className = 'product-picker-option is-selected';
                    btn.setAttribute('role', 'option');
                    btn.dataset.value = selectedVal;
                    btn.textContent = selectedVal;
                    optionsContainer.appendChild(btn);
                    count++;
                }

                for (let i = 0; i < rawOptions.length; i++) {
                    const opt = rawOptions[i];
                    if (opt === selectedVal) continue;
                    if (!term || opt.toLowerCase().includes(term)) {
                        const btn = document.createElement('button');
                        btn.type = 'button';
                        btn.className = 'product-picker-option';
                        btn.setAttribute('role', 'option');
                        btn.dataset.value = opt;
                        btn.textContent = opt;
                        optionsContainer.appendChild(btn);
                        count++;
                        if (!term && count >= 100) break;
                    }
                }

                if (empty) {
                    empty.hidden = count !== 0;
                    if (count === 0) {
                        optionsContainer.appendChild(empty);
                    }
                }
            };

            const close = function () { 
                menu.hidden = true; 
                trigger.setAttribute('aria-expanded', 'false'); 
            };

            trigger.addEventListener('click', function () { 
                const opening = menu.hidden; 
                document.querySelectorAll('.product-picker-menu').forEach(function (other) { 
                    if (other !== menu) other.hidden = true; 
                }); 
                menu.hidden = !opening; 
                trigger.setAttribute('aria-expanded', String(opening)); 
                if (opening) { 
                    search.value = ''; 
                    renderOptions('');
                    search.focus(); 
                } 
            });

            search.addEventListener('input', function () {
                renderOptions(search.value);
            });

            optionsContainer.addEventListener('click', function (event) {
                const option = event.target.closest('.product-picker-option');
                if (!option) return;
                value.value = option.dataset.value;
                label.textContent = option.dataset.value;
                close();
            });

            if (form) {
                form.addEventListener('submit', function (event) {
                    if (value.value.trim()) return;
                    event.preventDefault();
                    trigger.style.borderColor = '#c62828';
                    trigger.focus();
                    alert('Please select a Box Style from the list.');
                });
            }
            document.addEventListener('click', function (event) { 
                if (!picker.contains(event.target)) close(); 
            });
        });
    });
</script>
@endonce
