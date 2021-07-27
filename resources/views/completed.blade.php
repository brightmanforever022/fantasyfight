@extends('layouts.app')

@section('title', 'LeaderBoard')

@section('headerbar')
    @parent
@stop

@section('content')
    <div class="profile-body" id="sign-up-complete">
        <h1 style="color: white">Signed up successfully.</h1>
        <a style="background-image: linear-gradient(to bottom, #5ac1c2, #478acd); color: #FFF; font-size: 19px; text-decoration: none; padding: 5px 20px; border-radius: 5px;"
            href="/">Get Started</a>
    </div>
@stop

@section('scripts')
<script>
    credit=1
    var stripe = Stripe("{{env('STRIPE_CLIENT_KEY')}}");
    fetch('/payments/initiate', {
        method: 'POST',
        body: "credit=" + credit,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Content-Type': 'application/x-www-form-urlencoded'
        }
    })
    .then(function(response) {
        return response.json();
    })
    .then(function(session) {
        return stripe.redirectToCheckout({
            sessionId: session.id
        });
    })
    .then(function(result) {
        // If `redirectToCheckout` fails due to a browser or network
        // error, you should display the localized error message to your
        // customer using `error.message`.
        if (result.error) {
            alert(result.error.message);
        }
    })
    .catch(function(error) {
        console.error('Error:', error);
    });
</script>
@endsection
