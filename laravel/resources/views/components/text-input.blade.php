@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => ' focus:ring-indigo-500 rounded-md shadow-sm']) }}>
