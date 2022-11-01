<button {{ $attributes->merge(['class' => 'addBtn inline-flex items-center px-4 py-2 bg-red-700 border border-transparent rounded-md font-semibold clearfix text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-500 focus:outline-none focus:border-red-900 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
