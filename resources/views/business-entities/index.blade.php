<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Business Entities') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (isset($reminders) && $reminders->isNotEmpty())
                <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-4" role="alert">
                    <h3 class="font-bold">Reminders</h3>
                    @foreach ($reminders as $reminder)
                        <div class="mt-2">
                            <p>{{ $reminder->content }}</p>
                            <p class="text-sm">
                                For: {{ $reminder->businessEntity->legal_name ?? 'Unknown Entity' }} - 
                                Due: {{ $reminder->reminder_date instanceof \Carbon\Carbon ? $reminder->reminder_date->format('d/m/Y') : ($reminder->reminder_date ?? 'N/A') }} - 
                                Created by: {{ $reminder->user->name ?? 'Unknown' }}
                            </p>
                            <form action="{{ route('notes.finalize', $reminder->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('POST')
                                <button type="submit" class="text-blue-500 underline mr-2">Finalize</button>
                            </form>
                            <form action="{{ route('notes.extend', $reminder->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('POST')
                                <button type="submit" class="text-blue-500 underline">Extend (3 days)</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if ($businessEntities->isEmpty())
                        <p>No business entities yet. <a href="{{ route('business-entities.create') }}" class="text-blue-500">Add one</a>.</p>
                    @else
                        <ul class="list-disc pl-5">
                            @foreach ($businessEntities as $entity)
                                <li>
                                    <a href="{{ route('business-entities.show', $entity->id) }}" class="text-blue-500 hover:underline">
                                        {{ $entity->legal_name }} ({{ $entity->entity_type }}) - {{ $entity->registered_address }}
                                    </a>
                                    <span class="text-sm text-gray-500"> - Created by {{ $entity->user->name ?? 'Unknown' }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
