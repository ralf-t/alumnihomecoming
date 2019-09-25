@extends('_layout')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('body')
<div id="ui">
	<h1 class="titleHead">Alumni Homecoming Registration Form</h1>
	@include('_register_form')
</div>
<div class="footer-copyright text-center py-3 text-muted">© 2019 UNIVERSITY OF THE EAST MANILA CCSS RESEARCH AND DEVELOPMENT UNIT</div>

<!-- Modal -->
<div class="modal fade bd-modal-lg" id="privacyNotice" tabindex="-1" role="dialog" aria-labelledby="privacyDetails" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content ">
			<div class="modal-header">
				<h5 class="col-12 modal-title" id="privacyDetails">Privacy Notice</h5>
			</div>
			<div class="modal-body">
				<p class="text-justify priv">The event organizers collected information from you as participants for the purposes of registration and overall event management. By providing your information, you are giving your consent to us to use your information for the aforementioned purposes.</p>
				<p class="text-justify priv">After conclusion of the event and completion of all necessary reports, your personal data will be saved in secure files for future reference and networking activities. <b>If you do not wish to be contacted further after this event, kindly inform the organizers.</b></p>
				<p class="text-justify priv">Picture generated in this event may be posted in different social media platforms for the purpose of documenting the said event. <b>Should you have any reservations about this matter, please inform the organizers now.</b></p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
				<button type="submit" class="btn btn-success">Proceed</button>
			</div>
		</div>
	</div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/yearpicker.js') }}"></script>
@endsection