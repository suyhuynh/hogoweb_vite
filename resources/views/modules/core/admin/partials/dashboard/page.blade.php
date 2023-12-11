@if (auth()->user()->hasAccess('admin.pages.index'))
<div class="small-box bg-aqua">
    <div class="inner">
        <h3>{{ $total }}</h3>

        <p>{{ trans('core::cores.dashboard.page') }}</p>
    </div>
    <div class="icon">
        <i class="ion ion-document-text"></i>
    </div>
    <a href="{{ route('admin.pages.index') }}" class="small-box-footer">{{ trans('core::cores.dashboard.view_more') }} <i class="fa fa-arrow-circle-right"></i></a>
</div>
@endif