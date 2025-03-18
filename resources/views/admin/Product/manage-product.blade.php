@extends('admin.layout.main')
@push('title')
    <title>Manage  </title>
@endpush
<style>
    .btn-icon {
        font-size: 20px;
        margin: 0 12px 0 0;
        color: #111;
    }

    .overflow-text {
    height: 90px;
    overflow: auto;
}
</style>
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Manage Product</h1>
                    </div>
                    <div class="col-sm-6">
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Category</th>
                                        <th>EV Sub Category</th>
                                        <th style="width: 6%">Brand Name</th>
                                        <th>Pages Name</th>
                                        <th>Product Lable</th>
                                        <th>Product Name</th>
                                        <th>Product URL</th>
                                        <th>Ex-Showroom Price</th>
                                        <th>On Road Price</th>
                                        <th>1. Product Image  </th>
                                        <th>2. Product Image  </th>
                                        <th>3. Product Image  </th>
                                        <th>4. Product Image  </th>
                                        <th>5. Product Image  </th>
                                        <th>6. Product Image  </th>
                                        <th>7. Product Image  </th>
                                        <th>8. Product Image  </th>
                                        <th>Body Type</th>
                                        <th>Color</th>
                                        <th>Mileage</th>
                                        <th>Displacement</th>
                                        <th>Fule Tank Capacity</th>
                                        <th>Kerb Weight</th>
                                        <th>Height</th>
                                        <th>Top Speed</th>
                                        <th>Engine</th>
                                        <th>Fuel Type</th>
                                        <th>Transmission Type</th>
                                        <th>Seating Capacity</th>
                                        <th>Safety</th>
                                        <th>Driving Range</th>
                                        <th>Charging Time</th>
                                        <th>Meta Tags</th>
                                        <th>Meta Description</th>
                                        <th>Highlights</th>
                                        <th style="width: 6%">Status</th>
                                        <th style="width: 50px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($product as $item)
                                        <tr>
                                            <td><span class="increment">{{ $loop->iteration + $product->firstItem() - 1 }}.</span></td>
                                            <td>
                                                {{$item->category}}
                                            </td>
                                            <td>
                                                {{$item->ev_sub_category}}
                                            </td>
                                            <td>
                                                {{$item->brands}}
                                            </td>
                                            <td>
                                                {{$item->pages_name}}
                                            </td>
                                            <td>
                                                @if($item->product_label == "1")
                                                    Just Launched
                                                @endif
                                                @if($item->product_label == '2')
                                                    Electric
                                                @endif
                                            </td>
                                            <td>
                                                {{$item->product_name}}
                                            </td>
                                            <td>
                                                {{$item->product_url}}
                                            </td>
                                            <td>
                                                {{$item->showroom_price}}
                                            </td>
                                            <td>
                                                {{$item->on_road_price}}
                                            </td>
                                            <td>
                                                <img style="width: 130px; height:90px" src="{{ asset($item->productimage1) }}" alt="">
                                            </td>
                                            <td>
                                                <img style="width: 130px; height:90px" src="{{ asset($item->productimage2) }}" alt="">

                                            </td>
                                            <td>
                                                <img style="width: 130px; height:90px" src="{{ asset($item->productimage3) }}" alt="">

                                            </td>
                                            <td>
                                                <img style="width: 130px; height:90px" src="{{ asset($item->productimage4) }}" alt="">

                                            </td>
                                     
                                            <td>
                                                <img style="width: 130px; height:90px" src="{{ asset($item->productimage5) }}" alt="">

                                            </td>
                                            <td>
                                                <img style="width: 130px; height:90px" src="{{ asset($item->productimage6) }}" alt="">

                                            </td>
                                            <td>
                                                <img style="width: 130px; height:90px" src="{{ asset($item->productimage7) }}" alt="">

                                            </td>
                                            <td>
                                                <img style="width: 130px; height:90px" src="{{ asset($item->productimage8) }}" alt="">

                                            </td>
                                            <td>
                                                {{$item->body_types}}
                                            </td>
                                            <td>
                                                {{$item->color}}
                                            </td>
                                            <td>
                                                {{$item->mileage}}
                                            </td>
                                            <td>
                                                {{$item->displacement}}
                                            </td>
                                            <td>
                                                {{$item->fule_tank_capacity}}
                                            </td>
                                            <td>
                                                {{$item->kerb_weight}}
                                            </td>
                                            <td>
                                                {{$item->height}}
                                            </td>
                                            <td>
                                                {{$item->top_speed}}
                                            </td>
                                            <td>
                                                {{$item->engine}}
                                            </td>
                                            <td>
                                                {{$item->fuel_type}}
                                            </td>
                                            <td>
                                                {{$item->transmission_type}}
                                            </td>
                                            <td>
                                                {{$item->seating_capacity}}
                                            </td>
                                            <td>
                                                {{$item->safety}}
                                            </td>
                                            <td>
                                                {{$item->driving_range}}
                                            </td>
                                            <td>
                                                {{$item->charging_time}}
                                            </td>
                                            <td>
                                                <div class="overflow-text">
                                                {{$item->meta_tags}}
                                            </div>
                                            </td>
                                            <td>
                                                <div class="overflow-text">
                                                {{$item->meta_description}}
                                            </td>
                                        </div>
                                            <td>
                                                <div class="overflow-text">
                                                {{$item->highlights}}
                                            </div>
                                            </td>
                                            
                                            <td style="text-wrap: nowrap;">
                                                <div>
                                                    @if ($item->status == 1)
                                                        <a
                                                            href="{{ route('status-product', ['id' => $item->id, 'status' => '0']) }}"onclick="return confirm('Are you sure!')">
                                                            <span class="btn bg-success">Active</span>
                                                        </a>
                                                    @elseif ($item->status == 0)
                                                        <a href="{{ route('status-product', ['id' => $item->id, 'status' => '1']) }}"
                                                            onclick="return confirm('Are you sure!')">
                                                            <span class="btn bg-danger">Deactive</span>
                                                        </a>
                                                    @else
                                                    @endif
                                                </div>
                                            </td>
                                            <td style="text-wrap: nowrap;">
                                                <div>
                                                    <a href="{{ route('edit-product', ['id' => $item->id]) }} "
                                                        class="btn-icon">
                                                        <i class="far fa-edit"></i>
                                                    </a>
                                                    <a href="{{ route('delete-product', ['id' => $item->id]) }} "
                                                        class="btn-icon open-detele-modal" data-toggle="modal"
                                                        data-target="#modal-default">
                                                        <i class="fas  text-danger fa-trash"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="blog__pagination px-2">
                                {{ $product->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Delete Modal -->
        <div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="modal-default-label"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-default-label">Confirm Delete</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- Modal Body -->
                    <div class="modal-body text-center">
                        <b>Are you sure want to delete this Product?</b>
                    </div>
                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <a href="" class="btn btn-primary delete-modal">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
