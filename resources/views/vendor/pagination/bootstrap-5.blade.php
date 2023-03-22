@if ($paginator->hasPages())


     <div class="d-flex justify-content-center">
         <p class="small text-muted">
             {!! __('Showing') !!}
             <span class="fw-semibold">{{ $paginator->firstItem() }}</span>
             {!! __('to') !!}
             <span class="fw-semibold">{{ $paginator->lastItem() }}</span>
             {!! __('of') !!}
             <span class="fw-semibold">{{ $paginator->total() }}</span>
             {!! __('results') !!}
         </p>
     </div>

     <div class="d-flex justify-content-center">
         <ul class="pagination">
             {{-- Previous Page Link --}}
             @if ($paginator->onFirstPage())
                 <li class="page-item disabled mx-2" aria-disabled="true" aria-label="@lang('pagination.previous')">
                     <span class="page-link border-0" aria-hidden="true"><i class="fas fa-arrow-left "></i></span>
                 </li>
             @else
                 <li class="page-item mx-2">
                     <a class="page-link border-0" href="{{ $paginator->previousPageUrl() }}" rel="prev"
                        aria-label="@lang('pagination.previous')"><i class="fas fa-arrow-left "></i></a>
                 </li>
             @endif

             @if($paginator->currentPage() > 3)
                 <li class="page-item mx-1 hidden-xs"><a class="page-link" href="{{ $paginator->url(1) }}">1</a></li>
             @endif
             @if($paginator->currentPage() > 4)
                 <li class="page-item mx-1"><span class="page-link">...</span></li>
             @endif
             @foreach(range(1, $paginator->lastPage()) as $i)
                 @if($i >= $paginator->currentPage() - 2 && $i <= $paginator->currentPage() + 2)
                     @if ($i == $paginator->currentPage())
                         <li class="page-item mx-1 active"><span class="page-link">{{ $i }}</span></li>
                     @else
                         <li class="page-item mx-1"><a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
                     @endif
                 @endif
             @endforeach
             @if($paginator->currentPage() < $paginator->lastPage() - 3)
                 <li class="page-item mx-1"><span class="page-link">...</span></li>
             @endif
             @if($paginator->currentPage() < $paginator->lastPage() - 2)
                 <li class="page-item mx-1 hidden-xs"><a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</a></li>
             @endif
{{--             --}}
{{--             --}}{{-- Pagination Elements --}}
{{--             @foreach ($elements as $element)--}}
{{--                 --}}{{-- "Three Dots" Separator --}}
{{--                 @if (is_string($element))--}}
{{--                     <li class="page-item disabled mx-1" aria-disabled="true"><span class="page-link">{{ $element }}</span>--}}
{{--                     </li>--}}
{{--                 @endif--}}

{{--                 --}}{{-- Array Of Links --}}
{{--                 @if (is_array($element))--}}
{{--                     @foreach ($element as $page => $url)--}}
{{--                         @if ($page == $paginator->currentPage())--}}
{{--                             <li class="page-item active mx-1" aria-current="page"><span class="page-link">{{ $page }}</span>--}}
{{--                             </li>--}}
{{--                         @else--}}
{{--                             <li class="page-item mx-1"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>--}}
{{--                         @endif--}}
{{--                     @endforeach--}}
{{--                 @endif--}}
{{--             @endforeach--}}

             {{-- Next Page Link --}}
             @if ($paginator->hasMorePages())
                 <li class="page-item mx-2">
                     <a class="page-link border-0" href="{{ $paginator->nextPageUrl() }}" rel="next"
                        aria-label="@lang('pagination.next')"><i class="fas fa-arrow-right"></i></a>
                 </li>
             @else
                 <li class="page-item disabled mx-2" aria-disabled="true" aria-label="@lang('pagination.next')">
                     <span class="page-link border-0" aria-hidden="true"><i class="fas fa-arrow-right "></i></span>
                 </li>
             @endif
         </ul>
     </div>

@endif
