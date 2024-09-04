<div wire:ignore x-data="{ selectinput: $id('{{ $attributes['wire:model'] }}') }" x-init="$($refs.{{ $attributes['wire:model'] }}).select2({
    placeholder: 'Pilih {{ $attributes['label'] }}',
    minimumResultsForSearch: {{ $attributes['nosearch'] ? 'Infinity' : 'null' }},
    dropdownParent: {{ $attributes['modal'] ? '$(\'#' . $attributes['modal'] . '\')' : 'null' }},
    tags: {{ $attributes['customValue'] ? 'true' : 'false' }},
});
$($refs.{{ $attributes['wire:model'] }}).on('change', function(e) {
    $wire.set('{{ $attributes['wire:model'] }}', e.target.value);
});
Livewire.on('clearSelect2', () => {
    $($refs.{{ $attributes['wire:model'] }}).val(null).trigger('change');
});">
    @if ($attributes['label'])
        <label :for="selectinput" class="form-label">{{ $attributes['label'] }}</label>
    @endif
    <select x-ref="{{ $attributes['wire:model'] }}" :id="selectinput" class="form-select w-100" style="width: 100%">
        <option value="">Pilih {{ $attributes['label'] }}</option>
        @foreach ($attributes['data'] as $dat)
            <option value="{{ $dat->{$attributes['dataKey']} }}"
                {{ $attributes['selected'] == $dat->{$attributes['dataKey']} ? 'selected' : '' }}>
                {{ $attributes['dataLabel'] ? $dat->{$attributes['dataLabel']} : ucwords(strtolower($dat->name)) }}
            </option>
        @endforeach
    </select>
</div>
