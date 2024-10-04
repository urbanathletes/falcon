@extends('master3')

@section('content')
    <form id="autoOrderForm" action="{{ route('falconlong.order') }}" method="POST">
        @csrf
        <input type="hidden" name="lead_id" value="{{ $leadId }}">
        <input type="hidden" name="package_membership_id" value="{{ $packageMembershipId }}">
        <input type="hidden" name="checkout_id" value="{{ $checkoutId }}">
    </form>

    <script>
        // Form ini akan otomatis submit saat halaman dimuat
        document.getElementById('autoOrderForm').submit();
    </script>
@endsection
