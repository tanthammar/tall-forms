<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    {{ $title ?? null }}
</h2>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-md sm:rounded-md p-12">
            {{ $slot }}
        </div>
    </div>
</div>
