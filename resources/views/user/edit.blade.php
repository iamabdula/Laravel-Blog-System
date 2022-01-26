@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header alert alert-success text-center">Update User Profile</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row">
                        <form method="POST" action="{{ url('/UpdateUser',array($users->id)) }}" aria-label="{{ __('Register') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                                <div class="col-md-6">
                                    <input id="name" type="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $users->name }}" autofocus>
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>
                                <div class="col-md-6">
                                    <textarea id="email" rows="1" cols="90" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"> {{ $users->email }}
                                    </textarea>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update User') }}
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
////////////////////////////////////////////////////////////////////////////////////////
@extends('layouts.admin')
@section ('content')
    <section class="section">
        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb bg-primary text-white-all">
                                <li class="breadcrumb-item"><a href="{{ url('/home') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ url('category/allCategories') }}"><i class="far fa-file"></i> Category</a></li>
                                <li class="breadcrumb-item active" aria-current="page" href="{{ url('category/addCategories') }}" ><i class="fas fa-list"></i>Edit</li>
                            </ol>
                        </nav>
                        <div class="card-header">
                            <h1 >Edit Category</h1>
                        </div>
                        <div class="card-body">
                            <!--Add Category -->
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <div class="block">

                                <form method="POST" action="{{ url('category/saveEditedCategory', array($categories[0]->cat_id)) }}" aria-label="{{ __('cat_name') }}"
                                      enctype="multipart/form-data">
                                @csrf
                                <!-- add Name -->
                                    <div class="form-group row">
                                        <label for="cat_name" class="col-md-2  col-form-label text-md-left"> {{ __('Category Name') }}</label>

                                        <div class="col-md-9">
                                            <input id="cat_name" type="text"
                                                   class="form-control{{ $errors->has('cat_name') ? ' is-invalid' : '' }}"
                                                   type="name" name="cat_name" value="{{$categories[0]->cat_name}}" >

                                            @if ($errors->has('cat_name'))
                                                <span class="invalid-feedback yes" role="alert" >
                                        <strong>{{ $errors->first('cat_name') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- add slug -->
                                    <div class="form-group row">
                                        <label for="slug" class="col-md-2  col-form-label text-md-left"> {{ __('Category Slug') }}</label>
                                        <div class="col-md-9">
                                            <input id="slug" type="text"
                                                   class="form-control{{ $errors->has('slug') ? ' is-invalid' : ''}}"
                                                   type="name" name="slug" value="{{$categories[0]->slug}}" onfocus="get_slug()">

                                            @if ($errors->has('slug'))
                                                <span class="invalid-feedback yes" role="alert">
                                        <strong>{{ $errors->first('slug') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- add category description-->
                                    <div class="form-group row">
                                        <label for="description"
                                               class="col-md-2 col-form-label text-md-left">{{ __('Description') }}</label>

                                        <div class="col-md-9">
                                <textarea id="description" rows="14" type="text"
                                          class="form-control  {{ $errors->has('description') ? ' is-invalid' : '' }}"
                                          name="description" value="" > {{$categories[0]->description}}</textarea>

                                            @if ($errors->has('description'))
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- add post button -->
                                    <div class="form-group row mb-0 text-right">
                                        <div class="col-md-9 offset-md-2">
                                            <button type="submit" class="btn btn-primary btn-large float-left ">
                                                {{ __('Publish Post') }}
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

    </section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {


        });
        function get_slug(){

            var title= $('#cat_name').val();

            var get_slug= title.toLowerCase().replace(/ /g,"-");
            $('#slug').val(get_slug);
        }


    </script>
@endsection
































