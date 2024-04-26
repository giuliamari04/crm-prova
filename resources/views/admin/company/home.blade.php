@extends('layouts.admin')
@section('content')
<main class="">
     <section class="container">
        <div class="p-4">
             @livewire('CompanyTable')
        </div>
    </section>
</main>

@endsection
