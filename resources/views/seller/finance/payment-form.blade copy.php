@extends('layouts.app')
@section('page-title')
order Payment
@endsection



@section('content')


<div class="container">
    <div class="col-md12">
        <div class="row">
            <div class="col-md-7">
                <div class="card mb-3">
                    <div class="card-header bg-purple ">
                        <h3 class="card-title text-white">Payment Form</h3>

                    </div>
                    <div class="card-body ">

                        <form id="payment-form" method="post" action="{{route('order.store')}}">
                            @csrf
                            <input type="hidden" name="amount" value="{{$propose_price ?? ''}}" />
                            <!-- Replace the value with your transaction amount -->
                            <input type="hidden" name="payment_method" value="both" />
                            <!-- Can be card, account, both -->
                            <input type="hidden" name="description" value="Beats by Dre. 2017" />
                            <!-- Replace the value with your transaction description -->
                            <input type="hidden" name="country" value="ZM" />
                            <!-- Replace the value with your transaction country -->
                            <input type="hidden" name="currency" value="ZMW" />
                            <!-- Replace the value with your transaction currency -->
                            <div class="row">



                                <div class="col-md-12 mb-3">
                                    <label for="lastName">Phone Number <span class="text-danger">*</span></label>
                                    <input type="tel" name="phonenumber" value="{{Auth::user()->mobile_number ?? ''}}"
                                        class="form-control" id="phonenumber" />
                                    <!-- Replace the value with your customer lastname -->
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="country">Country</label>
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
                                            <strong id="error_brand"></strong>
                                        </span>

                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="state_or_province">State / Province</label>
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
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="city">City</label>
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
                                <div class="col-md-12">
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
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="home_number">Home Number</label>
                                        <div class="input-group">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-envelope"></span>
                                                </div>
                                            </div>
                                            <input type="number" id="home_number" name="home_number"
                                                placeholder="Home Number" class="form-control "
                                                value="{{ $address->home_number ?? ''}}" />
                                        </div>

                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong id="error_home_number"></strong>
                                        </span>

                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="street_name">Street Name</label>
                                        <div class="input-group">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-envelope"></span>
                                                </div>
                                            </div>
                                            <input type="text" id="street_name" name="street_name"
                                                placeholder="Street Name" class="form-control "
                                                value="{{ $address->street_name ?? ''}}" />
                                        </div>

                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong id="error_street_name"></strong>
                                        </span>

                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="full_address">Full Address</label>
                                        <div class="input-group">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-envelope"></span>
                                                </div>
                                            </div>
                                            <input type="text" id="full_address" name="full_address"
                                                placeholder="Full Address" class="form-control "
                                                value="{{ $address->full_address ?? ''}}" />
                                        </div>

                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong id="error_full_address"></strong>
                                        </span>

                                    </div>
                                </div>
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
                        </form>


                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card mb-3">
                    <div class="card-header bg-purple ">
                        <h3 class="card-title text-white">Summary of order</h3>
                    </div>
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="email">Email<span class="text-danger">*</span></label>
                                <input type="text" readonly class="form-control" id="email" name="email"
                                    value="{{Auth::user()->email}}" />
                                <!-- Replace the value with your customer email -->
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="lastName">Name <span class="text-danger">*</span></label>
                                <input type="text" readonly class="form-control" name="lastname"
                                    value="{{Auth::user()->name}}" id="lastName" />
                                <!-- Replace the value with your customer lastname -->
                            </div>
                        </div>
                        <h5 class="font-weight-bolder">Selling Amount: <span class="text-orange">
                                {{number_format($max_price,2) ?? ''}}</span></h5>
                        <h5 class="font-weight-bolder">Amount to pay: <span
                                class="text-purple">{{number_format($propose_price,2) ?? ''}}</span></h5>
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
color: "#32325d",
fontFamily: 'Arial, sans-serif',
fontSmoothing: "antialiased",
fontSize: "16px",
"::placeholder": {
color: "#32325d"
}
},
invalid: {
fontFamily: 'Arial, sans-serif',
color: "#fa755a",
iconColor: "#fa755a"
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



// Complete payment when the submit button is clicked
payWithCard(stripe, card, '{{ $client_secret}} ');
document.querySelector("button").disabled = true;
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
orderComplete(result.paymentIntent.id);
$.ajax({
type:form.method,
url:form.action,
data:JSON.stringify({ paymentIntent: result.paymentIntent}),
dataType: 'json',
success:function(response) {
    // window.location.href = '/payment/success';
if(response.success == "succeeded") {
Swal.fire({
position: 'top-end',
icon: 'success',
title: 'Payment succeeded and order created!',
showConfirmButton: false,
toast: true,
timer: 1500
});
$('#cart_item_number').text(0);
}else{
    console.log(response);
}
}
});
}
});
};
/* ------- UI helpers ------- */
// Shows a success message when the payment is complete
var orderComplete = function(paymentIntentId) {
loading(false);
document
.querySelector(".result-message a")
.setAttribute(
"href",
"https://dashboard.stripe.com/test/payments/" + paymentIntentId
);
document.querySelector(".result-message").classList.remove("hidden");
document.querySelector("button").disabled = true;
};
// Show the customer the error from Stripe if their card fails to charge
var showError = function(errorMsgText) {
loading(false);
var errorMsg = document.querySelector("#card-error");
errorMsg.textContent = errorMsgText;
setTimeout(function() {
errorMsg.textContent = "";
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
        color: red;
    }

    .result-message {
        line-height: 22px;
        font-size: 16px;
    }

    .result-message a {
        color: rgb(89, 111, 214);
        font-weight: 600;
        text-decoration: none;
    }

    .hidden {
        display: none;
    }

    #card-error {
        color: rgb(105, 115, 134);
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
        color: #ffffff;
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
        color: #ffffff;
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
