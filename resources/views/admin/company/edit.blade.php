@extends('layouts.admin')
@section('content')
@livewire('EditCompany', ['id'=>$company->id])
@endsection

