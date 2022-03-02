<button {{ $attributes->merge(['type' => 'submit', 'class' => 'px-4 py-3 bg-yellow border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-light active:bg-yellow-dark focus:outline-none focus:border-yellow focus:ring ring-yellow focus:ring-opacity-60 disabled:opacity-25 transition ease-in-out duration-150', 'style' => 'box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.3);',], ) }}>
    {{ $slot }}
</button>
