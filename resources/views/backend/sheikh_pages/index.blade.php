@extends('layouts.admin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <div class="card-naving">
                <h3 class="font-weight-bold text-primary">
                    <i class="fa fa-book"></i>
                    {{ __('panel.manage_sheikh_pages') }}
                </h3>
                <ul class="breadcrumb pt-3">
                    <li><a href="{{ route('admin.index') }}">{{ __('panel.main') }}</a> \</li>
                    <li class="ms-1">{{ __('panel.show_sheikh_pages') }}</li>
                </ul>
            </div>
            <div class="ml-auto">
                @ability('admin', 'create_sheikh_page')
                    <a href="{{ route('admin.sheikh_pages.create') }}" class="btn btn-primary">
                        <span class="icon text-white-50 d-none d-sm-inline-block">
                            <i class="fa fa-plus-square"></i>
                        </span>
                        <span class="text">{{ __('panel.add_new_content') }}</span>
                    </a>
                @endability
            </div>
        </div>


        @include('backend.sheikh_pages.filter.filter')

        <div class="card-body">
            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                style="width: 100%;">
                <thead>
                    <tr>
                        <th class="wd-5p border-bottom-0">#</th>
                        <th class="wd-50p border-bottom-0">{{ __('panel.title') }}</th>
                        <th class="wd-10p border-bottom-0 d-none d-sm-table-cell">{{ __('panel.status') }}</th>
                        <th class="wd-15p border-bottom-0 d-none d-sm-table-cell">{{ __('panel.published_on') }}</th>
                        <th class="text-center border-bottom-0" style="width: 120px;">{{ __('panel.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pages as $page)
                        <tr>
                            <td class="text-center">
                                <input type="checkbox" name="checkfilter" value="{{ $page->id }}">
                            </td>
                            <td>{{ $page->title }}</td>
                            <td class="d-none d-sm-table-cell">
                                <a href="javascript:void(0);" class="updatePageStatus" id="page-{{ $page->id }}"
                                    page_id="{{ $page->id }}">
                                    @if ($page->status)
                                        <i class="fas fa-toggle-on fa-lg text-success" style="font-size:1.6em;"></i>
                                    @else
                                        <i class="fas fa-toggle-off fa-lg text-warning" style="font-size:1.6em;"></i>
                                    @endif
                                </a>
                            </td>
                            <td class="d-none d-sm-table-cell">
                                {{ $page->published_on?->diffForHumans() ?? '-' }}
                            </td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm">
                                    <div class="dropdown mb-2">
                                        <a class="d-flex align-items-center" href="#"
                                            id="dropdownMenuButton{{ $page->id }}" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false" style="cursor:pointer;">
                                            <i data-feather="more-vertical" class="icon-sm text-muted"></i>
                                            {{ __('panel.operation_options') }}
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $page->id }}">
                                            <a class="dropdown-item d-flex align-items-center"
                                                href="{{ route('admin.sheikh_pages.edit', $page->id) }}">
                                                <i data-feather="edit-2" class="icon-sm me-2"></i>
                                                <span>{{ __('panel.operation_edit') }}</span>
                                            </a>
                                            <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center"
                                                onclick="confirmDelete('delete-page-{{ $page->id }}', '{{ __('panel.confirm_delete_message') }}')">
                                                <i data-feather="trash" class="icon-sm me-2"></i>
                                                <span>{{ __('panel.operation_delete') }}</span>
                                            </a>
                                            <form id="delete-page-{{ $page->id }}"
                                                action="{{ route('admin.sheikh_pages.destroy', $page->id) }}"
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
                            <td colspan="5" class="text-center">{{ __('panel.no_found_item') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-3">
                {{ $pages->links() }}
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.updatePageStatus', function() {
                var el = $(this);
                var page_id = el.attr('page_id');
                $.ajax({
                    type: 'POST',
                    url: '{{ route('admin.sheikh_pages.toggleStatus') }}',
                    data: {
                        _token: '{{ csrf_token() }}',
                        page_id: page_id
                    },
                    success: function(response) {
                        if (response.status) {
                            el.html(
                                '<i class="fas fa-toggle-on fa-lg text-success" style="font-size:1.6em;"></i>'
                            );
                        } else {
                            el.html(
                                '<i class="fas fa-toggle-off fa-lg text-warning" style="font-size:1.6em;"></i>'
                            );
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
                const form = document.getElementById(formId);
                if (form) {
                    form.submit();
                }
            }
        }
    </script>
@endsection
