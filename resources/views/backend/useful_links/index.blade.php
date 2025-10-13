@extends('layouts.admin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <div class="card-naving">
                <h3 class="font-weight-bold text-primary">
                    <i class="fa fa-link"></i>
                    {{ __('panel.manage_useful_links') }}
                </h3>
                <ul class="breadcrumb pt-3">
                    <li><a href="{{ route('admin.index') }}">{{ __('panel.main') }}</a> \</li>
                    <li class="ms-1">{{ __('panel.show_useful_links') }}</li>
                </ul>
            </div>
            <div class="ml-auto">
                @ability('admin', 'create_useful_link')
                    <a href="{{ route('admin.useful_links.create') }}" class="btn btn-primary">
                        <span class="icon text-white-50 d-none d-sm-inline-block">
                            <i class="fa fa-plus-square"></i>
                        </span>
                        <span class="text">{{ __('panel.add_new_content') }}</span>
                    </a>
                @endability
            </div>
        </div>

        @include('backend.useful_links.filter.filter')

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
                    @forelse ($links as $link)
                        <tr>
                            <td class="text-center">
                                <input type="checkbox" name="checkfilter" value="{{ $link->id }}">
                            </td>
                            <td>{{ $link->title }}</td>
                            <td class="d-none d-sm-table-cell">
                                {{ $link->creator?->first_name ?? __('panel.unknown') }}
                            </td>
                            <td class="d-none d-sm-table-cell">
                                <a href="javascript:void(0);" class="updateUsefulLinkStatus"
                                    id="useful-link-{{ $link->id }}" useful_link_id="{{ $link->id }}">
                                    @if ($link->status)
                                        <i class="fas fa-toggle-on fa-lg text-success" style="font-size:1.6em;"></i>
                                    @else
                                        <i class="fas fa-toggle-off fa-lg text-warning" style="font-size:1.6em;"></i>
                                    @endif
                                </a>
                            </td>
                            <td class="d-none d-sm-table-cell">
                                {{ $link->published_on?->diffForHumans() ?? '-' }}
                            </td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm">
                                    <div class="dropdown mb-2">
                                        <a class="d-flex align-items-center" href="#"
                                            id="dropdownMenuButton{{ $link->id }}" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false" style="cursor:pointer;">
                                            <i data-feather="more-vertical" class="icon-sm text-muted"></i>
                                            {{ __('panel.operation_options') }}
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $link->id }}">
                                            <a class="dropdown-item d-flex align-items-center"
                                                href="{{ route('admin.useful_links.edit', $link->id) }}">
                                                <i data-feather="edit-2" class="icon-sm me-2"></i>
                                                <span>{{ __('panel.operation_edit') }}</span>
                                            </a>
                                            <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center"
                                                onclick="confirmDelete('delete-useful-link-{{ $link->id }}')">
                                                <i data-feather="trash" class="icon-sm me-2"></i>
                                                <span>{{ __('panel.operation_delete') }}</span>
                                            </a>
                                            <form id="delete-useful-link-{{ $link->id }}"
                                                action="{{ route('admin.useful_links.destroy', $link->id) }}"
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
                {{ $links->links() }}
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            // تحديث حالة الرابط المفيد
            $(document).on('click', '.updateUsefulLinkStatus', function() {
                var el = $(this);
                var useful_link_id = el.attr('useful_link_id');
                $.ajax({
                    type: 'POST',
                    url: '{{ route('admin.useful_links.toggleStatus') }}',
                    data: {
                        _token: '{{ csrf_token() }}',
                        useful_link_id: useful_link_id
                    },
                    success: function(response) {
                        if (response.status) {
                            el.html(
                                '<i class="fas fa-toggle-on fa-lg text-success" style="font-size:1.6em;"></i>');
                        } else {
                            el.html(
                                '<i class="fas fa-toggle-off fa-lg text-warning" style="font-size:1.6em;"></i>');
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'خطأ!',
                            text: 'حدث خطأ أثناء تغيير الحالة.',
                            confirmButtonText: 'حسنًا'
                        });
                    }
                });
            });
        });

        // تأكيد الحذف باستخدام SweetAlert
        function confirmDelete(formId) {
            Swal.fire({
                title: 'هل أنت متأكد من الحذف؟',
                text: "لن تتمكن من التراجع بعد ذلك!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'نعم، احذف!',
                cancelButtonText: 'إلغاء'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(formId).submit();
                    Swal.fire({
                        icon: 'success',
                        title: 'تم الحذف!',
                        text: 'تم حذف العنصر بنجاح.',
                        timer: 1500,
                        showConfirmButton: false
                    });
                } else {
                    Swal.fire({
                        icon: 'info',
                        title: 'تم الإلغاء',
                        text: 'لم يتم حذف أي شيء.',
                        timer: 1000,
                        showConfirmButton: false
                    });
                }
            });
        }
    </script>
@endsection
