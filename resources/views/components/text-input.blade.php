@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-deep_peach-400 focus:ring-indigo-500 dark:focus:ring-deep_peach-500 rounded-md shadow-sm']) !!}>
