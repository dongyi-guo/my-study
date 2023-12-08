@extends('layout')
@section('content')

<section class="create_rent">

    <!-- Back to Rental Page -->
    <a class="btn_back" href="/rental">
        <i class="fa fa-solid fa-chevron-left"></i>
        Go Back
    </a>

    <div class="create_rent_align">

        <!-- View computer iamge -->
        <img src="/storage/{{$computer->image}}" />

        <!-- Create Rent Form -->
        <form class="create_rent_form" action="/rental/update/{{$computer->id}}" method="POST">
            @csrf
            @method('PUT')

            <!-- View computer info-->
            <div class="create_rent_group">
                <div>Brand:</div>
                <div>{{$computer->brand}}</div>
            </div>
        
            <div class="create_rent_group">
                <div>Price:</div>
                <div>$ {{$computer->price}}/h</div>
            </div>

            <!-- Enter number of hours of renting (5 hours max) -->
            <div class="create_rent_group">
                <label for="hours">Select the rental hours:</label>
                <select class="create_rent_input" name="hours" id="hours">
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>

            <!-- Insurance checkbox -->
            <div class="form-check insurance">

                <!-- A hidden input gives insurance a defalut value of false -->
                <input type="hidden" name="insurance" value="0"/>
                <input class="form-check-input" type="checkbox" id="insurance" name="insurance" value="10"/>
                <label class="form-check-label" for="insurance">I want an Insurance</label><br>
            </div>

            <!-- View Calculated Price -->
            <div class="create_rent_group mg">
                Total Price: <p id="calculated_price">$ 50</p>
                <input type="hidden" id="price" name="balance" value="50">
            </div>

            <!-- Price constructions -->
            <div class="price_note">
                <p>(Deposit: $50)</p>
                <p id="discount_note"></p>
            </div>

            <!-- View current user's balance -->
            <div class="create_rent_group mg">
                <div>Your balance:</div> 
                <div>$ {{$customer->balance}}</div>
            </div>

            <!-- Submit: can not submit if balance is not enough -->
            <input id="submit" class="btn btn-basic btn_rent_create rg" type="submit" value="Submit"/>
        </form>

    </div>

</section>

<!-- Jquery -->
<script>

    var price_hour = 0;
    var price_insurance = 0;
    var calculated_price = 0;
    var deposit = 50;

    // Show the Student discount text if the user is student
    if ({{$customer->isStudent}}) {
        $('#discount_note').text('(Student Discount: -10%)');
    }

    // Price calulator, hour base part
    $('#hours').change(function() {

        // set the rental price based on the insurance tick box and hour selection box
        price_hour = $('#hours').val() * {{$computer->price}};

        // give the calculate price a student discount
        if ({{$customer->isStudent}}) {
            calculated_price = (price_hour * 0.9 + price_insurance + deposit).toFixed(1);
        }
        else {
            calculated_price = price_hour + price_insurance + deposit
        }
        $('#calculated_price').text('$ '+calculated_price);

        // set value to the hidden price input
        $('#price').val(calculated_price);
    })

    // Price calulator, insurance part
    $('#insurance').change(function() {

        // set the rental price based on the insurance tick box and hour selection box
        $('#insurance').is(':checked') ? price_insurance = 10 : price_insurance = 0

        // give the calculate price a student discount
        if ({{$customer->isStudent}}) {
            calculated_price = (price_hour * 0.9 + price_insurance + deposit).toFixed(1);
        }
        else {
            calculated_price = price_hour + price_insurance + deposit
        }
        $('#calculated_price').text('$ '+calculated_price);

        // set value to the hidden price input
        $('#price').val(calculated_price);
    })

    $('form').submit(function(e) {

        // If the user does not have enought balance, stop the form submission
        if ({{$customer->balance}} < $('#price').val()) {
            e.preventDefault();
            alert("Insufficient Funds")
        }

    })

</script>

@endsection