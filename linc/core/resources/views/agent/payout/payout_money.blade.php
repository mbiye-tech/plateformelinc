@extends('agent.layouts.app')

@section('panel')
    <div class="row justify-content-center mt-5">
        <div class="col-xxl-5 col-xl-7 col-md-8 col-sm-10">
            <div class="border--card h-auto">
                <h4 class="title"> <i class="las la-money-check-alt"></i> {{ __($pageTitle) }}</h4>
                <div class="card-body p-0">
                    <form action="{{ route('agent.payout.info') }}" method="get" class="row">
                        <div class="form-group">
                            <label for="trx">@lang('Transaction Number')</label>
                            <input id="trx" type="text" value="{{ old('trx') }}" class="form--control" placeholder="@lang('Enter Transaction / Slip Number')" name="trx">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn--base btn-md w-100">@lang('Submit')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
