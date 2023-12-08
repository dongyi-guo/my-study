@extends('layout')
@section('content')

  <!-- Master Page Section: Staff -->
  <section class="master">
    <!-- Create a new computer in the stock -->
    <button
      class="btn-add btn-basic"
      data-bs-toggle="modal"
      data-bs-target="#compModal"
    >
      Add New
    </button>

    <!-- Computer Modal -->
    <div class="modal fade" id="compModal">
      @csrf
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Create a New Computer</h4>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
            ></button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <!-- Form to create a new computer -->
            <form class="form" action="/createComputer" method="POST" enctype="multipart/form-data">
              @csrf
              <!-- upload an image -->
              <div class="form-group">
                <label class="custom-file-label" for="image"
                  >Computer Image</label
                >
                <!-- check image input, client-side verification -->
                <input
                  type="file"
                  class="form-control"
                  id="image"
                  accept="image/*"
                  name="image"
                  required
                />
                @error('image')
                  <p>{{$message}}</p>
                @enderror
              </div>

              <!-- enter a brand -->
              <div class="form-group">
                <label for="brand" class="form-label">Brand</label>
                <input
                  type="text"
                  class="form-control"
                  id="brand"
                  name="brand"
                  required
                />
              @error('brand')
                <p>{{$message}}</p>
              @enderror
              </div>

              <!-- enter a rental price for the computer -->
              <div class="form-group">
                <label for="price" class="form-label">Price per hour</label>
                <input
                  type="number"
                  class="form-control"
                  id="price"
                  name="price"
                  required
                />
                @error('price')
                  <p>{{$message}}</p>
                @enderror
              </div>

              <!-- choose an operating system -->
              <div class="form-group">
                <label for="system" class="form-label"
                  >Operating System</label
                >
                <input
                  list="systems"
                  class="form-control"
                  id="system"
                  name="system"
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

              <!-- enter the display size -->
              <div class="form-group">
                <label for="display" class="form-label">Display Size</label>
                <input
                  type="text"
                  class="form-control"
                  id="display"
                  name="display"
                  required
                />
                @error('display')
                  <p>{{$message}}</p>
                @enderror
              </div>

              <!-- enter the number of RAM -->
              <div class="form-group">
                <label for="ram" class="form-label">RAM</label>
                <input
                  type="number"
                  class="form-control"
                  id="ram"
                  name="ram"
                  required
                />
                @error('ram')
                  <p>{{$message}}</p>
                @enderror
              </div>

              <!-- enter the number of usb port -->
              <div class="form-group">
                <label for="usbCount" class="form-label"
                  >USB port</label
                >
                <input
                  type="number"
                  class="form-control"
                  id="usbCount"
                  name="usbCount"
                  required
                />
                @error('usbCount')
                  <p>{{$message}}</p>
                @enderror
              </div>

              <!-- enter the number of HDMI port -->
              <div class="form-group">
                <label for="hdmi" class="form-label">HDMI port</label>
                <input
                  type="number"
                  class="form-control"
                  id="hdmi"
                  name="hdmi"
                  required
                />
                @error('hdmi')
                  <p>{{$message}}</p>
                @enderror
              </div>

              <!-- Close button -->
              <button
                type="button"
                class="btn btn-danger"
                data-bs-dismiss="modal"
              >
                Close
              </button>

              <!-- Submit button -->
              <button type="submit" class="btn btn-primary float-right">
                Submit
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>

    @if (!$computers->isEmpty())

    <ul class="computer-list">
      @foreach ($computers as $computer)
        <x-computer-master :computer="$computer"/>
      @endforeach
    </ul>

  @endif
  </section>

@endsection
