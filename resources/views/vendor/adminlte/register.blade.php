@extends('adminlte::master')

@section('title', 'Registration')

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/css/auth.css') }}">
    @yield('css')
@stop

@section('body_class', 'register-page')

@section('body')
    <div class="register-box">
        <div class="register-logo">
            <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}">{!! config('adminlte.logo', '<b>Admin</b>LTE') !!}</a>
        </div>

        <div class="register-box-body">
            <p class="login-box-msg">{{ trans('adminlte::adminlte.register_message') }}</p>
            <form action="{{ url(config('adminlte.register_url', 'register')) }}" method="post">
                {!! csrf_field() !!}

{{--                <div class="form-group has-feedback {{ $errors->has('emp_id') ? 'has-error' : '' }}">--}}
{{--                    <input type="text" name="emp_id" class="form-control" value="{{ old('emp_id') }}"--}}
{{--                           placeholder="Employee ID">--}}
{{--                    <span class="glyphicon glyphicon-user form-control-feedback"></span>--}}
{{--                    @if ($errors->has('emp_id'))--}}
{{--                        <span class="help-block">--}}
{{--                            <strong>{{ $errors->first('emp_id') }}</strong>--}}
{{--                        </span>--}}
{{--                    @endif--}}
{{--                </div>--}}
                <div class="form-group has-feedback {{ $errors->has('last_name') ? 'has-error' : '' }}">
                    <input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}"
                           placeholder="Last name">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    @if ($errors->has('last_name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('last_name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('first_name') ? 'has-error' : '' }}">
                    <input type="text" name="first_name" class="form-control" value="{{ old('first_name') }}"
                           placeholder="First name">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    @if ($errors->has('first_name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('first_name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('middle_name') ? 'has-error' : '' }}">
                    <input type="text" name="middle_name" class="form-control" value="{{ old('middle_name') }}"
                           placeholder="Middle name">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    @if ($errors->has('middle_name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('middle_name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                           placeholder="{{ trans('adminlte::adminlte.email') }}">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
{{--                <div class="form-group has-feedback {{ $errors->has('username') ? 'has-error' : '' }}">--}}
{{--                    <input type="hidden" name="username" class="form-control" value="{{ old('username') }}"--}}
{{--                           placeholder="User name">--}}
{{--                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>--}}
{{--                    @if ($errors->has('username'))--}}
{{--                        <span class="help-block">--}}
{{--                            <strong>{{ $errors->first('username') }}</strong>--}}
{{--                        </span>--}}
{{--                    @endif--}}
{{--                </div>--}}
                <div class="form-group has-feedback {{ $errors->has('office_department') ? 'has-error' : '' }}">
                    <select type="dropdown" name="office_department_id" class="form-control" value="{{ old('office_department') }}"
                           placeholder="Office">
                        <option value="">-- Select Office or Department --</option>
                        @foreach($office_department_list as $office_department)
                            <option value="{{ $office_department->id }}">{{ $office_department->name }}</option>
                        @endforeach
                        </select>
                    @if ($errors->has('office_department'))
                        <span class="help-block">
                            <strong>{{ $errors->first('office_department') }}</strong>
                        </span>
                    @endif
                </div>
{{--                <div class="form-group has-feedback {{ $errors->has('college_id') ? 'has-error' : '' }}">--}}
{{--                    <select type="dropdown" name="college_id" class="form-control" value="{{ old('college_id') }}" placeholder="College">--}}
{{--                        <option value="">-- Select College --</option>--}}
{{--                        @foreach($college_list as $college)--}}
{{--                            <option value="{{ $college->id }}">{{ $college->name }}</option>--}}
{{--                        @endforeach--}}
{{--                        </select>--}}
{{--                    @if ($errors->has('college_id'))--}}
{{--                        <span class="help-block">--}}
{{--                            <strong>{{ $errors->first('college_id') }}</strong>--}}
{{--                        </span>--}}
{{--                    @endif--}}
{{--                </div>--}}
                <div class="form-group has-feedback {{ $errors->has('role') ? 'has-error' : '' }}">
                    <select type="dropdown" name="role_id" class="form-control" value="{{ old('role') }}"
                           placeholder="Role">
                        <option value="">-- Choose User Type --</option>
                        @foreach($role_list as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('role'))
                        <span class="help-block">
                            <strong>{{ $errors->first('role') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                    <input type="password" name="password" class="form-control"
                           placeholder="{{ trans('adminlte::adminlte.password') }}">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                    <input type="password" name="password_confirmation" class="form-control"
                           placeholder="{{ trans('adminlte::adminlte.retype_password') }}">
                    <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>
                <button type="submit"
                        class="btn btn-primary btn-block btn-flat"
                >{{ trans('adminlte::adminlte.register') }}</button>
            </form>
            <div class="auth-links">
                <a href="{{ url(config('adminlte.login_url', 'login')) }}"
                   class="text-center">I already have an account</a>
            </div>
        </div>
        <!-- /.form-box -->
    </div><!-- /.register-box -->
@stop

@section('adminlte_js')
    @yield('js')
@stop
