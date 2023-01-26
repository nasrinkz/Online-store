<section class="pagination">
    <div class="container">
        <div class="row justify-content-center">
            <div class="pagination-group">
                @if ($paginator->hasPages())
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
                            @if ($paginator->onFirstPage())
                                <li class="page-item disabled">
                                    <a class="p_prev" href="#"
                                       tabindex="-1"><svg xmlns="http://www.w3.org/2000/svg" width="9.414" height="16.828" viewBox="0 0 9.414 16.828">
                                            <path id="Icon_feather-chevron-left" data-name="Icon feather-chevron-left" d="M20.5,23l-7-7,7-7" transform="translate(-12.5 -7.586)" fill="none" stroke="#1a2224" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                                        </svg></a>
                                </li>
                            @else
                                <li class="page-item"><a class="p_prev"
                                                         href="{{ $paginator->previousPageUrl() }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="9.414" height="16.828" viewBox="0 0 9.414 16.828">
                                            <path id="Icon_feather-chevron-left" data-name="Icon feather-chevron-left" d="M20.5,23l-7-7,7-7" transform="translate(-12.5 -7.586)" fill="none" stroke="#1a2224" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                                        </svg></a>
                                </li>
                            @endif

                            @foreach ($elements as $element)
                                @if (is_string($element))
                                    <li class="cdp_i disabled">{{ $element }}</li>
                                @endif

                                @if (is_array($element))
                                    @foreach ($element as $page => $url)
                                        @if ($page == $paginator->currentPage())
                                            <a class="cdp_i active">{{ $page }}</a>
                                        @else
                                            <a class="cdp_i "
                                               href="{{ $url }}">{{ $page }}</a>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach

                            @if ($paginator->hasMorePages())
                                <li class="page-item">
                                    <a class="p_next"
                                       href="{{ $paginator->nextPageUrl() }}"
                                       rel="next"><svg xmlns="http://www.w3.org/2000/svg" width="9.414" height="16.829" viewBox="0 0 9.414 16.829">
                                            <g id="Arrow" transform="translate(1.414 15.414) rotate(-90)">
                                                <path id="Arrow-2" data-name="Arrow" d="M1474.286,26.4l7,7,7-7" transform="translate(-1474.286 -26.4)" fill="none" stroke="#1a2224" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                                            </g>
                                        </svg></a>
                                </li>
                            @else
                                <li class="page-item disabled">
                                    <a class="p_next" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="9.414" height="16.829" viewBox="0 0 9.414 16.829">
                                            <g id="Arrow" transform="translate(1.414 15.414) rotate(-90)">
                                                <path id="Arrow-2" data-name="Arrow" d="M1474.286,26.4l7,7,7-7" transform="translate(-1474.286 -26.4)" fill="none" stroke="#1a2224" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                                            </g>
                                        </svg></a>
                                </li>
                            @endif
                        </ul>
                    </nav>
                @endif
            </div>
        </div>
    </div>
</section>
