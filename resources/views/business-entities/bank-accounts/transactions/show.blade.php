@extends('layouts.app')
@section('content')
    <h1>Transaction Details</h1>
    <p><strong>Date:</strong> {{ $transaction->date }}</p>
    <p><strong>Amount:</strong> {{ $transaction->amount }}</p>
    <p><strong>Description:</strong> {{ $transaction->description }}</p>
    <p><strong>Transaction Type:</strong> {{ \App\Models\Transaction::$transactionTypes[$transaction->transaction_type] ?? 'N/A' }}</p>
    <p><strong>GST Amount:</strong> {{ $transaction->gst_amount }}</p>
    <p><strong>GST Status:</strong> {{ $transaction->gst_status }}</p>
    @if ($transaction->receipt_path)
        <p><strong>Receipt:</strong> 
            <a href="{{ \Illuminate\Support\Facades\Storage::disk('dropbox')->temporaryUrl($transaction->receipt_path, now()->addMinutes(30)) }}" target="_blank">View Receipt</a>
        </p>
    @endif
@endsection