@extends('home')
@section('content')
    <div class="col-6 m-auto">
        <form  method="post" class="p-3 border border-primary" action="alert"> 
            @csrf
            <div class="form-group row">
                <label class="col-3">Email</label>
                <div class="col-9">
                    <input type="text" class="form-control" name="email">
                </div>
                <span class="error-message">{{ $errors->first('email') }}</span>
            </div>
            <div class="form-group row">
                <label class="col-3">Chủ đề</label>
                <div class="col-9">
                    <input type="text" class="form-control" name="subject">
                </div>
                <span class="error-message">{{ $errors->first('subject') }}</span>
            </div>
            <div class="form-group row">
                <label class="col-3">Nội dung</label>
                <div class="col-9">
                    <textarea rows="5" cols="40" class="form-control" name="message"></textarea>
                </div>
                <span class="error-message">{{ $errors->first('message') }}</span>
            </div>
            <div class="form-group row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary w-25">Feedback</button>
                </div>
            </div>
        </form> 
    </div>
@endsection