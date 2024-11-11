@extends('frontend.layouts.master')

@section('title', env('APP_NAME') . ' || Posts')

@section('main-content')

@include('frontend.layouts.header_fe')


@php
    $svgContent = file_get_contents(public_path('frontend/svg/posts.svg'));
    echo $svgContent;
  @endphp

<div class="post-wrap padding-large overflow-hidden">
    <div class="container">
        <div class="row">
            <main class="post-grid">
                <div class="row">
                    <article class="post-item mt-5">
                        <div class="post-content">
                            <div class="post-meta text-uppercase">
                                <span class="post-category">{{$post->created_at->format('d/m/Y')}} </span> / <span class="meta-date">-  technology</span>
                            </div>
                            <h1 class="post-title">{{$post->title}}</h1>
                            <div class="post-description review-item padding-medium">
                                <p>
                                    {!! ($post->description) !!}
                                </p>

                                <div class="post-bottom-link d-flex justify-content-between">
                                   
                                    <div class="social-links d-flex">
                                        <div class="element-title pe-2">Share:</div>
                                        <ul class="d-flex list-unstyled">
                                            <li>
                                                <a href="#">
                                                    <svg class="facebook">
                            <use xlink:href="#facebook"></use>
                          </svg>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <svg class="instagram">
                            <use xlink:href="#instagram"></use>
                          </svg>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <svg class="twitter">
                            <use xlink:href="#twitter"></use>
                          </svg>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <svg class="linkedin">
                            <use xlink:href="#linkedin"></use>
                          </svg>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <svg class="youtube">
                            <use xlink:href="#youtube"></use>
                          </svg>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            {{-- <div id="single-post-navigation" class="mb-5">
                                <div class="post-navigation d-flex flex-wrap align-items-center justify-content-between">
                                    <a itemprop="url" class="post-prev d-flex align-items-center" href="">
                                        <svg class="chevron-left">
                      <use xlink:href="#chevron-left"></use>
                    </svg>
                                        <span class="page-nav-title text-uppercase">Get some cool gadgets in 2023</span>
                                    </a>
                                    <a itemprop="url" class="post-next d-flex align-items-center" href="">
                                        <span class="page-nav-title text-uppercase">TOP 10 SMALL CAMERA IN THE WORLD</span>
                                        <svg class="chevron-right">
                      <use xlink:href="#chevron-right"></use>
                    </svg>
                                    </a>
                                </div>
                            </div> --}}
                        </div>
                    </article>

                </div>
            </main>
        </div>
    </div>
</div>



{{-- thiếu dòng @endsection cho section maincontent sẽ bị mất head --}}
@endsection 


