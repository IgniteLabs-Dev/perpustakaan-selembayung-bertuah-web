@if ($label != '')
    <label for="{{ $inputId }}" class="text-sm text-gray-500">{{ $label }}<span
            class="text-red-500 text-lg">{{ $symbol }}</span></label>
@endif
<input id="{{ $inputId }}" wire:model.{{ $typeWire }}="{{ $wireModel }}" type="{{ $type }}"
    {{ $attribute ?? '' }}
    class="bg-gray-200 w-full border-0 p-2 mt-1 rounded-lg focus:outline-gray-300 read-only:bg-gray-300 read-only:focus:outline-0"
    placeholder="{{ $placeholder }}">

@error($wireModel)
    <div class="text-red-500 text-sm">{{ $message }}</div>
@enderror
