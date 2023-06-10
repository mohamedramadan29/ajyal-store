@extends('layouts.dashboard')
@section('title', 'Edit Profile')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active"> Edit Profile </li>

@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <x-alert />
        </div>
        <div class="card-body">

            <form method="post" action="{{ route('dashboard.profile.update') }}"
                  enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="form-group">
                    <label for="name"> First Name </label>
                    <input type="text" @class(['form-control', 'is-invalid' => $errors->has('first_name')]) class="form-control" id="first_name" name="first_name"
                           value="{{ old('first_name', $user->profile->first_name) }}">
                    <div class="invalid-feedback">
                        @error('first_name')
                        {{ $message }}
                        @enderror
                    </div>

                </div>
                <div class="form-group">
                    <label for="name"> Last Name  </label>
                    <input type="text" @class(['form-control', 'is-invalid' => $errors->has('last_name')]) class="form-control" id="last_name" name="last_name"
                           value="{{ old('last_name', $user->profile->last_name) }}">
                    <div class="invalid-feedback">
                        @error('last_name')
                        {{ $message }}
                        @enderror
                    </div>

                </div>
                <div class="form-group">
                    <label for="name"> phone </label>
                    <input type="text" @class(['form-control', 'is-invalid' => $errors->has('phone')]) class="form-control" id="phone" name="phone"
                           value="{{ old('phone', $user->profile->phone) }}">
                    <div class="invalid-feedback">
                        @error('phone')
                        {{ $message }}
                        @enderror
                    </div>

                </div>
                <div class="form-group">
                    <label for="name"> birthdate </label>
                    <input type="date" @class(['form-control', 'is-invalid' => $errors->has('birthdate')]) class="form-control" id="birthdate" name="birthdate"
                           value="{{ old('birthdate', $user->profile->birthdate) }}">
                    <div class="invalid-feedback">
                        @error('birthdate')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="name"> gender </label>
                    <select class="form-control" name="gender">
                        <option value=""> Select gender  </option>
                        <option @selected(old('gender',$user->profile->gender) == 'male') value="male">male</option>
                        <option @selected(old('gender',$user->profile->gender) == 'female') value="female">Female</option>

                    </select>

                </div>
                <div class="form-group">
                    <label for="name"> Address </label>
                    <input type="text" @class(['form-control', 'is-invalid' => $errors->has('address')]) class="form-control" id="address" name="address"
                           value="{{ old('address', $user->profile->address) }}">
                    <div class="invalid-feedback">
                        @error('address')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="name"> City </label>
                    <input type="text" @class(['form-control', 'is-invalid' => $errors->has('city')]) class="form-control" id="city" name="city"
                           value="{{ old('city', $user->profile->city) }}">
                    <div class="invalid-feedback">
                        @error('city')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="name"> state </label>
                    <input type="text" @class(['form-control', 'is-invalid' => $errors->has('state')]) class="form-control" id="state" name="state"
                           value="{{ old('state', $user->profile->state) }}">
                    <div class="invalid-feedback">
                        @error('state')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="name"> postal_code </label>
                    <input type="text" @class(['form-control', 'is-invalid' => $errors->has('postal_code')]) class="form-control" id="postal_code" name="postal_code"
                           value="{{ old('postal_code', $user->profile->postal_code) }}">
                    <div class="invalid-feedback">
                        @error('postal_code')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="name"> Country </label>
                    <input type="text" @class(['form-control', 'is-invalid' => $errors->has('country')]) class="form-control" id="country" name="country"
                           value="{{ old('country', $user->profile->country) }}">
                    <div class="invalid-feedback">
                        @error('country')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="name"> Local </label>
                    <input type="text" @class(['form-control', 'is-invalid' => $errors->has('local')]) class="form-control" id="local" name="local"
                           value="{{ old('local', $user->profile->local) }}">
                    <div class="invalid-feedback">
                        @error('local')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <button class="btn btn-primary" type="submit"> Edit Profile <i class="fa fa-plus"></i> </button>
            </form>
        </div>
    </div>
@endsection
