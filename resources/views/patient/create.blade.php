@extends('layouts.app')

@section('head_title', 'Register Patient |' )

@section('content')

<div class="container">

    {{-- Print status message for registration and first appointment creation succeeding or failing --}}
    @include('patient.sub.status')

    {{-- Form registration code --}}
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>Register Patient</h3></div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('store-patient') }}">
                        {{ csrf_field() }}
                        
                        <input type="hidden" name="users_id" value="{{ $user->id }}"/>

                        <!-- ************ Given name ************* -->
                        <div class="form-group{{ $errors->has('given_name') ? ' has-error' : '' }}">
                            <label for="given_name" class="col-md-4 control-label">Given Name</label>

                            <div class="col-md-6">
                                <input id="given_name" type="text" class="form-control" name="given_name" value="{{ old('given_name') }}" required autofocus>

                                @if ($errors->has('given_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('given_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- ************ Surname ************* -->
                        <div class="form-group{{ $errors->has('surname') ? ' has-error' : '' }}">
                            <label for="surname" class="col-md-4 control-label">Surname</label>

                            <div class="col-md-6">
                                <input id="surname" type="text" class="form-control" name="surname" value="{{ old('surname') }}" required autofocus>

                                @if ($errors->has('surname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('surname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- ************ Gender ************* -->
                        <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                            <label for="gender" class="col-md-4 control-label">Gender</label>

                            <div class="col-md-6">
                                <select name="gender" id="gender" class="form-control" value="{{ old('gender') }}" required autofocus>
                                    <option>...</option>
                                    <option value="m"  {{ old('gender')=='m' ? 'selected' : '' }}>Male</option>
                                    <option value="f"  {{ old('gender')=='f' ? 'selected' : '' }}>Female</option>
                                </select>

                                @if ($errors->has('gender'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- ************ Marital status ************* -->
                        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                            <label for="marital_status" class="col-md-4 control-label">Marital Status</label>

                            <div class="col-md-6">
                                <select name="marital_status" id="marital_status" class="form-control" value="{{ old('marital_status') }}" required autofocus>
                                    <option>...</option>
                                    <option value="married" {{ old('marital_status')=='married' ? 'selected' : '' }}>Married</option>
                                    <option value="single" {{ old('marital_status')=='single' ? 'selected' : '' }}>Single</option>
                                </select>

                                @if ($errors->has('marital_status'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('marital_status') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- ************ Date of birth ************* -->
                        <div class="form-group{{ $errors->has('dob') ? ' has-error' : '' }}">
                            <label for="dob" class="col-md-4 control-label">Date of birth</label>

                            <div class="col-md-6">
                                <input id="dob" type="text" class="form-control" name="dob" value="{{ old('dob') }}" placeholder="format: yyyy/mm/dd" required autofocus>

                                @if ($errors->has('dob'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('dob') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- ************ Phone number ************* -->
                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-4 control-label">Phone</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}" placeholder="e.g 678257084" required>

                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- ************ Address ************* -->
                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="address" class="col-md-4 control-label">Address</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control" name="address" value="{{ old('address') }}" required autofocus>

                                @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- ************ Other Phone ************* -->
                        <div class="form-group{{ $errors->has('other_phone') ? ' has-error' : '' }}">
                            <label for="other_phone" class="col-md-4 control-label">Other phone</label>

                            <div class="col-md-6">
                                <input id="other_phone" type="text" class="form-control" name="other_phone" value="{{ old('other_phone') }}" placeholder="Optional" autofocus>

                                @if ($errors->has('other_phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('other_phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- ************ Email address ************* -->
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Email address</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" placeholder="Optional" autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <hr>

                        <!-- ************ HIV TYPE/DRUGS ************* -->
                        <div class="form-group{{ $errors->has('specialty') ? ' has-error' : '' }}">
                            <label for="drugs_id" class="col-md-4 control-label">HIV Type / Drugs</label>

                            <div class="col-md-6">
                                <select name="drugs_id" id="drugs_id" class="form-control" value="{{ old('drugs_id') }}" required autofocus>
                                    <option value="">...</option>

                                    @foreach($drugs_data as $drug)
                                        <option value="{{$drug->id}}" {{ old('drugs_id') == $drug->id ? 'selected' : '' }}>
                                            {{$drug->d_type . ' --> ' . $drug->d_name}}
                                        </option>
                                    @endforeach

                                </select>
                                
                                @if ($errors->has('drugs_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('drugs_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <hr>

                        <!-- ************ 1st Appointment ************* -->
                        <div class="form-group{{ $errors->has('a_date') ? ' has-error' : '' }}">
                            <label for="a_date" class="col-md-4 control-label">Date of 1st Appointment</label>

                            <div class="col-md-6">
                                <input id="a_date" type="text" class="form-control" name="a_date" value="{{ old('a_date') }}" placeholder="format: yyyy/mm/dd" required autofocus>

                                @if ($errors->has('a_date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('a_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>  
                        
                        <!-- ************ Appointment frequency ************* -->
                        <div class="form-group{{ $errors->has('frequency') ? ' has-error' : '' }}">
                            <label for="frequency" class="col-md-4 control-label">Appointment frequency</label>

                            <div class="col-md-6">
                                <select name="frequency" id="frequency" class="form-control" value="{{ old('frequency') }}" required autofocus>
                                    <option>...</option>
                                    <option value="daily">Daily</option>
                                    <option value="weekly">Weekly</option>
                                    <option value="Monthly">Monthly</option>
                                    <option value="yearly">Yearly</option>
                                </select>

                                @if ($errors->has('frequency'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('frequency') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>  
                        <hr>

                        <!-- ************ Register button ************* -->
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
