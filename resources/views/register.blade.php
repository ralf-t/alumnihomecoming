@extends('_layout')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('body')
<div id="ui">
	<h1 class="titleHead">Alumni Homecoming Registration Form</h1>
	@include('_form_register')
</div>
<div class="text-center text-white fixed-bottom">© 2019 UNIVERSITY OF THE EAST MANILA CCSS RESEARCH AND DEVELOPMENT UNIT</div>
@endsection

@section('scripts')
<script src="{{ asset('js/register.js') }}"></script>
@endsection