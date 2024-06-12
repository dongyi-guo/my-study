@extends('layout')
@section('content')

<!-- Computer Detail Editing Page -->
<section class="edit_computer">

    <a class="btn_back" href="/master">
        <i class="fa fa-solid fa-chevron-left"></i>
        Go Back
      </a>

    <form class="form edit_computer_form" method="POST" action="/master/edit/{{$computer->id}}">
        @csrf
        @method('PUT')

        <!-- enter the new brand -->
        <div class="form-group">
            <label for="brand" class="form-label">Enter the new Brand:</label>
            <input
            type="text"
            class="form-control"
            id="brand"
            name="brand"
            value={{$computer->brand}}
            required
            />
        @error('brand')
            <p>{{$message}}</p>
        @enderror
        </div>

        <!-- enter the new price of the given computer -->
        <div class="form-group">
        <label for="price" class="form-label"
            >Enter the new Price: </label
        >
        <input
            type="number"
            class="form-control"
            id="price"
            name="price"
            value={{$computer->price}}
            required
        />
        @error('price')
            <p>{{$message}}</p>   
        @enderror
        </div>

        <!-- choose an operating system -->
        <div class="form-group">
            <label for="system" class="form-label"
            >Choose a new Operating System:</label
            >
            <input
            list="systems"
            class="form-control"
            id="system"
            name="system"
            placeholder={{$computer->system}}
            required
            />
            <datalist id="systems">
            <option value="Ios"></option>
            <option value="Windows"></option>
            <option value="Linux"></option>
            </datalist>
            @error('system')
            <p>{{$message}}</p>
            @enderror
        </div>

        <!-- enter the new display size -->
        <div class="form-group">
            <label for="display" class="form-label">Enter the new Display Size:</label>
            <input
            type="text"
            class="form-control"
            id="display"
            name="display"
            value={{$computer->display}}
            required
            />
            @error('display')
            <p>{{$message}}</p>
            @enderror
        </div>

        <!-- enter the new RAM -->
        <div class="form-group">
            <label for="ram" class="form-label">Enter the new RAM:</label>
            <input
            type="number"
            class="form-control"
            id="ram"
            name="ram"
            value={{$computer->ram}}
            required
            />
            @error('ram')
            <p>{{$message}}</p>
            @enderror
        </div>

        <!-- enter the new number of usb port -->
        <div class="form-group">
            <label for="usbCount" class="form-label"
            >Enter the new number of USB port</label
            >
            <input
            type="number"
            class="form-control"
            id="usbCount"
            name="usbCount"
            value={{$computer->usbCount}}
            required
            />
            @error('usbCount')
            <p>{{$message}}</p>
            @enderror
        </div>

        <!-- enter the number of HDMI port -->
        <div class="form-group">
            <label for="hdmi" class="form-label">Enter the new number of HDMI port</label>
            <input
            type="number"
            class="form-control"
            id="hdmi"
            name="hdmi"
            value={{$computer->hdmi}}
            required
            />
            @error('hdmi')
            <p>{{$message}}</p>
            @enderror
        </div>

        <!-- Submit button -->
        <button type="submit" class="btn btn-primary float-right">
        Submit
        </button>
    </form>
</section>