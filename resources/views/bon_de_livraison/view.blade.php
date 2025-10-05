@extends('layouts.main')
@section('page-title')
    {{ __('Delivery Note Detail') }}
@endsection
@section('page-breadcrumb')
    {{ __('Delivery Note') }}
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="invoice">
                        <div class="invoice-print">
                            <div class="row invoice-title mt-2">
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-12">
                                    <h2>{{__('Delivery Note')}}</h2>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-12 text-end">
                                    <h3 class="invoice-number">{{ \App\Models\BonDeLivraison::bonDeLivraisonNumberFormat($bonDeLivraison->bon_de_livraison_id) }}</h3>
                                </div>
                                <div class="col-12">
                                    <hr>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col text-end">
                                    <div class="d-flex align-items-center justify-content-end">
                                        <div class="me-4">
                                            <small>
                                                <strong>{{__('Issue Date')}} :</strong><br>
                                                {{ company_date_formate($bonDeLivraison->issue_date)}}<br><br>
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                @if (!empty($customer->billing_name) && !empty($customer->billing_address))
                                    <div class="col">
                                        <small class="font-style">
                                            <strong>{{__('Customer')}} :</strong><br>
                                                {{ !empty($customer->name) ? $customer->name : '' }}<br>
                                                {{ !empty($customer->email) ? $customer->email : '' }}<br>
                                        </small>
                                    </div>
                                @endif
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div class="font-weight-bold">{{__('Item Summary')}}</div>
                                    <div class="table-responsive mt-2">
                                        <table class="table mb-0 table-striped">
                                            <tr>
                                                <th class="text-dark">#</th>
                                                <th class="text-dark">{{__('Item')}}</th>
                                                <th class="text-dark">{{__('Quantity')}}</th>
                                                <th class="text-dark">{{__('Price')}}</th>
                                                <th class="text-end text-dark">{{__('Total')}}</th>
                                            </tr>
                                            @foreach($iteams as $key =>$iteam)
                                                <tr>
                                                    <td>{{$key+1}}</td>
                                                    <td>{{!empty($iteam->product())?$iteam->product()->name:''}}</td>
                                                    <td>{{$iteam->quantity}}</td>
                                                    <td>{{ currency_format_with_sym($iteam->price)}}</td>
                                                    <td class="text-end">{{ currency_format_with_sym($iteam->price * $iteam->quantity)}}</td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
