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
                        <h1>Manage News</h1>
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
                                        <th style="width: 10%">News Page</th>
                                        <th style="width: 10%">Category</th>
                                        <th style="width: 10%">Brands</th>
                                        <th style="width: 10%">Product Name </th>
                                        <th>News Image</th>
                                        <th style="width: 15%">Title</th>
                                        <th style="width: 15%">Slug</th>
                                        <th>News Details</th>
                                        <th style="width: 6%">Status</th>
                                        <th style="width: 50px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($newsdetail as $item)
                                        <tr>
                                            <td><span class="increment">{{ $loop->iteration + $newsdetail->firstItem() - 1 }}.</span></td>
                                            <td>
                                                {{$item->news_page}}
                                            </td>
                                            <td>
                                                {{$item->category}}
                                            </td>
                                            <td>
                                                {{$item->brands}}
                                            </td>
                                            <td>
                                                {{$item->product_name}}
                                            </td>
                                            <td>
                                                <img style="width: 90px; height:90px" src="{{ asset($item->news_image) }}"
                                                alt="">
                                            </td>
                                            <td>
                                                <p>{{ $item->title}}</p>
                                            </td>
                                            <td>
                                                <p>{{ $item->slug}}</p>
                                            </td>

                                            
                                            <td>
                                                <div class="overflow-text">{!!$item->news_details!!}</div>
                                            </td>
                                            <td style="text-wrap: nowrap;">
                                                <div>
                                                    @if ($item->status == 1)
                                                        <a
                                                            href="{{ route('status-news-reviews', ['id' => $item->id, 'status' => '0']) }}"onclick="return confirm('Are you sure!')">
                                                            <span class="btn bg-success">Active</span>
                                                        </a>
                                                    @elseif ($item->status == 0)
                                                        <a href="{{ route('status-news-reviews', ['id' => $item->id, 'status' => '1']) }}"
                                                            onclick="return confirm('Are you sure!')">
                                                            <span class="btn bg-danger">Deactive</span>
                                                        </a>
                                                    @else
                                                    @endif
                                                </div>
                                            </td>
                                            <td style="text-wrap: nowrap;">
                                                <div>
                                                    <a href="{{ route('edit-news-reviews', ['id' => $item->id]) }} "
                                                        class="btn-icon">
                                                        <i class="far fa-edit"></i>
                                                    </a>
                                                    <a href="{{ route('delete-news-reviews', ['id' => $item->id]) }} "
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
                                {{ $newsdetail->links('pagination::bootstrap-5') }}
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
                        <b>Are you sure want to delete this News</b>
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
