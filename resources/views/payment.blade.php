@extends('layouts.app')

@section('title', "My Payments")


@section('headerbar')
    @parent
@stop

@section('content')

<div class="lead-body">
        <span class="lead-title">MY PAYMENTS</span>
        <div class="lead-table-box">
            <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col">DATE</th>
                    <th scope="col">TOTAL CREDITS</th>
                    <th scope="col">TOTAL AMOUNT</th>
                    <th scope="col">STATUS</th>
                    </tr>
                </thead>
                <tbody class="sport-results">
                    @foreach($payments as $index => $result)
                    <tr>
                    <th>{{$result->created_at}}</th>
                    <td>{{$result->credit}}</td>
                    <td>{{$result->amount}} USD</td>
                    <td>{{$result->status}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@stop