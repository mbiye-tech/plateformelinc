@extends($activeTemplate . 'layouts.master')

@section('content')
    <div class="section section--sm">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card custom--card">
                        <div class="card-header">
                            <h5 class="card-title">
                                {{ __($pageTitle) }}
                            </h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('user.kyc.submit') }}" method="post" enctype="multipart/form-data">
                                @csrf

                                <x-viser-form identifier="act" identifierValue="kyc"></x-viser-form>
                                <button type="submit" class="btn btn--primary btn--xl  w-100">@lang('Submit')</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
