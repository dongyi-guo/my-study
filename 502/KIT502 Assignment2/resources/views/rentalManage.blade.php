@extends('layout')
@section('content')
  <!-- Manage return section: Staff -->
    <section class="table_page">

        <!-- If there are currently computers waiting for return confirmation -->
        @if (!$computers->isEmpty())
        <!-- Return pending Computer List -->
        <div class="return_title"> Rental List </div>
        <table class="table_view">
            <thead>
                <tr>
                <th>Action</th>
                <th>Brand</th>
                <th>System</th>
                <th>Price</th>
                <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($computers as $computer)
                <x-computer-manage :computer="$computer"/>
                @endforeach
            </tbody>
        </table>

        <!-- Damage selection Modal -->
        <div class="modal fade" id="damageModal">
            <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                <h4 class="modal-title">Status Check</h4>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                ></button>
                </div>
    
                <!-- Modal body -->
                <div class="modal-body">
                <form class="form" method="POST" action="/return/confirm/{{$computer->id}}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="isDamaged" class="form-label">Damage Condition</label>
                        <select class="form-control" name="isDamaged" id="isDamaged">
                            <option value="0">No Damage</option>
                            <option value="1">Minor Damage</option>
                            <option value="2">Major Damage</option>
                        </select>

                        @error('name')
                            <p>{{$message}}</p>   
                        @enderror
                    </div>
    
                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary float-right">
                    Submit
                    </button>
                </form>
                </div>
            </div>
            </div>
        </div>

    @else
        <div class="lg">No Computer Pending Return</div>
    @endif
    </section>
@endsection