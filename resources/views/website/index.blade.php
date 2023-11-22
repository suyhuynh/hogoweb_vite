@extends('website.layouts.master')

@section('content')

<h1 class="text-center">HoGoWeb</h1>
{!! Form::bsText(trans('post::posts.form.auth'), 'credit', 'sdsdsd', []) !!}

@endsection

@push('script')

@endpush