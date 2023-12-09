@if (auth()->user()->hasAccess('admin.post_categories.index'))
<div class="small-box bg-light-blue">
    <div class="inner">
        <h3>{{ $total }}</h3>

        <p>{{ trans('core::cores.dashboard.post_category') }}</p>
    </div>
    <div class="icon">
        <i class="ion ion-android-list"></i>
    </div>
    <a href="{{ route('admin.post_categories.index') }}" class="small-box-footer">{{ trans('core::cores.dashboard.view_more') }} <i class="fa fa-arrow-circle-right"></i></a>
</div>
@endif