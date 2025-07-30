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
                    <form action="{{ route('suppliers.store') }}" method="post" class="form-horizontal">
                        @csrf
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="name" class=" form-control-label">Supplier
                                    Name</label>
                            </div>
                            <div class="col-12 col-md-9"><input type="text" id="name" name="name"
                                    placeholder="Name" class="form-control">
                                @error('name')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="email" class=" form-control-label">
                                    Email
                                </label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="email" id="email-input" name="email" placeholder="johnDoe@mail.com"
                                    class="form-control">
                                @error('email')
                                    <small class="help-block form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="phone" class=" form-control-label">
                                    Phone
                                </label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="phone-input" name="phone" placeholder="08129xxxxxx"
                                    class="form-control">
                                @error('phone')
                                    <small class="help-block form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="address-input" class=" form-control-label">Address</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <textarea name="address" id="address-input" rows="4" placeholder="Content..." class="form-control"></textarea>
                                @error('address')
                                    <small class="help-block form-text text-danger">{{ $message }}</small>
                                @enderror

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <a href="{{ route('suppliers.index') }}" class="btn btn-secondary btn-sm">
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
