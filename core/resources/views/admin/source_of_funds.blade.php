@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10">
                <div class="card-body p-0">
                    <div class="table-responsive--md table-responsive">
                        <table class="table--light style--two table">
                            <thead>
                                <tr>
                                    <th>@lang('S.N.')</th>
                                    <th>@lang('Name')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($sourceOfFunds as $sourceOfFund)
                                    <tr>
                                        <td data-label="@lang('S.N.')">{{ $sourceOfFunds->firstItem() + $loop->index }}</td>

                                        <td data-label="@lang('Name')">{{ $sourceOfFund->name }}</td>

                                        <td data-label="@lang('Status')">
                                            <span class="badge badge-pill badge--{{ $sourceOfFund->status == 0 ? 'danger' : 'success' }}">{{ $sourceOfFund->status == 0 ? 'Disabled' : 'Active' }}</span>
                                        </td>

                                        <td data-label="@lang('Action')">
                                            <button class="btn btn-sm btn-outline--primary cuModalBtn ml-1" data-modal_title="@lang('Update Source of Fund')" data data-resource="{{ $sourceOfFund }}" data-has_status="1"><i class="las la-pen"></i> @lang('Edit')</button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="100%" class="text-center">
                                            {{ __($emptyMessage) }}
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
                @if ($sourceOfFunds->hasPages())
                    <div class="card-footer py-4">
                        {{ paginateLinks($sourceOfFunds) }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Save MODAL --}}
    <div id="cuModal" class="modal fade">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Edit Sending Purpose')</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <form action="{{ route('admin.sof.save') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>@lang('Name') </label>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}" required />
                        </div>
                        <div class="status"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn--primary h-45 w-100">@lang('Submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <div class="top--control d-flex justify-content-md-end flex-nowrap" style="gap:23px 10px">
        <form action="" method="GET" class="float-sm-right">
            <div class="input-group">
                <input type="text" name="search" class="form-control text--dark bg-white" placeholder="@lang('Name')" value="{{ request()->search }}">
                <button type="submit" class="input-group-text bg--primary border-0 text-white"><i class="fa fa-search"></i></button>
            </div>
        </form>
        <button type="button" class="btn btn-sm btn-outline--primary cuModalBtn" data-modal_title="@lang('Add New Source of Fund')"><i class="las la-plus"></i>@lang('Add New')</button>
    </div>
@endpush
