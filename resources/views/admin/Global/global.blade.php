<?php
    use Illuminate\Support\Facades\Storage;
?>
@extends('admin.layout.main')
@push('title')
    <title>Global</title>
@endpush
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Global</h1>
                </div>
                <div class="col-sm-6">

                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <form action="{{ route('global') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="data_id" value="{{ $global->id ?? '' }}">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Global Setting</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Header Logo -->
                    <div class="row align-items-center">
                        <div class="col-lg-8 col-md-6">
                            <div class="mb-3">
                                <label for="header_logo" class="form-label">Header Logo</label>
                                <input type="file" name="header_logo" id="header_logo" value="" class="form-control" accept="image/*" />
                                @error('header_logo')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 pt-4">
                            <div class="mb-3 position-relative">
                                @if(isset($global->headerlogo) && $global->headerlogo)
                                    <img src="{{ asset($global->headerlogo) }}" alt="" style="width: 120px;height: 80px;object-fit: contain;">
                                    <a href="{{ route('delete-header-logo', ['id' => $global->id]) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"  onclick="return confirm('Are you sure you want to delete the header logo?');">
                                        <i class="nav-icon fas fa-trash text-danger pe-auto admin-delete"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Favicon -->
                    <div class="row align-items-center">
                        <div class="col-lg-8 col-md-6">
                            <div class="mb-3">
                                <label for="favicon" class="form-label">Favicon</label>
                                <input type="file" name="favicon" id="favicon" class="form-control" accept="image/*" />
                                @error('favicon')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 pt-4">
                            <div class="mb-3">
                                @if(isset($global->favicon) && $global->favicon)
                                <img src="{{ asset($global->favicon) }}" alt="" style="width: 30px;height: 30px;object-fit: contain;">
                                <a href="{{ route('delete-favicon', ['id' => $global->id]) }}"  data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" onclick="return confirm('Are you sure you want to delete the favicon?');">
                                    <i class="nav-icon fas fa-trash text-danger pe-auto admin-delete"></i>
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Footer Logo -->
                    <div class="row align-items-center">
                        <div class="col-lg-8 col-md-6">
                            <div class="mb-3">
                                <label for="footer_logo" class="form-label">Footer Logo</label>
                                <input type="file" name="footer_logo" id="footer_logo" class="form-control" accept="image/*" />

                                @error('footer_logo')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 pt-4">
                            <div class="mb-3">

                                @if(isset($global->footerlogo) && $global->footerlogo)
                                <img src="{{ asset($global->footerlogo) }}" alt="" style="width: 120px;height: 80px;object-fit: contain;">
                                <a href="{{ route('delete-footer-logo', ['id' => $global->id]) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"  onclick="return confirm('Are you sure you want to delete the footer logo?');">
                                    <i class="nav-icon fas fa-trash text-danger pe-auto admin-delete"></i>
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Other Fields -->
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="instagram_link" class="form-label">Instagram Link</label>
                                <input type="url" name="instagram_link" id="instagram_link" class="form-control" value="{{  $global?$global->instagramlink : ''}}" />
                                @error('instagram_link')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="youtube_link" class="form-label">Youtube Link</label>
                                <input type="url" name="youtube_link" id="youtube_link" class="form-control" value="{{  $global?$global->youtubelink : ''}}" />
                                @error('youtube_link')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="facebook_link" class="form-label">Facebook Link</label>
                                <input type="url" name="facebook_link" id="facebook_link" class="form-control" value="{{  $global?$global->facebooklink : '' }}" />
                                @error('facebook_link')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="linkedin_link" class="form-label">Linkedin Link</label>
                                <input type="url" name="linkedin_link" id="linkedin_link" class="form-control" value="{{ $global? $global->linkedinlink : ''}}" />
                                @error('linkedin_link')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" name="phone" id="phone" maxlength="10" minlength="10" class="form-control" value="{{ $global? $global->phone : '' }}" />
                                @error('phone')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ $global?$global->email : '' }}" />
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="office_address" class="form-label">Office Address</label>
                                <input type="text" name="office_address" id="office_address" class="form-control" value="{{ $global? $global->address : '' }}" />
                                @error('office_address')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary">Submit</button>
        </form>

    </section>

</div>
@endsection
