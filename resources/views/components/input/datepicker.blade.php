@props(['options' => [], 'range' => false])

@php
    $options = array_merge(
        [
            'mode' => $range ? 'range' : 'single',
            'dateFormat' => 'Y-m-d',
            'enableTime' => false,
            'altFormat' => 'j F Y',
            'altInput' => true,
            'monthSelectorType' => 'static',
            'minDate' => 'today',
        ],
        $options,
    );
@endphp

<div wire:ignore>
    <input required x-data="{
        value: @entangle($attributes->wire('model')),
        instance: undefined,
        init() {
            $watch('value', value => this.instance.setDate(value, false));
            this.instance = flatpickr(this.$refs.input, {{ json_encode((object) $options) }});
        }
    }" x-ref="input" x-bind:value="value" type="text" autocomplete="off"
        placeholder="{{ $range ? '01 August 2024 - 31 August 2024' : '01 August 2024' }}"
        {{ $attributes->merge(['class' => 'form-input']) }} />
</div>
