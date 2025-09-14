<div class="card-body">
    <form action="{{ route('admin.main_sliders.index') }}" method="get">
        <div class="row">
            <!-- كلمة البحث -->
            <div class="col-md-3 col-lg-3 col-8 col-sm-7 ">
                <div class="form-group">
                    <input type="text" name="keyword" value="{{ old('keyword', request()->input('keyword')) }}"
                        class="form-control" placeholder="كلمة البحث">
                </div>
            </div>

            <!-- الحالة -->
            <div class="col-md-2 d-none d-md-block">
                <div class="form-group">
                    <select name="status" class="form-control">
                        <option value="">عرض الكل</option>
                        <option value="1" {{ old('status', request()->input('status')) == '1' ? 'selected' : '' }}>
                            مفعل
                        </option>
                        <option value="0" {{ old('status', request()->input('status')) == '0' ? 'selected' : '' }}>
                            معطل
                        </option>
                    </select>
                </div>
            </div>

            <!-- ترتيب حسب -->
            <div class="col-md-2 d-none d-sm-block col-sm-2 ">
                <div class="form-group">
                    <select name="sort_by" class="form-control">
                        <option value="" selected>الترتيب الافتراضي</option>
                        <option value="published_on"
                            {{ old('sort_by', request()->input('sort_by')) == 'published_on' ? 'selected' : '' }}>
                            تاريخ النشر
                        </option>
                        <option value="created_at"
                            {{ old('sort_by', request()->input('sort_by')) == 'created_at' ? 'selected' : '' }}>
                            تاريخ الإنشاء
                        </option>
                        <option value="id"
                            {{ old('sort_by', request()->input('sort_by')) == 'id' ? 'selected' : '' }}>
                            المعرف
                        </option>
                        <option value="title"
                            {{ old('sort_by', request()->input('sort_by')) == 'title' ? 'selected' : '' }}>
                            العنوان
                        </option>
                    </select>
                </div>
            </div>

            <!-- ترتيب تصاعدي/تنازلي -->
            <div class="col-md-2 d-none d-md-block">
                <div class="form-group">
                    <select name="order_by" class="form-control">
                        <option value="asc"
                            {{ old('order_by', request()->input('order_by')) == 'asc' ? 'selected' : '' }}>
                            تصاعدي
                        </option>
                        <option value="desc"
                            {{ old('order_by', request()->input('order_by')) == 'desc' ? 'selected' : '' }}>
                            تنازلي
                        </option>
                    </select>
                </div>
            </div>

            <!-- عدد النتائج -->
            <div class="col-md-1 d-none d-md-block">
                <div class="form-group">
                    <select name="limit_by" class="form-control">
                        <option value="">---</option>
                        <option value="10"
                            {{ old('limit_by', request()->input('limit_by')) == '10' ? 'selected' : '' }}>10</option>
                        <option value="20"
                            {{ old('limit_by', request()->input('limit_by')) == '20' ? 'selected' : '' }}>20</option>
                        <option value="50"
                            {{ old('limit_by', request()->input('limit_by')) == '50' ? 'selected' : '' }}>50</option>
                        <option value="100"
                            {{ old('limit_by', request()->input('limit_by')) == '100' ? 'selected' : '' }}>100</option>
                    </select>
                </div>
            </div>

            <!-- زر البحث -->
            <div class="col-md-2 col-lg-2 col-4 col-sm-3 d-flex justify-content-end">
                <div class="form-group">
                    <button type="submit" name="submit" class="btn btn-outline-primary">
                        <i class="fa fa-search "></i>
                        بحث
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
