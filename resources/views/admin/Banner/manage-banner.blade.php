@extends('admin.layout.main')
@push('title')
    <title>Manage Banner</title>
@endpush
<style>
    .btn-icon {
        font-size: 20px;
        margin: 0 12px 0 0;
        color: #111;
    }
    .overflow-fiexd {
        height: 130px;
        overflow-y: auto;
        font-size: 14px;
    }
</style>
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Manage Banner</h1>
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
                                        <th>Page</th>
                                        <th>Banner URL</th>
                                        <th>Banner</th>
                                        <th style="width: 11%">Status</th>
                                        <th style="width: 50px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $subcat = [];
                                        $pagename = [];

                                        foreach ($category as $items) {
                                            foreach ($category as $subcategory) {
                                                if ($subcategory->parent_id == $items->id) {
                                                    $subcat[] = $subcategory->category;
                                                }
                                            }
                                        }

                                        foreach($banner_page_name as $banner_page){
                                            $pagename[] = $banner_page->pages_name;
                                        }
                                    @endphp

                                    @foreach ($banner as $item)
                                        <tr>
                                            <td><span class="increment">{{ $loop->iteration + $banner->firstItem() - 1 }}.</span></td>
                                            <td>
                                                @if ($item->pages_name == 'Home Page')
                                                    <p>Home Page</p>
                                                    @elseif (in_array($item->pages_name, $pagename))
                                                    <p>{{ $item->pages_name }}</p>
                                                @endif

                                                {{-- @if (in_array($item->pages_name, $subcat))
                                                    @if ($subcategory->parent_id == array_search($item->pages_name, $pagename))
                                                        <p>{{ $subcategory->category }}</p>
                                                    @endif
                                                @endif --}}
                                            </td>
                                            <td>
                                                <p>{{ $item->banner_url ?? 'null' }}</p>
                                            </td>
                                            <td>
                                                <img style="width: 250px; height:90px" src="{{ asset($item->banner) }}" alt="">
                                            </td>
                                            <td style="text-wrap: nowrap;">
                                                <div>
                                                    @if ($item->status == 1)
                                                        <a href="{{ route('status-banner', ['id' => $item->id, 'status' => '0']) }}" onclick="return confirm('Are you sure?')">
                                                            <span class="btn bg-success">Active</span>
                                                        </a>
                                                    @elseif ($item->status == 0)
                                                        <a href="{{ route('status-banner', ['id' => $item->id, 'status' => '1']) }}" onclick="return confirm('Are you sure?')">
                                                            <span class="btn bg-danger">Deactive</span>
                                                        </a>
                                                    @endif
                                                </div>
                                            </td>
                                            <td style="text-wrap: nowrap;">
                                                <div>
                                                    <a href="{{ route('edit-banner', ['id' => $item->id]) }}" class="btn-icon">
                                                        <i class="far fa-edit"></i>
                                                    </a>
                                                    <a href="{{ route('delete-banner', ['id' => $item->id]) }}" class="btn-icon open-detele-modal" data-toggle="modal" data-target="#modal-default">
                                                        <i class="fas text-danger fa-trash"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>


                            </table>
                            <div class="blog__pagination px-2">
                                {{ $banner->links('pagination::bootstrap-5') }}
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
                        <b>Are you sure want to delete this Banner</b>
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
