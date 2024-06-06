@extends('admin.layout.template')

@section('body')
<div class="container-fluid">

    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header"><strong>Change password</strong></div>
            <div class="card-body">
                @if (Session::has('success'))
                    @include('admin.includes.message.success')
                @elseif(Session::has('error'))
                    @include('admin.includes.message.error')
                @endif
                    <form action="{{ route('schedule.update',$schedule->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method("PUT")
                        <div class="row">

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Airplane Name</label>
                                    <select name="airplane_id" class="form-control">
                                        <option value="1">Please Slecet Plane if any</option>
                                        @foreach ($airplanes as $airplane)
                                            <option @if($schedule->airplane_id==$airplane->id) selected @endif value="{{ $airplane->id}}"> {{$airplane->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Start Time</label>
                                    <input type="time" name="start_time" class="form-control" autocomplete="off" value="{{ $schedule->start_time }}" required="required">
                                </div>
                                <div class="form-group">
                                    <label>End Time</label>
                                    <input type="time" name="end_time" class="form-control" autocomplete="off" value="{{ $schedule->end_time }}" required="required">
                                </div>

                            </div>

                            <div class="col-lg-6">

                                <div class="form-group">
                                    <label>Price</label>
                                    <input type="text" name="price" class="form-control" autocomplete="off" value="{{ $schedule->price }}">
                                </div>
                                <div class="form-group">
                                    <label>Note</label>
                                    <textarea   rows="3" name="note" class="form-control" >{{ $schedule->note }}</textarea>
                                </div>

                            </div>

                            <div class="col-lg-12">

                                <div class="form-group">
                                    <label>Plane Schedule Available</label>
                                    <select name="is_available" class="form-control">
                                        <option>Please Slecet the Status</option>
                                        <option @if($schedule->is_available==1) selected @endif value="1">Yes</option>
                                        <option @if($schedule->is_available==0) selected @endif value="0">No</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <input class="btn btn-primary mt-4" type="submit" name="add Schedule" class="btn btn-teal m-b-10" value="Update Schedule">
                                </div>
                            </div>

                        </div>


                    </form>

            </div>
        </div>
    </div>
</div>
@endsection