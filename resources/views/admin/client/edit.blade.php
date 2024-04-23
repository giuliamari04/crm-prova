@extends('layouts.admin')
@section('content')
@livewire('EditClient', ['id'=>$client->id])
@endsection

