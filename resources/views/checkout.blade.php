@extends('layouts.app')

@section('content')
    <form method="post" action="{{ route('basket.checkout') }}">
        @csrf
        <div class="row d-flex flex-row">
            <div class="col-8">
                <div class="card">
                    <div class="card-header">
                        User Info
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tbody>
                            <tr>
                                <th>Receiver:</th>
                                <td>{{ auth()->user()->name }}</td>
                            </tr>
                            <tr>
                                <th>Address:</th>
                                <td>{{ auth()->user()->address }}</td>
                            </tr>
                            <tr>
                                <th>Phone:</th>
                                <td>{{ auth()->user()->phone_number }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card mt-5">
                    <div class="card-header">
                        Payment Method
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tbody>
                            <tr>
                                <td>
                                    <div class="row d-flex flex-row justify-content-between align-items-center">
                                        <div class="col-4 custom-control custom-radio">
                                            <input type="radio" id="online" value="online" name="method"
                                                   class="custom-control-input">
                                            <label class="custom-control-label" for="online">Online Pay</label>
                                        </div>
                                        <div class="col-7">
                                            <div class="input-group">
                                                <select class="custom-select" id="gateway" name="gateway"
                                                        aria-label="Payment Gateway">
                                                    <option value="saman">Saman Bank</option>
                                                    <option value="pasargad">Pasargad Bank</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="row d-flex flex-row justify-content-between align-items-center">
                                        <div class="col-4 custom-control custom-radio">
                                            <input type="radio" id="cash" value="Cash" name="method"
                                                   class="custom-control-input">
                                            <label class="custom-control-label" for="cash">Cash Pay</label>
                                        </div>
                                        <p class="col-7 font-italic p-0 m-0">You Can Pay Door To Door</p>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="row d-flex flex-row justify-content-between align-items-center">
                                        <div class="col-4 custom-control custom-radio">
                                            <input type="radio" id="card" value="card" name="method"
                                                   class="custom-control-input">
                                            <label class="custom-control-label" for="card">Card To Card Pay</label>
                                        </div>
                                        <p class="col-7 font-italic p-0 m-0">You Can Pay By ATM</p>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-4">
                @include('summary')
                <input type="submit" class="btn btn-primary btn-block mt-4" value="Pay"/>
                @include('partials.validation-errors')
            </div>
        </div>
    </form>
@endsection
