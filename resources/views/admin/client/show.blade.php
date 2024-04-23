@extends('layouts.admin')
@section('content')
@livewire('DetailsClient', ['id' => $client->id])
@endsection

