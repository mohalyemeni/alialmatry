@extends('layouts.admin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <div class="card-naving">
                <h3 class="font-weight-bold text-primary">
                    <i class="fa fa-user-shield"></i>
                    {{ __('panel.manage_supervisors') }}
                </h3>
                <ul class="breadcrumb pt-3">
                    <li><a href="{{ route('admin.index') }}">{{ __('panel.home') }}</a> \</li>
                    <li class="ms-1">{{ __('panel.supervisors_list') }}</li>
                </ul>
            </div>
            <div class="ml-auto">
                @ability('admin', 'create_supervisors')
                    <a href="{{ route('admin.supervisors.create') }}" class="btn btn-primary">
                        <span class="icon text-white-50 d-none d-sm-inline-block">
                            <i class="fa fa-plus-square"></i>
                        </span>
                        <span class="text">{{ __('panel.add_new_supervisor') }}</span>
                    </a>
                @endability
            </div>
        </div>


        @include('backend.supervisors.filter.filter')

        <div class="card-body">
            <table class="table table-striped table-bordered dt-responsive nowrap" style="width: 100%;">
                <thead>
                    <tr>
                        <th class="wd-10p border-bottom-0">#</th>
                        <th class="wd-10p border-bottom-0">{{ __('panel.image') }}</th>
                        <th class="wd-20p border-bottom-0">{{ __('panel.name') }}</th>
                        <th class="wd-25p border-bottom-0">{{ __('panel.email_mobile') }}</th>
                        <th class="wd-10p border-bottom-0">{{ __('panel.status') }}</th>
                        <th class="wd-10p border-bottom-0 d-none d-sm-table-cell">{{ __('panel.created_at') }}</th>
                        <th class="text-center border-bottom-0" style="width: 120px;">{{ __('panel.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($supervisors as $supervisor)
                        <tr>
                            <td class="text-center">
                                <input type="checkbox" name="checkfilter" value="{{ $supervisor->id }}">
                            </td>
                            <td>
                                @if ($supervisor->user_image)
                                    <img src="{{ asset('assets/users/' . $supervisor->user_image) }}"
                                        alt="{{ $supervisor->full_name }}" class="img-thumbnail" style="max-width: 60px;">
                                @else
                                    <img src="{{ asset('assets/users/avatar.svg') }}" alt="Avatar" class="img-thumbnail"
                                        style="max-width: 60px;">
                                @endif
                            </td>
                            <td>{{ $supervisor->full_name }}<br><small>{{ $supervisor->username }}</small></td>
                            <td>{{ $supervisor->email }}<br>{{ $supervisor->mobile }}</td>
                            <td class="text-center">
                                <a href="javascript:void(0);" class="updateSupervisorStatus"
                                    id="supervisor-{{ $supervisor->id }}" supervisor_id="{{ $supervisor->id }}">
                                    @if ($supervisor->status)
                                        <i class="fas fa-toggle-on fa-lg text-success"></i>
                                    @else
                                        <i class="fas fa-toggle-off fa-lg text-warning"></i>
                                    @endif
                                </a>
                            </td>
                            <td class="d-none d-sm-table-cell">{{ $supervisor->created_at?->diffForHumans() ?? '-' }}</td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm">
                                    <div class="dropdown mb-2">
                                        <a class="d-flex align-items-center" href="#"
                                            id="dropdownMenuButton{{ $supervisor->id }}" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false" style="cursor:pointer;">
                                            <i data-feather="more-vertical" class="icon-sm text-muted"></i>
                                            {{ __('panel.operation_options') }}
                                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                                viewBox="0 0 25 15" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-chevron-down link-arrow ms-1">
                                                <polyline points="6 9 12 15 18 9"></polyline>
                                            </svg>
                                        </a>
                                        <div class="dropdown-menu"
                                            aria-labelledby="dropdownMenuButton{{ $supervisor->id }}">
                                            <a class="dropdown-item d-flex align-items-center"
                                                href="{{ route('admin.supervisors.edit', $supervisor->id) }}">
                                                <i data-feather="edit-2" class="icon-sm me-2"></i> {{ __('panel.edit') }}
                                            </a>
                                            <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center"
                                                onclick="confirmDelete('delete-supervisor-{{ $supervisor->id }}', '{{ __('panel.confirm_delete') }}')">
                                                <i data-feather="trash" class="icon-sm me-2"></i> {{ __('panel.delete') }}
                                            </a>
                                            <form id="delete-supervisor-{{ $supervisor->id }}"
                                                action="{{ route('admin.supervisors.destroy', $supervisor->id) }}"
                                                method="POST" class="d-none">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">{{ __('panel.no_supervisors_found') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-3">
                {{ $supervisors->links() }}
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.updateSupervisorStatus', function() {
                var el = $(this);
                var supervisor_id = el.attr('supervisor_id');

                $.ajax({
                    type: 'POST',
                    url: '{{ route('admin.supervisors.toggleStatus') }}',
                    data: {
                        _token: '{{ csrf_token() }}',
                        supervisor_id: supervisor_id
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            if (response.new_status) {
                                el.html('<i class="fas fa-toggle-on fa-lg text-success"></i>');
                            } else {
                                el.html('<i class="fas fa-toggle-off fa-lg text-warning"></i>');
                            }
                        } else {
                            alert('حدث خطأ: ' + (response.message || 'خطأ غير معروف'));
                        }
                    },
                    error: function() {
                        alert('حدث خطأ أثناء تغيير الحالة');
                    }
                });
            });
        });

        function confirmDelete(formId, message) {
            if (confirm(message)) {
                document.getElementById(formId).submit();
            }
        }
    </script>
@endsection
