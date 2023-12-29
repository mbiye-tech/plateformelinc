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
                                @forelse ($sendingPurposes as $sendingPurpose)
                                    <tr>
                                        <td data-label="@lang('S.N.')">{{ $sendingPurposes->firstItem() + $loop->index }}</td>
                                        <td data-label="@lang('Name')">{{ $sendingPurpose->name }}</td>
                                        <td data-label="@lang('Status')">
                                            <span class="badge badge-pill badge--{{ $sendingPurpose->status == 0 ? 'danger' : 'success' }}">{{ $sendingPurpose->status == 0 ? 'Disabled' : 'Active' }}</span>
                                        </td>
                                        <td data-label="@lang('Action')">
                                            <button class="btn btn-sm btn-outline--primary cuModalBtn ml-1" data-modal_title="@lang('Update Sending Purpose')" data data-resource="{{ $sendingPurpose }}" data-has_status="1"><i class="las la-pen"></i>
                                                @lang('Edit')</button>
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
                @if ($sendingPurposes->hasPages())
                    <div class="card-footer py-4">
                        {{ paginateLinks($sendingPurposes) }}
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
                    <h5 class="modal-title">@lang('Edit Sending Purposes')</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <form action="{{ route('admin.sending.purpose.save') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>@lang('Name') </label>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}" required />
                        </div>
                        <div class="status"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn--primary w-100 h-45">@lang('Submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('breadcrumb-plugins')
    <div class="top--control d-flex justify-content-md-end flex-nowrap" style="gap:23px 10px">
        <form action="" method="GET" class="float-sm-right">
            <div class="input-group bg-white">
                <input type="text" name="search" class="form-control bg--white text--dark" placeholder="@lang('Name')" value="{{ request()->search ?? '' }}">
                <button type="submit" class="input-group-text bg--primary border-0 text-white"><i class="fa fa-search"></i></button>
            </div>
        </form>
        <button type="button" class="btn btn-sm btn-outline--primary cuModalBtn" data-modal_title="@lang('Add New Sending Purpose')"><i class="las la-plus"></i>@lang('Add New')</button>
    </div>
@endpush
