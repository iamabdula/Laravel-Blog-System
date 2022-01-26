@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Post</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row">
                        <form method="POST" action="{{ url('/editPost',array($posts->id)) }}" aria-label="{{ __('Register') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="post_title" class="col-md-4 col-form-label text-md-right">{{ __('Post Title') }}</label>
                                <div class="col-md-6">
                                    <input id="post_title" type="post_title" class="form-control{{ $errors->has('post_title') ? ' is-invalid' : '' }}" name="post_title" value="{{ $posts->post_title }}" required autofocus>
                                    @if ($errors->has('post_title'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('post_title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="post_body" class="col-md-4 col-form-label text-md-right">{{ __('Post Body') }}</label>
                                <div class="col-md-6">
                                    <textarea id="post_body" rows="5" cols="90" class="form-control{{ $errors->has('post_body') ? ' is-invalid' : '' }}" name="post_body"> {{ $posts->post_body }}
                                    </textarea>
                                    @if ($errors->has('post_body'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('post_body') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>                            
                            <div class="form-group row">
                                <label for="post_image" class="col-md-4 col-form-label text-md-right">{{ __('Featured Image') }}</label>
                                <div class="col-md-6">
                                    <input id="post_image" type="file" value="{{$posts->post_image}}" class="form-control{{ $errors->has('post_image') ? ' is-invalid' : '' }}" name="post_image" required>
                                    @if ($errors->has('post_image'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('post_image') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update Post') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection