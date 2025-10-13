@extends('layouts.admin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <div class="card-naving">
                <h3 class="font-weight-bold text-primary">
                    <i class="fa fa-book"></i>
                    {{ __('panel.manage_books') }}
                </h3>
                <ul class="breadcrumb pt-3">
                    <li><a href="{{ route('admin.index') }}">{{ __('panel.main') }}</a> \</li>
                    <li class="ms-1">{{ __('panel.show_books') }}</li>
                </ul>
            </div>
            <div class="ml-auto">
                @ability('admin', 'create_books')
                    <a href="{{ route('admin.books.create') }}" class="btn btn-primary">
                        <span class="icon text-white-50 d-none d-sm-inline-block">
                            <i class="fa fa-plus-square"></i>
                        </span>
                        <span class="text">{{ __('panel.add_new_content') }}</span>
                    </a>
                @endability
            </div>
        </div>

        @include('backend.books.filter.filter')

        <div class="card-body">
            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                style="width: 100%;">
                <thead>
                    <tr>
                        <th class="wd-5p border-bottom-0">#</th>
                        <th class="wd-35p border-bottom-0">{{ __('panel.title') }}</th>
                        <th class="wd-15p border-bottom-0 d-none d-sm-table-cell">{{ __('panel.author') }}</th>
                        <th class="wd-10p border-bottom-0 d-none d-sm-table-cell">{{ __('panel.status') }}</th>
                        <th class="wd-15p border-bottom-0 d-none d-sm-table-cell">{{ __('panel.published_on') }}</th>
                        <th class="text-center border-bottom-0" style="width: 120px;">{{ __('panel.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($books as $book)
                        <tr>
                            <td class="text-center">
                                <input type="checkbox" name="checkfilter" value="{{ $book->id }}">
                            </td>
                            <td>{{ $book->title }}</td>
                            <td class="d-none d-sm-table-cell">
                                {{ $book->creator?->first_name ?? __('panel.unknown') }}
                            </td>
                            <td class="d-none d-sm-table-cell text-center">
                                <a href="javascript:void(0);" class="updateBookStatus" id="book-{{ $book->id }}"
                                    book_id="{{ $book->id }}">
                                    @if ($book->status)
                                        <i class="fas fa-toggle-on fa-lg text-success" style="font-size:1.6em;"></i>
                                    @else
                                        <i class="fas fa-toggle-off fa-lg text-warning" style="font-size:1.6em;"></i>
                                    @endif
                                </a>
                            </td>
                            <td class="d-none d-sm-table-cell">
                                {{ $book->published_on?->diffForHumans() ?? '-' }}
                            </td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm">
                                    <div class="dropdown mb-2">
                                        <a class="d-flex align-items-center" href="#"
                                            id="dropdownMenuButton{{ $book->id }}" data-bs-toggle="dropdown"
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
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $book->id }}">
                                            <a class="dropdown-item d-flex align-items-center"
                                                href="{{ route('admin.books.edit', $book->id) }}">
                                                <i data-feather="edit-2" class="icon-sm me-2"></i>
                                                <span>{{ __('panel.operation_edit') }}</span>
                                            </a>
                                            <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center"
                                                onclick="confirmDelete('delete-book-{{ $book->id }}', '{{ __('panel.confirm_delete_message') }}', '{{ __('panel.yes_delete') }}', '{{ __('panel.cancel') }}')">
                                                <i data-feather="trash" class="icon-sm me-2"></i>
                                                <span>{{ __('panel.operation_delete') }}</span>
                                            </a>
                                            <form id="delete-book-{{ $book->id }}"
                                                action="{{ route('admin.books.destroy', $book->id) }}" method="POST"
                                                class="d-none">
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
                            <td colspan="6" class="text-center">{{ __('panel.no_found_item') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-3">
                {{ $books->links() }}
            </div>
        </div>
    </div>
@endsection

@section('script')
    {{-- SweetAlert2 --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $(document).on('click', '.updateBookStatus', function() {
                var el = $(this);
                var book_id = el.attr('book_id');

                // optional: show small loading indicator while request in-flight
                const originalHtml = el.html();
                el.html('<i class="fas fa-spinner fa-pulse"></i>');

                $.ajax({
                    type: 'POST',
                    url: '{{ route('admin.books.toggleStatus') }}',
                    data: {
                        _token: '{{ csrf_token() }}',
                        book_id: book_id
                    },
                    success: function(response) {
                        // Determine new state robustly
                        let isActive = null;

                        if (typeof response.new_status !== 'undefined') {
                            isActive = !!response.new_status;
                        } else if (typeof response.status === 'boolean') {
                            // some endpoints return the new status as boolean
                            isActive = response.status;
                        } else if (response.status == 1 || response.status === '1') {
                            // sometimes status=1 means active
                            isActive = true;
                        } else if (response.status == 0 || response.status === '0') {
                            isActive = false;
                        }

                        // Fallback: toggle based on current icon if server response unclear
                        if (isActive === null) {
                            const icon = el.find('i');
                            const currentlyActive = icon.hasClass('text-success');
                            isActive = !currentlyActive;
                        }

                        if (isActive) {
                            el.html(
                                '<i class="fas fa-toggle-on fa-lg text-success" style="font-size:1.6em;"></i>'
                            );
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                icon: 'success',
                                title: '{{ __('panel.status_changed_successfully') }}',
                                showConfirmButton: false,
                                timer: 1400
                            });
                        } else {
                            el.html(
                                '<i class="fas fa-toggle-off fa-lg text-warning" style="font-size:1.6em;"></i>'
                            );
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                icon: 'info',
                                title: '{{ __('panel.status_changed_successfully') }}',
                                showConfirmButton: false,
                                timer: 1400
                            });
                        }
                    },
                    error: function(xhr) {
                        console.error('toggle status error:', xhr.status, xhr.responseText);
                        // restore original UI
                        el.html(originalHtml);

                        // show friendly Swal error
                        Swal.fire({
                            icon: 'error',
                            title: '{{ __('panel.something_was_wrong') }}',
                            text: '{{ __('panel.error_while_changing_status') }}',
                            confirmButtonText: 'حسناً'
                        });
                    }
                });
            });
        });

        function confirmDelete(formId, message, yesText = 'نعم، احذف', cancelText = 'إلغاء') {
            Swal.fire({
                title: message,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: yesText,
                cancelButtonText: cancelText,
                reverseButtons: true,
                customClass: {
                    confirmButton: 'btn btn-danger mx-2',
                    cancelButton: 'btn btn-secondary'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.getElementById(formId);
                    if (form) {
                        // إرسال الحذف عبر AJAX
                        $.ajax({
                            url: form.action,
                            type: 'POST',
                            data: $(form).serialize(),
                            success: function() {
                                Swal.fire({
                                    title: '{{ __('panel.operation_success') }}',
                                    text: '{{ __('panel.item_deleted_successfully') ?? 'تم حذف العنصر بنجاح.' }}',
                                    icon: 'success',
                                    timer: 1200,
                                    showConfirmButton: false
                                });
                                setTimeout(function() {
                                    window.location.reload();
                                }, 1250);
                            },
                            error: function() {
                                Swal.fire('{{ __('panel.something_was_wrong') }}',
                                    '{{ __('panel.error_on_delete') ?? 'حدث خطأ أثناء الحذف، حاول مجددًا.' }}',
                                    'error');
                            }
                        });
                    } else {
                        console.error('Form not found: ' + formId);
                    }
                }
            });
        }
    </script>
@endsection
