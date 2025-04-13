@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Entity-Person Relationships
                    <a href="{{ route('entity-persons.create') }}" class="btn btn-primary float-end">Add New Relationship</a>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Business Entity</th>
                                <th>Person/Trustee</th>
                                <th>Role</th>
                                <th>Appointment Date</th>
                                <th>ASIC Due Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($entityPersons as $entityPerson)
                                <tr>
                                    <td>{{ $entityPerson->businessEntity->legal_name }}</td>
                                    <td>
                                        @if ($entityPerson->person)
                                            {{ $entityPerson->person->first_name }} {{ $entityPerson->person->last_name }}
                                        @elseif ($entityPerson->trusteeEntity)
                                            {{ $entityPerson->trusteeEntity->legal_name }} (Trustee)
                                        @endif
                                    </td>
                                    <td>{{ $entityPerson->role }}</td>
                                    <td>{{ $entityPerson->appointment_date->format('d/m/Y') }}</td>
                                    <td>
                                        @if ($entityPerson->asic_due_date)
                                            {{ $entityPerson->asic_due_date->format('d/m/Y') }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('entity-persons.show', $entityPerson->id) }}" class="btn btn-info btn-sm">View</a>
                                        <a href="{{ route('entity-persons.edit', $entityPerson->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('entity-persons.destroy', $entityPerson->id) }}" method="POST" style="display:inline;"
                                            onsubmit="return confirm('Are you sure you want to delete this relationship?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                        @if ($entityPerson->asic_due_date)
                                            <form action="{{ route('entity-persons.finalize-due-date', $entityPerson) }}" method="POST" style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm">Finalize</button>
                                            </form>
                                            <form action="{{ route('entity-persons.extend-due-date', $entityPerson) }}" method="POST" style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-warning btn-sm">Extend</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection