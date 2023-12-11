@if (session()->has('success'))
    <div class="alert alert-success alert-styled-left alert-arrow-left alert-dismissible">
        <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
        <i class="icon fa fa-check"></i> {!! session('success') !!}
    </div>
@endif
@if (session()->has('error'))
    <div class="alert alert-danger alert-styled-left alert-dismissible">
        <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
        <i class="icon fa fa-info"></i> {!! session('error') !!}
    </div>
@endif
