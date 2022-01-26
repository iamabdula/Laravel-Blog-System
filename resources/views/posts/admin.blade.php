@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header alert alert-success text-center">Admin Panel</div>
                <div class="card-body" >
                    <span class="alert alert-primary" style="border:double; padding:3px ; margin-left:-3% ; "  > User Profiles </span>
                     @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row">
                        <table class="table ">
                            <thead >
                                <tr style="font-size:20px;font-weight:bold" >
                                    <td>Name</td>
                                    <td>Edit</td>
                                    <td>Delete</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    @if($user->id != 1)
                                        <tr>
                                            <td>
                                                {{$user->name}}
                                            </td>

                                            <td>
                                            <a href='{{ url("/editUser/{$user->id}") }}'>
                                                    <span style="margin-right:8px" class="fa fa-pencil-square-o">  Edit</span>
                                                </a>
                                            </td>

                                            <td>
                                            <a href='{{ url("/deleteUser/{$user->id}") }}'>
                                                    <span class="fa fa-trash">  Delete</span>
                                                </a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>



                </div>

            </div>
            <br>

                        <!-- APPROVE POST SECTION -->
            <div class="card">
                 <div class="card-body" >
                    <span class="alert alert-primary" style="border:double; padding:3px ; margin-left:-3% ; "  > Approve Blogs </span>
                     @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row">
                        <table class="table">
                            <thead>
                                <tr style="font-size:20px;font-weight:bold">
                                    <td >Blog Title</td>
                                    <td>Posted By</td>
                                    <td>Status</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($posts->all() as $post)
                                <tr>
                                    <td>
                                        <a href='{{ url("/approvePost/{$post->id}") }}'>
                                            <span style="margin-right:8px" class="fa fa-eye">{{  $post->post_title}}</span>
                                        </a>
                                    </td>

                                    <td>
                                       @foreach($users->all() as $user)
                                          @if($user->id === $post->user_id)
                                             {{$user->name}}
                                              @break
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                     <input type="radio" name="approvePost" id="approvePost" value="approvePost" />
                                            <label for="approvePost">Approve</label>

                                    <input type="radio" name="disapprovePost" id="disapprovePost" value="disapprovePost" >
                                        <label for="disapprovePost">Disapprove</label>
                                    </td>


                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

              </div>
        </div>
        <br>

            <!-- APPROVE COMMENTS SECTION -->
            <!-- <div class="card">
             <div class="card-body" >
                    <span class="alert alert-primary" style="border:double; padding:3px ; margin-left:-3% ; "  > Approve COMMENTS </span>
                     @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row">
                        <table class="table">
                            <thead>
                                <tr style="font-size:20px;font-weight:bold">
                                    <td >Blog Title</td>
                                    <td>Posted By</td>
                                    <td>Status</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users->all() as $user)
                                <tr>
                                    <td>
                                        {{$user->name}}
                                    </td>

                                    <td>
                                    <a href='{{ url("/editUser/{$user->id}") }}'>
                                            <span style="margin-right:8px" class="fa fa-pencil-square-o">  Edit</span>
                                        </a>
                                    </td>

                                    <td>
                                    <a href='{{ url("/deleteUser/{$user->id}") }}'>
                                            <span class="fa fa-trash">  Delete</span>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

              </div>
        </div> -->

    </div>
</div>
@endsection
