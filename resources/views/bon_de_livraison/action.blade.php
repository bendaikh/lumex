<span>
    <div class="action-btn bg-primary ms-2">
        <a href="{{ route('bon-de-livraison.pdf', \Crypt::encrypt($bonDeLivraison->id)) }}"
            class="mx-3 btn btn-sm  align-items-center"
            data-bs-toggle="tooltip" title="{{ __('Download') }}"
            data-original-title="{{ __('Download PDF') }}"
            target="_blank">
            <i class="ti ti-download text-white"></i>
        </a>
    </div>
    <div class="action-btn bg-warning ms-2">
        <a href="{{ route('bon-de-livraison.show', \Crypt::encrypt($bonDeLivraison->id)) }}"
            class="mx-3 btn btn-sm  align-items-center"
            data-bs-toggle="tooltip" title="{{ __('Show') }}"
            data-original-title="{{ __('Detail') }}">
            <i class="ti ti-eye text-white text-white"></i>
        </a>
    </div>
    <div class="action-btn bg-danger ms-2">
        {{ Form::open(['route' => ['bon-de-livraison.destroy', $bonDeLivraison->id], 'class' => 'm-0']) }}
        @method('DELETE')
        <a href="#"
            class="mx-3 btn btn-sm  align-items-center bs-pass-para show_confirm"
            data-bs-toggle="tooltip" title=""
            data-bs-original-title="{{__('Delete')}}" aria-label="{{__('Delete')}}"
            data-confirm="{{ __('Are You Sure?') }}"
            data-text="{{ __('This action can not be undone. Do you want to continue?') }}"
            data-confirm-yes="delete-form-{{ $bonDeLivraison->id }}"><i
                class="ti ti-trash text-white text-white"></i></a>
        {{ Form::close() }}
    </div>
</span>
