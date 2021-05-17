<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150']) }} style="background: #00a9f1; min-width: 105px; display: inline-block;" onmouseover="this.style.opacity=0.9" onmouseout="this.style.opacity=1">
    {{ $slot }}
</button>
