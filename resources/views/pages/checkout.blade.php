@extends('layout')
@section('content')
<section id="cart_items">
<div class="container">
<div class="register-req">
	<p>Please Filap this form.......</p>
</div><!--/register-req-->

<div class="shopper-informations">
<div class="row">
<div class="col-sm-12 clearfix">
	<div class="bill-to">
<p>Bill To</p>
<div class="form-one">
	<form action="" method="post">
		<input type="text" name="shipping_email" placeholder="Email*">
		<input type="text" name="shipping_first_name" placeholder="First Name *">
		<input type="text" name="shipping_last_name" placeholder="Last Name *">
		<input type="text" name="shipping_address" placeholder="Address *">
		<input type="text" name="shipping_mobile" placeholder="Mobile Number *">
		<input type="text" name="shipping_city" placeholder="City *">
		<input type="submit" class="btn btn-success" value="Done" />
	</form>
</div>
		
	</div>
</div>
			
</div>
</div>
<div class="review-payment">
	<h2>Review & Payment</h2>
</div>

</div>
</section> <!--/#cart_items-->





@endsection