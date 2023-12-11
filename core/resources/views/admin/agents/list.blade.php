@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--md  table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th>@lang('Agent')</th>
                                    <th>@lang('Email-Phone')</th>
                                    <th>@lang('Country')</th>
                                    <th>@lang('Joined At')</th>
                                    <th>@lang('Balance')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($agents as $agent)
                                    <tr>
                                        <td data-label="@lang('Agent')">
                                            <span class="fw-bold">{{ $agent->fullname }}</span>
                                            <br>
                                            <span class="small">
                                                <a href="{{ route('admin.agents.detail', $agent->id) }}"><span>@</span>{{ $agent->username }}</a>
                                            </span>
                                        </td>


                                        <td data-label="@lang('Email-Phone')">
                                            {{ $agent->email }}<br>{{ $agent->mobile }}
                                        </td>
                                        <td data-label="@lang('Country')">
                                            <span class="fw-bold" title="{{ @$agent->address->country }}">{{ $agent->country_code }}</span>
                                        </td>



                                        <td data-label="@lang('Joined At')">
                                            {{ showDateTime($agent->created_at) }} <br> {{ diffForHumans($agent->created_at) }}
                                        </td>


                                        <td data-label="@lang('Balance')">
                                            <span class="fw-bold">

                                                {{ $general->cur_sym }}{{ showAmount($agent->balance) }}
                                            </span>
                                        </td>

                                        <td data-label="@lang('Action')">
                                            <a href="{{ route('admin.agents.detail', $agent->id) }}" class="btn btn-sm btn-outline--primary">
                                                <i class="las la-desktop text--shadow"></i> @lang('Details')
                                            </a>
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
                @if ($agents->hasPages())
                    <div class="card-footer py-4">
                        {{ paginateLinks($agents) }}
                    </div>
                @endif
            </div>
        </div>


    </div>
@endsection

@push('breadcrumb-plugins')
    <div class="d-flex flex-wrap justify-content-end">
        <a class="btn btn-outline--primary h-45 me-2 mb-2" href="{{ route('admin.agents.add') }}"><i class="las la-plus"></i>@lang('Add New')</a>
        <form accept="" class="form-inline">
            <div class="input-group justify-content-end">
                <input type="text" name="search" class="form-control bg--white" placeholder="@lang('Search Username')" value="{{ request()->search }}">
                <button class=" btn btn--primary input-group-text"><i class="fa fa-search"></i></button>
            </div>
        </form>
    </div>
@endpush
