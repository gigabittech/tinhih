@extends('admin.layout.template')

@section('body')


<!-- Table Area Start -->
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header">
                <strong>Users</strong>

            </div>
                <div class="card-body">
                <table class="table table-bordered">
                        <thead class="table-dark">
                        <tr>
                            <th scope="col">SL. No</th>

                            <th scope="col">User Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">License</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($users as $k=>$user)


                        <tr>
                                <th scope="row">{{ ++$k }}</th>

                                <td>{{ $user->name}}</td>
                                <td> {{ $user->email}}</td>
                                <td>{{ $user->phone}}</td>
                                <td class="text-success"> {{ isset($user->profile)?$user->profile->license_number:""}}</td>

                                <td>

                                    <button type="button" class="btn btn-danger" data-coreui-toggle="modal" data-coreui-target="#exampleModal"> Delete</button>
                                </td><!-- Button trigger modal -->


                                <!-- Modal Start-->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Do You Confirm to Delete This Schedule!</h5>
                                                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary">Close</button>
                                                <form action="{{route ('schedule.destroy', $user->id) }}" method="POST">
                                                    @csrf
                                                    @method("DELETE")
                                                    <button type="submit" class="btn btn-danger">Yes</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal Ends-->
                            </tr>

                        @endforeach


                        </tbody>
                    </table>
                    @if (count($users)== 0 )
                        <div class="alert alert-info">
                            No. Airplane Schedule Added Yet. Please Add a Airplane Schedule First.
                        </div>
                    @endif
              </div>
            </div> 
          </div> 
        </div>
      </div> 
    </div>
      <!-- Table Area Ends -->

@endsection
