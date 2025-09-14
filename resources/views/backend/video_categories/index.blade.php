@extends('layouts.admin')

@section('content')
    <div class="card shadow mb-4">

        <div class="card-header py-3 d-flex justify-content-between">
            <div class="card-naving">
                <h3 class="font-weight-bold text-primary">
                    <i class="fa fa-folder"></i>
                    {{ __('panel.manage_video_categories') }}
                </h3>
                <ul class="breadcrumb pt-3">
                    <li><a href="{{ route('admin.index') }}">{{ __('panel.main') }}</a> \</li>
                    <li class="ms-1">{{ __('panel.show_video_categories') }}</li>
                </ul>
            </div>

            <div class="ml-auto">
                @ability('admin', 'create_categories')
                    <a href="{{ route('admin.video_categories.create') }}" class="btn btn-primary">
                        <span class="icon text-white-50 d-none d-sm-inline-block">
                            <i class="fa fa-plus-square"></i>
                        </span>
                        <span class="text">{{ __('panel.add_new_content') }}</span>
                    </a>
                @endability
            </div>
        </div>

        @include('backend.video_categories.filter.filter')

        <div class="card-body">
            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                style="width: 100%;">
                <thead>
                    <tr>
                        <th class="wd-5p border-bottom-0">#</th>
                        <th class="wd-35p border-bottom-0">{{ __('panel.title') }}</th>
                        <th class="wd-15p border-bottom-0 d-none d-sm-table-cell">{{ __('panel.author') }}</th>
                        <th class="wd-10p border-bottom-0 d-none d-sm-table-cell">{{ __('panel.status') }}</th>
                        <th class="wd-10p border-bottom-0 d-none d-sm-table-cell">{{ __('panel.featured') }}</th>
                        <th class="wd-15p border-bottom-0 d-none d-sm-table-cell">{{ __('panel.published_on') }}</th>
                        <th class="text-center border-bottom-0" style="width: 120px;">{{ __('panel.actions') }}</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($page_categories as $page_category)
                        <tr>
                            <td class="text-center">
                                <input type="checkbox" name="checkfilter" value="{{ $page_category->id }}">
                            </td>

                            <td>{{ $page_category->title }}</td>

                            <td class="d-none d-sm-table-cell">
                                {{ $page_category->creator?->first_name ?? __('panel.unknown') }}
                            </td>

                            <td class="d-none d-sm-table-cell">
                                <a href="javascript:void(0);" class="updatePageCategoryStatus"
                                    id="page-category-{{ $page_category->id }}"
                                    page_category_id="{{ $page_category->id }}">
                                    @if ($page_category->status)
                                        <i class="fas fa-toggle-on fa-lg text-success" style="font-size:1.6em;"></i>
                                    @else
                                        <i class="fas fa-toggle-off fa-lg text-warning" style="font-size:1.6em;"></i>
                                    @endif
                                </a>
                            </td>

                            <td class="d-none d-sm-table-cell text-center">
                                <a href="javascript:void(0);" class="toggleVideoCategoryFeatured"
                                    id="video-category-featured-{{ $page_category->id }}"
                                    page_category_id="{{ $page_category->id }}">
                                    @if ($page_category->featured)
                                        <i class="fas fa-star fa-lg text-warning" style="font-size:1.6em;"></i>
                                    @else
                                        <i class="far fa-star fa-lg text-muted" style="font-size:1.6em;"></i>
                                    @endif
                                </a>
                            </td>

                            <td class="d-none d-sm-table-cell">
                                {{ $page_category->published_on?->diffForHumans() ?? '-' }}
                            </td>

                            <td class="text-center">
                                <div class="btn-group btn-group-sm">
                                    <div class="dropdown mb-2">
                                        <a class="d-flex align-items-center" href="#"
                                            id="dropdownMenuButton{{ $page_category->id }}" data-bs-toggle="dropdown"
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
                                            aria-labelledby="dropdownMenuButton{{ $page_category->id }}">
                                            <a class="dropdown-item d-flex align-items-center"
                                                href="{{ route('admin.video_categories.edit', $page_category->id) }}">
                                                <i data-feather="edit-2" class="icon-sm me-2"></i>
                                                <span>{{ __('panel.operation_edit') }}</span>
                                            </a>

                                            <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center"
                                                onclick="confirmDelete('delete-video-category-{{ $page_category->id }}', '{{ __('panel.confirm_delete_message') }}', '{{ __('panel.yes_delete') }}', '{{ __('panel.cancel') }}')">
                                                <i data-feather="trash" class="icon-sm me-2"></i>
                                                <span>{{ __('panel.operation_delete') }}</span>
                                            </a>

                                            <form id="delete-video-category-{{ $page_category->id }}"
                                                action="{{ route('admin.video_categories.destroy', $page_category->id) }}"
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
                            <td colspan="7" class="text-center">{{ __('panel.no_found_item') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-3">
                {{ $page_categories->links() }}
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.updatePageCategoryStatus', function() {
                var el = $(this);
                var category_id = el.attr('page_category_id');

                $.ajax({
                    type: 'POST',
                    url: '{{ route('admin.video_categories.toggleStatus') }}',
                    data: {
                        _token: '{{ csrf_token() }}',
                        category_id: category_id
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
                    error: function(xhr, status, error) {
                        console.error('toggle status error:', xhr.status, error, xhr
                            .responseText);
                        alert('حدث خطأ أثناء تغيير الحالة');
                    }
                });
            });

            // toggle featured
            $(document).on('click', '.toggleVideoCategoryFeatured', function() {
                var el = $(this);
                var category_id = el.attr('page_category_id');

                $.ajax({
                    type: 'POST',
                    url: '{{ route('admin.video_categories.toggleFeatured') }}',
                    data: {
                        _token: '{{ csrf_token() }}',
                        category_id: category_id
                    },
                    success: function(response) {
                        if (response.featured) {
                            el.html(
                                '<i class="fas fa-star fa-lg text-warning" style="font-size:1.6em;"></i>'
                            );
                        } else {
                            el.html(
                                '<i class="far fa-star fa-lg text-muted" style="font-size:1.6em;"></i>'
                            );
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('toggle featured error:', xhr.status, error, xhr
                            .responseText);
                        var msg = 'حدث خطأ أثناء تغيير حالة المميز';
                        if (xhr.status === 403) msg += ' — ليس لديك صلاحية.';
                        if (xhr.status === 419) msg += ' — فشل التحقق من الجلسة (CSRF).';
                        alert(msg);
                    }
                });
            });
        });
    </script>

    <script>
        function confirmDelete(formId, message, yesText, cancelText) {
            if (confirm(message)) {
                console.log('Submitting form: ' + formId);
                const form = document.getElementById(formId);
                if (form) {
                    form.submit();
                } else {
                    console.error('Form not found: ' + formId);
                }
            } else {
                console.log('User cancelled deletion');
            }
        }
    </script>
@endsection
