@extends('layouts.app')

@section('content')

    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Account Settings</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <x-profile-navbar :user="$user"></x-profile-navbar>
                </div>
                <div class="col-lg-9">
                    <div class="card border-0 shadow mb-4">
                        <form id="userForm">
                        <div class="card-body  p-4">
                            <h3 class="fs-4 mb-1">My Profile</h3>
                            <div class="mb-4">
                                <label for="" class="mb-2">Name*</label>
                                <input type="text" placeholder="Enter Name" class="form-control" value="{{old('name',$user->name)}}" name="name" id="name">
                                <p></p>
                            </div>
                            <div class="mb-4">
                                <label for="" class="mb-2">Email*</label>
                                <input type="text" placeholder="Enter Email" class="form-control" value="{{old('email',$user->email)}}" name="email" id="email">
                                <p></p>
                            </div>
                            <div class="mb-4">
                                <label for="" class="mb-2">Designation*</label>
                                <input type="text" placeholder="Designation" class="form-control" value="{{old('designation',$user->designation)}}" name="designation" id="designation">
                                <p></p>
                            </div>
                            <div class="mb-4">
                                <label for="" class="mb-2">Mobile*</label>
                                <input type="text" placeholder="Mobile" class="form-control" value="{{old('mobile',$user->mobile)}}" name="mobile" id="mobile">
                                <p></p>
                            </div>
                        </div>
                        <div class="card-footer  p-4">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                        </form>
                    </div>

                    <div class="card border-0 shadow mb-4">
                        <form id="passwordForm">
                        <div class="card-body p-4">
                            <h3 class="fs-4 mb-1">Change Password</h3>
                            <div class="mb-4">
                                <label for="" class="mb-2">Old Password*</label>
                                <input type="password" placeholder="Old Password" class="form-control" name="old_password" id="old_password" value="{{old('old_password')}}">
                                <p></p>
                            </div>
                            <div class="mb-4">
                                <label for="" class="mb-2">New Password*</label>
                                <input type="password" placeholder="New Password" class="form-control" name="password" id="password" value="{{old('password')}}">
                                <p></p>
                            </div>
                            <div class="mb-4">
                                <label for="" class="mb-2">Confirm Password*</label>
                                <input type="password" placeholder="Confirm Password" class="form-control" name="password_confirmation" id="password_confirmation" value="{{old('password_confirmation')}}">
                                <p></p>
                            </div>
                        </div>
                        <div class="card-footer  p-4">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('custom-js')
    <script>
        $('#userForm').submit(function (e) {
            e.preventDefault()

            $.ajax({
                url: '{{route('account.profile.update.process')}}',
                type: 'put',
                dataType: 'json',
                data: $('#userForm').serialize(),
                success: function (resp){
                    $('.form-control').removeClass('is-invalid');
                    $('p.invalid-feedback').html('').removeClass('invalid-feedback');

                    if(resp.status == false){
                        let errors = resp.errors

                        if(errors.name){
                            $('#name').addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback')
                                .html(errors.name);
                        }

                        if(errors.email){
                            $('#email').addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback')
                                .html(errors.email);
                        }

                        if(errors.designation){
                            $('#designation').addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback')
                                .html(errors.designation);
                        }

                        if(errors.mobile){
                            $('#mobile').addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback')
                                .html(errors.mobile);
                        }
                    } else {
                        window.location.href='{{route('account.profile')}}'
                    }
                }
            })
        })

        $('#passwordForm').submit(function (e) {
            e.preventDefault()

            $.ajax({
                url: '{{route('account.profile.update.password')}}',
                type: 'put',
                dataType: 'json',
                data: $('#passwordForm').serialize(),
                success: function (resp){
                    $('.form-control').removeClass('is-invalid');
                    $('p.invalid-feedback').html('').removeClass('invalid-feedback');

                    if(resp.status == false){
                        let errors = resp.errors

                        if(errors.old_password){
                            $('#old_password').addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback')
                                .html(errors.old_password);
                        }

                        if(errors.password){
                            $('#password').addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback')
                                .html(errors.password);
                        }

                        if(errors.password_confirmation){
                            $('#password_confirmation').addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback')
                                .html(errors.password_confirmation);
                        }
                    } else {
                        window.location.href='{{route('account.profile')}}'
                    }
                }
            })
        })
    </script>
@endsection
