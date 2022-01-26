@extends('layouts.app')
<style type="text/css">
.avatar{
    border-radius:100%;
    max-width:100px;
}
.dashboad1{
    display: flex;
    flex-direction: row;
    justify-content:center;
}
.dashboard-left{
    margin-right:8%;
}
.blog_buttons
{
    display: flex;
    flex-direction: row;
    justify-content:center;
}
</style>
@section('content')
<div class="container">
    <div class="row justify-content-center">
     

        <div class="col-md-8">
        @if(count ($errors)>0)
                    @foreach($errors -> all() as $error)
                        <div class="alert alert-danger"> {{$error}} </div>
                    @endforeach
            @endif   

            @if(session('response'))
                <div class="alert alert-headings alert-success" role="alert">
                {{session('response')}} </div>
            @endif
            <div class="card">
                <div class="card-header alert alert-success text-center"> <strong>Dashboard </strong></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <!-- ------------- profile pic -------------- -->  
                    <div class=""> 

                    @if(!empty($profile))
                    <div class ="dashboad1">
                        <div class="dashboard-left">
                            <img src="{{url ($profile->profile_pic)}} " alt="" 
                             class="avatar" alt="">
                        </div>

                        <div class="dashboard-right">
                          
                             <p class="lead">  Name: {{$profile->name}} </p>    
                             <p class="lead">Email: {{$profile->email}} </p> 
                             <p class="lead">Designation: {{$profile->designation}} </p>      
                             <br><br><br><br>               
                        </div>
                        
                             @else
                    <img src="{{ url('images/index.png') }}" class="avatar" alt="" />
                    <p></p>
                    <p></p>
                    @endif


                    </div>
                    <div class="col-md-8">                                     
                          @if(!empty($posts) )
                            @foreach($posts->all() as $post)
                            @if(Auth::User()->id !=1)
                                @if($post-> status ===1)
                                    <p style="font-size: 30;"> <strong>{{$post->post_title}} </strong> </p>
                                    <img src="{{$post->post_image}}" alt="" style="max-width:60%; max-height:60%;">
                                    <p style="font-size: 18;">{{substr($post->post_body,0,50)}}</p>
                                    <cite style=""> Posted On: {{ date('M j, Y h:I',strtotime($post->updated_at))}}
                                    </cite>
                                    
                                    <ul class="nav nav-pills text-right">
                                        <li role="presentation">
                                            <a  href='{{ url("/view/{$post->id}") }}' > 
                                                <span style="margin-right:8px" class="fa fa-eye">  View  </span>
                                                <!-- style="text-decoration:underline;" -->
                                            </a>
                                        </li>
                                    </ul>

                                    <p style="font-size: 18;">____________________________________________</p>
                                    @if($user_id === $post->user_id)
                                    <ul class="nav nav-pills text-right">
                                        <li role="presentation">
                                        

                                            <a href='{{ url("/edit/{$post->id}") }}'> 
                                                <span style="margin-right:8px" class="fa fa-pencil-square-o">  Edit</span>
                                            </a>

                                            <a href='{{ url("/delete/{$post->id}") }}'> 
                                                <span class="fa fa-trash">  Delete</span>
                                            </a>
                                        </li>
                                    </ul>
                                    <p style="font-size: 18;">____________________________________________</p>
                                    <!-- <ul class="nav nav-pills">
                                        <li role="presentation">
                                            <a href=""> 
                                                <span class="fa fa-pencil-square-o">Edit Blog</span>
                                            </a>
                                        </li>
                                    </ul>

                                    <ul class="nav nav-pills">
                                        <li role="presentation">
                                            <a href=""> 
                                                <span class="fa fa-trash">Delete Blog</span>
                                            </a>
                                        </li>
                                    </ul> -->

                                    
                                    <br><br><br>
                                    
                                    @endif
                                    @endif
                                @else
                                <p style="font-size: 30;"> <strong>{{$post->post_title}} </strong> </p>
                                    <img src="{{$post->post_image}}" alt="" style="max-width:60%; max-height:60%;">
                                    <p style="font-size: 18;">{{substr($post->post_body,0,50)}}</p>
                                    <cite style=""> Posted On: {{ date('M j, Y h:I',strtotime($post->updated_at))}}
                                    </cite>
                                    
                                    <ul class="nav nav-pills text-right">
                                        <li role="presentation">
                                            <a  href='{{ url("/view/{$post->id}") }}' > 
                                                <span style="margin-right:8px" class="fa fa-eye">  View  </span>
                                                <!-- style="text-decoration:underline;" -->
                                            </a>
                                        </li>
                                    </ul>

                                    <p style="font-size: 18;">____________________________________________</p>
                                    @if($user_id === $post->user_id)
                                    <ul class="nav nav-pills text-right">
                                        <li role="presentation">
                                        

                                            <a href='{{ url("/edit/{$post->id}") }}'> 
                                                <span style="margin-right:8px" class="fa fa-pencil-square-o">  Edit</span>
                                            </a>

                                            <a href='{{ url("/delete/{$post->id}") }}'> 
                                                <span class="fa fa-trash">  Delete</span>
                                            </a>
                                        </li>
                                    </ul>
                                    <p style="font-size: 18;">____________________________________________</p>
                                    <!-- <ul class="nav nav-pills">
                                        <li role="presentation">
                                            <a href=""> 
                                                <span class="fa fa-pencil-square-o">Edit Blog</span>
                                            </a>
                                        </li>
                                    </ul>

                                    <ul class="nav nav-pills">
                                        <li role="presentation">
                                            <a href=""> 
                                                <span class="fa fa-trash">Delete Blog</span>
                                            </a>
                                        </li>
                                    </ul> -->

                                    
                                    <br><br><br>
                                    
                                    @endif
                                @endif                             
                            @endforeach
                                @else
                                <p>No Posts Available</p>
                        @endif
                        <div style="margin-left:50%">
                        
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
