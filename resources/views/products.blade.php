<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>All Products</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 font-sans">

    <div class="flex">
        <!-- Sidebar -->
        <aside class="min-h-screen w-64 bg-white shadow-lg">
            <div class="border-b border-gray-200 p-6">
                <div class="flex h-fit w-full items-center justify-center text-2xl font-bold text-[#2563EA]">
                    GRAND MORTAR
                </div>
            </div>
            <nav class="mt-6 space-y-2 px-4">
                <a href="/admin" class="flex items-center rounded-md px-4 py-2 text-gray-700 hover:bg-gray-200">
                    <span class="mr-3">📊</span> DASHBOARD
                </a>
                <a href="#" class="flex items-center rounded-md bg-[#003B4A] px-4 py-2 text-white">
                    <span class="mr-3">👜</span> ALL PRODUCTS
                </a>
                <a href="/order-list" class="flex items-center rounded-md px-4 py-2 text-gray-700 hover:bg-gray-200">
                    <span class="mr-3">📝</span> ORDER LIST
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 bg-[#EEF0EA] p-6">
            <!-- Top Bar -->
            <div class="mb-6 flex items-center justify-between">
                <div>
                    <h1 class="text-xl font-semibold text-black">All Products</h1>
                    @session('error')
                        <p>{{ session('error') }}</p>
                    @endsession

                    <p class="text-sm text-gray-600">Home &gt; All Products</p>
                </div>
                <!-- You can open the modal using ID.showModal() method -->
                <button class="btn" onclick="my_modal_3.showModal()">➕ ADD NEW PRODUCT</button>
                <dialog id="my_modal_3" class="modal">
                    <div class="modal-box bg-[#003B4A]">
                        <form method="dialog">
                            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                        </form>
                        <div>
                            <h2 class="my-3 text-3xl font-bold">Add Product</h2>
                            <hr>
                        </div>
                        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <fieldset class="fieldset">
                                <legend class="fieldset-legend">Choose image</legend>
                                <input type="file"
                                    class="file-input w-full bg-white text-black file:bg-white file:text-black"
                                    name="image" />
                                @error('image')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                                <legend class="fieldset-legend">Name</legend>
                                <input type="text" class="input w-full bg-white text-black" placeholder="Name"
                                    name="name" />
                                @error('name')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                                <legend class="fieldset-legend">Description</legend>
                                <textarea class="textarea h-24 w-full bg-white text-black" placeholder="Description"
                                    name="description"></textarea>
                                @error('description')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                                <legend class="fieldset-legend">Price</legend>
                                <input type="number" class="input w-full bg-white text-black" placeholder="Price"
                                    name="price" />
                                @error('price')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                                <legend class="fieldset-legend">Stock</legend>
                                <input type="number" class="input w-full bg-white text-black" placeholder="Stock"
                                    name="stock" />
                                @error('stock')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </fieldset>
                            <button class="btn btn-outline my-5" type="submit">Submit</button>
                        </form>
                    </div>
                </dialog>
            </div>

            <!-- Product Grid -->
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <!-- Product Card -->
                @foreach ($products as $product)
                    <div class="relative rounded-lg bg-white p-4 shadow">
                        <div class="dropdown dropdown-end absolute right-3 top-3">
                            <div tabindex="0" role="button" class="cursor-pointer text-gray-500">⋮</div>
                            <div tabindex="0" class="dropdown-content menu bg-base-100 rounded-box z-[1] w-52 p-2 shadow">
                                <a class="block w-full p-2 text-white hover:bg-gray-700"
                                    onclick="edit_modal_{{ $product->id }}.showModal()">
                                    ✏️ Edit
                                </a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button class="block w-full p-2 text-left text-white hover:bg-gray-700"
                                        onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this product?')) { this.closest('form').submit(); }">
                                        🗑️ Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                        <dialog id="edit_modal_{{ $product->id }}" class="modal">
                            <div class="modal-box bg-[#003B4A]">
                                <form method="dialog">
                                    <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                                </form>
                                <div>
                                    <h2 class="my-3 text-3xl font-bold">Edit Product</h2>
                                    <hr>
                                </div>
                                <form action="{{ route('products.update', $product->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <fieldset class="fieldset">
                                        <legend class="fieldset-legend">Choose image</legend>
                                        <input type="file"
                                            class="file-input w-full bg-white text-black file:bg-white file:text-black"
                                            name="image" va;lue="{{ $product->image }}" />
                                        @error('image')
                                            <span class="text-red-500">{{ $message }}</span>
                                        @enderror
                                        <legend class="fieldset-legend">Name</legend>
                                        <input type="text" class="input w-full bg-white text-black" placeholder="Name"
                                            name="name" value="{{ $product->name }}" />
                                        @error('name')
                                            <span class="text-red-500">{{ $message }}</span>
                                        @enderror
                                        <legend class="fieldset-legend">Description</legend>
                                        <textarea class="textarea h-24 w-full bg-white text-black" placeholder="Description"
                                            name="description">{{ $product->description }}</textarea>
                                        @error('description')
                                            <span class="text-red-500">{{ $message }}</span>
                                        @enderror
                                        <legend class="fieldset-legend">Price</legend>
                                        <input type="number" class="input w-full bg-white text-black" placeholder="Price"
                                            name="price" value="{{ $product->price }}" />
                                        @error('price')
                                            <span class="text-red-500">{{ $message }}</span>
                                        @enderror
                                        <legend class="fieldset-legend">Stock</legend>
                                        <input type="number" class="input w-full bg-white text-black" placeholder="Stock"
                                            name="stock" value="{{ $product->stock }}" />
                                        @error('stock')
                                            <span class="text-red-500">{{ $message }}</span>
                                        @enderror
                                    </fieldset>
                                    <button class="btn btn-outline my-5" type="submit">Submit</button>
                                </form>
                            </div>
                        </dialog>


                        <img src="{{ asset('storage/' . $product->image) }}" alt="Product"
                            class="mx-auto mb-3 h-32 w-full rounded object-cover">
                        <p class="mt-2 text-xl font-medium text-black">{{ $product->name }}</p>
                        <p class="text-sm text-gray-500">{{ $product->description }}</p>
                        <p class="text-sm text-gray-600">Stock: {{ $product->stock }}</p>
                        <p class="mt-2 text-sm font-bold text-black">
                            Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                    </div>
                @endforeach
            </div>
        </main>
    </div>

</body>

</html>