@extends('master')

@section('content')
<form id="autoCheckoutForm" action="{{ route('falconlong.checkout') }}" method="POST">
    @csrf
    <input type="hidden" name="package_id" value="{{ $packageId }}">
    <input type="hidden" name="user_info" value="{{ json_encode($userInfo) }}">
</form>

<script>
    // Form ini akan otomatis submit saat halaman dimuat
    document.getElementById('autoCheckoutForm').submit();
</script>
@endsection