@extends('../layouts/user')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <button class="btn btn-light text-dark ml-auto mr-3 mb-3" data-toggle="modal" data-target="#add_new"> <i class="mdi mdi-account-plus"></i> Add new admin role</button>
        </div>
        <div class="row ">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                    <h4 class="card-title">Current Admin List</h4>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th> Name </th>
                                        <th> Email </th>
                                        <th> Role </th>
                                        <th> Created At </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($list_admin as $admin)
                                        <tr class="text-center">
                                            <td> {{$admin->name}}</td>
                                            <td> {{$admin->email}} </td>
                                            <td> {{$admin->role}} </td>
                                            <td> {{$admin->created_at}} </td>
                                        </tr>                                        
                                    @endforeach                              
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="add_new" tabindex="-1" role="dialog" aria-labelledby="add_newTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="add_newTitle">Add new admin</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form action="{{ url('sa/add_admin') }}" method="post">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label for="name" class="col-sm-3 col-form-label">Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="name" placeholder="Name" name="name" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <input type="email" class="form-control" id="email" placeholder="Email" name="email" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-sm-3 col-form-label">Role</label>
                                    <div class="col-sm-9">
                                        <select name="role" id="role" class="form-control">
                                            <option value="">---Select One----</option>
                                            <option value="sa">Super Admin</option>
                                            <option value="fed">Frontdesk</option>
                                            <option value="ssc">Student Service Centre</option>
                                            <option value="lc">Lecture</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary">Add</button>
                            </div>                
                        </form>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
      