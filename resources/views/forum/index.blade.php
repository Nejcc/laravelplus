@extends('layouts.plugins.forum.master')

@section('title', __('Dashboard'))

@section('header')
    <div class="page-header d-print-none">
        <div class="{{ config('plugins.forum.container') }}">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        {{__('Overview')}}
                    </div>
                    <h2 class="page-title">
                        {{__('Dashboard')}}
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <span class="d-none d-sm-inline">
                            <a href="#" class="btn">New view</a>
                        </span>
                        <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal"
                           data-bs-target="#modal-report">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M12 5l0 14"></path>
                                <path d="M5 12l14 0"></path>
                            </svg>
                            Create new report
                        </a>
                        <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal"
                           data-bs-target="#modal-report" aria-label="Create new report">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M12 5l0 14"></path>
                                <path d="M5 12l14 0"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <x-notification.modals.what-is-new></x-notification.modals.what-is-new>

    <div class="{{ config('plugins.forum.container') }} my-3">
        <div class="row row-cards">
            <div class="col-9">
                <div class="row">
                    @foreach($topics as $topic)
                        {{--                        @dd($topic)--}}
                        <div class="col-12">
                            <h1 class="mb-0">{{ $topic['title'] ?? '---' }}</h1>
                            <p>{{ $topic['description'] ?? '' }}</p>
                        </div>
                        @foreach($topic['topics'] as $topic)
                            <div class="col-12 mb-3">
                                <div class="card rounded-3">
                                    <div class="card-header hover-shadow-sm ">
                                        <a href="#">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                <span class="avatar bg-warning avatar-rounded avatar-sm">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler text-white icon-tabler-messages" width="24" height="24" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
   <path d="M21 14l-3 -3h-7a1 1 0 0 1 -1 -1v-6a1 1 0 0 1 1 -1h9a1 1 0 0 1 1 1v10"></path>
   <path d="M14 15v2a1 1 0 0 1 -1 1h-7l-3 3v-10a1 1 0 0 1 1 -1h2"></path>
</svg>
                                                </span>
                                                </div>
                                                <div class="col">
                                                    <div class="card-title">{{ $topic['title'] }}</div>
                                                    <div class="card-subtitle">{{ $topic['description'] }}</div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="card-actions col-3">
                                        <span class="mx-3">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 class="icon icon-tabler icon-tabler-brand-wechat" width="24"
                                                 height="24" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor"
                                                 fill="none" stroke-linecap="round" stroke-linejoin="round">
   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
   <path d="M16.5 10c3.038 0 5.5 2.015 5.5 4.5c0 1.397 -.778 2.645 -2 3.47l0 2.03l-1.964 -1.178a6.649 6.649 0 0 1 -1.536 .178c-3.038 0 -5.5 -2.015 -5.5 -4.5s2.462 -4.5 5.5 -4.5z"></path>
   <path d="M11.197 15.698c-.69 .196 -1.43 .302 -2.197 .302a8.008 8.008 0 0 1 -2.612 -.432l-2.388 1.432v-2.801c-1.237 -1.082 -2 -2.564 -2 -4.199c0 -3.314 3.134 -6 7 -6c3.782 0 6.863 2.57 7 5.785l0 .233"></path>
   <path d="M10 8h.01"></path>
   <path d="M7 8h.01"></path>
   <path d="M15 14h.01"></path>
   <path d="M18 14h.01"></path>
</svg>
                                            34
                                        </span>
                                            <span class="mx-3">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 class="icon icon-tabler icon-tabler-eye" width="24" height="24"
                                                 viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none"
                                                 stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                                <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6"></path>
                                            </svg>
                                            13.4M
                                        </span>
                                            <span class="mx-3">
                                            {{now()->format('F d, Y')}}
                                        </span>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-body">
                        <h2 class="title">BeeApp Beekeeping Forums</h2>
                        <span class="board-since">Since 1999</span>
                        <div>
                            <p>A forum community dedicated to beekeeping, bee owners and enthusiasts. Come join the
                                discussion about breeding, honey production, health, behavior, hives, housing, adopting,
                                care, classifieds, and more!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')

@endsection

@push('css')

@endpush

@push('js')

@endpush
