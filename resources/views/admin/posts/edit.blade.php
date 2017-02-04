@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            {{ isset($post) ? 'Edit' : 'New' }} post
        </div>
        <div class="card-block">
            <form id="save-post"
                  method="POST"
                  action="{{ isset($post) ? route('admin.posts.update', $post) : route('admin.posts.store') }}"
                  enctype="multipart/form-data"
                  novalidate>
                {{ csrf_field() }}

                @if(isset($post))
                    {{ method_field('PUT') }}
                @endif

                <fieldset {{ isset($post) && Auth::user()->cannot('update', $post) ? 'disabled' : '' }}>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                <label for="title" class="form-control-label">Title</label>
                                <input type="text"
                                       id="title"
                                       form="save-post"
                                       class="form-control{{ $errors->has('title') ? ' form-control-danger' : '' }}"
                                       name="title"
                                       value="{{ isset($post) ? $post->title : old('title') }}"
                                       required
                                       autocomplete="off">

                                @if ($errors->has('title'))
                                    <div class="form-control-feedback">
                                        {{ $errors->first('title') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('media') || $errors->has('media.0.file') ? ' has-danger' : '' }}">
                                <label class="form-control-label">Picture/Video</label>
                                <input type="file"
                                       id="media"
                                       name="media[][file]"
                                       class="form-control media-upload"
                                       multiple
                                       accept="image/*,video/mp4,video/x-m4v,video/*">

                                @if ($errors->has('media'))
                                    <div class="form-control-feedback">
                                        {{ $errors->first('media') }}
                                    </div>
                                @endif

                                @if ($errors->has('media.0.file'))
                                    <div class="form-control-feedback">
                                        The files must be images or videos and cannot be more than 1G in size.
                                    </div>
                                @endif
                            </div>

                            @if (isset($post))
                                <div class="row sortable" data-post-id="{{ $post->id }}">
                                    @foreach ($post->media as $media)
                                        <div class="col-xs-6 col-lg-3 mb-2 draggable" data-media-id="{{ $media->id }}">
                                            <div class="card">
                                                <div style="position:relative">
                                                    <img src="{{ Storage::url($media->getThumbnail()->path) }}"
                                                         class="card-img-top img-fluid">
                                                    @if ($media->type === 'video')
                                                        <i class="fa fa-play-circle-o fa-4x play-icon"></i>
                                                    @endif
                                                </div>
                                                <div class="card-block">
                                                    <div class="checkbox float-xs-left">
                                                        <label class="custom-control custom-checkbox mb-0">
                                                            <input type="checkbox"
                                                                   name="media[{{ $media->id }}][protected]"
                                                                   class="custom-control-input"
                                                                    {{ $media->protected ? 'checked' : '' }}>
                                                            <span class="custom-control-indicator"></span>
                                                            <span class="custom-control-description">VIP</span>
                                                        </label>
                                                    </div>
                                                    <button type="button"
                                                            class="close delete-media-button"
                                                            data-post-id="{{ $post->id }}"
                                                            data-media-id="{{ $media->id }}">
                                                        <i class="fa fa-times text-danger"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            <div class="row media-previews pt-1 m-1 rounded"></div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('content') ? ' has-danger' : '' }} mb-4">
                        <label for="content" class="form-control-label">Content</label>
                        <textarea id="content"
                                  form="save-post"
                                  class="form-control{{ $errors->has('content') ? ' form-control-danger' : '' }} tinymce"
                                  name="content"
                                  required>{{ isset($post) ? $post->content : old('content') }}</textarea>

                        @if ($errors->has('content'))
                            <span class="form-control-feedback">
                            {{ $errors->first('content') }}
                        </span>
                        @endif
                    </div>

                    @if(isset($post))
                        <fieldset class="form-inline" {{ Auth::user()->can('update', $post) ?: 'disabled' }}>
                            <button type="submit" class="btn btn-success">Update</button>
                            <button type="button" class="btn btn-danger delete-post-button">Delete</button>
                        </fieldset>
                    @else
                        <button type="submit" form="save-post" class="btn btn-success">Publish Blogpost</button>
                    @endif

                </fieldset>
            </form>
            <form id="delete-media-form"
                  method="POST"
                  style="display:none">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
            </form>
            @if (isset($post))
                <form id="delete-post"
                      action="{{ route('admin.posts.destroy', $post) }}"
                      method="POST"
                      style="display:none">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                </form>
            @endif
        </div>
    </div>
@endsection
