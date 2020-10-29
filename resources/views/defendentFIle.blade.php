@extends('welcome')

<?php

//    $companies = \App\Company::all();

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
                <option
                    value="{{ route('customer.show', ['id' => $company->id]) }}"
                    {{$company->id == $customer->company_id ? 'selected' : ''}}
                >{{$company->name}}</option>
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
       <hr>
        <br>

        <h4>Defendent query builder using Laravel</h4>
        <div class="row">
            <label>Division</label>
            <select onchange="top.location.href = this.options[this.selectedIndex].value">
                @foreach($divisions as $division)
                    <option
                        value="{{ route('division', ['id' =>$division->id]) }}"
                        {{ $division->id == $city->division_id ? "selected" : "" }}
                    > {{$division->name}} </option>
                @endforeach
            </select>
            <br>
            <label>Cities</label>
            <select onchange="top.location.href = this.options[this.selectedIndex].value">
                <option value="-1">--select--</option>
                @foreach($cities as $city)
                    <option value="{{ route('division.city', ['id' => $city->id, 'division_id'=>$city->division_id]) }}"
                    {{ $city->id == $area->city_id ? "Selected" : "" }}
                    > {{$city->name}} </option>
                @endforeach

            </select>
            <br>
            <label>Area</label>
            <select>
                <option value="-1">--select--</option>
                @foreach($areas as $area)
                    <option value="{{ $area->id }}">{{ $area->name }}</option>
                @endforeach
            </select>
        </div>
        <hr>
    </div>

@endsection

@push('js')
    <script>


    </script>

@endpush
