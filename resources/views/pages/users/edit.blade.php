@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">{{ $title . ' Page' }} </strong>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <strong>Form {{ $title }}</strong>
                </div>
                <div class="card-body">
                    <form action="{{ route('users.update', $user->id) }}" method="post" class="form-horizontal">
                        @method('PUT')
                        @csrf
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="name" class=" form-control-label">
                                    Full Name
                                </label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="name" name="name" placeholder="Name" class="form-control"
                                    value="{{ old('name', $user->name) }}">
                                @error('name')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="username" class=" form-control-label">
                                    Username
                                </label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="username" name="username" placeholder="doni123"
                                    class="form-control" value="{{ old('username', $user->username) }}">
                                @error('username')
                                    <small class="help-block form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="role" class=" form-control-label">Select Role</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <select name="role" id="role" class="form-control">
                                    <option selected disabled>Please select</option>
                                    <option {{ $user->role == 'master' ? 'selected' : '' }} value="master">Master</option>
                                    <option {{ $user->role == 'admin' ? 'selected' : '' }} value="admin">Admin</option>
                                </select>
                                @error('role')
                                    <small class="help-block form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <a href="{{ route('users.index') }}" class="btn btn-secondary btn-sm">
                                    <i class="fa fa-ban"></i> Cancel
                                </a>
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="fa fa-dot-circle-o"></i> Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
