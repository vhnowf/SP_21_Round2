@extends('layouts.app')
@section('return-content')
    <div class="card card-4">
      <div class="card-body">
          <h2 class="title">Product Return</h2>
          <form method="POST" action="{{route("return.store")}}" enctype="multipart/form-data">
            <h4 style="margin-bottom: 20px">1. Order information</h4>
              <div class="row row-space">
                  <div class="col-md-6 col-xs-12">
                      <div class="input-group">
                          <label class="label">Name</label>
                          <input class="input--style-4" type="text" name="name">
                      </div>
                  </div>
              </div>
              <div class="row row-space">
                <div class="col-md-6 col-xs-12">
                    <div class="input-group">
                        <label class="label">E-Mail</label>
                        <input class="input--style-4" type="email" name="email">
                    </div>
                </div>
                <div class="col-md-6 col-xs-12">
                    <div class="input-group">
                        <label class="label">Phone number</label>
                        <input class="input--style-4" type="tel" name="phone">
                    </div>
                </div>
            </div>
              <div class="row row-space">
                  <div class="col-md-6 col-xs-3">
                    <div class="input-group">
                        <label class="label">Order ID</label>
                        <div class="input-group">
                            <input class="input--style-4" type="text" name="order_id">
                        </div>
                    </div>
                  </div>
              </div>
            <h4 style="margin-bottom: 20px">2. Product information</h4>
            <div class="row row-space">
              <div class="col-md-6 col-xs-12">
                  <div class="input-group">
                      <label class="label">Product name</label>
                      <input class="input--style-4" type="text" name="product_name">
                  </div>
              </div>
              <div class="col-md-6 col-xs-12">
                  <div class="input-group">
                      <label class="label">Product code</label>
                      <input class="input--style-4" type="text" name="product_code">
                  </div>
              </div>
            </div>
            <div class="row">
              <div class="col-4">
                  <div class="input-group">
                      <label class="label">Quantity</label>
                      <input class="input--style-4" type="number" name="quantity">
                  </div>
              </div>
            </div>
           <div class="row">
              <div class="col-4">
                <label for="photo">{{ trans('cruds.return.fields.photo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('photo') ? 'is-invalid' : '' }}" id="photo-dropzone">
                </div>
                @if($errors->has('photo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('photo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.return.fields.photo_helper') }}</span>
                </div>
            </div> 
            <h5 style="margin-bottom: 20px; font-size: 16px">Reasons of Return</h5>
            <div style="margin-left : 40px" class="row">
            <div class="col-12"> 
              <input id="option-one" name="radio" value="Dead On Arrival" checked="checked" type="radio"> 
              <label for="option-one"> 
                <span></span> Dead On Arrival
              </label> 
            </div> 
            <div class="col-12"> 
              <input id="option-two" name="radio" value="Faulty, please supply details" type="radio"> 
              <label for="option-two"> <span></span> Faulty, please supply details
              </label> 
            </div>
            <div class="col-12"> 
              <input id="option-three" name="radio" value="Order error" type="radio"> 
              <label for="option-three"> <span></span> Order error
              </label> 
            </div>
            <div class="col-12"> 
              <input id="option-four" name="radio" value="Others, please supply details" type="radio"> 
              <label for="option-four"> <span></span> Others, please supply details
              </label> 
            </div>
            <div class="col-12"> 
              <input id="option-five" name="radio" value="Received wrong Item" type="radio"> 
              <label for="option-five"> <span></span> Received wrong item
              </label> 
            </div>
          </div>
          <div class="row form-group">
            <div class="col-12">
              <label style="font-size:16px; margin:30px 0 20px 0" for="exampleFormControlTextarea1">Faulty or other details</label>
              <textarea placeholder="Faulty or other details" class="form-control col-12" id="exampleFormControlTextarea1" rows="4"></textarea>
            </div>
          </div>
              <div style=" margin-top: 20px;"
              class="p-t-15">
                  <button class="btn btn--radius-2 btn--blue" type="submit">Submit</button>
              </div>
          </form>
      </div>
</section>
@endsection

@section('scripts')
<script>
    Dropzone.options.photoDropzone = {
    url: '{{ route('return.storeMedia') }}',
    maxFilesize: 5, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="photo"]').remove()
      $('form').append('<input type="hidden" name="photo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="photo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($coupon) && $coupon->photo)
      var file = {!! json_encode($coupon->photo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="photo" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}
</script>
@endsection