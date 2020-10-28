@extends('welcome')

<?php

    $companies = \App\Company::all();

?>

@section('body')
 <br>
 <br>
 <br>
    <div class="container">
        <h4>Laravel Defendent Query</h4>
        <div class="row">
            company
            <select type="dropdown-toggle" onchange="top.location.href = this.options[this.selectedIndex].value">
                @foreach($companies as $company)
                <option  value="{{ route('customer.show', ['id' => $company->id]) }}">{{$company->name}}</option>
                @endforeach
            </select>
        </div>
        <br>
        <div class="row">
            Customer
            <select onchange="top.location.href = this.option[this.selectedIndex].value">
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}">{{$customer->name}}</option>
                @endforeach

            </select>
        </div>

    </div>

@endsection

@push('js')
    <script>


    </script>

@endpush
