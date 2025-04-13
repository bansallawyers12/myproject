<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Upload Statement for {{ $bankAccount->bank_name }} ({{ $businessEntity->legal_name }})
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-6 border-t-4 border-indigo-300">
                <form method="POST" action="{{ route('business-entities.bank-accounts.process-statement', [$businessEntity->id, $bankAccount->id]) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Upload CSV File</label>
                        <input type="file" name="csv_file" accept=".csv,.txt" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" required>
                        @error('csv_file')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                        <p class="mt-2 text-sm text-gray-500">Accepted formats: .csv or .txt (max 2MB). With headers: 'date', 'amount', 'description' (optional). Without headers: assume order is date, amount, description.</p>
                    </div>
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Allocate to Business Entity (Optional)</label>
                        <select name="business_entity_id" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">Default ({{ $businessEntity->legal_name }})</option>
                            @foreach (\App\Models\BusinessEntity::all() as $entity)
                                <option value="{{ $entity->id }}">{{ $entity->legal_name }}</option>
                            @endforeach
                        </select>
                        @error('business_entity_id')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                        <p class="mt-2 text-sm text-gray-500">Select an entity if this bank account serves multiple businesses.</p>
                    </div>
                    <div class="flex space-x-4">
                        <button type="submit" class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-md shadow-sm transition duration-200">Upload Statement</button>
                        <a href="{{ route('business-entities.show', $businessEntity->id) }}#tab_bank_accounts" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-md shadow-sm transition duration-200">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>