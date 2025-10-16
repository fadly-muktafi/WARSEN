<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <a href="{{ route('waiter.orders.select_table') }}" class="inline-flex items-center justify-center w-10 h-10 mr-4 bg-secondary-200 text-secondary-800 hover:bg-secondary-300 rounded-full transition-colors dark:bg-secondary-800 dark:text-secondary-200 dark:hover:bg-secondary-700">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
            </a>
            <div>
                <h2 class="font-semibold text-2xl text-secondary-800 leading-tight dark:text-secondary-200">
                    {{ __('Order for Table ') }} <span class="text-primary-600 dark:text-primary-500">{{ $table->nomor_meja }}</span>
                </h2>
                <p class="mt-1 text-sm text-secondary-600 dark:text-secondary-400">
                    Add menu items and customer details to create the order.
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form id="order-form" action="{{ route('waiter.orders.store') }}" method="POST">
                @csrf
                <input type="hidden" name="table_id" value="{{ $table->id }}">
                <div class="lg:grid lg:grid-cols-3 lg:gap-8">
                    
                    <!-- Left Column: Menu List -->
                    <div class="lg:col-span-2">
                        <div class="bg-white p-6 sm:p-8 border border-secondary-200 shadow-sm sm:rounded-2xl dark:bg-secondary-800 dark:border-secondary-700">
                            <h3 class="text-xl font-semibold text-secondary-900 mb-6 dark:text-secondary-100">Menu</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                                @foreach ($menus as $menu)
                                    <div id="menu-card-{{ $menu->id }}" class="menu-card border border-secondary-200 rounded-xl overflow-hidden transition-all duration-300 dark:border-secondary-700">
                                        <div class="p-4">
                                            <h4 class="font-bold text-lg text-secondary-800 truncate dark:text-secondary-200">{{ $menu->nama_menu }}</h4>
                                            <p class="text-md font-semibold text-primary-600 dark:text-primary-500">Rp {{ number_format($menu->harga, 0, ',', '.') }}</p>
                                            <div class="mt-4 flex items-center justify-center">
                                                <button type="button" 
                                                        class="quantity-btn decrease-btn w-10 h-10 bg-secondary-200 text-secondary-800 rounded-l-lg hover:bg-secondary-300 transition-colors dark:bg-secondary-700 dark:text-secondary-200 dark:hover:bg-secondary-600"
                                                        data-menu-id="{{ $menu->id }}"
                                                        data-menu-name="{{ $menu->nama_menu }}"
                                                        data-menu-price="{{ $menu->harga }}">
                                                    -
                                                </button>
                                                <input type="number" name="menus[{{ $menu->id }}]" id="menu-quantity-{{ $menu->id }}" class="quantity-input w-16 h-10 text-center border-t border-b border-secondary-200 text-secondary-800 font-semibold dark:bg-secondary-800 dark:border-secondary-700 dark:text-secondary-200" value="0" min="0" readonly>
                                                <button type="button" 
                                                        class="quantity-btn increase-btn w-10 h-10 bg-secondary-200 text-secondary-800 rounded-r-lg hover:bg-secondary-300 transition-colors dark:bg-secondary-700 dark:text-secondary-200 dark:hover:bg-secondary-600"
                                                        data-menu-id="{{ $menu->id }}"
                                                        data-menu-name="{{ $menu->nama_menu }}"
                                                        data-menu-price="{{ $menu->harga }}">
                                                    +
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Right Column: Order Summary -->
                    <div class="lg:col-span-1 mt-8 lg:mt-0">
                        <div class="sticky top-24">
                            <div class="bg-white p-6 sm:p-8 border border-secondary-200 shadow-sm sm:rounded-2xl dark:bg-secondary-800 dark:border-secondary-700">
                                <h3 class="text-xl font-semibold text-secondary-900 dark:text-secondary-100">Order Summary</h3>
                                
                                <div class="mt-6">
                                    <label for="customer_name" class="block text-sm font-medium text-secondary-700 dark:text-secondary-300">Customer Name</label>
                                    <input type="text" name="customer_name" id="customer_name" class="mt-1 block w-full border-secondary-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm dark:bg-secondary-900 dark:border-secondary-600 dark:text-secondary-200 dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                                </div>

                                <div class="mt-4">
                                    <label for="jumlah_pelanggan" class="block text-sm font-medium text-secondary-700 dark:text-secondary-300">Number of Customers</label>
                                    <input type="number" name="jumlah_pelanggan" id="jumlah_pelanggan" class="mt-1 block w-full border-secondary-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm dark:bg-secondary-900 dark:border-secondary-600 dark:text-secondary-200 dark:focus:ring-primary-500 dark:focus:border-primary-500" required min="1" value="1">
                                </div>

                                <div id="order-items" class="mt-6 border-t border-secondary-200 pt-4 space-y-3 dark:border-secondary-700">
                                    <!-- Order items will be injected here by JS -->
                                    <p id="empty-cart-message" class="text-center text-secondary-500 dark:text-secondary-400">No items added yet.</p>
                                </div>

                                <div class="mt-6 border-t border-primary-200 pt-4 dark:border-primary-500/30">
                                    <div class="flex justify-between items-center">
                                        <span class="text-lg font-semibold text-secondary-800 dark:text-secondary-200">Total</span>
                                        <span id="total-amount" class="text-2xl font-bold text-primary-600 dark:text-primary-500">Rp 0</span>
                                    </div>
                                </div>

                                <div class="mt-6">
                                    <button type="submit" id="submit-order-btn" class="w-full text-center px-4 py-3 bg-primary-600 border border-transparent rounded-lg font-semibold text-sm text-white shadow-md hover:bg-primary-700 focus:bg-primary-700 active:bg-primary-800 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition ease-in-out duration-150 disabled:opacity-50 disabled:cursor-not-allowed dark:focus:ring-offset-secondary-800" disabled>
                                        Place Order
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const orderItems = new Map();
            const orderItemsContainer = document.getElementById('order-items');
            const totalAmountEl = document.getElementById('total-amount');
            const emptyCartMessage = document.getElementById('empty-cart-message');
            const submitBtn = document.getElementById('submit-order-btn');

            function formatCurrency(value) {
                return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
            }

            function updateOrderSummary() {
                orderItemsContainer.innerHTML = '';
                let totalAmount = 0;

                if (orderItems.size === 0) {
                    orderItemsContainer.appendChild(emptyCartMessage);
                } else {
                    orderItems.forEach((item, menuId) => {
                        const itemEl = document.createElement('div');
                        itemEl.className = 'flex justify-between items-center text-sm';
                        itemEl.innerHTML = `
                            <div>
                                <p class="font-semibold text-secondary-800 dark:text-secondary-200">${item.name}</p>
                                <p class="text-secondary-500 dark:text-secondary-400">Qty: ${item.quantity}</p>
                            </div>
                            <p class="font-semibold text-secondary-700 dark:text-secondary-300">${formatCurrency(item.price * item.quantity)}</p>
                        `;
                        orderItemsContainer.appendChild(itemEl);
                        totalAmount += item.price * item.quantity;
                    });
                }

                totalAmountEl.textContent = formatCurrency(totalAmount);
                
                // Enable/disable submit button
                if (orderItems.size > 0) {
                    submitBtn.disabled = false;
                } else {
                    submitBtn.disabled = true;
                }
            }

            document.querySelectorAll('.quantity-btn').forEach(button => {
                button.addEventListener('click', () => {
                    const menuId = button.dataset.menuId;
                    const menuName = button.dataset.menuName;
                    const menuPrice = parseFloat(button.dataset.menuPrice);
                    const input = document.getElementById(`menu-quantity-${menuId}`);
                    const menuCard = document.getElementById(`menu-card-${menuId}`);
                    let currentValue = parseInt(input.value);

                    if (button.classList.contains('increase-btn')) {
                        currentValue++;
                    } else if (button.classList.contains('decrease-btn') && currentValue > 0) {
                        currentValue--;
                    }

                    input.value = currentValue;

                    if (currentValue > 0) {
                        orderItems.set(menuId, { name: menuName, price: menuPrice, quantity: currentValue });
                        menuCard.classList.add('border-primary-500', 'bg-primary-50', 'dark:bg-primary-900/20', 'dark:border-primary-500');
                    } else {
                        orderItems.delete(menuId);
                        menuCard.classList.remove('border-primary-500', 'bg-primary-50', 'dark:bg-primary-900/20', 'dark:border-primary-500');
                    }
                    
                    updateOrderSummary();
                });
            });
            
            // Also update when directly changing the input field
            document.querySelectorAll('.quantity-input').forEach(input => {
                input.addEventListener('change', function() {
                    const menuId = this.id.replace('menu-quantity-', '');
                    const menuCard = document.getElementById(`menu-card-${menuId}`);
                    const quantity = parseInt(this.value) || 0;
                    
                    if (quantity > 0) {
                        // Find the menu details from the buttons
                        const increaseBtn = document.querySelector(`.increase-btn[data-menu-id="${menuId}"]`);
                        const menuName = increaseBtn.dataset.menuName;
                        const menuPrice = parseFloat(increaseBtn.dataset.menuPrice);
                        
                        orderItems.set(menuId, { name: menuName, price: menuPrice, quantity: quantity });
                        menuCard.classList.add('border-primary-500', 'bg-primary-50', 'dark:bg-primary-900/20', 'dark:border-primary-500');
                    } else {
                        orderItems.delete(menuId);
                        menuCard.classList.remove('border-primary-500', 'bg-primary-500', 'dark:bg-primary-900/20', 'dark:border-primary-500');
                    }
                    
                    updateOrderSummary();
                });
            });
        });
    </script>
    @endpush
</x-app-layout>