@extends('logged.layout')

@section('title', 'Buy Product')

@section('content')
<div class="container">
    <div class="">
        <div class="p-2">
            <h1>Buy a Product</h1>
        </div>
		<div class="">    
        	<span id="lblMessage" class=""></span>
       	</div>
        <div class="row">
            <div class="col-sm-12 col-md-8">
                @csrf
                <div class="mb-3 d-none">
                    <input type="hidden" class="form-control" name="id" id="id" value="{{$product->id}}">
                </div>
                <div class="mb-3">
                    <label for="ownerId" class="form-label">Owner:</label>
                    <input type="text" class="form-control" name="ownerId" id="ownerId" value="{{$product->ownerName}}" disabled>
                </div>
                <div class="mb-3">
                    <label for="energyTypeId" class="form-label">Type:</label>
                    <select class="form-select" id="energyTypeId" name="energyTypeId" required>
                        <option value="" selected>Select the Energy Type:</option>
                        @foreach ($energy_types as $type)
                        	<option value="{{$type->id}}">{{$type->typeName}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="zoneId" class="form-label">Zone:</label>
                    <select class="form-select" id="zoneId" name="zoneId" required >
                        <option value="" selected>Select the Zone</option>
                        @foreach ($zones as $zone)
                        <option value="{{$zone->id}}">{{$zone->zoneName}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="volume" class="form-label">Volume</label>
                    <input type="number" class="form-control" name="volume" id="volume" onchange="GetPrice()">
                </div>
                <div class="mb-3">
                    <label for="sellerPrice" class="form-label">Price</label>
                    <input type="number" class="form-control" name="sellerPrice" id="sellerPrice">
                </div>
                <button id="btnSaveBuy" type="submit" class="btn btn-primary" onclick="ValidateBuyAndSave()">Save Purchase</button>
            </div>
            <div class="col-sm-12 col-md-4">
            	<div class="card border-light mb-3">
  					<div class="card-body">
                    	<h5>Owner Details</h5>
                    	<hr />
    					<h6 class="card-title">{{$owner->userName}}</h6>
    					<span class="card-text">Address: {{$owner->postalAddress}}</span>
                        <br />
                        <span class="card-text">Email: <a href="mailto:{{$owner->email}}">{{$owner->email}}</a></span>
  					</div>
				</div>
                <div class="card border-light mb-3">
  					<div class="card-body">
                    	<h5>Buyer Details</h5>
                    	<hr />
    					<h6 class="card-title">{{Auth::user()->userName}}</h6>
    					<span class="card-text">Address: {{Auth::user()->postalAddress}}</span>
                        <br />
                        <span class="card-text">Available Balance: <b>{{Auth::user()->balance}}</b></span>
  					</div>
				</div>
                <div class="card border-light mb-3" id="divPriceCalculation">
  					<div class="card-body">
                    	<h5>Price Calculation</h5>
                    	<hr />
    					<span class="small" id="spanPriceCalculation"></span>
  					</div>
				</div>
                        
                <input id="lblFeeId" type="hidden" value="" />
                <input id="lblTax" type="hidden" value="" />
                <input id="lblAdminFee" type="hidden" value="" />
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        const energyTypeId = document.querySelector('#energyTypeId');
	  	energyTypeId.value = {{$product->energyTypeId}};
                    
        const zoneId = document.querySelector('#zoneId');
	  	zoneId.value = {{$product->zoneId}};
                        
        $('#sellerPrice').attr('readonly', true);
        $('#sellerPrice').css('background-color' , '#DEDEDE');
        $("#divPriceCalculation").hide();
                        
        GetPrice();
    });

	function ShowMessage(message) {
    	str = "<div class='alert alert-info' role='alert'>" + message + "</div>";
    	$("#lblMessage").html(str);
    }

	function GetPrice() {    
    	var volume = document.getElementById('volume').value;
    
    	if(volume.trim() == "" || volume == "0" || isNaN(volume)) {
        	document.getElementById("sellerPrice").value = ""; 
        	$("#divPriceCalculation").hide();
            $("#spanPriceCalculation").html("");
        	return;
        }
    	
    	$.ajax({
            url: 'CalculateProductPrice/',
            type: 'POST',
            datatype: 'json',
            data: {
            	"_token": "{{ csrf_token() }}",
                productId: {{$product->id}}, 
                volume: volume
            },
            success: function(msg) {
                document.getElementById("sellerPrice").value = msg.tradePrice; 
            	var str = "Price: " + (msg.averagePrice*volume) + "<br />Tax: " + msg.tax + "<br />Administration fee: " + msg.adminFee + "<hr /><b>Total price: " + msg.tradePrice + "</b>";
            
            	$("#divPriceCalculation").show();
            	$("#spanPriceCalculation").html(str);
            
            	document.getElementById("lblFeeId").setAttribute('value', msg.feeId);
            	document.getElementById("lblTax").setAttribute('value', msg.tax);
            	document.getElementById("lblAdminFee").setAttribute('value', msg.adminFee);
            },
            error: function(msg) {
                console.log("An error occurred.");
            }
        });
    }

	function ValidateBuyAndSave() {
    	console.log('a');
    	var volume = document.getElementById('volume').value;
    
    	if (volume.trim() == "") {
            alert("Please enter volume.");
            return;
        }
    
    	if (isNaN(volume)) {
        	ShowMessage("Volume should contain numbers only.");
            return;
        }
    
    	availableVolume = {{$product->volume}}
    
    	if(volume > availableVolume) {
        	ShowMessage("Volume exceeded the maximum available volume (" + availableVolume + ").");
            return;
        }
    
    	var totalPrice = document.getElementById('sellerPrice').value;
    
    	if(totalPrice > {{Auth::user()->balance}}) {
        	ShowMessage("You do not have enough balance for this purchase. Please top-up and try again.");
            return;
        }
    
    	var feeId = document.getElementById('lblFeeId').value;
    	var tax = document.getElementById('lblTax').value;
    	var adminFee = document.getElementById('lblAdminFee').value;
    
    	$.ajax({
            url: 'https://ictteach-www.its.utas.edu.au/groupwork/kit502-group-14/asm2/public/index.php/logged/SaveProductPurchase',
            type: 'POST',
            datatype: 'json',
            data: {
            	"_token": "{{ csrf_token() }}",
            	productId: {{$product->id}}, 
            	volume: volume,
                feeId: feeId,
                tradePrice: totalPrice,
                tax : tax,
                adminFee: adminFee
            },
        	success: function(msg) {
               	if(msg.data.length == 0) {
               		ShowMessage("Your purchase has been completed.");
            	} else {
               		ShowMessage(msg.data);
            	}
            },
            	error: function(msg) {
                ShowMessage("An error occurred. Please contact administrator.");
            }
        });
    }
</script>
@endsection