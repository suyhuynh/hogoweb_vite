@if (auth()->user()->hasAccess('admin.contacts.index'))
<div class="small-box bg-yellow">
    <div class="inner">
        <h3>{{ $total }}</h3>

        <p>{{ trans('core::cores.dashboard.contact') }}</p>
    </div>
    <div class="icon">
        <i class="ion ion-chatbubble-working"></i>
    </div>
    <a href="{{ route('admin.contacts.index') }}" class="small-box-footer">{{ trans('core::cores.dashboard.view_more') }} <i class="fa fa-arrow-circle-right"></i></a>
</div>
@endif