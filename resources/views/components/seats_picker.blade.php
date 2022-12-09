@push('styles')
  <style>
    /* TODO: make responsive */
    .seat-row>div {
      display: inline-block;
      height: 24px;
      width: 20px;
      margin: 6px;
      font-size: 0.9rem;
    }

    .seat {
      background-color: grey;
      border-radius: 20% 20% 0 0;

      transition: background-color 200ms ease,
        box-shadow 300ms ease;
    }

    .seat-row {
      display: flex;
      flex-direction: row;
      align-items: center;
      justify-content: center;

      text-align: center;

      font-weight: bold;
      color: gray;
    }

    .seat.occupied {
      background-color: orangered;
    }

    .seat.selected {
      background-color: greenyellow;
      box-shadow: 0px 0px 15px greenyellow;
    }

    .seat:not(.selected):not(.occupied):hover {
      box-shadow: 0px 0px 20px gray;
    }

    .seat-row>div:nth-child(7),
    .seat-row>div:nth-child(10) {
      margin-right: 16px;
    }

    /* Prevent user from accidentally selecting the seats like a text
     *
     * Fetched from:
     * https://stackoverflow.com/questions/2326004/prevent-selection-in-html
     */
    #seats-picker {
      -moz-user-select: -moz-none;
      -khtml-user-select: none;
      -webkit-user-select: none;

      /*
        Introduced in IE 10.
        See http://ie.microsoft.com/testdrive/HTML5/msUserSelect/
      */
      -ms-user-select: none;
      user-select: none;
    }

    #seats-picker.disabled {
      opacity: 50%;
      transition: opacity 500ms ease;
    }
  </style>
@endpush

@push('scripts')
  @isset($seats)
    <script>
      pushedSeats = {{ Illuminate\Support\Js::from($seats) }};
    </script>
  @endisset
  <script src="assets/seats-picker.js"></script>
@endpush


<div class="card">
  <h4 class="card-header">
    @isset($seats)
      Choose your seats
    @else
      Browse seats
    @endisset
  </h4>


  {{-- TODO: add screen --}}
  <div class="card-body">
    {{-- <div class="form-group row">
      <label class="col-md-3 col-form-label" for="time-slot-input"></label>
      <select id="time-slot-input"></select>
    </div> --}}

    @isset($seats)
    @else
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="branch-input">Branch</label>
          @isset($branches)
            <select class="form-control" id="branch-input" onchange="hallsSelectHandler(this)">
              <option hidden disabled selected value> -- Choose a branch -- </option>
              @foreach ($branches as $branch)
                <option value="{{ $branch['id'] }}">
                  {{ $branch['name'] }}
                </option>
              @endforeach
            </select>
          @else
            <select class="form-control" id="branch-input"> </select>
          @endisset
        </div>
        <div class="form-group col-md-6">
          <label for="hall-input"> Hall </label>
          <select class="form-control" name="hid" id="hall-input" onchange="timeSlotsSelectHandler(this)" disabled>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label for="time-slot-input"> Time Slot</label>
        <select class="form-control" id="time-slot-input" onchange="seatsPickerHandler(this)" disabled> </select>
      </div>
    @endisset

    <div id="seats-picker" class="my-4 disabled">
      <div class="seat-row">
        <div></div>
        @foreach (range(1, 15) as $j)
          <div> {{ $j }} </div>
        @endforeach
      </div>
      @foreach (range('A', 'E') as $i)
        <div class="seat-row">
          <div> {{ $i }} </div>
          @foreach (range(1, 15) as $j)
            <div class='seat' id="{{ $i . sprintf('%02d', $j) }}"></div>
          @endforeach
        </div>
      @endforeach
    </div>


    <div class="row mx-3">
      @isset($seats)
        <div class="price-container">
          Total Price: <span id="price-output"> 0 </span> BD
        </div>
      @endisset
      <div class="legend seat-row" style="margin-left: auto">
        <div class="seat"></div> available
        <div class="seat selected"></div> selected
        <div class="seat occupied"></div> occupied
      </div>
    </div>

    @isset($seats)
      <button id="continue-btn" class="btn btn-primary mt-3" disabled>Continue</button>
    @endisset
  </div>
</div>

<br>
<br>
<br>
<br>
<button class="btn btn-secondary" id="tmp">tmp</button>
