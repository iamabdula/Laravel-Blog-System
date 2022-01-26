@extends('layouts.app')

<style>

.textarea {
  width: 300px;
  height: 550px;
}
</style>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center alert alert-success"><strong>Publish to Blogs ILSA </strong></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h1>Post Something..</h1>

                    <div class="block">

                    <form method="POST" action="{{ url('/addPost') }}" aria-label="{{ __('post_title') }}"
                     enctype="multipart/form-data">
                        @csrf
<!-- add title -->
                        <div class="form-group row">
                            <label for="post_title" class="col-md-2  col-form-label text-md-left"> {{ __('Title') }}</label>

                            <div class="col-md-9">
                                <input id="post_title" type="text"
                                 class="form-control{{ $errors->has('post_title') ? 'has-error' : '' }}"
                                 type="name" name="post_title" value="{{ old('post_title') }}" required autofocus>

                                @if ($errors->has('post_title'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('post_title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
<!-- add blog text -->
                        <div class="form-group row">
                            <label for="post_body"
                            class="col-md-2 col-form-label text-md-left">{{ __('Blog Text') }}</label>

                            <div class="col-md-9">
                                <textarea id="post_body" rows="14" type="text"
                                class="form-control  {{ $errors->has('post_body') ? ' is-invalid' : '' }}"
                                  name="post_body" value="{{ old('post_body') }}" required> </textarea>

                                @if ($errors->has('post_body'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('post_body') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
     <!-- file upload -->
                        <div class="form-group row">
                            <label for="post_image" class="col-md-2 col-form-label text-md-left">{{ __('Blog Picture') }}</label>
                            <div class="col-md-9">
                                <input id="post_image" type="file" name="post_image"
                                 class="form-control{{ $errors->has('post_image') ? ' is-invalid' : '' }}"
                                 name="post_image" required>

                                @if ($errors->has('post_image'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('post_image') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
<!-- add post button -->
                        <div class="form-group row mb-0 text-right">
                            <div class="col-md-9 offset-md-2">
                                <button type="submit" class="btn btn-primary btn-large btn-block ">
                                    {{ __('Publish Post') }}
                                </button>
                            </div>
                        </div>
                    </form>

                  </div>



                     </div>
                </div>
{{--            sdsdsdsd--}}
            </div>
        </div>
    </div>
</div>
@endsection
