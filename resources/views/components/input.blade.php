@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'bg-[#058344] text-[#fdb515] rounded-md shadow-sm border-gray-300 focus:border-[#ffc615] focus:ring focus:ring-[#fdb515] focus:ring-opacity-60']) !!}>
