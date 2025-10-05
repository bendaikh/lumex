@extends('layouts.main')
@section('page-title')
    {{ __('Manage Delivery Notes') }}
@endsection
@section('page-breadcrumb')
    {{ __('Delivery Notes') }},{{ __('Delivery Note') }}
@endsection
@section('page-action')
    <div>
        <!-- Add actions here if needed -->
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="mt-2" id="multiCollapseExample1">
                <div class="card">
                    <div class="card-body">
                        {{ $dataTable->table(['width' => '100%']) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('css')
    @include('layouts.includes.datatable-css')
@endpush
@push('scripts')
    @include('layouts.includes.datatable-js')
    {{ $dataTable->scripts() }}
@endpush
