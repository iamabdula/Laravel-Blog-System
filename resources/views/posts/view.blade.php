@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
     

        <div class="col-md-8">
            <div class="card">
            @if(session('response'))
                <div class="alert alert-headings alert-success" role="alert">
                {{session('response')}} </div>
            @endif
                <div class="card-header alert alert-success text-center"> <strong>View Post </strong></div>

                <div class="col-md-14"> 
                          @if(count($posts)>0)
                            @foreach($posts->all() as $post)
                            <h1  style="font-family: Lucida Console, Courier New, monospace; font-size: 30; font-weight=bold;text-align: center" >{{$post->post_title}} </h1>
                                <!-- <h1 style="font-size: 30;"> <strong>{</strong> </h1> -->
                                <img src= "{{$post->post_image}}" alt="" style="max-width:40%; max-height:40%; justify-content:center ;margin-left:30%">
                                <br><br>
                   
                                <div class="card" style =" margin:5%">
                                    <p style="font-size: 20px; font-style:bold;
                                       
                                       color:black;
                                       margin-left:2%;
                                       margin-right:2%;  ">{{$post->post_body}}</p>
                                </div>

                                
                            @endforeach
                         @else
                                <p>No Posts Available</p>
                        @endif

                        <form method="POST" action='{{ url("/comment/{$post->id}")}}' aria-label="{{ __('Add Comment') }}"
                     enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="Add Comment" class="col-md-2  col-form-label text-md-left" style="font-size: 18px; font-weight=bold; margin-left:3%;">  {{ __('Comment') }}</label>

                            <div class="col-md-9">
                                <textarea id="comment" rows="2"  
                                style="margin-left:5%;" 
                                 class="form-control{{ $errors->has('comment') ? 'has-error' : '' }}"
                                 name="comment" value="{{ old('comment') }}" required autofocus>
                                </textarea>
                                <br>
                              
                            </div>

                            <div class="form-group">
                                <button 
                                style=" margin-right:4%";  
                                type="submit"  class="btn btn-success btn-md text-right float-right">
                                    Post Comment </button>
                            </div>
                            <br>
                            
                            <br>
                            <h2  style="font-family: Lucida Console, Courier New, monospace;  font-weight=bold;text-align: center" >Comments</h2>

                            <div class="card " style ="background-color: #FAF0E6; margin:5%">
                             @if(count($comments)>0)
                                  @foreach($comments->all() as $comment)
                                        <p style="font-size: 14px;font-style: italic;
                                       
                                        color:black;
                                        margin-left:2%;
                                        margin-right:2%;

                                        ">{{$comment->comment}}</p>
                                        <p style="text-align: right; margin-right:2%; 
                                        font-size: 16px;font-style: bold;
                                        font-family: Arial, Helvetica, sans-serif;
                                        " >Posted By: {{$comment->name}}</p>
                                        <p>_____________________________________________________________________________________</p>

                                  @endforeach

                             @else
                                <p>No Comments Available</p>
                            @endif
                            <div>
                        </div?>
                        </form>

                    </div>
            </div>
    </div>
</div>
@endsection
