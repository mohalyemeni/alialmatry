@extends('layouts.admin')

@section('content')

    <div class="card shadow mb-4">

        <div class="card-header py-3 d-flex justify-content-between">

            <div class="card-naving">
                <h3 class="font-weight-bold text-primary">
                    <i class="fa fa-folder"></i>
                    إدارة السلايدر
                </h3>
                <ul class="breadcrumb pt-3">
                    <li>
                        <a href="{{ route('admin.index') }}">الرئيسية</a>
                        \
                    </li>
                    <li class="ms-1">
                        عرض السلايدر
                    </li>
                </ul>
            </div>

            <div class="ml-auto">
                @ability('admin', 'create_main_sliders')
                    <a href="{{ route('admin.main_sliders.create') }}" class="btn btn-primary">
                        <span class="icon text-white-50">
                            <i class="fa fa-plus-square"></i>
                        </span>
                        <span class="text">إضافة سلايدر جديد</span>
                    </a>
                @endability
            </div>

        </div>

        <div class="card-body">

            {{-- اجعل لديك جزء الفلتر إذا أردت --}}
            @includeWhen(View::exists('backend.main_sliders.filter.filter'),
                'backend.main_sliders.filter.filter')

            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered dt-responsive nowrap"
                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                    <thead>
                        <tr>
                            <th>الصورة</th>
                            <th>العنوان</th>
                            <th class="d-none d-sm-table-cell">المؤلف</th>
                            <th class="d-none d-sm-table-cell">تاريخ النشر</th>
                            <th>الحالة</th>
                            <th class="text-center" style="width:30px;">العمليات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($mainSliders as $main_slider)
                            @php

                                $locale = 'ar';

                                $getTranslated = function ($value) use ($locale) {
                                    if (is_array($value)) {
                                        return $value[$locale] ?? (reset($value) ?? null);
                                    }
                                    return $value;
                                };

                                $title = $getTranslated($main_slider->title) ?: '-';

                                $placeholder = asset('image/not_found/placeholder.jpg');
                                if (
                                    !empty($main_slider->img) &&
                                    file_exists(public_path('assets/main_sliders/' . $main_slider->img))
                                ) {
                                    $main_slider_img = asset('assets/main_sliders/' . $main_slider->img);
                                } else {
                                    $main_slider_img = $placeholder;
                                }
                            @endphp

                            <tr>
                                <td>
                                    <img src="{{ $main_slider_img }}" width="60" height="60"
                                        alt="{{ e($title) }}">
                                </td>

                                <td>{{ \Illuminate\Support\Str::limit($title, 60) }}</td>

                                <td class="d-none d-sm-table-cell">{{ $main_slider->created_by ?? '-' }}</td>

                                <td class="d-none d-sm-table-cell">
                                    {{ optional($main_slider->published_on)->diffForHumans() ?? '-' }}
                                </td>

                                <td>
                                    @if ($main_slider->status == 1)
                                        <a href="javascript:void(0);" class="updateMainSliderStatus"
                                            id="main-slider-{{ $main_slider->id }}" main_slider_id="{{ $main_slider->id }}">
                                            <i class="fas fa-toggle-on fa-lg text-success" aria-hidden="true"
                                                status="Active" style="font-size: 1.6em"></i>
                                        </a>
                                    @else
                                        <a href="javascript:void(0);" class="updateMainSliderStatus"
                                            id="main-slider-{{ $main_slider->id }}"
                                            main_slider_id="{{ $main_slider->id }}">
                                            <i class="fas fa-toggle-off fa-lg text-warning" aria-hidden="true"
                                                status="Inactive" style="font-size: 1.6em"></i>
                                        </a>
                                    @endif
                                </td>

                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <div class="dropdown mb-2 ">
                                            <a type="button" class="d-flex" id="dropdownMenuButton"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="icon-lg text-muted pb-3px" data-feather="more-vertical"></i>
                                                خيارات
                                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                                    viewBox="0 0 25 15" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-chevron-down link-arrow">
                                                    <polyline points="6 9 12 15 18 9"></polyline>
                                                </svg>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item d-flex align-items-center"
                                                    href="{{ route('admin.main_sliders.edit', $main_slider->id) }}">
                                                    <i data-feather="edit-2" class="icon-sm me-2"></i>
                                                    <span>تعديل</span>
                                                </a>

                                                <a href="javascript:void(0);"
                                                    onclick="confirmDelete('delete-main_slider-{{ $main_slider->id }}', 'هل تريد الحذف؟', 'نعم', 'إلغاء')"
                                                    class="dropdown-item d-flex align-items-center">
                                                    <i data-feather="trash" class="icon-sm me-2"></i>
                                                    <span>حذف</span>
                                                </a>
                                                <form action="{{ route('admin.main_sliders.destroy', $main_slider->id) }}"
                                                    method="post" class="d-none"
                                                    id="delete-main_slider-{{ $main_slider->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>

                                                <a href="javascript:void(0);"
                                                    class="dropdown-item d-flex align-items-center btn btn-success copyButton"
                                                    data-copy-text="{{ config('app.url') }}/main_sliders/{{ $main_slider->slug ?? $main_slider->id }}"
                                                    data-id="{{ $main_slider->id }}" title="Copy the link">
                                                    <i data-feather="copy" class="icon-sm me-2"></i>
                                                    <span>نسخ الرابط</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">لا توجد عناصر</td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="6">
                                <div class="float-right">
                                    {!! $mainSliders->appends(request()->all())->links() !!}
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>

        </div>

    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.updateMainSliderStatus', function(e) {
                e.preventDefault();

                var el = $(this);

                var mainSliderId = el.attr('main_slider_id');

                // تأكد من وجود id
                if (!mainSliderId) {
                    console.error('main_slider_id attribute not found');
                    return;
                }

                $.ajax({
                    type: 'POST',
                    url: '{{ route('admin.slider.toggleStatus') }}',
                    data: {
                        _token: '{{ csrf_token() }}',
                        slider_id: mainSliderId
                    },
                    success: function(response) {

                        if (response.status == 1 || response.status === true) {
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

                        alert('حدث خطأ أثناء تغيير الحالة');
                        console.error(xhr.responseText || error);
                    }
                });
            });
        });

        function confirmDelete(formId, message, yesText = 'نعم', cancelText = 'إلغاء') {
            if (confirm(message)) {
                const form = document.getElementById(formId);
                if (form) form.submit();
            }
        }
    </script>
@endsection
