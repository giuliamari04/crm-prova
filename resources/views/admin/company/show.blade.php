@extends('layouts.admin')
@section('content')
@livewire('DetailsCompany', ['id'=> $company->id])
@endsection

