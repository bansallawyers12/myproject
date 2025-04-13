<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Business Entity') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('business-entities.store') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="legal_name" class="block text-sm font-medium text-gray-700">Legal Name</label>
                            <input type="text" name="legal_name" id="legal_name" class="mt-1 block w-full border-gray-300 rounded-md" required>
                            @error('legal_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-4">
                            <label for="trading_name" class="block text-sm font-medium text-gray-700">Trading Name</label>
                            <input type="text" name="trading_name" id="trading_name" class="mt-1 block w-full border-gray-300 rounded-md">
                        </div>
                        <div class="mb-4">
                            <label for="entity_type" class="block text-sm font-medium text-gray-700">Entity Type</label>
                            <select name="entity_type" id="entity_type" class="mt-1 block w-full border-gray-300 rounded-md" required>
                                <option value="Sole Trader">Sole Trader</option>
                                <option value="Company">Company</option>
                                <option value="Trust">Trust</option>
                                <option value="Partnership">Partnership</option>
                            </select>
                            @error('entity_type') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-4">
                            <label for="abn" class="block text-sm font-medium text-gray-700">ABN</label>
                            <input type="text" name="abn" id="abn" class="mt-1 block w-full border-gray-300 rounded-md" maxlength="11">
                        </div>
                        <div class="mb-4">
                            <label for="acn" class="block text-sm font-medium text-gray-700">ACN</label>
                            <input type="text" name="acn" id="acn" class="mt-1 block w-full border-gray-300 rounded-md" maxlength="9">
                        </div>
                        <div class="mb-4">
                            <label for="tfn" class="block text-sm font-medium text-gray-700">TFN</label>
                            <input type="text" name="tfn" id="tfn" class="mt-1 block w-full border-gray-300 rounded-md" maxlength="9">
                        </div>
                        <div class="mb-4">
                            <label for="corporate_key" class="block text-sm font-medium text-gray-700">Corporate Key</label>
                            <input type="text" name="corporate_key" id="corporate_key" class="mt-1 block w-full border-gray-300 rounded-md">
                        </div>
                        <div class="mb-4">
                            <label for="registered_address" class="block text-sm font-medium text-gray-700">Registered Address</label>
                            <textarea name="registered_address" id="registered_address" class="mt-1 block w-full border-gray-300 rounded-md" required></textarea>
                            @error('registered_address') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-4">
                            <label for="registered_email" class="block text-sm font-medium text-gray-700">Registered Email</label>
                            <input type="email" name="registered_email" id="registered_email" class="mt-1 block w-full border-gray-300 rounded-md" required>
                            @error('registered_email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-4">
                            <label for="phone_number" class="block text-sm font-medium text-gray-700">Phone Number</label>
                            <input type="text" name="phone_number" id="phone_number" class="mt-1 block w-full border-gray-300 rounded-md" required maxlength="15">
                            @error('phone_number') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-4">
                            <label for="asic_renewal_date" class="block text-sm font-medium text-gray-700">ASIC Renewal Date</label>
                            <input type="date" name="asic_renewal_date" id="asic_renewal_date" class="mt-1 block w-full border-gray-300 rounded-md">
                        </div>
                        <!-- Enhanced Save Button -->
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded shadow-md transition duration-200">
                            Save Business Entity
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>