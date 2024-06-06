@extends('admin.layout.template')

@section('body')


<div class="container-fluid bg-black pt-5 pb-5">
    <div class="card mb-4 bg-black">
        <div class="card-body">
            <div class="row">
                
                <div class="col-lg-6 mt-4">
                    <div class="bg-dark bg-dark1 p-4">
                        <div class="row">
                            <div class="col-lg-6">
                                <form action="{{route('drspecialization.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                    <div class="row">
                
                                    <div class="col-lg-12 profile-field">
                                        
                                        <select name="specialization_id" class="form-control">
                                            @foreach ($specializations as $specialization)
                                                <option value="{{ $specialization->id}}">{{$specialization->title}}</option>
                                            @endforeach
                                        </select>
                                        
                                        <div class="form-group">
                                            <input type="hidden" value="{{($drspecialization->doctor->id) }}" name="dr_id" class="form-control" autocomplete="off" required="required">
                
                                        <div class="form-group">
                                            <input class="btn btn-primary mt-4 login-button w-100" type="submit" name="add Dr Specialization" class="btn btn-teal m-b-10" value="Add Dr Specialization">
                                        </div>
                                    
                                    </div>
                
                
                                </form>
                            </div>
                            
                        </div>
                        
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection