<div class="navbar navbar-expand-lg navbar-light navbar-component nav-filter">
    <div class="text-center d-lg-none w-100">
        <button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-filter">
            <i class="icon-unfold mr-2"></i>
            Bộ lọc
        </button>
    </div>
    <form method="GET" action="{{ route('admin.customers.index') }}" id="filter-table">
        <div class="navbar-collapse collapse" id="navbar-filter">
            <span class="navbar-text font-weight-semibold mr-3">
                Bộ lọc:
            </span>
            <ul class="navbar-nav flex-wrap">
                {{ $filter }}
            </ul>
            <button type="submit" class="btn btn-light ml-3">Lọc</button>
        </div>
    </form>
</div>
