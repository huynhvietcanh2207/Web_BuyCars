
@extends('header_footer')
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('css/cart.css') }}">
    <link rel="stylesheet" href="{{asset('css/checkout.css')}}">

</head>


     
 <body>
    <!-- End Header -->
    <div class="row">
        <div class="col-md-4">
            <div class="mb-25">
                <h4>Billing Details</h4>
            </div>
            <form method="post">
                <div class="form-group">
                    <input type="text" required="" name="fname" placeholder="First name *">
                </div>
                <div class="form-group">
                    <input type="text" required="" name="lname" placeholder="Last name *">
                </div>
                <div class="form-group">
                    <input type="text" name="billing_address" required="" placeholder="Address *">
                </div>

                <div class="form-group">
                    <input required="" type="text" name="city" placeholder="City / Town *">
                </div>
                <div class="form-group">
                    <input required="" type="text" name="state" placeholder="State / County *">
                </div>
                <div class="form-group">
                    <input required="" type="text" name="zipcode" placeholder="Postcode / ZIP *">
                </div>
                <div class="form-group">
                    <input required="" type="text" name="phone" placeholder="Phone *">
                </div>
                <div class="form-group">
                    <input required="" type="text" name="email" placeholder="Email address *">
                </div>
                <div class="ship_detail">
                    <div class="form-group">
                        <div class="chek-form">
                            <div class="custome-checkbox">
                                <input class="form-check-input" type="checkbox" name="checkbox" id="differentaddress">
                                <label class="form-check-label label_info" data-bs-toggle="collapse"
                                    data-target="#collapseAddress" href="#collapseAddress"
                                    aria-controls="collapseAddress" for="differentaddress"><span>Ship to a different
                                        address?</span></label>
                            </div>
                        </div>
                    </div>
                    <div id="collapseAddress" class="different_address collapse in">
                        <div class="form-group">
                            <input type="text" required="" name="fname" placeholder="First name *">
                        </div>
                        <div class="form-group">
                            <input type="text" required="" name="lname" placeholder="Last name *">
                        </div>
                        <div class="form-group">
                            <input required="" type="text" name="cname" placeholder="Company Name">
                        </div>
                        <div class="form-group">
                            <input type="text" name="billing_address" required="" placeholder="Address *">
                        </div>
                        <div class="form-group">
                            <input type="text" name="billing_address2" required="" placeholder="Address line2">
                        </div>
                        <div class="form-group">
                            <input required="" type="text" name="city" placeholder="City / Town *">
                        </div>
                        <div class="form-group">
                            <input required="" type="text" name="state" placeholder="State / County *">
                        </div>
                        <div class="form-group">
                            <input required="" type="text" name="zipcode" placeholder="Postcode / ZIP *">
                        </div>
                    </div>
                </div>
                <div class="mb-20">
                    <h5>Additional information</h5>
                </div>
                <div class="form-group mb-30">
                    <textarea rows="5" placeholder="Order notes"></textarea>
                </div>
            </form>
        </div>
        <div class="col-md-6">
            <div class="order_review">
                <div class="mb-20">
                    <h4>Your Orders</h4>
                </div>
                <div class="table-responsive order_table text-center">
                    <table class="table">
                        <thead>
                            <tr>
                                <th colspan="2">Product</th>
                                <th>Total</th>
                            </tr>
                        </thead>



                    </table>
                </div>
                <div class="bt-1 border-color-1 mt-30 mb-30"></div>
                <div class="payment_method">
                    <div class="mb-25">
                        <h5>Payment</h5>
                    </div>
                    <div class="payment_option">
                        <div class="custome-radio">
                            <input class="form-check-input" required="" type="radio" name="payment_option"
                                id="exampleRadios3">
                            <label class="form-check-label" for="exampleRadios3" data-bs-toggle="collapse"
                                data-target="#cashOnDelivery" aria-controls="cashOnDelivery">Cash On Delivery</label>
                        </div>
                        <div class="custome-radio">
                            <input class="form-check-input" required="" type="radio" name="payment_option"
                                id="exampleRadios4">
                            <label class="form-check-label" for="exampleRadios4" data-bs-toggle="collapse"
                                data-target="#cardPayment" aria-controls="cardPayment">Card Payment</label>
                        </div>
                        <div class="custome-radio">
                            <input class="form-check-input" required="" type="radio" name="payment_option"
                                id="exampleRadios5">
                            <label class="form-check-label" for="exampleRadios5" data-bs-toggle="collapse"
                                data-target="#paypal" aria-controls="paypal">Paypal</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>