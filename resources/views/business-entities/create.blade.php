<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Create Business Entity') }}
            </h2>
            <a href="{{ route('business-entities.index') }}" class="px-4 py-2 bg-gray-200 rounded-md text-gray-700 hover:bg-gray-300 transition-colors duration-200 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to List
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('business-entities.store') }}">
                        @csrf
                        <div class="bg-blue-50 rounded-lg p-4 mb-6 border-l-4 border-blue-500">
                            <h3 class="text-lg font-medium text-blue-800 mb-2">Business Information</h3>
                            <p class="text-sm text-blue-600">Enter the basic information about your business entity.</p>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="legal_name" class="block text-sm font-medium text-gray-700 mb-1">Legal Name*</label>
                                <input type="text" name="legal_name" id="legal_name" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition" required>
                                @error('legal_name') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                            </div>
                            
                            <div>
                                <label for="trading_name" class="block text-sm font-medium text-gray-700 mb-1">Trading Name</label>
                                <input type="text" name="trading_name" id="trading_name" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition">
                            </div>
                            
                            <div>
                                <label for="entity_type" class="block text-sm font-medium text-gray-700 mb-1">Entity Type*</label>
                                <select name="entity_type" id="entity_type" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition" required>
                                    <option value="" disabled selected>Select entity type</option>
                                    <option value="Sole Trader">Sole Trader</option>
                                    <option value="Company">Company</option>
                                    <option value="Trust">Trust</option>
                                    <option value="Partnership">Partnership</option>
                                </select>
                                @error('entity_type') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                            </div>
                            
                            <div>
                                <label for="registered_email" class="block text-sm font-medium text-gray-700 mb-1">Email Address*</label>
                                <input type="email" name="registered_email" id="registered_email" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition" required>
                                @error('registered_email') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        
                        <div class="mt-8 bg-blue-50 rounded-lg p-4 mb-6 border-l-4 border-blue-500">
                            <h3 class="text-lg font-medium text-blue-800 mb-2">Identifiers & Contact Details</h3>
                            <p class="text-sm text-blue-600">Official business identifiers and contact information.</p>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label for="abn" class="block text-sm font-medium text-gray-700 mb-1">ABN</label>
                                <input type="text" name="abn" id="abn" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition" maxlength="11" placeholder="11 digits">
                            </div>
                            
                            <div>
                                <label for="acn" class="block text-sm font-medium text-gray-700 mb-1">ACN</label>
                                <input type="text" name="acn" id="acn" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition" maxlength="9" placeholder="9 digits">
                            </div>
                            
                            <div>
                                <label for="tfn" class="block text-sm font-medium text-gray-700 mb-1">TFN</label>
                                <input type="text" name="tfn" id="tfn" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition" maxlength="9" placeholder="9 digits">
                            </div>
                            
                            <div>
                                <label for="corporate_key" class="block text-sm font-medium text-gray-700 mb-1">Corporate Key</label>
                                <input type="text" name="corporate_key" id="corporate_key" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition">
                            </div>
                            
                            <div>
                                <label for="phone_number" class="block text-sm font-medium text-gray-700 mb-1">Phone Number*</label>
                                <input type="text" name="phone_number" id="phone_number" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition" required maxlength="15">
                                @error('phone_number') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                            </div>
                            
                            <div>
                                <label for="asic_renewal_date" class="block text-sm font-medium text-gray-700 mb-1">ASIC Renewal Date</label>
                                <input type="date" name="asic_renewal_date" id="asic_renewal_date" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition">
                            </div>
                        </div>
                        
                        <div class="mt-6">
                            <label for="registered_address" class="block text-sm font-medium text-gray-700 mb-1">Registered Address*</label>
                            <textarea name="registered_address" id="registered_address" rows="3" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition" required></textarea>
                            @error('registered_address') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        
                        <div class="mt-8 flex items-center justify-end">
                            <span class="text-sm text-gray-500 mr-4">* Required fields</span>
                            <button type="submit" class="inline-flex items-center px-6 py-3 bg-blue-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-lg transform transition hover:-translate-y-0.5 duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Save Business Entity
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>