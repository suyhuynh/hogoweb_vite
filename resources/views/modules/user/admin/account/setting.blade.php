@extends('app::admin.layouts.master')
@section('content')

@endsection

@push('script')
<script type="text/javascript">
	var mix = {
		data: {
			form: {
				password: '',
				password_confirmation: '',
			}
		},
		methods: {

		},
		mounted() {
			$('#content-master').css('padding-top', '1.25em');
		},
		created: function () {

		},
	}
</script>
@endpush