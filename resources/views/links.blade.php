<div class="btn-group">
    @if(!empty($url_detail))
    <button link="{{ $url_detail }}" class="btn btn-sm btn-success btn-detail btn-action btn-sm btn-flat "><i class='fa fa-eye'></i></button>
    @endif
    @if(!empty($link_show))
    <a href="{{ $link_show }}" class="btn btn-sm btn-success btn-sm btn-flat "><i class='fa fa-eye'></i></a>
    @endif
    @if(!empty($link_edit))
    <a href="{{ $link_edit }}" class="btn btn-sm btn-warning btn-sm btn-flat "><i class='fa fa-edit'></i></a>
    @endif
    @if(!empty($url_view))
    <Button link="{{ $url_view }}" class="btn btn-sm btn btn-success btn-action btn-detail btn-sm btn-flat"><i class='fas fa-fw fa-eye'></i></Button>
    @endif
    @if(!empty($url_edit))
    <button link="{{ $url_edit }}" class='btn btn-sm btn btn-warning btn-edit btn-action btn-sm btn-flat '><i class='fa fa-edit' aria-hidden="true"></i></button>
    @endif
    @if(!empty($url_hapus))
    <button link="{{ $url_hapus }}" class='btn btn-sm btn-danger btn-sm btn-action delete btn-flat '><i class="fas fa-fw  fa-trash" aria-hidden="true"></i></button>

    @endif
    {{-- <button class  = 'btn btn-sm btn-danger btn-sm btn-action'><i class  = 'fa fa-close'></i></button> --}}
</div>