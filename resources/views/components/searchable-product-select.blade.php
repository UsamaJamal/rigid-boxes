<?php
    $pickerId = $id ?? ('product-picker-' . uniqid());
    $pickerName = $name ?? 'box_style';
    $pickerSelected = $selected ?? '';
    $pickerPlaceholder = $placeholder ?? 'Select Box Style';
    $pickerOptions = app(\App\Support\QuoteProductOptions::class)->all();
?>

<select name="{{ $pickerName }}" id="{{ $pickerId }}" class="form-control" aria-label="{{ $pickerPlaceholder }}">
    <option value=""{{ $pickerSelected ? '' : ' selected' }} disabled>{{ $pickerPlaceholder }}</option>
    @if($pickerSelected && !$pickerOptions->contains($pickerSelected))
        <option value="{{ $pickerSelected }}" selected>{{ $pickerSelected }}</option>
    @endif
    @foreach($pickerOptions as $pickerOption)
        <option value="{{ $pickerOption }}"{{ $pickerOption === $pickerSelected ? ' selected' : '' }}>{{ $pickerOption }}</option>
    @endforeach
</select>
