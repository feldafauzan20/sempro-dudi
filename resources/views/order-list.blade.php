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
                <div class="flex h-fit w-full items-center justify-center text-[#2563EA] text-2xl font-bold">
                    GRAND MORTAR
                </div>
            </div>
            <nav class="mt-6 space-y-2 px-4">
                <a href="/admin" class="flex items-center rounded-md px-4 py-2 text-gray-700 hover:bg-gray-200">
                    <span class="mr-3">📊</span> DASHBOARD
                </a>
                <a href="/products" class="flex items-center rounded-md px-4 py-2 text-gray-700 hover:bg-gray-200">
                    <span class="mr-3">📝</span> ALL PRODUCT
                </a>
                <a href="#" class="flex items-center rounded-md bg-[#003B4A] px-4 py-2 text-white">
                    <span class="mr-3">👜</span> ORDER LIST
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 bg-[#EEF0EA] p-6">
            <!-- Top Bar -->
            <div class="mb-6 flex items-center justify-between">
                <div>
                    <h1 class="text-xl font-semibold text-black">All Products</h1>
                    <p class="text-sm text-gray-600">Home &gt; All Products</p>
                </div>

            </div>

            <div class="overflow-x-auto rounded-md bg-white text-black">
                <table class="table">
                    <!-- head -->
                    <thead>
                        <tr class="text-black">
                            <th>
                                <label>
                                    <input type="checkbox" class="checkbox border-black" />
                                </label>
                            </th>
                            <th>Product</th>
                            <th>Order ID</th>
                            <th>Quantity</th>
                            <th>Date</th>
                            <th>Customer Name</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Status</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <th>
                                    <label>
                                        <input type="checkbox" class="checkbox border-black" />
                                    </label>
                                </th>
                                <td>
                                    <div class="flex items-center gap-3">
                                        <div>
                                            <div class="">{{ $order->product->name }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    {{ $order->id }}
                                    <br />
                                </td>
                                <td>{{ $order->quantity }}</td>
                                <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                                <td>{{ $order->user->name }}</td>
                                <td>081212912182182</td>
                                <td>Depok</td>
                                <td>{{ $order->status }}</td>
                                <td>Rp{{ number_format($order->product->price * $order->quantity, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </main>
    </div>

</body>

</html>
