@if (auth()->user()->hasAccess('admin.posts.index'))
<div class="small-box bg-blue">
    <div class="inner">
        <h3>{{ $total }}</h3>

        <p>{{ trans('core::cores.dashboard.post') }}</p>
    </div>
    <div class="icon">
        <i class="ion ion-ios-paper-outline"></i>
    </div>
    <a href="{{ route('admin.posts.index') }}" class="small-box-footer">{{ trans('core::cores.dashboard.view_more') }} <i class="fa fa-arrow-circle-right"></i></a>
</div>
@endif