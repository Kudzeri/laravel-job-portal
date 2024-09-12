@extends('layouts.app')

@section('content')
    <section class="section-5">
        <div class="container my-5">
            <div class="py-lg-2">&nbsp;</div>
            <div class="row d-flex justify-content-center">
                <div class="col-md-5">
                    <div class="card shadow border-0 p-5">
                        <h1 class="h3">Login</h1>
                        <form name="loginForm" id="loginForm">
                            <div class="mb-3">
                                <label for="" class="mb-2">Email*</label>
                                <input type="text" name="email" id="email" class="form-control" placeholder="example@example.com">
                                <p></p>
                            </div>
                            <div class="mb-3">
                                <label for="" class="mb-2">Password*</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Enter Password">
                                <p></p>
                            </div>
                            <div class="justify-content-between d-flex">
                                <button class="btn btn-primary mt-2" type="submit">Login</button>
                                <a href="forgot-password.html" class="mt-3">Forgot Password?</a>
                            </div>
                        </form>
                    </div>
                    <div class="mt-4 text-center">
                        <p>Do not have an account? <a href="{{route('account.register')}}">Register</a></p>
                    </div>
                </div>
            </div>
            <div class="py-lg-5">&nbsp;</div>
        </div>
    </section>
@endsection

@section('custom-js')

    <script>
        $('#loginForm').submit(function (e){
            e.preventDefault();

            $.ajax({
                url: '{{ route('account.login.process') }}',
                type: 'post',
                data: $('#loginForm').serialize(),
                dataType: 'json',
                success: function (resp) {
                    $('.form-control').removeClass('is-invalid');
                    $('p.invalid-feedback').html('').removeClass('invalid-feedback');

                    if(resp.status === false) {
                        let errors = resp.errors;

                        if(errors.email){
                            $('#email').addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback')
                                .html(errors.email);
                        }

                        if(errors.password){
                            $('#password').addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback')
                                .html(errors.password);
                        }

                    } else {
                        window.location.href = '{{ route('account.profile') }}';
                    }
                }
            });
        });
    </script>

@endsection
