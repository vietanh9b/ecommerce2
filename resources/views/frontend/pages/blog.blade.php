@extends('frontend.layouts.master')

@section('title', env('APP_NAME') . ' || Blog')

@section('main-content')

@include('frontend.layouts.header_fe')


@php
    $svgContent = file_get_contents(public_path('frontend/svg/blog.svg'));
    echo $svgContent;
  @endphp

{{-- Banner --}}
<section class="hero-section position-relative bg-light-blue padding-medium">
    <div class="hero-content">
      <div class="container">
        <div class="row">
          <div class="text-center padding-large no-padding-bottom">
            <h1 class="display-2 text-uppercase text-dark">Blog</h1>
            <div class="breadcrumbs">
              <span class="item">
                <a href="{{ route('home') }}">Home ></a>
              </span>
              <span class="item">Blog</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="post-grid padding-large">
    <div class="container">
        <div class="row d-flex flex-wrap">
            <aside class="col-md-3">
                <div class="sidebar">
                    <div class="sidebar-filter pt-5">                    
                        <div class="widget sidebar-social-links mb-5">
                            <h5 class="widget-title text-uppercase">Social Links</h5>
                            <ul class="sidebar-list list-unstyled">
                                <li class="tags-item">
                                    <a href="">Facebook</a>
                                </li>
                                <li class="tags-item">
                                    <a href="">Instagram</a>
                                </li>
                                <li class="tags-item">
                                    <a href="">Twitter</a>
                                </li>
                                <li class="tags-item">
                                    <a href="">Pinterest</a>
                                </li>
                                <li class="tags-item">
                                    <a href="">Youtube</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </aside>
            <main class="col-md-9">
                <div class="row">
                    @foreach($posts as $post)
                    <div class="col-lg-4">
                        <div class="card border-none">
                            <div class="card-image">
                                <img src="{{ $post->photo }}" alt="" class="img-fluid">
                            </div>
                        </div>
                        <div class="card-body text-uppercase">
                            <div class="card-meta text-muted">
                                <span class="meta-date">{{ $post->created_at->format('d/m/Y')}}</span>
                                <span class="meta-category">- Gadgets</span>
                            </div>
                            <h3 class="card-title">
                                <a href="{{route('blog.detail',$post->slug)}}">{{ $post->title}}</a>
                            </h3>
                        </div>
                    </div>
                    @endforeach
                </div>
            </main>
            @if($posts->count())
                <div class="pagination">
                    {!! $posts->links('pagination::bootstrap-4') !!}
                </div>
            @endif
        </div>
    </div>
</section>

{{-- thiếu dòng @endsection cho section maincontent sẽ bị mất head --}}
@endsection 


