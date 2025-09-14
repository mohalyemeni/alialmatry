<div class="card-body">
    <form action="{{ route('admin.fatawa.index') }}" method="get">
        <div class="row">
            <div class="col-md-3 col-lg-3 col-8 col-sm-7 ">
                <div class="form-group">
                    <input type="text" name="keyword" value="{{ old('keyword', request()->input('keyword')) }}"
                        class="form-control" placeholder="{{ __('panel.keyword') }}">
                </div>
            </div>
            <div class="col-md-2 d-none d-md-block">
                <div class="form-group">
                    <select name="status" class="form-control">
                        <option value=""> {{ __('panel.show_all') }}</option>
                        <option value="1" {{ old('status', request()->input('status')) == '1' ? 'selected' : '' }}>
                            {{ __('panel.status_active') }}
                        </option>
                        <option value="0" {{ old('status', request()->input('status')) == '0' ? 'selected' : '' }}>
                            {{ __('panel.status_inactive') }}
                        </option>
                    </select>
                </div>
            </div>
            <div class="col-md-2 d-none d-sm-block col-sm-2 ">
                <div class="form-group">
                    <select name="sort_by" class="form-control">
                        <option value="" selected>{{ __('panel.show_all') }}</option>
                        <option value="published_on"
                            {{ old('sort_by', request()->input('sort_by')) == 'published_on' ? 'selected' : '' }}>
                            {{ __('panel.published_on') }}
                        </option>
                        <option value="created_at"
                            {{ old('sort_by', request()->input('sort_by')) == 'created_at' ? 'selected' : '' }}>
                            {{ __('panel.created_at') }}
                        </option>
                        <option value="id"
                            {{ old('sort_by', request()->input('sort_by')) == 'id' ? 'selected' : '' }}>
                            {{ __('panel.id') }}
                        </option>
                        <option value="title"
                            {{ old('sort_by', request()->input('sort_by')) == 'title' ? 'selected' : '' }}>
                            {{ __('panel.title') }}
                        </option>
                    </select>
                </div>
            </div>
            <div class="col-md-2 d-none d-md-block">
                <div class="form-group">
                    <select name="order_by" class="form-control">
                        <option value="asc"
                            {{ old('order_by', request()->input('order_by')) == 'asc' ? 'selected' : '' }}>
                            {{ __('panel.asc') }}
                        </option>
                        <option value="desc"
                            {{ old('order_by', request()->input('order_by')) == 'desc' ? 'selected' : '' }}>
                            {{ __('panel.desc') }}
                        </option>
                    </select>
                </div>
            </div>
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
            <div class="col-md-2 col-lg-2 col-4 col-sm-3 d-flex justify-content-end">
                <div class="form-group">
                    <button type="submit" name="submit" class="btn btn-outline-primary">
                        <i class="fa fa-search "></i>
                        {{ __('panel.search') }}
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
