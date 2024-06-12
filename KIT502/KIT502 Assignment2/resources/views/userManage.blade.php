@extends('layout')
@section('content')
  <!-- User Manage section -->
  <section class="table_page">

    <!-- For Staff -->

    <!-- All Customer -->
    <div class="lg"> All Customer List </div>
    <table class="table_view">
        <thead>
            <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Number</th>
            <th>Balance</th>
            <th>Is Student</th>
            <th>Damage Time</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customers as $customer)

            @if ($users->find($customer->id) != NULL)
            <tr>
                <x-customer-view :customer="$customer" :users="$users"/>
            </tr>
            @endif

            @endforeach
        </tbody>
    </table>

    <!-- Blacklisted Customer -->
    <div class="lg"> Customer Black List </div>
    <table class="table_view">
        <thead>
            <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Number</th>
            <th>Balance</th>
            <th>Is Student</th>
            <th>Damage Time</th>

            <!-- Web Manager only -->
            @if (auth()->user()->accessLevel == 2)
            <th>Action</th>
            @endif

            </tr>
        </thead>
        <tbody>
            @foreach ($customers as $customer)

            @if ($customer->damageTime >= 3)
            <tr>
                <x-customer-view :customer="$customer" :users="$users"/>

                <!-- Web Manager only -->
                @if (auth()->user()->accessLevel == 2)
                <td>
                    <form method="POST" action="/user/manage/unblacklist/{{$customer->id}}">
                        @csrf
                        @method('PUT')
                        <button class="btn btn-danger" type="submit">Unblacklist</button>
                    </form>
                </td>
                @endif

            </tr>
            @endif

            @endforeach
        </tbody>
    </table>

    
    <!-- For Web Manager only -->
    @if (auth()->user()->accessLevel == 2)

    <!-- Manage staff (add, remove staff) -->
    <div class="lg"> All Staff List </div>
    <table class="table_view">
        <thead>
            <tr>
            <th>ID</th>       
            <th>Name</th>
            <th>Email</th>
            <th>Number</th>
            <th>Access Level</th>
            <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)

            <!-- filter out the Customers from Users -->
            @if ($user->accessLevel != 0)
            <x-staff-view :user="$user"/>
            @endif

            @endforeach
            <tfoot>
                <td colspan="6">
                <button class="btn btn-basic btn-size" data-bs-toggle="modal" 
                data-bs-target="#addStaffModal">Add A New Staff</button>
                </td>
            </tfoot>
        </tbody>
    </table>

    <!-- Confirm Staff Removal Modal -->
    <div class="modal fade" id="confirmModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Removal Confirm</h4>
                    <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    ></button>
                </div>
    
                <!-- Modal body -->
                <div class="modal-body">
                    <form class="form" method="POST" action="/user/manage/delete/{{$user->id}}">
                        @csrf
                        @method('DELETE')
                        <!-- Submit button -->
                        <button class="btn btn-primary float-right">
                            Confirm
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add New Staff Modal -->
    <div class="modal fade" id="addStaffModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add a new staff</h4>
                    <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    ></button>
                </div>
    
                <!-- Modal body -->
                <div class="modal-body">
                    <form class="form" method="POST" action="/user/manage/create">
                        @csrf
                        
                        <!-- User Name -->
                        <div class="form-group">
                          <label for="name" class="form-label">Staff User Name</label>
                          <input type="text" class="form-control" id="name" name="name" required>
                          @error('name')
                            <p>{{$message}}</p>   
                          @enderror
                        </div>
                
                        <!-- Email -->
                        <div class="form-group">
                            <label for="email" class="form-label">Staff Email</label>
                            <input class="form-control" name="email" type="email" required/>
                            @error('email')
                                <p>{{$message}}</p>   
                            @enderror
                        </div>

                        <!-- Number -->
                        <div class="form-group">
                            <label for="number" class="form-label">Staff Number</label>
                            <input class="form-control" name="number" type="number" required/>
                            @error('number')
                                <p>{{$message}}</p>   
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="form-group">
                            <label for="password" class="form-label">Staff Password</label>
                            <input class="form-control" name="password" type="password" required/>
                            @error('password')
                                <p>{{$message}}</p>   
                            @enderror
                        </div>
                    
                        <!-- Confirm Password -->
                        <div class="form-group">
                            <label for="password_confirmation" class="form-label">Staff Password Confirm </label>
                            <input class="form-control" name="password_confirmation" type="password" required="required"/>
                            @error('password_confirmation')
                                <p>{{$message}}</p>   
                            @enderror
                        </div>
        
                      <!-- Submit button -->
                      <button type="submit" class="btn btn-primary float-right">
                        Create
                      </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif

  </section>
@endsection

