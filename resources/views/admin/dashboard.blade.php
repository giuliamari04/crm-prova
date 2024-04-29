@extends('layouts.admin')

@section('content')
<section>
    <div class="container-fluid px-4">
        <h1 class="mt-4">  {{ __('Dashboard') }}</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>

        <div class="row">
            <div class="col-12 mb-3">
                <div class="card">
                    <div class="card-header">{{ __('User Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif

                        {{ __('You are logged in!') }}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-area me-1"></i>
                        Bar Chart Example
                    </div>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
                    <div class="card-body"><canvas id="myChart" style="width:100%;max-width:600px"></canvas></div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-bar me-1"></i>
                        Area Chart Example
                    </div>
                    <div class="card-body"><canvas id="myAreaChart" style="width:100%;max-width:600px"></canvas></div>
                </div>
            </div>

            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-bar me-1"></i>
                        Area Chart Example
                    </div>
                    <div class="card-body"><canvas id="myPieChart" style="width:100%;max-width:600px"></canvas></div>
                </div>
            </div>
        </div>
    </div>
 </section>
@endsection

