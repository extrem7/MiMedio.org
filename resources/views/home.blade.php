@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-4 col-md-6 col-12">
            <a href="{{route(Auth::check()?'posts.create':'join')}}"
               class="button btn-yellow w-100 mb-4 btn-transform">Create the new post</a>
            <div class="main-h-news inline-blocks vertical-scroll">
                <div class="article-card card-lg">
                    <a href="" class="article-img mb-3 lg-img">
                        <img
                            src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRyCTUFDq2yLfY8ZGid4uxoFLxLeRAJBRH9o_rvMiXd5uSfDlXM&s"
                            alt="name-article">
                    </a>
                    <a href="" class="article-title title-nowrap mb-2">Mexico suma otro periodista asesinado</a>
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="date-info bottom-line d-flex align-items-center">
                            29.12.2019 <a href="" class="profile-link title-nowrap">Maria De Jesus</a>
                        </div>
                        <div class="copy-link" data-container="body" data-toggle="popover" data-placement="top"
                             data-content="Copy post URL">
                            <i class="far fa-copy"></i>
                        </div>
                    </div>
                    <div class="article-short-text title-line-cap">
                        El secretario general de la Organización de Estados Americanos (OEA), Luis Almagro, llegará a
                        Bolivia este viernes 17 de mayo y desde ya acapara toda la atención en la nación sudamericana.
                        El secretario general de la Organización de Estados Americanos (OEA), Luis Almagro, llegará a
                        Bolivia este viernes 17 de mayo y desde ya acapara toda la atención en la nación sudamericana.
                    </div>
                    <div class="article-button-action mt-3 position-relative">
                        <div class="d-inline-flex">
                            <button class="button btn-silver-light"><i class="far fa-thumbs-up"></i></button>
                            <button class="button btn-silver-light"><i class="far fa-thumbs-down"></i></button>
                            <button class="button btn-silver-light dropdown-toggle btn-comment" data-toggle="dropdown">
                                <i class="far fa-comment-alt"></i><span class="badge-counter">25</span></button>
                            <a href="" class="button btn-silver-light dropdown-toggle btn-comment-link"><i
                                    class="far fa-comment-alt"></i><span class="badge-counter">25</span></a>
                            <div class="dropdown-menu dropdown-last-comment">
                                <div class="semi-bold blue-color mb-2">Last Comments</div>
                                <div class="last-comment">
                                    <div class="last-comment-item">
                                        <div class="d-flex align-items-center">
                                            <div class="name title-nowrap">Gerry robins</div>
                                            <div class="date">8 days ago</div>
                                        </div>
                                        <div class="text-comment mt-1 title-line-cap">Lorem ipsum dolor sit amet, cu
                                            viderer deseruisse sea, ne ridens euripidis quo. No nec regione ornatus
                                            fabellas, id case erroribus quo.
                                        </div>
                                    </div>
                                    <div class="last-comment-item">
                                        <div class="d-flex align-items-center">
                                            <div class="name title-nowrap">Gerry robins</div>
                                            <div class="date">8 days ago</div>
                                        </div>
                                        <div class="text-comment mt-1 title-line-cap">Lorem ipsum dolor sit amet, cu
                                            viderer deseruisse sea, ne ridens euripidis quo. No nec regione ornatus
                                            fabellas, id case erroribus quo.
                                        </div>
                                    </div>
                                    <div class="last-comment-item">
                                        <div class="d-flex align-items-center">
                                            <div class="name title-nowrap">Gerry robins</div>
                                            <div class="date">8 days ago</div>
                                        </div>
                                        <div class="text-comment mt-1 title-line-cap">Lorem ipsum dolor sit amet, cu
                                            viderer deseruisse sea, ne ridens euripidis quo. No nec regione ornatus
                                            fabellas, id case erroribus quo.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="text-muted ml-15 mr-2">Share:</div>
                            <div class="btn-group">
                                <button class="button btn-silver-light extra-bold dropdown-toggle"
                                        data-toggle="dropdown">Mi
                                </button>
                                <div class="dropdown-menu dropdown-light">
                                    <a href="" class="">Share in My Feed</a>
                                    <a href="" class="">Share in Message</a>
                                </div>
                                <button class="button btn-silver-light"><i class="fab fa-twitter"></i></button>
                                <button class="button btn-silver-light"><i class="fab fa-facebook-f"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="article-card card-lg">
                    <a href="" class="article-img mb-3 lg-img">
                        <img
                            src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRyCTUFDq2yLfY8ZGid4uxoFLxLeRAJBRH9o_rvMiXd5uSfDlXM&s"
                            alt="name-article">
                    </a>
                    <a href="" class="article-title title-nowrap mb-2">Mexico suma otro periodista asesinado</a>
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="date-info bottom-line d-flex align-items-center">
                            29.12.2019 <a href="" class="profile-link title-nowrap">Maria De Jesus</a>
                        </div>
                        <div class="copy-link" data-container="body" data-toggle="popover" data-placement="top"
                             data-content="Copy post URL">
                            <i class="far fa-copy"></i>
                        </div>
                    </div>
                    <div class="article-short-text title-line-cap">
                        El secretario general de la Organización de Estados Americanos (OEA), Luis Almagro, llegará a
                        Bolivia este viernes 17 de mayo y desde ya acapara toda la atención en la nación sudamericana.
                        El secretario general de la Organización de Estados Americanos (OEA), Luis Almagro, llegará a
                        Bolivia este viernes 17 de mayo y desde ya acapara toda la atención en la nación sudamericana.
                    </div>
                    <div class="article-button-action mt-3 position-relative">
                        <div class="d-inline-flex">
                            <button class="button btn-silver-light"><i class="far fa-thumbs-up"></i></button>
                            <button class="button btn-silver-light"><i class="far fa-thumbs-down"></i></button>
                            <button class="button btn-silver-light dropdown-toggle btn-comment" data-toggle="dropdown">
                                <i class="far fa-comment-alt"></i><span class="badge-counter">25</span></button>
                            <a href="" class="button btn-silver-light dropdown-toggle btn-comment-link"><i
                                    class="far fa-comment-alt"></i><span class="badge-counter">25</span></a>
                            <div class="dropdown-menu dropdown-last-comment">
                                <div class="semi-bold blue-color mb-2">Last Comments</div>
                                <div class="last-comment">
                                    <div class="last-comment-item">
                                        <div class="d-flex align-items-center">
                                            <div class="name title-nowrap">Gerry robins</div>
                                            <div class="date">8 days ago</div>
                                        </div>
                                        <div class="text-comment mt-1 title-line-cap">Lorem ipsum dolor sit amet, cu
                                            viderer deseruisse sea, ne ridens euripidis quo. No nec regione ornatus
                                            fabellas, id case erroribus quo.
                                        </div>
                                    </div>
                                    <div class="last-comment-item">
                                        <div class="d-flex align-items-center">
                                            <div class="name title-nowrap">Gerry robins</div>
                                            <div class="date">8 days ago</div>
                                        </div>
                                        <div class="text-comment mt-1 title-line-cap">Lorem ipsum dolor sit amet, cu
                                            viderer deseruisse sea, ne ridens euripidis quo. No nec regione ornatus
                                            fabellas, id case erroribus quo.
                                        </div>
                                    </div>
                                    <div class="last-comment-item">
                                        <div class="d-flex align-items-center">
                                            <div class="name title-nowrap">Gerry robins</div>
                                            <div class="date">8 days ago</div>
                                        </div>
                                        <div class="text-comment mt-1 title-line-cap">Lorem ipsum dolor sit amet, cu
                                            viderer deseruisse sea, ne ridens euripidis quo. No nec regione ornatus
                                            fabellas, id case erroribus quo.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="text-muted ml-15 mr-2">Share:</div>
                            <div class="btn-group">
                                <button class="button btn-silver-light extra-bold dropdown-toggle"
                                        data-toggle="dropdown">Mi
                                </button>
                                <div class="dropdown-menu dropdown-light">
                                    <a href="" class="">Share in My Feed</a>
                                    <a href="" class="">Share in Message</a>
                                </div>
                                <button class="button btn-silver-light"><i class="fab fa-twitter"></i></button>
                                <button class="button btn-silver-light"><i class="fab fa-facebook-f"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="article-card card-lg">
                    <a href="" class="article-img mb-3 lg-img">
                        <img
                            src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRyCTUFDq2yLfY8ZGid4uxoFLxLeRAJBRH9o_rvMiXd5uSfDlXM&s"
                            alt="name-article">
                    </a>
                    <a href="" class="article-title title-nowrap mb-1">Mexico suma otro periodista asesinado</a>
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="date-info bottom-line d-flex align-items-center">
                            29.12.2019 <a href="" class="profile-link title-nowrap">Maria De Jesus</a>
                        </div>
                        <div class="copy-link" data-container="body" data-toggle="popover" data-placement="top"
                             data-content="Copy post URL">
                            <i class="far fa-copy"></i>
                        </div>
                    </div>
                    <div class="article-short-text title-line-cap">
                        El secretario general de la Organización de Estados Americanos (OEA), Luis Almagro, llegará a
                        Bolivia este viernes 17 de mayo y desde ya acapara toda la atención en la nación sudamericana.
                        El secretario general de la Organización de Estados Americanos (OEA), Luis Almagro, llegará a
                        Bolivia este viernes 17 de mayo y desde ya acapara toda la atención en la nación sudamericana.
                    </div>
                    <div class="article-button-action mt-3 position-relative">
                        <div class="d-inline-flex">
                            <button class="button btn-silver-light"><i class="far fa-thumbs-up"></i></button>
                            <button class="button btn-silver-light"><i class="far fa-thumbs-down"></i></button>
                            <button class="button btn-silver-light dropdown-toggle btn-comment" data-toggle="dropdown">
                                <i class="far fa-comment-alt"></i><span class="badge-counter">25</span></button>
                            <a href="" class="button btn-silver-light dropdown-toggle btn-comment-link"><i
                                    class="far fa-comment-alt"></i><span class="badge-counter">25</span></a>
                            <div class="dropdown-menu dropdown-last-comment">
                                <div class="semi-bold blue-color mb-2">Last Comments</div>
                                <div class="last-comment">
                                    <div class="last-comment-item">
                                        <div class="d-flex align-items-center">
                                            <div class="name title-nowrap">Gerry robins</div>
                                            <div class="date">8 days ago</div>
                                        </div>
                                        <div class="text-comment mt-1 title-line-cap">Lorem ipsum dolor sit amet, cu
                                            viderer deseruisse sea, ne ridens euripidis quo. No nec regione ornatus
                                            fabellas, id case erroribus quo.
                                        </div>
                                    </div>
                                    <div class="last-comment-item">
                                        <div class="d-flex align-items-center">
                                            <div class="name title-nowrap">Gerry robins</div>
                                            <div class="date">8 days ago</div>
                                        </div>
                                        <div class="text-comment mt-1 title-line-cap">Lorem ipsum dolor sit amet, cu
                                            viderer deseruisse sea, ne ridens euripidis quo. No nec regione ornatus
                                            fabellas, id case erroribus quo.
                                        </div>
                                    </div>
                                    <div class="last-comment-item">
                                        <div class="d-flex align-items-center">
                                            <div class="name title-nowrap">Gerry robins</div>
                                            <div class="date">8 days ago</div>
                                        </div>
                                        <div class="text-comment mt-1 title-line-cap">Lorem ipsum dolor sit amet, cu
                                            viderer deseruisse sea, ne ridens euripidis quo. No nec regione ornatus
                                            fabellas, id case erroribus quo.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="text-muted ml-15 mr-2">Share:</div>
                            <div class="btn-group">
                                <button class="button btn-silver-light extra-bold dropdown-toggle"
                                        data-toggle="dropdown">Mi
                                </button>
                                <div class="dropdown-menu dropdown-light">
                                    <a href="" class="">Share in My Feed</a>
                                    <a href="" class="">Share in Message</a>
                                </div>
                                <button class="button btn-silver-light"><i class="fab fa-twitter"></i></button>
                                <button class="button btn-silver-light"><i class="fab fa-facebook-f"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="article-card card-lg">
                    <a href="" class="article-img mb-3 lg-img">
                        <img
                            src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRyCTUFDq2yLfY8ZGid4uxoFLxLeRAJBRH9o_rvMiXd5uSfDlXM&s"
                            alt="name-article">
                    </a>
                    <a href="" class="article-title title-nowrap mb-1">Mexico suma otro periodista asesinado</a>
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="date-info bottom-line d-flex align-items-center">
                            29.12.2019 <a href="" class="profile-link title-nowrap">Maria De Jesus</a>
                        </div>
                        <div class="copy-link" data-container="body" data-toggle="popover" data-placement="top"
                             data-content="Copy post URL">
                            <i class="far fa-copy"></i>
                        </div>
                    </div>
                    <div class="article-short-text title-line-cap">
                        El secretario general de la Organización de Estados Americanos (OEA), Luis Almagro, llegará a
                        Bolivia este viernes 17 de mayo y desde ya acapara toda la atención en la nación sudamericana.
                        El secretario general de la Organización de Estados Americanos (OEA), Luis Almagro, llegará a
                        Bolivia este viernes 17 de mayo y desde ya acapara toda la atención en la nación sudamericana.
                    </div>
                    <div class="article-button-action mt-3 position-relative">
                        <div class="d-inline-flex">
                            <button class="button btn-silver-light"><i class="far fa-thumbs-up"></i></button>
                            <button class="button btn-silver-light"><i class="far fa-thumbs-down"></i></button>
                            <button class="button btn-silver-light dropdown-toggle btn-comment" data-toggle="dropdown">
                                <i class="far fa-comment-alt"></i><span class="badge-counter">25</span></button>
                            <a href="" class="button btn-silver-light dropdown-toggle btn-comment-link"><i
                                    class="far fa-comment-alt"></i><span class="badge-counter">25</span></a>
                            <div class="dropdown-menu dropdown-last-comment">
                                <div class="semi-bold blue-color mb-2">Last Comments</div>
                                <div class="last-comment">
                                    <div class="last-comment-item">
                                        <div class="d-flex align-items-center">
                                            <div class="name title-nowrap">Gerry robins</div>
                                            <div class="date">8 days ago</div>
                                        </div>
                                        <div class="text-comment mt-1 title-line-cap">Lorem ipsum dolor sit amet, cu
                                            viderer deseruisse sea, ne ridens euripidis quo. No nec regione ornatus
                                            fabellas, id case erroribus quo.
                                        </div>
                                    </div>
                                    <div class="last-comment-item">
                                        <div class="d-flex align-items-center">
                                            <div class="name title-nowrap">Gerry robins</div>
                                            <div class="date">8 days ago</div>
                                        </div>
                                        <div class="text-comment mt-1 title-line-cap">Lorem ipsum dolor sit amet, cu
                                            viderer deseruisse sea, ne ridens euripidis quo. No nec regione ornatus
                                            fabellas, id case erroribus quo.
                                        </div>
                                    </div>
                                    <div class="last-comment-item">
                                        <div class="d-flex align-items-center">
                                            <div class="name title-nowrap">Gerry robins</div>
                                            <div class="date">8 days ago</div>
                                        </div>
                                        <div class="text-comment mt-1 title-line-cap">Lorem ipsum dolor sit amet, cu
                                            viderer deseruisse sea, ne ridens euripidis quo. No nec regione ornatus
                                            fabellas, id case erroribus quo.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="text-muted ml-15 mr-2">Share:</div>
                            <div class="btn-group">
                                <button class="button btn-silver-light extra-bold dropdown-toggle"
                                        data-toggle="dropdown">Mi
                                </button>
                                <div class="dropdown-menu dropdown-light">
                                    <a href="" class="">Share in My Feed</a>
                                    <a href="" class="">Share in Message</a>
                                </div>
                                <button class="button btn-silver-light"><i class="fab fa-twitter"></i></button>
                                <button class="button btn-silver-light"><i class="fab fa-facebook-f"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a href="" class="box-rounded see-more mt-4 link d-block">Load more</a>
        </div>
        <div class="col-lg-4 col-md-6 col-12 mt-5 mt-md-0">
            <a href="{{route('rss')}}" class="button btn-blue btn-transform w-100 mb-4">Add news channel</a>
            @foreach($rss as $item)
                @include('rss.includes.item',['home'=>true])
            @endforeach
        </div>
        <div class="col-lg-4 col-md-12 mt-5 mt-lg-0">
            <div class="row">
                <div class="col-lg-12 col-md-6 col-12">
                    @include('posts.includes.playlist')
                </div>
                <div class="col-lg-12 col-md-6 col-12">
                    <div class="chat-list-sidebar">
                        <div class="box-shadow-content text-center">
                            <div class="title-semi-bold blue-color">Chat</div>
                            <div class="small-size medium-bold silver-color">Last messages</div>
                        </div>
                        <div class="box-rounded border-top-0 vertical-scroll">
                            <a href="" class="chat-item">
                                <div class="avatar">
                                    <img
                                        src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRyCTUFDq2yLfY8ZGid4uxoFLxLeRAJBRH9o_rvMiXd5uSfDlXM&s"
                                        alt="name-article">
                                </div>
                                <div class="chat-info">
                                    <div class="name"><span class="title-nowrap">Paul Shephard </span><span
                                            class="status online"></span></div>
                                    <div class="semi-bold small-size silver-color">29.12.2019</div>
                                    <div class="short-text title-line-cap">Lorem ipsum dolor sit amet, consectetur
                                        adipiscing elit. Vivamus magna. Cras in mi at felis aliquet cong ue. Ut a est
                                        eget ligula molestie.
                                    </div>
                                </div>
                            </a>
                            <a href="" class="chat-item">
                                <div class="avatar">
                                    <img
                                        src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRyCTUFDq2yLfY8ZGid4uxoFLxLeRAJBRH9o_rvMiXd5uSfDlXM&s"
                                        alt="name-article">
                                </div>
                                <div class="chat-info">
                                    <div class="name title-nowrap">Paul Shephard <span class="status online"></span>
                                    </div>
                                    <div class="semi-bold small-size silver-color">29.12.2019</div>
                                    <div class="short-text title-line-cap">Lorem ipsum dolor sit amet, consectetur
                                        adipiscing elit. Vivamus magna. Cras in mi at felis aliquet cong ue. Ut a est
                                        eget ligula molestie.
                                    </div>
                                </div>
                            </a>
                            <a href="" class="chat-item">
                                <div class="avatar">
                                    <img
                                        src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRyCTUFDq2yLfY8ZGid4uxoFLxLeRAJBRH9o_rvMiXd5uSfDlXM&s"
                                        alt="name-article">
                                </div>
                                <div class="chat-info">
                                    <div class="name title-nowrap">Paul Shephard <span class="status online"></span>
                                    </div>
                                    <div class="semi-bold small-size silver-color">29.12.2019</div>
                                    <div class="short-text title-line-cap">Lorem ipsum dolor sit amet, consectetur
                                        adipiscing elit. Vivamus magna. Cras in mi at felis aliquet cong ue. Ut a est
                                        eget ligula molestie.
                                    </div>
                                </div>
                            </a>
                            <a href="" class="chat-item">
                                <div class="avatar">
                                    <img
                                        src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRyCTUFDq2yLfY8ZGid4uxoFLxLeRAJBRH9o_rvMiXd5uSfDlXM&s"
                                        alt="name-article">
                                </div>
                                <div class="chat-info">
                                    <div class="name title-nowrap">Paul Shephard <span class="status online"></span>
                                    </div>
                                    <div class="semi-bold small-size silver-color">29.12.2019</div>
                                    <div class="short-text title-line-cap">Lorem ipsum dolor sit amet, consectetur
                                        adipiscing elit. Vivamus magna. Cras in mi at felis aliquet cong ue. Ut a est
                                        eget ligula molestie.
                                    </div>
                                </div>
                            </a>
                            <a href="" class="chat-item">
                                <div class="avatar">
                                    <img
                                        src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRyCTUFDq2yLfY8ZGid4uxoFLxLeRAJBRH9o_rvMiXd5uSfDlXM&s"
                                        alt="name-article">
                                </div>
                                <div class="chat-info">
                                    <div class="name title-nowrap">Paul Shephard <span class="status online"></span>
                                    </div>
                                    <div class="semi-bold small-size silver-color">29.12.2019</div>
                                    <div class="short-text title-line-cap">Lorem ipsum dolor sit amet, consectetur
                                        adipiscing elit. Vivamus magna. Cras in mi at felis aliquet cong ue. Ut a est
                                        eget ligula molestie.
                                    </div>
                                </div>
                            </a>
                            <a href="" class="chat-item">
                                <div class="avatar">
                                    <img
                                        src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRyCTUFDq2yLfY8ZGid4uxoFLxLeRAJBRH9o_rvMiXd5uSfDlXM&s"
                                        alt="name-article">
                                </div>
                                <div class="chat-info">
                                    <div class="name title-nowrap">Paul Shephard <span class="status online"></span>
                                    </div>
                                    <div class="semi-bold small-size silver-color">29.12.2019</div>
                                    <div class="short-text title-line-cap">Lorem ipsum dolor sit amet, consectetur
                                        adipiscing elit. Vivamus magna. Cras in mi at felis aliquet cong ue. Ut a est
                                        eget ligula molestie.
                                    </div>
                                </div>
                            </a>
                            <a href="" class="chat-item">
                                <div class="avatar">
                                    <img
                                        src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRyCTUFDq2yLfY8ZGid4uxoFLxLeRAJBRH9o_rvMiXd5uSfDlXM&s"
                                        alt="name-article">
                                </div>
                                <div class="chat-info">
                                    <div class="name title-nowrap">Paul Shephard <span class="status online"></span>
                                    </div>
                                    <div class="semi-bold small-size silver-color">29.12.2019</div>
                                    <div class="short-text title-line-cap">Lorem ipsum dolor sit amet, consectetur
                                        adipiscing elit. Vivamus magna. Cras in mi at felis aliquet cong ue. Ut a est
                                        eget ligula molestie.
                                    </div>
                                </div>
                            </a>
                            <a href="" class="chat-item">
                                <div class="avatar">
                                    <img
                                        src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRyCTUFDq2yLfY8ZGid4uxoFLxLeRAJBRH9o_rvMiXd5uSfDlXM&s"
                                        alt="name-article">
                                </div>
                                <div class="chat-info">
                                    <div class="name title-nowrap">Paul Shephard <span class="status online"></span>
                                    </div>
                                    <div class="semi-bold small-size silver-color">29.12.2019</div>
                                    <div class="short-text title-line-cap">Lorem ipsum dolor sit amet, consectetur
                                        adipiscing elit. Vivamus magna. Cras in mi at felis aliquet cong ue. Ut a est
                                        eget ligula molestie.
                                    </div>
                                </div>
                            </a>
                            <a href="" class="chat-item">
                                <div class="avatar">
                                    <img
                                        src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRyCTUFDq2yLfY8ZGid4uxoFLxLeRAJBRH9o_rvMiXd5uSfDlXM&s"
                                        alt="name-article">
                                </div>
                                <div class="chat-info">
                                    <div class="name title-nowrap">Paul Shephard <span class="status online"></span>
                                    </div>
                                    <div class="semi-bold small-size silver-color">29.12.2019</div>
                                    <div class="short-text title-line-cap">Lorem ipsum dolor sit amet, consectetur
                                        adipiscing elit. Vivamus magna. Cras in mi at felis aliquet cong ue. Ut a est
                                        eget ligula molestie.
                                    </div>
                                </div>
                            </a>
                            <a href="" class="chat-item">
                                <div class="avatar">
                                    <img
                                        src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRyCTUFDq2yLfY8ZGid4uxoFLxLeRAJBRH9o_rvMiXd5uSfDlXM&s"
                                        alt="name-article">
                                </div>
                                <div class="chat-info">
                                    <div class="name title-nowrap">Paul Shephard <span class="status online"></span>
                                    </div>
                                    <div class="semi-bold small-size silver-color">29.12.2019</div>
                                    <div class="short-text title-line-cap">Lorem ipsum dolor sit amet, consectetur
                                        adipiscing elit. Vivamus magna. Cras in mi at felis aliquet cong ue. Ut a est
                                        eget ligula molestie.
                                    </div>
                                </div>
                            </a>
                            <a href="" class="chat-item">
                                <div class="avatar">
                                    <img
                                        src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRyCTUFDq2yLfY8ZGid4uxoFLxLeRAJBRH9o_rvMiXd5uSfDlXM&s"
                                        alt="name-article">
                                </div>
                                <div class="chat-info">
                                    <div class="name title-nowrap">Paul Shephard <span class="status online"></span>
                                    </div>
                                    <div class="semi-bold small-size silver-color">29.12.2019</div>
                                    <div class="short-text title-line-cap">Lorem ipsum dolor sit amet, consectetur
                                        adipiscing elit. Vivamus magna. Cras in mi at felis aliquet cong ue. Ut a est
                                        eget ligula molestie.
                                    </div>
                                </div>
                            </a>
                            <a href="" class="chat-item">
                                <div class="avatar">
                                    <img
                                        src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRyCTUFDq2yLfY8ZGid4uxoFLxLeRAJBRH9o_rvMiXd5uSfDlXM&s"
                                        alt="name-article">
                                </div>
                                <div class="chat-info">
                                    <div class="name title-nowrap">Paul Shephard <span class="status online"></span>
                                    </div>
                                    <div class="semi-bold small-size silver-color">29.12.2019</div>
                                    <div class="short-text title-line-cap">Lorem ipsum dolor sit amet, consectetur
                                        adipiscing elit. Vivamus magna. Cras in mi at felis aliquet cong ue. Ut a est
                                        eget ligula molestie.
                                    </div>
                                </div>
                            </a>
                        </div>
                        <a href="" class="box-rounded see-more border-top-0 link d-block">Messages</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
