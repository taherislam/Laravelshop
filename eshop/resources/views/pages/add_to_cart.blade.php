@extends('layout')
@section('content')

<section id="cart_items">
		<div class="container col-sm-12">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<?php 
					$content =Cart::content();
					//echo '<pre>';
					//print_r($content);
					//echo '</pre>';
					//exit();


				?>	
					<thead>
						<tr class="cart_menu">
							<td class="image">Image</td>
							<td class="description">Name</td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td >Action</td>
							
						</tr>
					</thead>
					<tbody>
				@foreach($content as $v_cart)	
						<tr>
							<td class="cart_product">
								<a href=""><img src="{{$v_cart->options->image}}" style="height:80px; width: 80px" alt=""></a>
							</td>

							<td class="cart_description">
								<h4><a href="">{{$v_cart->name}}</a></h4>
							</td>
							<td class="cart_price">
								<p>{{$v_cart->price}} Tk</p>
							</td>
							<td class="cart_quantity">
								<form action="{{url('/update-cart')}}" method="post">
									{{ csrf_field() }}
								<div class="cart_quantity_button">
									<input class="cart_quantity_input" type="text" name="qty" value="{{$v_cart->qty}} " autocomplete="off" size="2">
									<input type="hidden" name="rowId" value="{{$v_cart->rowId}} " >
									<input type="submit" name="submit" value="update" class="btn btn-sm btn-default">
								</div>
								</form>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">{{$v_cart->total}} Tk</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="{{URL::to('/delete-to-cart/'.$v_cart->rowId)}}"><i class="fa fa-times"></i></a>
							</td>
						</tr>
					@endforeach
						
					
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->

	<section id="do_action">
		<div class="container">
			<div class="heading">
				<h3>What would you like to do next?</h3>
				<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
			</div>
			<div class="row">
				{{-- <div class="col-sm-6">
					<div class="chose_area">
						<ul class="user_option">
							<li>
								<input type="checkbox">
								<label>Use Coupon Code</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Use Gift Voucher</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Estimate Shipping & Taxes</label>
							</li>
						</ul>
						<ul class="user_info">
							<li class="single_field">
								<label>Country:</label>
								<select>
									<option>United States</option>
									<option>Bangladesh</option>
									<option>UK</option>
									<option>India</option>
									<option>Pakistan</option>
									<option>Ucrane</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
								
							</li>
							<li class="single_field">
								<label>Region / State:</label>
								<select>
									<option>Select</option>
									<option>Dhaka</option>
									<option>London</option>
									<option>Dillih</option>
									<option>Lahore</option>
									<option>Alaska</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
							
							</li>
							<li class="single_field zip-field">
								<label>Zip Code:</label>
								<input type="text">
							</li>
						</ul>
						<a class="btn btn-default update" href="">Get Quotes</a>
						<a class="btn btn-default check_out" href="">Continue</a>
					</div>
				</div> --}}
				<div class="col-sm-8">
					<div class="total_area">
						<ul>
							<li>Cart Sub Total <span>{{Cart::subtotal()}} Tk</span></li>
							<li>Eco Tax <span>{{Cart::tax()}} Tk</span></li>
							<li>Shipping Cost <span>Free</span></li>
							<li>Total <span>{{Cart::total()}} Tk</span></li>
						</ul>
							<a class="btn btn-default check_out" href="{{URL::to('/login-check')}}">Check Out</a>
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->




@endsection