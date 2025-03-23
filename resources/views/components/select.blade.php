@if ($label != '')
    <label for="{{ $selectId }}" class="text-sm text-gray-500">{{ $label }}<span
            class="text-red-500 text-lg">{{ $symbol }}</span></label>
@endif
<select id="{{ $selectId }}" wire:model.defer="{{ $wireModel }}"
    class="border-0 py-2.5 bg-gray-200 text-sm w-full px-2 mt-1 rounded-lg focus:outline-gray-300">
    <option selected value="">{{ $placeholder }}</option>
    @foreach ($options as $value => $text)
        <option value="{{ $value }}">{{ $text }}</option>
    @endforeach
</select>

@error($wireModel)
    <div class="text-red-500 text-sm">{{ $message }}</div>
@enderror
