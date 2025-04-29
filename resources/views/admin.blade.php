<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard</title>
    @vite('resources/css/app.css')

</head>

<body class="bg-gray-100 font-sans">

    <!-- Sidebar -->
    <div class="flex">
        <aside class="min-h-screen w-64 bg-white shadow-lg">
            <div class="border-b border-gray-200 p-6">
                <div class="flex h-fit w-full items-center justify-center text-[#2563EA] text-2xl font-bold">
                    GRAND MORTAR
                </div>
            </div>
            <nav class="mt-6 space-y-2 px-4">
                <a href="#" class="flex items-center rounded-md bg-[#003B4A] px-4 py-2 text-white">
                    <span class="mr-3">📊</span> DASHBOARD
                </a>
                <a href="{{ route('products.index') }}"
                    class="flex items-center rounded-md px-4 py-2 text-gray-700 hover:bg-gray-200">
                    <span class="mr-3">📦</span> ALL PRODUCTS
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
                    <h1 class="text-xl font-semibold text-black">Dashboard</h1>
                    <p class="text-sm text-gray-600">Home &gt; Dashboard</p>
                </div>
                <div class="flex items-center space-x-4">
                    <button class="text-gray-600">🔍</button>
                    <button class="text-gray-600">🔔</button>
                    <div class="dropdown dropdown-end dropdown-hover relative">
                        <button tabindex="0"
                            class="rounded-md bg-white px-3 py-1 text-sm font-medium text-black shadow">ADMIN ⌄</button>
                        <div tabindex="0" class="dropdown-content menu bg-base-100 rounded-box z-[1] w-32 p-2 shadow">
                            <div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="cursor-pointer w-full text-left px-4 py-2 text-sm text-white hover:bg-white/25 rounded-sm">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>


                    </div>

                </div>
            </div>

            <!-- Stats Cards -->
            <div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                <!-- Total Orders -->
                <div class="rounded-lg bg-white p-4 shadow">
                    <div class="flex items-center justify-between">
                        <div class="rounded-full bg-[#003B4A] p-2 text-white">🛒</div>
                        <button>⋮</button>
                    </div>
                    <div class="mt-4 text-gray-700">
                        <p class="text-sm">Total Orders</p>
                        <p class="text-2xl font-semibold">{{ $orders->count() }}</p>
                        <p class="text-sm text-green-500">↑ {{ $orders->count() }}</p>
                        <p class="text-xs">Total Revenue:
                            Rp{{ $orders->sum(fn($order) => $order->quantity * $order->product->price) }}
                        </p>
                    </div>
                </div>

                <!-- Active Orders -->
                <div class="rounded-lg bg-white p-4 shadow">
                    <div class="flex items-center justify-between">
                        <div class="rounded-full bg-[#003B4A] p-2 text-white">🛍️</div>
                        <button>⋮</button>
                    </div>
                    <div class="mt-4 text-gray-700">
                        <p class="text-sm">Active Orders</p>
                        <p class="text-2xl font-semibold">{{ $orders->where('status', 'active')->count() }}</p>
                        <p class="text-sm text-green-500">↑ {{ $orders->where('status', 'active')->count() }}</p>
                        <p class="text-xs">{{ $orders->where('status', 'active')->count() }}</p>
                    </div>
                </div>

                <!-- Completed Orders -->
                <div class="rounded-lg bg-white p-4 shadow">
                    <div class="flex items-center justify-between">
                        <div class="rounded-full bg-[#003B4A] p-2 text-white">✅</div>
                        <button>⋮</button>
                    </div>
                    <div class="mt-4 text-gray-700">
                        <p class="text-sm">Completed Orders</p>
                        <p class="text-2xl font-semibold">{{ $orders->where('status', 'completed')->count() }}</p>
                        <p class="text-sm text-green-500">↑ {{ $orders->where('status', 'completed')->count() }}</p>
                        <p class="text-xs">{{ $orders->where('status', 'completed')->count() }}</p>
                    </div>
                </div>

                {{-- <!-- Return Orders -->
                <div class="rounded-lg bg-white p-4 shadow">
                    <div class="flex items-center justify-between">
                        <div class="rounded-full bg-[#003B4A] p-2 text-white">↩️</div>
                        <button>⋮</button>
                    </div>
                    <div class="mt-4 text-gray-700">
                        <p class="text-sm">Return Orders</p>
                        <p class="text-2xl font-semibold">{{ $orders->where('status', 'return')->count() }}</p>
                        <p class="text-sm text-green-500">↑ {{ $orders->where('status', 'return')->count() }}</p>
                        <p class="text-xs">{{ $orders->where('status', 'return')->count() }}</p>
                    </div>
                </div> --}}
            </div>

            <!-- Sales Graph -->
            <div class="rounded-lg bg-white p-6 shadow">
                <div class="mb-4 flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-black">Sales Graph</h2>
                    <div class="space-x-2">
                        <button
                            class="rounded-md border bg-white px-3 py-1 text-sm text-black hover:bg-gray-100">WEEKLY</button>
                        <button class="rounded-md bg-[#003B4A] px-3 py-1 text-sm text-white">MONTHLY</button>
                        <button
                            class="rounded-md border bg-white px-3 py-1 text-sm text-black hover:bg-gray-100">YEARLY</button>
                    </div>
                </div>
                <div class="h-64 w-full bg-gray-100 p-4">
                    <div class="flex h-full items-end justify-between">
                        <div class="flex w-1/12 flex-col items-center">
                            <div class="h-20 w-8 rounded-t-md bg-[#003B4A]"></div>
                            <span class="mt-2 text-xs text-gray-500">JUL</span>
                        </div>
                        <div class="flex w-1/12 flex-col items-center">
                            <div class="h-28 w-8 rounded-t-md bg-[#003B4A]"></div>
                            <span class="mt-2 text-xs text-gray-500">AUG</span>
                        </div>
                        <div class="flex w-1/12 flex-col items-center">
                            <div class="h-16 w-8 rounded-t-md bg-[#003B4A]"></div>
                            <span class="mt-2 text-xs text-gray-500">SEP</span>
                        </div>
                        <div class="flex w-1/12 flex-col items-center">
                            <div class="h-36 w-8 rounded-t-md bg-[#003B4A]"></div>
                            <span class="mt-2 text-xs text-gray-500">OCT</span>
                        </div>
                        <div class="flex w-1/12 flex-col items-center">
                            <div class="h-32 w-8 rounded-t-md bg-[#003B4A]"></div>
                            <span class="mt-2 text-xs text-gray-500">NOV</span>
                        </div>
                        <div class="flex w-1/12 flex-col items-center">
                            <div class="h-44 w-8 rounded-t-md bg-[#003B4A]"></div>
                            <span class="mt-2 text-xs text-gray-500">DEC</span>
                        </div>
                    </div>
                </div>
                <div class="mt-2 flex justify-between text-sm text-gray-500">
                    <span>0</span><span>20K</span><span>40K</span><span>60K</span><span>80K</span><span>100K</span>
                </div>
            </div>
        </main>
    </div>

</body>

</html>
