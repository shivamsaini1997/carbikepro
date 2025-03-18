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
        height: 35px;
        overflow: auto;
    }
.headtable tr th {
    box-shadow: none !important;
    border: 0;
}
</style>
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Manage Category</h1>
                    </div>
                    <div class="col-sm-6">
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="card-body table-responsive p-0">
                        <table class="table table-head-fixed text-nowrap table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">#</th>
                                    <th style="width: 10%;">Category</th>
                                    <th style="width: 90%;">
                                        <table class="table table-sm text-nowrap m-0 headtable">
                                            <thead>
                                                <tr>
                                                    <th style="width: 20%;">Sub Category</th>
                                                    <th style="width: 20%;">Page Type</th>
                                                    <th style="width: 20%;">Meta Description</th>
                                                    <th style="width: 20%;">Meta Tags</th>
                                                    <th style="width: 30%;">Action</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $counter = 1;
                                    $categieryid = [];
                                    $catid = [];

                                    // Collect all parent IDs in the $categieryid array
                                    foreach ($category as $item) {
                                        foreach ($category as $subcategory) {
                                            if ($item->id == $subcategory->parent_id) {
                                                $categieryid[] = $subcategory->parent_id;
                                            }
                                        }
                                    }

                                    // Store parent IDs into $catid array
                                    foreach ($categieryid as $items) {
                                        $catid[] = $items;
                                    }
                                @endphp

                                @foreach ($category as $item)
                                    @if($item->parent_id == 0)
                                        <tr>
                                            <td><span class="increment">{{$counter}}.</span></td>
                                            <td>
                                                <b>{{$item->category}}</b>
                                                @if (!in_array($item->id, $catid))
                                                    <a href="{{route('delete-category' ,['id' => $item->id])}}" class="px-2">
                                                        <i class="fas text-danger fa-trash"></i>
                                                    </a>
                                                @endif
                                            </td>
                                            <td class="p-0">
                                                <table class="table table-sm table-bordered m-0">
                                                    @foreach ($category as $subcategory)
                                                        @if ($subcategory->parent_id == $item->id)
                                                            <tr>
                                                                <td style="width: 20%;">{{$subcategory->category}}</td>
                                                                <td style="width: 20%;">
                                                                    @if ($subcategory->page_type == 1)
                                                                        Category page
                                                                        @elseif ($subcategory->page_type == 2)
                                                                        Sub Category page
                                                                    @endif

                                                                </td>
                                                                <td style="width: 20%;">
                                                                    <div class="overflow-text">
                                                                        {{$subcategory->meta_description}}
                                                                    </div>
                                                                    
                                                                    </td>
                                                                <td style="width: 20%;">
                                                                    <div class="overflow-text">
                                                                        {{$subcategory->meta_tags}}
                                                                    </div>
                                                                </td>
                                                                <td style="width: 30%;">
                                                                    <a href="{{ route('edit-subcategory', ['id' => $subcategory->id]) }} "
                                                                        class="btn-icon">
                                                                        <i class="far fa-edit"></i>
                                                                    </a>
                                                                    <a href="{{route('delete-subcategory' ,['id' => $subcategory->id])}}" class="px-2">
                                                                        <i class="fas text-danger fa-trash"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                </table>
                                            </td>
                                        </tr>
                                        @php
                                            $counter++;
                                        @endphp
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
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
                        <b>Are you sure want to delete this Category</b>
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
