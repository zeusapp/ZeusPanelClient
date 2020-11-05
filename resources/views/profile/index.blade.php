@extends('layouts.app')

@section('content')
    <h3 class="text-dark mb-4">Profile</h3>
    <div class="row mb-3">
        <div class="col-lg-4">
            <div class="card mb-3">
                <div class="card-body text-center shadow" style="max-height: 200px"><img class="rounded-circle mb-3 mt-4" src="{{gravatar(auth()->user()->email)}}">
                    <div class="mb-3"><a class="btn btn-primary btn-sm" href="https://en.gravatar.com/" target="_blank" type="button">Change Photo</a></div>
                </div>
            </div>

        </div>
        <div class="col-lg-8">

            <div class="row">
                <div class="col">
                    <div class="card shadow mb-3">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 font-weight-bold">Profile Editor</p>
                        </div>
                        <div class="card-body">
                            @include("inc/messages")
                            <form method="POST" action="/profile/{{auth()->user()->profile->id}}">
                                {{ csrf_field() }}
                                {{ method_field('PATCH') }}
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group"><label for="username"><strong>Username</strong></label><input class="form-control" type="text" placeholder="Username" name="username" value="{{auth()->user()->username}}"></div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group"><label for="email"><strong>Email Address</strong></label><input class="form-control" type="email" placeholder="user@example.com" value="{{auth()->user()->email}}" name="email"></div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group"><label for="first_name"><strong>First Name</strong></label><input class="form-control" type="text" placeholder="John" name="first_name" value="{{$profile->first_name}}"></div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group"><label for="last_name"><strong>Last Name</strong></label><input class="form-control" type="text" placeholder="Doe" name="last_name" value="{{$profile->last_name}}"></div>
                                    </div>
                                </div>
                                <div class="form-group"><label for="address"><strong>Discord</strong></label><input class="form-control" type="text" placeholder="Wumpus#0000" name="discord" value="{{$profile->discord}}"></div>
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group"><label for="city"><strong>Location</strong></label><input class="form-control" type="text" placeholder="1234 Rue Ste-Catherine, Montréal, Canada" name="location" value="{{$profile->location}}"></div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group"><label for="country"><strong>Phone</strong></label><input class="form-control" type="text" placeholder="(000)-000 0000" name="phone" value="{{$profile->phone}}"></div>
                                    </div>
                                </div>
                                <div class="form-group"><label for="signature"><strong>Signature</strong><br></label><textarea class="form-control" rows="4" name="signature">{{$profile->signature}}</textarea></div>
                                <div class="form-group"><button class="btn btn-primary btn-sm" type="submit">Save Settings</button></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
