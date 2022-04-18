@extends('../layouts/user')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Missing Item List</h4>
                        <div class="row">
                            <div class="info_box text-left mb-3 col-lg-6">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <a href="{{ url('ssc/item_list') }}" class="btn btn-info btn-rounded pt-2"> Missing Item List</a>
                                    </div>
                                    <div class="col-lg-6">
                                        <a href="{{ url('ssc/request_list') }}" class="btn btn-info btn-rounded pt-2"> Request Item List</a>
                                    </div>
                                </div>
                            </div>
                            <div class="info_box text-right mb-3 col-lg-6">
                                <button class="btn btn-light btn-rounded" data-toggle="modal" data-target="#add_item"> <i class="mdi mdi-upload"></i> Upload Item </button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="category_table" style="border-top: 1px solid #2c2e33;">
                                <thead>
                                    <tr>
                                        <th> Item Code </th>
                                        <th> Item Photo </th>
                                        <th> Item Name </th>
                                        <th> Location </th>
                                        <th> Description </th>
                                        <th> Action </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="text-center">
                                        <td> A0854 </td>
                                        <td> <img src="https://cf.shopee.co.id/file/ef8799808e8f5d0928186332869065cf" alt="Botol Minum" width="60"> </td>
                                        <td> Botol Minum </td>
                                        <td> Aryaduta </td>
                                        <td> Ditemukan botol minum berwarna hitam di lantai 3 ruangan 302 </td>
                                        <td>
                                            <button class="btn btn-rounded btn-warning">Edit</button>
                                            <button class="btn btn-rounded btn-danger">Delete</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="add_item" tabindex="-1" role="dialog" aria-labelledby="add_itemTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="add_itemTitle">Add new Item</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="l_name" class="col-sm-3 col-form-label">Item Code</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" value="A{{str_pad(rand(0,100),3,'0',STR_PAD_LEFT)}}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="l_name" class="col-sm-3 col-form-label">Date</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" value="{{date('Y-m-d')}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="l_name" class="col-sm-3 col-form-label">Item Title</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="Item Name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="l_name" class="col-sm-3 col-form-label">Item Category</label>
                        <div class="col-sm-9">
                            <select class="js-example-basic-single" style="width:100%" name="l_name_ed">
                                <option value="">Botol Minuman</option>
                                <option value="">Alat Tulis</option>
                                <option value="">Kotak Makanan</option>
                                <option value="">Gadget</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-form-label">Location</label>
                        <div class="col-sm-9">
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                <input type="radio" class="form-check-input"> Lippo Mall <i class="input-helper"></i></label>
                            </div>    
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                <input type="radio" class="form-check-input"> Aryaduta <i class="input-helper"></i></label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="desc" class="col-sm-3 col-form-label">Description</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="desc" id="" cols="30" rows="10">Description Here</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="desc" class="col-sm-3 col-form-label">Photo File</label>
                        <div class="col-sm-9">
                            <input type="file" allow="images/*">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Add</button>
                </div>     
              </div>
            </div>
        </div>
    </div>
@endsection
      