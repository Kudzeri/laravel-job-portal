@extends('layouts.app')

@section('content')
    <section class="section-5">
        <div class="container my-5">
            <div class="py-lg-2">&nbsp;</div>
            <div class="row d-flex justify-content-center">
                <div class="col-md-5">
                    <div class="card shadow border-0 p-5">
                        <h1 class="h3">Register</h1>
                        <form name="registerForm" id="registerForm">
                            <div class="mb-3">
                                <label for="name" class="mb-2">Name*</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name">
                                <p></p>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="mb-2">Email*</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Enter Email">
                                <p></p>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="mb-2">Password*</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Enter Password">
                                <p></p>
                            </div>
                            <div class="mb-3">
                                <label for="password_confirmation" class="mb-2">Confirm Password*</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm Password">
                                <p></p>
                            </div>
                            <button class="btn btn-primary mt-2" type="submit">Register</button>
                        </form>
                    </div>
                    <div class="mt-4 text-center">
                        <p>Have an account? <a href="{{route('account.login')}}">Login</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('custom-js')

    <script>
        $('#registerForm').submit(function (e){
            e.preventDefault();

            $.ajax({
                url: '{{ route('account.register.process') }}',
                type: 'post',
                data: $('#registerForm').serialize(),
                dataType: 'json',
                success: function (resp) {
                    $('.form-control').removeClass('is-invalid');
                    $('p.invalid-feedback').html('').removeClass('invalid-feedback');

                    if(resp.status === false) {
                        let errors = resp.errors;

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
                        window.location.href = '{{ route('account.login') }}';
                    }
                }
            });
        });
    </script>

@endsection
