@extends('layouts.admin')
@section('content')
    <section class="container">
        <div class="p-4">
             @livewire('ClientsTable')
        </div>

    </section>
@endsection
