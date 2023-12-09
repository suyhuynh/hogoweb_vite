@section('breadcrumb')
    <section class="content-header" style="background: #FFF;padding-bottom: 15px;">
        <h1><a href="javascript:history.go(-1)" title="Back" class="mr-1"><i class="fa fa-mail-reply"></i></a> {{ $title }}</h1>
        <ol class="breadcrumb" style="top: 11px;">
            <li><a href="{{ route('admin.dashboard.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            @if(!empty($listBreadcrumb))
                @if(is_array($listBreadcrumb))
                    @php
                        $total = count($listBreadcrumb) - 1;
                    @endphp
                    @foreach($listBreadcrumb as $key => $value)
                        @if($key != $total)
                            <li><a href="{{ $value['route'] }}">{{ $value['title'] }}</a></li>
                        @else
                            <li class="active">{{ $value['title'] }}</li>
                        @endif
                    @endforeach
                @endif
            @endif
        </ol>
    </section>
@endsection