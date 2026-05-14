<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-foreground leading-tight">Crear Producto</h2>
    </x-slot>

    <div class="bg-white rounded-xl shadow-sm border border-divider p-6 max-w-lg">
        <form action="{{ route('products.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-foreground/80 mb-1">Nombre</label>
                <input type="text" name="name" value="{{ old('name') }}" required class="w-full border-divider rounded-lg shadow-sm focus:border-primary focus:ring focus:ring-primary/20">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-foreground/80 mb-1">Categoría</label>
                <input type="text" name="category" value="{{ old('category') }}" required class="w-full border-divider rounded-lg shadow-sm focus:border-primary focus:ring focus:ring-primary/20">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-foreground/80 mb-1">Precio</label>
                <input type="number" step="0.01" min="0" name="price" value="{{ old('price') }}" required class="w-full border-divider rounded-lg shadow-sm focus:border-primary focus:ring focus:ring-primary/20">
            </div>
            <div class="flex gap-3">
                <button type="submit" class="bg-primary hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">Guardar</button>
                <a href="{{ route('products.index') }}" class="bg-white border border-divider hover:bg-surface text-foreground/80 px-4 py-2 rounded-lg text-sm font-medium transition-colors">Cancelar</a>
            </div>
        </form>
    </div>
</x-app-layout>
