@props(['data'])

<ul class="paginate">
    @if ($data->lastPage() > 1)
        <li class="arrow-paginate">
            <a href="{{ $data->previousPageUrl() }}" rel="prev">
                <i class="fa-solid fa-angle-left"></i>
            </a>
        </li>
        <li class="{{ ($data->currentPage() == 1) ? ' paginate-active' : '' }}">
            <a href="{{ $data->url($data->onFirstPage()) }}">1</a>
        </li>
        <?php
            $start = $data->currentPage() - 2;
            $end = $data->currentPage() + 2;
            if ($start < 1) {
                $start = 1;
                $end += 1;
            } 
            if ($end >= $data->lastPage()) {
                $end = $data->lastPage();
            }
        ?>
        @if ($data->currentPage() > 3)
            <li><span>...</span></li>
        @endif
        @for ($i = $start + 1; $i < $end; $i++)
                <li class="{{ ($data->currentPage() == $i) ? ' paginate-active' : '' }}">
                    <a href="{{ $data->url($i) }}">{{$i}}</a>
                </li>
        @endfor
        @if ($data->currentPage()+2 < $data->lastPage())
            <li><span>...</span></li>
        @endif
        <li class="{{ ($data->currentPage() == $data->lastPage()) ? ' paginate-active' : '' }}">
            <a href="{{ $data->url($data->lastPage()) }}">{{ $data->lastPage() }}</a>
        </li>
        <li class="arrow-paginate">
            <a href="{{ $data->nextPageUrl() }}" rel="next">
                <i class="fa-solid fa-angle-right"></i>
            </a>
        </li>
    @endif
</ul>
