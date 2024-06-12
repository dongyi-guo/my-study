@extends('logged.layout')

@section('title', 'Fee and Tax Management')

@section('content')
<h1>Fee and Tax Management</h1>
<br>
<table id="table1" class="my-4">
  <tr>
    <th></th>
    <th>Market Price</th>
    <th>Administration Fee</th>
    <th>Tax Rate</th>
  </tr>
  <tr>
    <th>Current Price</td>
    <td><span id="lblCurrentMarketPrice"></span></td>
    <td><span id="lblCurrentAdminFee"></span></td>
    <td><span id="lblCurrentTaxRate"></span></td>
  </tr>
  <tr>
    <th>View History</td>
    <td><button type="button" class="btn btn-outline-dark" onclick="ViewPrice(1)">View Market Price</button></td>
    <td><button type="button" class="btn btn-outline-dark" onclick="ViewPrice(2)">View Administration Fee</button></td>
    <td><button type="button" class="btn btn-outline-dark" onclick="ViewPrice(3)">View Tax Rate</button></td>
  </tr>
  <tr>
    <th>Update Fee</td>
    <td><button type="button" class="btn btn-outline-dark" onclick="ShowPriceSection(1)">Update Market Price</button></td>
    <td><button type="button" class="btn btn-outline-dark" onclick="ShowPriceSection(2)">Update Administration Fee</button></td>
    <td><button type="button" class="btn btn-outline-dark" onclick="ShowPriceSection(3)">Update Tax Rate</button></td>
  </tr>
</table>

<div id="divPriceList" class="my-4">
	<span id="lblPriceInfo"></span>
</div>

<div id="divUpdatePriceForm" class="col-sm-12 col-md-6 col-lg-3">
	@csrf
    <div class="card">
      <div class="card-body">
        <label id="lblUpdatePrice" for="txtUpdatePrice">Enter updated Price</label />
    	<input type="" class="form-control my-4" id="txtUpdatePrice" placeholder="Enter updated price here" /> 
        <input id="lblId" type="hidden" value="" />
        
        <div class="">
      		<button type="reset" class="btn btn-sm btn-danger" onclick="ClearPrice()" style="max-width: 100px; margin-right: 15px;">Clear</button>
  			<button type="submit" class="btn btn-sm btn-primary" onclick="SaveNewPrice()" style="max-width: 100px;">Submit</button>
      	</div>
      </div>
    </div>
</div>

<style>
  #table1 {
    font-family: Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
  }

  #table1 th{
        background-color: #87CEEB;
        color: #000000;
        font-weight: bold;
  }

  #table1 td, #table1 th {
        padding: 8px;
  }

  #table1 tr{
        border-bottom: 1px solid #ddd;
  }

  #table1 tr:nth-child(even){background-color: #D5FFFF;}  
</style>

<script type="text/javascript">
    $(document).ready(function () {
        $("#divPriceList").hide();
        $("#divUpdatePriceForm").hide();

		UpdateCurrentPrice();
    });

	function UpdateCurrentPrice() {   
        var objXMLHttpRequest = new XMLHttpRequest();
        objXMLHttpRequest.onreadystatechange = function() {
            if(objXMLHttpRequest.readyState === 4) {
                if(objXMLHttpRequest.status === 200) {
                    const jsonObj = JSON.parse(objXMLHttpRequest.responseText);
                    $("#lblCurrentMarketPrice").html('$' + jsonObj.marketFee);
                	$("#lblCurrentAdminFee").html('$' + jsonObj.adminFee);
                	$("#lblCurrentTaxRate").html(jsonObj.taxRate + '%');
                }
            }
        }

        objXMLHttpRequest.open('GET', 'GetCurrentPrice/');
        objXMLHttpRequest.send();
    }

    function ViewPrice(id) {
    	$("#divPriceList").show();
        $("#divUpdatePriceForm").hide();
    
        var objXMLHttpRequest = new XMLHttpRequest();
        objXMLHttpRequest.onreadystatechange = function() {
            if(objXMLHttpRequest.readyState === 4) {
                if(objXMLHttpRequest.status === 200) {
                    const jsonObj = JSON.parse(objXMLHttpRequest.responseText);
                    $("#lblPriceInfo").html(jsonObj.data);
                }
            }
        }

        objXMLHttpRequest.open('GET', 'ShowFeePrices/' + id);
        objXMLHttpRequest.send();
    }

	function ShowPriceSection(id) {
    	$("#divPriceList").hide();
        $("#divUpdatePriceForm").show();
    	str = "";
    
    	if (id == 1) {
        	str = "Enter Market Price";
        } else if (id == 2) {
        	str = "Enter Administration Fee";
        } else if (id == 3) {
        	str = "Enter Tax Rate";
        }
    
    	$('#lblUpdatePrice').text(str);
        $('#txtUpdatePrice').attr('placeholder', str);
    	document.getElementById("lblId").setAttribute('value', id);
    }

	function ClearPrice() {
    	document.getElementById('txtUpdatePrice').value = "";
    }

	function SaveNewPrice() {
    	var id = document.getElementById('lblId').value;
    	var price = document.getElementById('txtUpdatePrice').value;
    	console.log("id: " + id);
    	console.log(price);
        
        if (isNaN(price)) {
            alert("Please enter a valid number");
            return;
        }

        $.ajax({
            url: 'SaveMarketPrice/',
            type: 'POST',
            datatype: 'json',
            data: {
                "_token": "{{ csrf_token() }}",
                id: id, 
                price: price
            },
            success: function(msg) {
                console.log(msg);
                msg = msg.data;

                if(msg.length == 0) {
                    alert("Price has been added.");
                	UpdateCurrentPrice();	
                	ClearPrice();
                    ViewPrice(id);
                } else {
                    alert(msg);
                }
            },
            error: function(msg) {
                alert("An error occurred. Details: " + msg);
            }
        });
    }
</script>

@endsection