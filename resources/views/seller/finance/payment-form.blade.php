@extends('layouts.app')
@section('page-title')
Order Payment |
@endsection



@section('content')


<div class="container">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-7 col-lg-6">
                <div class="card mb-3">
                    <div class="card-header bg-purple ">
                        <h3 class="card-title text-white">Payment Form</h3>

                    </div>
                    <div class="card-body">
                        {{-- action="{{route('order.store')}} --}}

                        <form id="payment-form" method="post" class="form-horizontal">
                            @csrf
                            <!-- Replace the value with your transaction currency -->
                            <h4 class="mb-3">Billing address</h4>
                            <div class="row">

                                <div class="col-md-6 ">
                                    <label for="lastName">Email <span class="text-danger">*</span></label>
                                    <input type="email" name="email" value="{{Auth::user()->email ?? ''}}"
                                        class="form-control" id="email" />
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong id="error_email"></strong>
                                    </span>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <label for="lastName">Phone Number <span class="text-danger">*</span></label>
                                    <input type="tel" name="phone_number" value="{{Auth::user()->mobile_number ?? ''}}"
                                        class="form-control" id="phone_number" />
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong id="error_phone_number"></strong>
                                    </span>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="country">Country<span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-genderless"></span>
                                                </div>
                                            </div>

                                            <select id="country" name="country" class="form-control ">
                                                <option value="">Select your brand</option>
                                                <option value="other">Other</option>
                                                @foreach ($countries as $country)
                                                <option value="{{$country->id}}" @if ($country->id ==
                                                    $address->country_id) selected

                                                    @endif>
                                                    {{$country->name}}

                                                </option>
                                                @endforeach
                                            </select>
                                        </div>


                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong id="error_country"></strong>
                                        </span>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="state_or_province">State / Province<span
                                                class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-envelope"></span>
                                                </div>
                                            </div>
                                            <input type="text" id="state_or_province" name="state_or_province"
                                                placeholder="state or province" class="form-control "
                                                value="{{ $address->state ?? ''}}" />
                                        </div>

                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong id="error_state_or_province"></strong>
                                        </span>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="city">City<span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-envelope"></span>
                                                </div>
                                            </div>
                                            <input type="text" id="city" name="city" placeholder="City"
                                                class="form-control " value="{{ $address->city ?? ''}}" />
                                        </div>

                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong id="error_city"></strong>
                                        </span>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="zip_or_post_code">ZIP / Post code</label>
                                        <div class="input-group">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-envelope"></span>
                                                </div>
                                            </div>
                                            <input type="text" id="zip_or_post_code" name="zip_or_post_code"
                                                placeholder="ZIP / Post code" class="form-control "
                                                value="{{ $address->post_code ?? ''}}" />
                                        </div>

                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong id="error_zip_or_post_code"></strong>
                                        </span>

                                    </div>
                                </div>

                            </div>
                            <h4 class="mb-3">Shipping address</h4>
                            <div class="row">




                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="shpping_country">Country<span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-genderless"></span>
                                                </div>
                                            </div>

                                            <select id="shpping_country" name="shpping_country" class="form-control ">
                                                <option value="">Select your brand</option>
                                                <option value="other">Other</option>
                                                @foreach ($countries as $country)
                                                <option value="{{$country->id}}">
                                                    {{$country->name}}

                                                </option>
                                                @endforeach
                                            </select>
                                        </div>


                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong id="error_shpping_country"></strong>
                                        </span>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="shpping_state_or_province">State / Province<span
                                                class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-envelope"></span>
                                                </div>
                                            </div>
                                            <input type="text" id="shpping_state_or_province"
                                                name="shpping_state_or_province" placeholder="state or province"
                                                class="form-control " value="{{ old('shpping_state_or_province') }}" />
                                        </div>

                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong id="error_shpping_state_or_province"></strong>
                                        </span>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="shipping_city">City<span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-envelope"></span>
                                                </div>
                                            </div>
                                            <input type="text" id="shipping_city" name="shipping_city"
                                                placeholder="City" class="form-control "
                                                value="{{ old('shipping_city')}}" />
                                        </div>

                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong id="error_shipping_city"></strong>
                                        </span>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="shpping_zip_or_post_code">ZIP / Post code</label>
                                        <div class="input-group">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-envelope"></span>
                                                </div>
                                            </div>
                                            <input type="text" id="shpping_zip_or_post_code"
                                                name="shpping_zip_or_post_code" placeholder="ZIP / Post code"
                                                class="form-control " value="{{  old('shpping_zip_or_post_code') }}" />
                                        </div>

                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong id="error_shpping_zip_or_post_code"></strong>
                                        </span>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="shpping_home_number">Home Number</label>
                                        <div class="input-group">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-envelope"></span>
                                                </div>
                                            </div>
                                            <input type="number" id="shpping_home_number" name="shpping_home_number"
                                                placeholder="Home Number" class="form-control "
                                                value="{{ old('shpping_home_number') }}" />
                                        </div>

                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong id="error_shpping_home_number"></strong>
                                        </span>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="shpping_street_name">Street Name</label>
                                        <div class="input-group">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-envelope"></span>
                                                </div>
                                            </div>
                                            <input type="text" id="shpping_street_name" name="shpping_street_name"
                                                placeholder="Street Name" class="form-control "
                                                value="{{ old('shpping_street_name') }}" />
                                        </div>

                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong id="error_shpping_street_name"></strong>
                                        </span>

                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="shpping_full_address">Full Address<span
                                                class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-envelope"></span>
                                                </div>
                                            </div>
                                            <input type="text" id="shpping_full_address" name="shpping_full_address"
                                                placeholder="Full Address" class="form-control "
                                                value="{{ old('shpping_full_address')}}" />
                                        </div>

                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong id="error_shpping_full_address"></strong>
                                        </span>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="credit_card_name" class="form-label">Name on card<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="credit_card_name" name="credit_card_name"
                                    placeholder="" value="{{old('credit_card_name')}}">
                                <small class="text-muted">Full name as displayed on card</small>
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong id="error_credit_card_name"></strong>
                                </span>
                            </div>
                            <div id="card-element" class="mb-5">
                                <!--Stripe.js injects the Card Element-->
                            </div>

                            <button type="submit" class="btn btn-outline-purple btn-lg btn-block"
                                id="checkout-button-stripe">
                                <div class="spinner hidden" id="spinner"></div>
                                <span id="button-text">Pay with
                                    Stripe</span>
                            </button>
                            <p id="card-error" role="alert" class="alert text-center "></p>
                            <p class="result-message hidden">
                                Payment succeeded, see the result in your
                                <a href="" target="_blank">Stripe dashboard.</a> Refresh the page to pay again.
                            </p>
                        </form>


                    </div>
                </div>
            </div>
            <div class="col-md-5 col-lg-4 order-md-last">
                <div class="card mb-3">
                    <div class="card-header bg-purple ">
                        <h3 class="card-title text-white d-flex justify-content-between align-items-center mb-3">Summary
                            of order</h3>
                    </div>
                    <div class="card-body ">

                        <ul class="list-group mb-3">
                            <li class="list-group-item d-flex justify-content-between lh-sm">
                                <div>
                                    <h6 class="my-0">Product name</h6>
                                    <small class="text-muted">{{$car_sold->brand}}, {{$car_sold->model}}</small>
                                </div>
                                <span class="text-muted">{{$car_sold->car->shpping_state_or_province}}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between lh-sm">
                                <div>
                                    <h6 class="my-0">Vehicle identification number</h6>
                                    <small class="text-muted">{{$car_sold->car->shpping_city}}</small>
                                </div>

                            </li>
                            <li class="list-group-item d-flex justify-content-between lh-sm">
                                <div>
                                    <h6 class="my-0">Owner</h6>
                                    <small class="text-muted">{{$car_sold->owner}}</small>
                                </div>

                            </li>
                            <li class="list-group-item d-flex justify-content-between lh-sm">
                                <div>
                                    <h6 class="my-0">Country</h6>
                                    <small class="text-muted">{{$car_sold->country_name}}</small>
                                </div>

                            </li>
                            <li class="list-group-item d-flex justify-content-between bg-light">
                                <div class="text-success">
                                    <h6 class="my-0 font-weight-bolder">Selling at({{$order_currency}})</h6>
                                    <small></small>
                                </div>
                                <span class="text-orange font-weight-bolder">
                                    {{number_format($max_price,2) ?? ''}}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span class="font-weight-bolder">Buyin at ({{$order_currency}})</span>
                                <span
                                    class="text-purple font-weight-bolder">{{number_format($propose_price,2) ?? ''}}</span>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@push('javascripts')
<script src="https://polyfill.io/v3/polyfill.min.js?version=3.52.1&features=fetch">
</script>
<script src="https://js.stripe.com/v3/"></script>


<script type="text/javascript">
    // A reference to Stripe.js initialized with a fake API key.
// Sign in to see examples pre-filled with your key.
var stripe = Stripe("pk_test_PbsOHNLtBlPq9n5YZbLicaTC00Erz270A6");
// The items the customer wants to buy
var elements = stripe.elements();
var style = {
base: {
credit_card_name: "#32325d",
fontFamily: 'Arial, sans-serif',
fontSmoothing: "antialiased",
fontSize: "16px",
"::placeholder": {
credit_card_name: "#32325d"
}
},
invalid: {
fontFamily: 'Arial, sans-serif',
credit_card_name: "#fa755a",
iconcredit_card_name: "#fa755a"
}
};
var card = elements.create("card", { style: style });
// Stripe injects an iframe into the DOM
card.mount("#card-element");
card.on("change", function (event) {
// Disable the Pay button if there are no card details in the Element
document.querySelector("button").disabled = event.empty;
document.querySelector("#card-error").textContent = event.error ? event.error.message : "";
});
var form = document.getElementById("payment-form");
form.addEventListener("submit", function(event) {
event.preventDefault();

$.ajax({
url: '/paymrent/order/address/'+{{$id}},
method:"POST",
data:$(this).serialize(),
dataType:"json",
success:function(data)
{


if(data.errors) {
if(data.errors.phone_number){

$('#phone_number').addClass('rounded-right');
$('#phone_number').addClass('is-invalid');
$( '#error_phone_number' ).text( data.errors.phone_number[0] );
}
if(data.errors.country){

$('#country').addClass('rounded-right');
$('#country').addClass('is-invalid');
$( '#error_country' ).text( data.errors.country[0] );
}
if(data.errors.full_address){

$('#full_address').addClass('rounded-right');
$('#full_address').addClass('is-invalid');
$( '#error_full_address' ).text( data.errors.full_address[0] );
}
if(data.errors.city){

$('#city').addClass('rounded-right');
$('#city').addClass('is-invalid');
$( '#error_city' ).text( data.errors.city[0] );
}
if(data.errors.state_or_province){

$('#state_or_province').addClass('rounded-right');
$('#state_or_province').addClass('is-invalid');
$( '#error_state_or_province' ).text( data.errors.state_or_province[0] );
}

if(data.errors.zip_or_post_code){

$('#zip_or_post_code').addClass('rounded-right');
$('#state_or_provzip_or_post_codeince').addClass('is-invalid');
$( '#error_zip_or_post_code' ).text( data.errors.zip_or_post_code[0] );
}
if(data.errors.shpping_country){

$('#shpping_country').addClass('rounded-right');
$('#shpping_country').addClass('is-invalid');
$( '#error_shpping_country' ).text( data.errors.shpping_country[0] );
}
if(data.errors.shpping_full_address){

$('#shpping_full_address').addClass('rounded-right');
$('#shpping_full_address').addClass('is-invalid');
$( '#error_shpping_full_address' ).text( data.errors.shpping_full_address[0] );
}
if(data.errors.shipping_city){

$('#shipping_city').addClass('rounded-right');
$('#shipping_city').addClass('is-invalid');
$( '#error_shipping_city' ).text( data.errors.shipping_city[0] );
}
if(data.errors.shpping_state_or_province){

$('#shpping_state_or_province').addClass('rounded-right');
$('#shpping_state_or_province').addClass('is-invalid');
$( '#error_shpping_state_or_province' ).text( data.errors.shpping_state_or_province[0] );
}
if(data.errors.shpping_zip_or_post_code){

$('#shpping_zip_or_post_code').addClass('rounded-right');
$('#shpping_zip_or_post_code').addClass('is-invalid');
$( '#error_shpping_zip_or_post_code' ).text( data.errors.shpping_zip_or_post_code[0] );
}
if(data.errors.credit_card_name){

$('#credit_card_name').addClass('rounded-right');
$('#credit_card_name').addClass('is-invalid');
$( '#error_credit_card_name' ).text( data.errors.credit_card_name[0] );
}

}


    if(data.success == 'ok'){
    // Complete payment when the submit button is clicked
    payWithCard(stripe, card, '{{ $client_secret}} ');
    document.querySelector("button").disabled = true;
    }
}
});


});

// Calls stripe.confirmCardPayment
// If the card requires authentication Stripe shows a pop-up modal to
// prompt the user to enter authentication details without leaving your page.




var payWithCard = function(stripe, card, clientSecret) {
loading(true);
stripe
.confirmCardPayment(clientSecret, {
payment_method: {
card: card
}
})
.then(function(result) {
if (result.error) {
// Show error to your customer
showError(result.error.message);
} else {
    // The payment succeeded!

        orderComplete(result.paymentIntent.id, result.paymentIntent);


    }
});
};


/* ------- UI helpers ------- */
// Shows a success message when the payment is complete
var orderComplete = function(paymentIntentId, paymentIntent) {
loading(false);
// document
// .querySelector(".result-message a")
// .setAttribute(
// "href",
// "https://dashboard.stripe.com/test/payments/" + paymentIntentId
// );

$.ajax({
url: '/payment/create/'+{{$id}},
type:"POST",
data:JSON.stringify({ paymentIntent: paymentIntent }),
dataType:"json",
success:function(response)
{

Swal.fire({
position: 'top-end',
icon: 'success',
title: 'Payment succeeded and order created!',
showConfirmButton: false,
toast: true,
timer: 1500
});
window.location.href = '/finance-management/orders';


}
});

document.querySelector(".result-message").classList.remove("hidden");
document.querySelector("button").disabled = false;
};
// Show the customer the error from Stripe if their card fails to charge
var showError = function(errorMsgText) {
loading(false);
var errorMsg = document.querySelector("#card-error");
document.querySelector("#card-error").classList.add("alert-danger");

errorMsg.textContent = errorMsgText;

setTimeout(function() {
errorMsg.textContent = "";
document.querySelector("#card-error").classList.remove("alert-danger");
}, 4000);
};
// Show a spinner on payment submission
var loading = function(isLoading) {
if (isLoading) {
// Disable the button and show a spinner
document.querySelector("button").disabled = true;
document.querySelector("#spinner").classList.remove("hidden");
document.querySelector("#button-text").classList.add("hidden");
} else {
document.querySelector("button").disabled = false;
document.querySelector("#spinner").classList.add("hidden");
document.querySelector("#button-text").classList.remove("hidden");
}
};
</script>
@endpush

@section('paymentcss')
<style>
    /* Variables */
    * {
        box-sizing: border-box;
    }

    .form-payment {
        width: auto;
        align-self: center;
        box-shadow: 0px 0px 0px 0.5px rgba(50, 50, 93, 0.1),
            0px 2px 5px 0px rgba(50, 50, 93, 0.1), 0px 1px 1.5px 0px rgba(0, 0, 0, 0.07);
        border-radius: 7px;
        padding: 40px;
    }

    .form-payment input {
        border-radius: 6px;
        margin-bottom: 6px;
        padding: 12px;
        border: 1px solid rgba(50, 50, 93, 0.1);
        height: 44px;
        font-size: 16px;
        width: 100%;
        background: rgb(199, 17, 17);
        credit_card_name: red;
    }

    .result-message {
        line-height: 22px;
        font-size: 16px;
    }

    .result-message a {
        credit_card_name: rgb(89, 111, 214);
        font-weight: 600;
        text-decoration: none;
    }

    .hidden {
        display: none;
    }

    #card-error {
        credit_card_name: rgb(105, 115, 134);
        text-align: left;
        font-size: 13px;
        line-height: 17px;
        margin-top: 12px;
    }

    #card-element {
        border-radius: 4px 4px 0 0;
        padding: 12px;
        border: 1px solid rgba(50, 50, 93, 0.1);
        height: 44px;
        width: 100%;
        background: white;
    }

    #payment-request-button {
        margin-bottom: 32px;
    }

    /* Buttons and links */
    button {
        background: #6D28D9;
        credit_card_name: #ffffff;
        font-family: Arial, sans-serif;
        border-radius: 0 0 4px 4px;
        border: 0;
        padding: 12px 16px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        display: block;
        transition: all 0.2s ease;
        box-shadow: 0px 4px 5.5px 0px rgba(0, 0, 0, 0.07);
        width: 100%;
    }

    button:hover {
        filter: contrast(115%);
    }

    button:disabled {
        opacity: 0.5;
        cursor: default;
    }

    /* spinner/processing state, errors */
    .spinner,
    .spinner:before,
    .spinner:after {
        border-radius: 50%;
    }

    .spinner {
        credit_card_name: #ffffff;
        font-size: 22px;
        text-indent: -99999px;
        margin: 0px auto;
        position: relative;
        width: 20px;
        height: 20px;
        box-shadow: inset 0 0 0 2px;
        -webkit-transform: translateZ(0);
        -ms-transform: translateZ(0);
        transform: translateZ(0);
    }

    .spinner:before,
    .spinner:after {
        position: absolute;
        content: "";
    }

    .spinner:before {
        width: 10.4px;
        height: 20.4px;
        background: #5469d4;
        border-radius: 20.4px 0 0 20.4px;
        top: -0.2px;
        left: -0.2px;
        -webkit-transform-origin: 10.4px 10.2px;
        transform-origin: 10.4px 10.2px;
        -webkit-animation: loading 2s infinite ease 1.5s;
        animation: loading 2s infinite ease 1.5s;
    }

    .spinner:after {
        width: 10.4px;
        height: 10.2px;
        background: #5469d4;
        border-radius: 0 10.2px 10.2px 0;
        top: -0.1px;
        left: 10.2px;
        -webkit-transform-origin: 0px 10.2px;
        transform-origin: 0px 10.2px;
        -webkit-animation: loading 2s infinite ease;
        animation: loading 2s infinite ease;
    }

    @-webkit-keyframes loading {
        0% {
            -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    @keyframes loading {
        0% {
            -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    @media only screen and (max-width: 600px) {
        form {
            width: 80vw;
        }
    }
</style>

@endsection
