@php
    use App\Models\Transaction;
@endphp
<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white">
                {{ $businessEntity->legal_name }}
            </h2>
            <div class="flex space-x-3">
                <a href="{{ route('business-entities.edit', $businessEntity->id) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg shadow-md transition-all duration-200 ease-in-out transform hover:scale-105">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                    </svg>
                    Edit Entity
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-gray-50 dark:bg-gray-800 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-6">
                <!-- Left Sidebar: Business Details -->
                <div class="w-full lg:w-1/3">
                    <div class="bg-white dark:bg-gray-900 rounded-xl shadow-lg p-6 border-l-4 border-indigo-500 transition-all duration-200 hover:shadow-xl">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-6">Business Details</h3>
                        <dl class="space-y-4">
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Legal Name</dt>
                                <dd class="text-gray-900 dark:text-gray-200">{{ $businessEntity->legal_name }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Trading Name</dt>
                                <dd class="text-gray-900 dark:text-gray-200">{{ $businessEntity->trading_name ?? 'N/A' }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Entity Type</dt>
                                <dd class="text-gray-900 dark:text-gray-200">{{ $businessEntity->entity_type }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">ABN</dt>
                                <dd class="text-gray-900 dark:text-gray-200">{{ $businessEntity->abn ?? 'N/A' }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">ACN</dt>
                                <dd class="text-gray-900 dark:text-gray-200">{{ $businessEntity->acn ?? 'N/A' }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">TFN</dt>
                                <dd class="text-gray-900 dark:text-gray-200">{{ $businessEntity->tfn ?? 'N/A' }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Corporate Key</dt>
                                <dd class="text-gray-900 dark:text-gray-200">{{ $businessEntity->corporate_key ?? 'N/A' }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Address</dt>
                                <dd class="text-gray-900 dark:text-gray-200">{{ $businessEntity->registered_address }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Email</dt>
                                <dd class="text-gray-900 dark:text-gray-200">{{ $businessEntity->registered_email }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Phone</dt>
                                <dd class="text-gray-900 dark:text-gray-200">{{ $businessEntity->phone_number }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">ASIC Renewal</dt>
                                <dd class="text-gray-900 dark:text-gray-200">{{ $businessEntity->asic_renewal_date ? $businessEntity->asic_renewal_date->format('d/m/Y') : 'N/A' }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Created by</dt>
                                <dd class="text-gray-900 dark:text-gray-200">{{ $businessEntity->user->name ?? 'Unknown' }}</dd>
                            </div>
                        </dl>
                        <a href="{{ route('business-entities.edit', $businessEntity->id) }}" class="mt-6 inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg shadow-md transition-all duration-200 transform hover:scale-105">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg>
                            Edit Details
                        </a>
                    </div>
                </div>

                <!-- Right Content: Tabs and Details -->
                <div class="w-full lg:w-2/3">
                    <div class="bg-white dark:bg-gray-900 rounded-xl shadow-lg p-6">
                        <!-- Action Buttons -->
                        <div class="flex flex-wrap gap-3 mb-6">
                            <a href="{{ route('entity-persons.create', $businessEntity->id) }}" class="inline-flex items-center px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded-lg shadow-md transition-all duration-200 transform hover:scale-105">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                </svg>
                                Add Person
                            </a>
                            <a href="{{ route('business-entities.assets.create', $businessEntity->id) }}" class="inline-flex items-center px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg shadow-md transition-all duration-200 transform hover:scale-105">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Add Asset
                            </a>
                            <button type="button" class="inline-flex items-center px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg shadow-md transition-all duration-200 transform hover:scale-105" id="toggle-note-form">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Add Note
                            </button>
                            <button type="button" class="inline-flex items-center px-4 py-2 bg-purple-500 hover:bg-purple-600 text-white rounded-lg shadow-md transition-all duration-200 transform hover:scale-105" onclick="document.getElementById('upload-form').classList.toggle('hidden')">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                </svg>
                                Upload Document
                            </button>
                            <form id="upload-form" class="hidden mt-4 w-full bg-gray-50 dark:bg-gray-800 p-4 rounded-lg shadow-inner" method="POST" action="{{ route('business-entities.upload-document', $businessEntity->id) }}" enctype="multipart/form-data">
                                @csrf
                                <div class="grid gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Upload Document</label>
                                        <input type="file" name="document" class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                                        @error('document') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Document Type</label>
                                        <select name="document_type" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm" required>
                                            <option value="">Select Document Type</option>
                                            <option value="legal">Legal</option>
                                            <option value="financial">Financial</option>
                                            <option value="other">Other</option>
                                        </select>
                                        @error('document_type') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description (optional)</label>
                                        <textarea name="description" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm" rows="3" placeholder="Enter document description"></textarea>
                                        @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">File Name (optional)</label>
                                        <input type="text" name="file_name" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm" placeholder="Enter custom file name (without extension)">
                                        @error('file_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="flex justify-end">
                                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg shadow-md transition-all duration-200 transform hover:scale-105">
                                            Upload
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Tabs -->
                        <div class="border-b border-gray-200 dark:border-gray-700 mb-6">
                            <nav class="flex flex-wrap gap-2" aria-label="Tabs" id="entity-tabs">
                                <a href="#tab_assets" class="tab-link px-4 py-2 text-sm font-medium text-gray-600 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400 border-b-2 border-transparent hover:border-indigo-500 transition-all duration-200">Assets</a>
                                <a href="#tab_persons" class="tab-link px-4 py-2 text-sm font-medium text-gray-600 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400 border-b-2 border-transparent hover:border-indigo-500 transition-all duration-200">Persons</a>
                                <a href="#tab_bank_accounts" class="tab-link px-4 py-2 text-sm font-medium text-gray-600 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400 border-b-2 border-transparent hover:border-indigo-500 transition-all duration-200">Bank Accounts</a>
                                <a href="#tab_transactions" class="tab-link px-4 py-2 text-sm font-medium text-gray-600 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400 border-b-2 border-transparent hover:border-indigo-500 transition-all duration-200">Transactions</a>
                                <a href="#tab_documents" class="tab-link px-4 py-2 text-sm font-medium text-gray-600 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400 border-b-2 border-transparent hover:border-indigo-500 transition-all duration-200">Documents</a>
                                <a href="#tab_notes" class="tab-link px-4 py-2 text-sm font-medium text-gray-600 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400 border-b-2 border-transparent hover:border-indigo-500 transition-all duration-200">Notes</a>
                                <a href="#tab_reminders" class="tab-link px-4 py-2 text-sm font-medium text-gray-600 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400 border-b-2 border-transparent hover:border-indigo-500 transition-all duration-200">Reminders</a>
                            </nav>
                        </div>

                        <!-- Tab Content -->
                        <div class="tab-content-container">
                            <!-- Assets Tab -->
                            <div id="tab_assets" class="tab-content hidden">
                                <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded-lg">
                                    <div class="flex justify-between items-center mb-4">
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Assets</h3>
                                        <a href="{{ route('business-entities.assets.create', $businessEntity->id) }}#tab_assets" class="inline-flex items-center px-3 py-1 bg-blue-500 hover:bg-blue-600 text-white rounded-lg text-sm shadow-md transition-all duration-200 transform hover:scale-105">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                            </svg>
                                            Add Asset
                                        </a>
                                    </div>
                                    @if (isset($assets) && $assets->isEmpty())
                                        <p class="text-gray-500 dark:text-gray-400 text-center py-4">No assets yet.</p>
                                    @else
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                            @foreach ($assets as $asset)
                                                <div class="bg-white dark:bg-gray-900 p-4 rounded-lg shadow-md hover:shadow-lg transition-all duration-200">
                                                    <a href="{{ route('business-entities.assets.show', [$businessEntity->id, $asset->id]) }}#tab_assets" class="text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300 font-medium">
                                                        {{ $asset->name }}
                                                    </a>
                                                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ $asset->asset_type }}</p>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Persons Tab -->
                            <div id="tab_persons" class="tab-content hidden">
                                <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded-lg">
                                    <div class="flex justify-between items-center mb-4">
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Persons</h3>
                                        <a href="{{ route('entity-persons.create', $businessEntity->id) }}#tab_persons" class="inline-flex items-center px-3 py-1 bg-green-500 hover:bg-green-600 text-white rounded-lg text-sm shadow-md transition-all duration-200 transform hover:scale-105">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                            </svg>
                                            Add Person
                                        </a>
                                    </div>
                                    @if (isset($persons) && $persons->isEmpty())
                                        <p class="text-gray-500 dark:text-gray-400 text-center py-4">No persons yet.</p>
                                    @else
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                            @foreach ($persons as $entityPerson)
                                                <div class="bg-white dark:bg-gray-900 p-4 rounded-lg shadow-md hover:shadow-lg transition-all duration-200">
                                                    <a href="{{ route('entity-persons.show', $entityPerson->id) }}#tab_persons" class="text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300 font-medium">
                                                        @if ($entityPerson->person)
                                                            {{ $entityPerson->person->first_name }} {{ $entityPerson->person->last_name }}
                                                        @elseif ($entityPerson->trusteeEntity)
                                                            {{ $entityPerson->trusteeEntity->legal_name }} (Trustee)
                                                        @endif
                                                    </a>
                                                    <div class="mt-2">
                                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200">
                                                            {{ $entityPerson->role }}
                                                        </span>
                                                    </div>
                                                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">
                                                        Status: {{ $entityPerson->role_status }}
                                                        @if ($entityPerson->asic_due_date)
                                                            <span class="block mt-1">ASIC Due: {{ $entityPerson->asic_due_date->format('d/m/Y') }}</span>
                                                        @endif
                                                    </p>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Bank Accounts Tab -->
                            <div id="tab_bank_accounts" class="tab-content hidden">
                                <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded-lg">
                                    <div class="flex justify-between items-center mb-4">
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Bank Accounts</h3>
                                        <a href="{{ route('business-entities.bank-accounts.create', $businessEntity->id) }}#tab_bank_accounts" class="inline-flex items-center px-3 py-1 bg-blue-500 hover:bg-blue-600 text-white rounded-lg text-sm shadow-md transition-all duration-200 transform hover:scale-105">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                            </svg>
                                            Add Bank Account
                                        </a>
                                    </div>
                                    @if (empty($bankAccounts) || (isset($bankAccounts) && $bankAccounts->isEmpty()))
                                        <p class="text-gray-500 dark:text-gray-400 text-center py-4">No bank accounts yet.</p>
                                    @else
                                        <div class="mb-6">
                                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                                @foreach ($bankAccounts as $bankAccount)
                                                    <div class="bg-white dark:bg-gray-900 p-4 rounded-lg shadow-md hover:shadow-lg transition-all duration-200">
                                                        <a href="{{ route('business-entities.show', $businessEntity->id) }}?bank_account_id={{ $bankAccount->id }}#tab_bank_accounts" class="text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300 font-medium">
                                                            {{ $bankAccount->bank_name }}
                                                            @if($bankAccount->nickname)
                                                                <span class="text-gray-500 dark:text-gray-400">({{ $bankAccount->nickname }})</span>
                                                            @endif
                                                        </a>
                                                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">BSB: {{ $bankAccount->bsb }} | Account: {{ $bankAccount->account_number }}</p>
                                                        <div class="mt-2 flex space-x-2">
                                                            <a href="{{ route('business-entities.bank-accounts.edit', [$businessEntity->id, $bankAccount->id]) }}#tab_bank_accounts" class="text-indigo-500 hover:text-indigo-700 dark:text-indigo-400 dark:hover:text-indigo-300 text-sm">Edit</a>
                                                            <a href="{{ route('business-entities.bank-accounts.upload-statement', [$businessEntity->id, $bankAccount->id]) }}#tab_bank_accounts" class="text-indigo-500 hover:text-indigo-700 dark:text-indigo-400 dark:hover:text-indigo-300 text-sm">Upload Statement</a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                        <div class="w-full">
                                            @php
                                                $selectedBankAccount = request()->has('bank_account_id')
                                                    ? $bankAccounts->firstWhere('id', request()->bank_account_id)
                                                    : $bankAccounts->first();
                                            @endphp
                                            @if ($selectedBankAccount)
                                                <div class="bg-white dark:bg-gray-900 p-4 rounded-lg shadow-md">
                                                    <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-3">Bank Statement Entries</h4>
                                                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">Showing entries for: {{ $selectedBankAccount->bank_name }}</p>
                                                    @if ($selectedBankAccount->bankStatementEntries->isEmpty())
                                                        <p class="text-gray-500 dark:text-gray-400 text-center py-4">No entries found.</p>
                                                    @else
                                                        <div class="overflow-x-auto">
                                                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 bg-white dark:bg-gray-900 rounded-lg">
                                                                <thead class="bg-indigo-50 dark:bg-indigo-900/50">
                                                                    <tr>
                                                                        <th class="px-6 py-3 text-left text-xs font-medium text-indigo-800 dark:text-indigo-200 uppercase tracking-wider">Date</th>
                                                                        <th class="px-6 py-3 text-left text-xs font-medium text-indigo-800 dark:text-indigo-200 uppercase tracking-wider">Amount</th>
                                                                        <th class="px-6 py-3 text-left text-xs font-medium text-indigo-800 dark:text-indigo-200 uppercase tracking-wider">Description</th>
                                                                        <th class="px-6 py-3 text-left text-xs font-medium text-indigo-800 dark:text-indigo-200 uppercase tracking-wider">Transaction Type</th>
                                                                        <th class="px-6 py-3 text-left text-xs font-medium text-indigo-800 dark:text-indigo-200 uppercase tracking-wider">Accounting Purpose</th>
                                                                        <th class="px-6 py-3 text-left text-xs font-medium text-indigo-800 dark:text-indigo-200 uppercase tracking-wider">Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                                                    @foreach ($selectedBankAccount->bankStatementEntries as $entry)
                                                                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800">
                                                                            <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-300">{{ $entry->date->format('d/m/Y') }}</td>
                                                                            <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-300">{{ $entry->amount }}</td>
                                                                            <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-300">{{ $entry->description }}</td>
                                                                            <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-300">
                                                                                {{ $entry->transaction ? Transaction::$transactionTypes[$entry->transaction->transaction_type] ?? 'Unknown' : 'Not Matched' }}
                                                                            </td>
                                                                            <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-300">
                                                                                {{ $entry->transaction ? $entry->transaction->businessEntity->legal_name ?? 'Unallocated' : 'N/A' }}
                                                                            </td>
                                                                            <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-300">
                                                                                @if ($entry->transaction)
                                                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                                                                        Matched
                                                                                    </span>
                                                                                @else
                                                                                    <form action="{{ route('business-entities.bank-accounts.match-transaction', [$businessEntity->id, $selectedBankAccount->id, $entry->id]) }}" method="POST" class="inline-flex items-center">
                                                                                        @csrf
                                                                                        <select name="transaction_id" class="border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm mr-2 focus:ring-indigo-500 focus:border-indigo-500">
                                                                                            <option value="">Select Transaction</option>
                                                                                            @foreach ($unmatchedTransactions[$selectedBankAccount->id] ?? [] as $transaction)
                                                                                                @if ($transaction instanceof \App\Models\Transaction)
                                                                                                    <option value="{{ $transaction->id }}">{{ $transaction->description }} ({{ $transaction->amount }})</option>
                                                                                                @endif
                                                                                            @endforeach
                                                                                        </select>
                                                                                        <button type="submit" class="inline-flex items-center px-2 py-1 bg-indigo-100 hover:bg-indigo-200 text-indigo-700 dark:bg-indigo-900 dark:hover:bg-indigo-800 dark:text-indigo-200 rounded text-xs">
                                                                                            Match
                                                                                        </button>
                                                                                    </form>
                                                                                @endif
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    @endif
                                                </div>
                                            @else
                                                <p class="text-gray-500 dark:text-gray-400 text-center py-4">No bank account selected.</p>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Transactions Tab -->
                            <div id="tab_transactions" class="tab-content hidden">
                                <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded-lg">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Transactions</h3>
                                    @if ($transactions->isEmpty())
                                        <p class="text-gray-500 dark:text-gray-400 text-center py-4">No transactions yet.</p>
                                    @else
                                        <div class="overflow-x-auto">
                                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 bg-white dark:bg-gray-900 rounded-lg">
                                                <thead class="bg-indigo-50 dark:bg-indigo-900/50">
                                                    <tr>
                                                        <th class="px-6 py-3 text-left text-xs font-medium text-indigo-800 dark:text-indigo-200 uppercase tracking-wider">Date</th>
                                                        <th class="px-6 py-3 text-left text-xs font-medium text-indigo-800 dark:text-indigo-200 uppercase tracking-wider">Amount</th>
                                                        <th class="px-6 py-3 text-left text-xs font-medium text-indigo-800 dark:text-indigo-200 uppercase tracking-wider">Description</th>
                                                        <th class="px-6 py-3 text-left text-xs font-medium text-indigo-800 dark:text-indigo-200 uppercase tracking-wider">Type</th>
                                                        <th class="px-6 py-3 text-left text-xs font-medium text-indigo-800 dark:text-indigo-200 uppercase tracking-wider">Status</th>
                                                        <th class="px-6 py-3 text-left text-xs font-medium text-indigo-800 dark:text-indigo-200 uppercase tracking-wider">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                                    @foreach ($transactions as $transaction)
                                                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800">
                                                            <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-300">{{ $transaction->date->format('d/m/Y') }}</td>
                                                            <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-300">{{ $transaction->amount }}</td>
                                                            <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-300">{{ $transaction->description }}</td>
                                                            <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-300">{{ Transaction::$transactionTypes[$transaction->transaction_type] ?? 'Unknown' }}</td>
                                                            <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-300">
                                                                @if ($transaction->bankStatementEntries()->exists())
                                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                                                        Matched
                                                                    </span>
                                                                @else
                                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800 dark:bg-orange-900 dark:text-orange-200">
                                                                        Unmatched
                                                                    </span>
                                                                @endif
                                                            </td>
                                                            <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-300">
                                                                <div class="flex flex-wrap gap-2">
                                                                    <a href="{{ route('business-entities.bank-accounts.transactions.show', [$businessEntity->id, $bankAccounts->first()->id ?? 0, $transaction->id]) }}" class="inline-flex items-center px-2 py-1 bg-indigo-100 hover:bg-indigo-200 text-indigo-700 dark:bg-indigo-900 dark:hover:bg-indigo-800 dark:text-indigo-200 rounded text-xs">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                                        </svg>
                                                                        Edit
                                                                    </a>
                                                                    <a href="{{ route('business-entities.show', [$businessEntity->id, 'transaction_id' => $transaction->id]) }}#tab_transactions" class="inline-flex items-center px-2 py-1 bg-indigo-100 hover:bg-indigo-200 text-indigo-700 dark:bg-indigo-900 dark:hover:bg-indigo-800 dark:text-indigo-200 rounded text-xs">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                                        </svg>
                                                                        View
                                                                    </a>
                                                                    @if (!$transaction->bankStatementEntries()->exists())
                                                                        <form action="{{ route('business-entities.transactions.match', [$businessEntity->id, $transaction->id]) }}" method="POST" class="inline-flex items-center">
                                                                            @csrf
                                                                            <select name="bank_statement_entry_id" class="border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-xs mr-1 focus:ring-indigo-500 focus:border-indigo-500">
                                                                                <option value="">Match to Entry</option>
                                                                                @foreach ($bankAccounts as $bankAccount)
                                                                                    @foreach ($bankAccount->bankStatementEntries()->whereNull('transaction_id')->get() as $entry)
                                                                                        <option value="{{ $entry->id }}">{{ $entry->description }} ({{ $entry->amount }}) - {{ $bankAccount->bank_name }}</option>
                                                                                    @endforeach
                                                                                @endforeach
                                                                            </select>
                                                                            <button type="submit" class="inline-flex items-center px-2 py-1 bg-indigo-100 hover:bg-indigo-200 text-indigo-700 dark:bg-indigo-900 dark:hover:bg-indigo-800 dark:text-indigo-200 rounded text-xs">
                                                                                Match
                                                                            </button>
                                                                        </form>
                                                                    @endif
                                                                    @if ($transaction->receipt_path)
                                                                        <a href="{{ $transaction->receiptUrl }}" target="_blank" class="inline-flex items-center px-2 py-1 bg-indigo-100 hover:bg-indigo-200 text-indigo-700 dark:bg-indigo-900 dark:hover:bg-indigo-800 dark:text-indigo-200 rounded text-xs">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                                            </svg>
                                                                            Receipt
                                                                        </a>
                                                                    @endif
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        @if (request()->has('transaction_id'))
                                            @php $selectedTransaction = $transactions->firstWhere('id', request('transaction_id')); @endphp
                                            @if ($selectedTransaction)
                                                <div class="mt-4 p-4 bg-white dark:bg-gray-900 rounded-lg shadow-md">
                                                    <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-3">Transaction Details</h4>
                                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                                        <div>
                                                            <p class="mb-2"><span class="font-medium text-gray-700 dark:text-gray-300">Date:</span> {{ $selectedTransaction->date->format('d/m/Y') }}</p>
                                                            <p class="mb-2"><span class="font-medium text-gray-700 dark:text-gray-300">Amount:</span> {{ $selectedTransaction->amount }}</p>
                                                            <p class="mb-2"><span class="font-medium text-gray-700 dark:text-gray-300">Description:</span> {{ $selectedTransaction->description }}</p>
                                                            <p class="mb-2"><span class="font-medium text-gray-700 dark:text-gray-300">Type:</span> {{ Transaction::$transactionTypes[$selectedTransaction->transaction_type] ?? 'N/A' }}</p>
                                                        </div>
                                                        <div>
                                                            <p class="mb-2"><span class="font-medium text-gray-700 dark:text-gray-300">GST Amount:</span> {{ $selectedTransaction->gst_amount ?? 'N/A' }}</p>
                                                            <p class="mb-2"><span class="font-medium text-gray-700 dark:text-gray-300">GST Status:</span> {{ $selectedTransaction->gst_status ?? 'N/A' }}</p>
                                                            @if ($selectedTransaction->receipt_path)
                                                                <p class="mb-2">
                                                                    <span class="font-medium text-gray-700 dark:text-gray-300">Receipt:</span>
                                                                    <a href="{{ $transaction->receiptUrl }}" target="_blank" class="text-indigo-500 hover:text-indigo-700 dark:text-indigo-400 dark:hover:text-indigo-300">View Receipt</a>
                                                                </p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endif
                                    @endif
                                </div>
                            </div>

                            <!-- Documents Tab -->
                            <div id="tab_documents" class="tab-content hidden">
                                <div id="document-data" data-entity-id="{{ $businessEntity->id }}" data-entity-name="{{ $businessEntity->legal_name }}" style="display:none;"></div>
                                <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded-lg">
                                    <div id="upload-alerts"></div>
                                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                                        <div class="lg:col-span-1 bg-white dark:bg-gray-900 rounded-lg shadow-md">
                                            <div class="p-4">
                                                <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Uploaded Documents</h4>
                                                <div id="files-container" class="divide-y divide-gray-200 dark:divide-gray-700 max-h-[500px] overflow-y-auto">
                                                    <p class="text-gray-500 dark:text-gray-400 text-center py-4">Loading documents...</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="lg:col-span-2 bg-white dark:bg-gray-900 rounded-lg shadow-md">
                                            <div class="p-4">
                                                <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Document Preview</h4>
                                                <div id="preview-container" class="w-full h-[500px] flex items-center justify-center bg-gray-100 dark:bg-gray-700 rounded-lg">
                                                    <div class="text-center text-gray-500 dark:text-gray-400">
                                                        <svg class="w-12 h-12 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                        </svg>
                                                        <p>Select a document to preview</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Notes Tab -->
                            <div id="tab_notes" class="tab-content hidden">
                                <div class="bg-blue-50 dark:bg-blue-900/20 p-4 rounded-md">
                                    <div class="flex justify-between items-center mb-4">
                                        <h3 class="text-lg font-semibold text-blue-700 dark:text-blue-300">Notes</h3>
                                        <button type="button" class="inline-flex items-center bg-blue-100 hover:bg-blue-200 text-blue-700 dark:bg-blue-900 dark:hover:bg-blue-800 dark:text-blue-200 px-3 py-1 rounded-md text-sm" onclick="document.getElementById('note-form').classList.toggle('hidden')">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                            </svg>
                                            Add Note
                                        </button>
                                    </div>
                                    <form id="note-form" class="hidden mb-4 bg-white dark:bg-gray-800 p-4 rounded-lg shadow" method="POST" action="{{ route('business-entities.notes.store', $businessEntity->id) }}#tab_notes">
                                        @csrf
                                        <div class="mb-4">
                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Note</label>
                                            <textarea name="content" class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white" rows="3" required>{{ old('content') }}</textarea>
                                            @error('content') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="flex justify-end">
                                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-md shadow-sm transition duration-200">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                                Save Note
                                            </button>
                                        </div>
                                    </form>
                                    @if (isset($notes) && $notes->isEmpty())
                                        <p class="text-gray-500 dark:text-gray-400">No notes yet.</p>
                                    @else
                                        <div class="space-y-3">
                                            @foreach ($notes as $note)
                                                <div class="bg-white dark:bg-gray-800 p-4 rounded-md shadow-sm">
                                                    <p class="text-gray-700 dark:text-gray-200">{{ $note->content }}</p>
                                                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">
                                                        Added by {{ $note->user->name ?? 'Unknown' }} on {{ $note->created_at ? $note->created_at->format('d/m/Y H:i') : 'N/A' }}
                                                    </p>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Reminders Tab -->
                            <div id="tab_reminders" class="tab-content hidden">
                                <div class="bg-yellow-50 dark:bg-yellow-900/20 p-4 rounded-md">
                                    <div class="flex justify-between items-center mb-4">
                                        <h3 class="text-lg font-semibold text-yellow-700 dark:text-yellow-300">Reminders</h3>
                                        <button type="button" class="inline-flex items-center bg-yellow-100 hover:bg-yellow-200 text-yellow-700 dark:bg-yellow-900 dark:hover:bg-yellow-800 dark:text-yellow-200 px-3 py-1 rounded-md text-sm" onclick="document.getElementById('reminder-form').classList.toggle('hidden')">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                            </svg>
                                            Add Reminder
                                        </button>
                                    </div>
                                    <form id="reminder-form" class="hidden mb-4 bg-white dark:bg-gray-800 p-4 rounded-lg shadow" method="POST" action="{{ route('reminders.store') }}#tab_reminders">
                                        @csrf
                                        <input type="hidden" name="business_entity_id" value="{{ $businessEntity->id }}">
                                        <div class="mb-4">
                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Reminder</label>
                                            <textarea name="content" class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500 dark:bg-gray-700 dark:text-white" rows="3" required>{{ old('content') }}</textarea>
                                            @error('content') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="mb-4">
                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Due Date</label>
                                            <input type="date" name="next_due_date" class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500 dark:bg-gray-700 dark:text-white" min="{{ now()->format('Y-m-d') }}" value="{{ old('next_due_date') }}" required>
                                            @error('next_due_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="mb-4">
                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Repeat</label>
                                            <select name="repeat_type" id="repeat_type" class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500 dark:bg-gray-700 dark:text-white">
                                                <option value="none">One-off (No repeat)</option>
                                                <option value="monthly">Monthly</option>
                                                <option value="quarterly">Quarterly</option>
                                                <option value="annual">Annual</option>
                                            </select>
                                            @error('repeat_type') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="mb-4" id="repeat_end_date_container" style="display: none;">
                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">End Date (Optional)</label>
                                            <input type="date" name="repeat_end_date" class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500 dark:bg-gray-700 dark:text-white" min="{{ now()->format('Y-m-d') }}" value="{{ old('repeat_end_date') }}">
                                            @error('repeat_end_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="flex justify-end">
                                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-md shadow-sm transition duration-200">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                                Save Reminder
                                            </button>
                                        </div>
                                    </form>
                                    @if ($reminders->isEmpty())
                                        <p class="text-gray-500 dark:text-gray-400">No reminders yet.</p>
                                    @else
                                        <div class="space-y-3">
                                            @foreach ($reminders as $reminder)
                                                <div class="bg-white dark:bg-gray-800 p-4 rounded-md shadow-sm border-l-4 border-yellow-400">
                                                    <p class="text-gray-700 dark:text-gray-200">{{ $reminder->content }}</p>
                                                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">
                                                        Added by {{ $reminder->user->name ?? 'Unknown' }} on {{ $reminder->created_at ? $reminder->created_at->format('d/m/Y H:i') : 'N/A' }}
                                                    </p>
                                                    <div class="mt-2 flex items-center">
                                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                            </svg>
                                                            Due: {{ $reminder->next_due_date ? $reminder->next_due_date->format('d/m/Y') : 'N/A' }}
                                                        </span>
                                                        @if($reminder->repeat_type && $reminder->repeat_type !== 'none')
                                                            <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                                                </svg>
                                                                {{ ucfirst($reminder->repeat_type) }}
                                                            </span>
                                                        @endif
                                                    </div>
                                                    <div class="mt-3 flex space-x-2">
                                                        <form action="{{ route('reminders.complete', $reminder->id) }}#tab_reminders" method="POST" class="inline">
                                                            @csrf
                                                            <button type="submit" class="inline-flex items-center px-2 py-1 bg-green-100 hover:bg-green-200 text-green-700 dark:bg-green-900 dark:hover:bg-green-800 dark:text-green-200 rounded text-xs">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                                </svg>
                                                                Finalize
                                                            </button>
                                                        </form>
                                                        <form action="{{ route('reminders.extend', $reminder->id) }}#tab_reminders" method="POST" class="inline">
                                                            @csrf
                                                            <button type="submit" class="inline-flex items-center px-2 py-1 bg-blue-100 hover:bg-blue-200 text-blue-700 dark:bg-blue-900 dark:hover:bg-blue-800 dark:text-blue-200 rounded text-xs">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                                                </svg>
                                                                Extend
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        @vite('resources/js/documents.js')
        <script>
            // Initialize reminder logic
            function initializeReminderLogic() {
                const repeatTypeSelect = document.getElementById('repeat_type');
                const repeatEndDateContainer = document.getElementById('repeat_end_date_container');

                if (repeatTypeSelect && repeatEndDateContainer) {
                    // Set initial state
                    if (repeatTypeSelect.value !== 'none') {
                        repeatEndDateContainer.style.display = 'block';
                    } else {
                        repeatEndDateContainer.style.display = 'none';
                    }

                    // Add event listener
                    repeatTypeSelect.addEventListener('change', function() {
                        if (this.value !== 'none') {
                            repeatEndDateContainer.style.display = 'block';
                        } else {
                            repeatEndDateContainer.style.display = 'none';
                        }
                    });
                }
            }

            // Tab switching logic
            function initializeTabs() {
                const tabLinks = document.querySelectorAll('.tab-link');
                const tabContents = document.querySelectorAll('.tab-content');
                
                // Function to show a specific tab
                function showTab(tabId) {
                    // Hide all tabs
                    tabContents.forEach(tab => {
                        tab.classList.add('hidden');
                    });
                    
                    // Remove active class from all tab links
                    tabLinks.forEach(link => {
                        link.classList.remove('border-indigo-500', 'text-indigo-600', 'dark:text-indigo-400');
                        link.classList.add('border-transparent');
                    });
                    
                    // Show the selected tab
                    const selectedTab = document.getElementById(tabId);
                    if (selectedTab) {
                        selectedTab.classList.remove('hidden');
                    }
                    
                    // Add active class to the selected tab link
                    const selectedLink = document.querySelector(`a[href="#${tabId}"]`);
                    if (selectedLink) {
                        selectedLink.classList.add('border-indigo-500', 'text-indigo-600', 'dark:text-indigo-400');
                        selectedLink.classList.remove('border-transparent');
                    }
                    
                    // If the reminders tab is shown, initialize the reminder logic
                    if (tabId === 'tab_reminders') {
                        initializeReminderLogic();
                    }
                }
                
                // Add click event listeners to tab links
                tabLinks.forEach(link => {
                    link.addEventListener('click', function(e) {
                        e.preventDefault();
                        const tabId = this.getAttribute('href').substring(1);
                        showTab(tabId);
                    });
                });
                
                // Check if there's a hash in the URL and show that tab
                if (window.location.hash) {
                    const tabId = window.location.hash.substring(1);
                    if (document.getElementById(tabId)) {
                        showTab(tabId);
                    }
                } else {
                    // Show the first tab by default
                    showTab('tab_assets');
                }
            }

            // Call these functions when the page loads
            document.addEventListener('DOMContentLoaded', function() {
                initializeTabs();
                initializeReminderLogic();
            });
        </script>
    @endpush
</x-app-layout>