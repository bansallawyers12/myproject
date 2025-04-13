<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Business Entity') }} - {{ $businessEntity->legal_name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('business-entities.update', $businessEntity->id) }}">
                        @csrf
                        @method('PATCH')
                        <div class="mb-4">
                            <label for="legal_name" class="block text-sm font-medium text-gray-700">Legal Name</label>
                            <input type="text" name="legal_name" id="legal_name" value="{{ old('legal_name', $businessEntity->legal_name) }}" class="mt-1 block w-full border-gray-300 rounded-md" required>
                            @error('legal_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-4">
                            <label for="trading_name" class="block text-sm font-medium text-gray-700">Trading Name</label>
                            <input type="text" name="trading_name" id="trading_name" value="{{ old('trading_name', $businessEntity->trading_name) }}" class="mt-1 block w-full border-gray-300 rounded-md">
                        </div>
                        <div class="mb-4">
                            <label for="entity_type" class="block text-sm font-medium text-gray-700">Entity Type</label>
                            <select name="entity_type" id="entity_type" class="mt-1 block w-full border-gray-300 rounded-md" required>
                                <option value="Sole Trader" {{ old('entity_type', $businessEntity->entity_type) == 'Sole Trader' ? 'selected' : '' }}>Sole Trader</option>
                                <option value="Company" {{ old('entity_type', $businessEntity->entity_type) == 'Company' ? 'selected' : '' }}>Company</option>
                                <option value="Trust" {{ old('entity_type', $businessEntity->entity_type) == 'Trust' ? 'selected' : '' }}>Trust</option>
                                <option value="Partnership" {{ old('entity_type', $businessEntity->entity_type) == 'Partnership' ? 'selected' : '' }}>Partnership</option>
                            </select>
                            @error('entity_type') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-4">
                            <label for="abn" class="block text-sm font-medium text-gray-700">ABN</label>
                            <input type="text" name="abn" id="abn" value="{{ old('abn', $businessEntity->abn) }}" class="mt-1 block w-full border-gray-300 rounded-md" maxlength="11">
                        </div>
                        <div class="mb-4">
                            <label for="acn" class="block text-sm font-medium text-gray-700">ACN</label>
                            <input type="text" name="acn" id="acn" value="{{ old('acn', $businessEntity->acn) }}" class="mt-1 block w-full border-gray-300 rounded-md" maxlength="9">
                        </div>
                        <div class="mb-4">
                            <label for="tfn" class="block text-sm font-medium text-gray-700">TFN</label>
                            <input type="text" name="tfn" id="tfn" value="{{ old('tfn', $businessEntity->tfn) }}" class="mt-1 block w-full border-gray-300 rounded-md" maxlength="9">
                        </div>
                        <div class="mb-4">
                            <label for="corporate_key" class="block text-sm font-medium text-gray-700">Corporate Key</label>
                            <input type="text" name="corporate_key" id="corporate_key" value="{{ old('corporate_key', $businessEntity->corporate_key) }}" class="mt-1 block w-full border-gray-300 rounded-md">
                        </div>
                        <div class="mb-4">
                            <label for="registered_address" class="block text-sm font-medium text-gray-700">Registered Address</label>
                            <textarea name="registered_address" id="registered_address" class="mt-1 block w-full border-gray-300 rounded-md" required>{{ old('registered_address', $businessEntity->registered_address) }}</textarea>
                            @error('registered_address') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-4">
                            <label for="registered_email" class="block text-sm font-medium text-gray-700">Registered Email</label>
                            <input type="email" name="registered_email" id="registered_email" value="{{ old('registered_email', $businessEntity->registered_email) }}" class="mt-1 block w-full border-gray-300 rounded-md" required>
                            @error('registered_email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-4">
                            <label for="phone_number" class="block text-sm font-medium text-gray-700">Phone Number</label>
                            <input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number', $businessEntity->phone_number) }}" class="mt-1 block w-full border-gray-300 rounded-md" required maxlength="15">
                            @error('phone_number') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-4">
                            <label for="asic_renewal_date" class="block text-sm font-medium text-gray-700">ASIC Renewal Date</label>
                            <input type="date" name="asic_renewal_date" id="asic_renewal_date" value="{{ old('asic_renewal_date', $businessEntity->asic_renewal_date) }}" class="mt-1 block w-full border-gray-300 rounded-md">
                        </div>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update Business Entity</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>