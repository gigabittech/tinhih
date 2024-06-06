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
                                <form action="{{route('drcertificate.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                    <div class="row">
                
                                    <div class="col-lg-12 profile-field">
                                        
                                        <select name="certification_id" class="form-control">
                                            @foreach ($certifications as $certification)
                                                <option value="{{ $certification->id}}">{{$certification->title}}</option>
                                            @endforeach
                                        </select>
                                        
                                        <div class="form-group">
                                            <input type="hidden" value="{{($drcertificate->doctor->id) }}" name="dr_id" class="form-control" autocomplete="off" required="required">
                                        </div>
                
                                        <div class="form-group">
                                            <input class="btn btn-primary mt-4 login-button w-100" type="submit" name="add Dr Certification" class="btn btn-teal m-b-10" value="Add Dr Certification">
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