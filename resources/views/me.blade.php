@extends('layouts.app')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">About me <i class="fa fa-smile-o"></i></h3>
                </div>
                <div class="box-body">
                    <div class="col-md-2">
                        <img src="https://scontent.fcgk18-1.fna.fbcdn.net/v/t1.0-9/40389424_1845592865548602_9044637011486441472_n.jpg?_nc_cat=103&_nc_ht=scontent.fcgk18-1.fna&oh=8baf782cc800668cfb7100018e1efda1&oe=5CCD67E2" alt="It's me Jack!!" class="img-responsive img-circle">
                    </div>
                
                    <div class="col-md-10">
                        <h2>Just a weeb from nutshell <i class="fa fa-smile-o"></i></h2>
                        <h3>Please Follow me on <a href="https://www.facebook.com/steil34" class="btn btn-primary"><i class="fa fa-facebook"></i>acebook</a></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection